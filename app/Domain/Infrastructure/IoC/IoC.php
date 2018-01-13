<?php

declare(strict_types=1);

namespace app\Domain\Infrastructure\IoC;

use app\Domain\Base\Exceptions\Exception;
use app\Domain\Infrastructure\Container\Container;
use app\Domain\Infrastructure\Middleware\Middleware;
use app\Domain\Infrastructure\IoC\Interfaces\IoCInterface;
use app\Domain\Infrastructure\Middleware\Interfaces\MiddlewareInterface;

class IoC extends Container implements IoCInterface
{

    public function offsetSet($name, $value)
    {
        if(is_callable($value)){
            $value = $this->createMiddleware($value);
        }
        parent::offsetSet($name, $value);
    }

    /**
     * Фабричный метод создания Middleware объекта
     * @param callable $function
     * @return Middleware
     */
    protected function createMiddleware(callable $function)
    {
        return new Middleware($function);
    }

    /**
     * Проверка и получение необходимых компонент
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function required(array $params)
    {
        $result = [];
        foreach ($params as $name => $param) {
            switch (gettype($name)) {
                case 'string':
                    if (!$this->offsetExists($name)) {
                        throw new Exception(
                            sprintf('Необходимый компонент %s ' .
                                'не зарегистрирован в ядре', $name)
                        );
                    }
                    $value = $this->offsetGet($name);
                    if (!$value instanceof $param) {
                        throw new Exception(
                            sprintf('Компонент %s не реализует ' .
                                'необходимый интерфейс "%s"', $name, $param)
                        );
                    }
                    $result[$name] = $value;
                    break;
                case 'integer':
                    if (!$this->offsetExists($param)) {
                        throw new Exception(
                            sprintf('Необходимый компонент %s ' .
                                'не зарегистрирован в ядре', $param)
                        );
                    }
                    $result[$name] = $this->offsetGet($param);
                    break;
                default:
                    throw new Exception('Неверный тип ключа');
            }
        }
        return $result;
    }

    /**
     * Расширить зарегистрированную функцию
     * @param $name
     * @return MiddlewareInterface
     * @throws Exception
     */
    public function extend($name): MiddlewareInterface
    {
        if($this->offsetExists($name)){
            $value = $this->getRaw($name);
            if($value instanceof MiddlewareInterface){
                return $value;
            }
            throw new Exception('Значение не является функцией');
        }
        throw new Exception(sprintf('Значение по ключу "%s" ' .
            'не найдено', $name));
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function getRaw(string $name)
    {
        if (!$this->offsetExists($name)) {
            throw new Exception(sprintf('Ключ "%s" не найден', $name));
        }
        return $this->values[$name];
    }

    /**
     * @inheritdoc
     */
    public function factory($callable)
    {
        if (!is_object($callable)
            or !method_exists($callable, '__invoke')) {
            throw new Exception('Неверная функция');
        }
        $this->factories->attach($callable);
    }
}