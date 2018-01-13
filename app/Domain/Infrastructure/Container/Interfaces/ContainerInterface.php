<?php

namespace app\Domain\Infrastructure\Container\Interfaces;

interface ContainerInterface extends \ArrayAccess
{
    /**
     * Проверка наличия значения в контейнере по ключу
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool;

    /**
     * Получить значение контейнера по ключу
     * если значением является исполняемая фунция,
     * то возвращается результат её выполнения
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset);

    /**
     * Добавить значение в контейнер
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet($offset, $value);

    /**
     * Исключить значение из контейнера по ключу
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset);

}