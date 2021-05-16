<?php

use App\Contracts\ImageRepository;
use App\Exceptions\AppExceptionHandler;
use App\Http\Routes\WebRoutes;
use App\Repositories\CacheImageRepository;
use ArtARTs36\PushAllSender\Interfaces\PusherInterface;
use ArtARTs36\PushAllSender\Senders\PushAllSender;
use Core\Cache\Cache;
use Core\Cache\Contracts\CacheManager;
use Core\Console\ConsolePrinter;
use Core\Console\Contracts\ConsoleKernel;
use Core\Console\Contracts\ConsoleOutput;
use Core\Console\Kernel;
use Core\DependencyInjection\ContainerBuilder;
use Core\DependencyInjection\Contracts\Container;
use Core\Environment\Contracts\EnvFetcher;
use Core\Environment\Contracts\Environment;
use Core\Environment\EnvInstaller;
use Core\Environment\File\FileEnvFetcher;
use Core\Exception\Contracts\ExceptionHandler;
use Core\FileSystem\Contracts\FileSystem;
use Core\FileSystem\LocalFileSystem;
use Core\Http\Router;
use Core\Log\Logger;
use Core\View\Contracts\Viewer;
use Core\View\RegexViewer;
use Psr\Log\LoggerInterface;

$container = (new ContainerBuilder())
    ->build()
    ->bind(CacheManager::class, function () {
        return new Cache(__DIR__ . '/../var/cache');
    })
    ->after(Router::class, function (Router $router) {
        (new WebRoutes())->applyRoutes($router);
    })
    ->bind(Viewer::class, function () {
        return new RegexViewer(__DIR__ . '/../views');
    })
    ->bind(PushAllSender::class, function (Container $container) {
        /** @var Environment $env */
        $env = $container->get(Environment::class);

        return new PushAllSender($env->get('PUSHALL_CHANNEL_ID'), $env->get('PUSHALL_API_KEY'));
    })
    ->bind(Logger::class, function () {
        return new Logger(__DIR__ . '/../var/logs');
    })
    ->contract(PusherInterface::class, PushAllSender::class)
    ->contract(ImageRepository::class, CacheImageRepository::class)
    ->contract(ExceptionHandler::class, AppExceptionHandler::class)
    ->contract(ConsoleKernel::class, Kernel::class)
    ->contract(ConsoleOutput::class, ConsolePrinter::class)
    ->contract(EnvFetcher::class, FileEnvFetcher::class)
    ->contract(LoggerInterface::class, Logger::class)
    ->contract(FileSystem::class, LocalFileSystem::class);

$container
    ->make(EnvInstaller::class)
    ->fromContainer($container, __DIR__ . '/../.env');

return $container;
