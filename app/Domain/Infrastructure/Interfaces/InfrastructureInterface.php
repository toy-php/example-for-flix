<?php

namespace app\Domain\Infrastructure\Interfaces;

use app\Domain\Infrastructure\IoC\Interfaces\IoCInterface;

interface InfrastructureInterface
{

    /**
     * Зарегистрировать инфраструктурный сервис
     * в контейнере зависимостей
     * @param IoCInterface $c
     * @return void
     */
    static public function register(IoCInterface $c);
}