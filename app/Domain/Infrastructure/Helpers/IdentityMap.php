<?php

namespace app\Domain\Infrastructure\Helpers;

use app\Domain\Base\Exceptions\Exception;
use app\Domain\Base\Interfaces\Identity;

class IdentityMap
{

    protected $function;
    protected $items = [];

    public function __construct(callable $function = null)
    {
        $this->function = $function ?: function(Identity $identity){
            return $identity->getId();
        };
    }

    /**
     * Получить идентификатор сущности
     * @param $object
     * @return mixed
     * @throws Exception
     */
    public function getId($object)
    {
        $function = $this->function;
        $id = $function($object);
        if (empty($id)) {
            throw new Exception('Не определен идентификатор сущности');
        }
        return $id;
    }

    /**
     * Получить сущность, если имеется в карте
     * иначе сохранить в карту
     * @param $object
     * @return mixed
     * @throws Exception
     */
    public function getObject($object)
    {
        $id = $this->getId($object);
        if ($this->hasObject($object)) {
            return $this->items[$id];
        }
        return $this->items[$id] = $object;
    }

    /**
     * Проверить наличие сущности в карте
     * @param $object
     * @return bool
     */
    public function hasObject($object): bool
    {
        $id = $this->getId($object);
        return isset($this->items[$id]);
    }

    /**
     * Очистить карту
     * @return $this
     */
    public function clear()
    {
        $this->items = [];
        return $this;
    }
}