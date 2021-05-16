<?php

function linked_anim()
{
    @symlink(__DIR__ . '/var/anim', __DIR__ . '/../public/anim');
}

function composer()
{
    $dir = __DIR__ . '/../';

    if (file_exists($dir . 'composer.phar')) {
        @unlink($dir . 'composer-setup.php');
    } else {
        copy('https://getcomposer.org/installer', $dir. 'composer-setup.php');

        include $dir. 'composer-setup.php';

        unlink($dir. 'composer-setup.php');
    }

    shell_exec("cd $dir && php7.3 composer.phar install --no-dev");
}

composer();
linked_anim();
