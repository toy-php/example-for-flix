<?php

declare(strict_types=1);

namespace app\Domain\Infrastructure\Container;

use app\Domain\Base\Exceptions\Exception;
use app\Domain\Infrastructure\Container\Interfaces\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var \ArrayObject
     */
    protected $frozen;

    /**
     * @var \ArrayObject
     */
    protected $values;

    /**
     * @var \SplObjectStorage
     */
    protected $factories;

    /**
     * @var boolean
     */
    protected $frozenValues;

    public function __construct(array $defaults = [], $frozenValues = true)
    {
        $this->frozen = new \ArrayObject();
        $this->values = new \ArrayObject($defaults);
        $this->factories = new \SplObjectStorage();
        $this->frozenValues = $frozenValues;
    }

    /**
     * Проверка защищенности значения от изменений
     * @param $name
     * @throws Exception
     */
    private function checkFrozen($name)
    {
        if(!$this->frozenValues){
            return;
        }
        if($this->frozen->offsetExists($name)){
            throw new Exception(
                printf('Параметр "%s" был использован ' .
                    'и теперь защищен от изменения', $name)
            );
        }
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function offsetSet($name, $value)
    {
        if(is_null($name)){
            $this->values[] = $value;
            return;
        }
        $this->checkFrozen($name);
        $this->values[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($name)
    {
        if(is_null($name)){
            return null;
        }
        $value = $this->values->offsetExists($name)
            ? $this->frozen[$name] = $this->values[$name]
            : null;
        if (!is_object($value)
            or !method_exists($value, '__invoke')) {
            return $value;
        }
        return (isset($this->factories[$value]))
            ? $value($this)
            : $this->values[$name] = $value($this);
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($name):bool
    {
        if(is_null($name)){
            return false;
        }
        return isset($this->values[$name]);
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($name)
    {
        if(is_null($name)){
            return;
        }
        $this->checkFrozen($name);
        if ($this->offsetExists($name)) {
            $value = $this->values[$name];
            if (!is_object($value)
                or !method_exists($value, '__invoke')) {
                $this->factories->detach($value);
            }
            $this->values->offsetUnset($name);
        }
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        $keys = array_keys($this->values->getArrayCopy());
        $result = [];
        foreach ($keys as $key) {
            $value = $this[$key];
            $result[$key] = ($value instanceof ContainerInterface)
                ? $value->toArray()
                : $value;
        }
        return $result;
    }
}