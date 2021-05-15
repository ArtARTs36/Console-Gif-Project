<?php

namespace Core\DependencyInjection\Exceptions;

use Throwable;

class DependencyResolutionFailed extends \Exception
{
    private $failedParameterPosition;

    private $failedDependency;

    private $failedParameterType;

    public function __construct(
        string $parameterPosition,
        string $parameterType,
        string $dependency,
        $code = 0,
        ?Throwable $previous = null
    ) {
        $this->failedParameterPosition = $parameterPosition;
        $this->failedDependency = $dependency;
        $this->failedParameterType = $parameterType;

        $message = "Не удалось внедрить зависимость [$parameterPosition] $parameterType в $dependency";

        parent::__construct($message, $code, $previous);
    }

    public function getFailedParameterPosition(): string
    {
        return $this->failedParameterPosition;
    }

    public function getFailedDependency(): string
    {
        return $this->failedDependency;
    }

    public function getFailedParameterType(): string
    {
        return $this->failedParameterType;
    }
}
