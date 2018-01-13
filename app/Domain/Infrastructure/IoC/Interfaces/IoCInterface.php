<?php

namespace app\Domain\Infrastructure\IoC\Interfaces;

use app\Domain\Infrastructure\Middleware\Interfaces\MiddlewareInterface;

interface IoCInterface
{

    /**
     * Проверка и получение необходимых значений
     * @param array $params
     * @return array
     */
    public function required(array $params);

    /**
     * Расширить зарегистрированную функцию
     * @param $name
     * @return MiddlewareInterface
     */
    public function extend($name): MiddlewareInterface;

    /**
     * Получить сырые данные
     * @param string $name
     * @return mixed
     */
    public function getRaw(string $name);

    /**
     * Объявить функцию фабрикой
     * @param $callable
     * @return void
     */
    public function factory($callable);

}