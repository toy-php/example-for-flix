<?php

declare(strict_types=1);

namespace app\Domain\Infrastructure;

use app\Domain\Base\Exceptions\Exception;
use app\Domain\Base\Interfaces\AggregateInterface;
use app\Domain\Infrastructure\Interfaces\MapperInterface;
use app\Domain\Infrastructure\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{

    /**
     * Получить класс агрегата
     * @return string
     */
    abstract public function getAggregateClass(): string;

    /**
     * Проверка типа объекта
     * @param AggregateInterface $aggregate
     * @throws Exception
     */
    protected function checkType(AggregateInterface $aggregate)
    {
        $aggregateType = $this->getAggregateClass();
        if (!$aggregate instanceof $aggregateType) {
            throw new Exception('Неверный тип объекта');
        }
    }

    /**
     * Найти агрегат
     * @return MapperInterface
     */
    abstract public function find(): MapperInterface;

    /**
     * Сохранить агрегат
     * @param AggregateInterface $aggregate
     * @return void
     * @throws Exception
     */
    public function save(AggregateInterface $aggregate)
    {
        $this->checkType($aggregate);
        $aggregate->notify();
    }

    /**
     * Удалить агрегат
     * @param AggregateInterface $aggregate
     * @return void
     * @throws Exception
     */
    public function remove(AggregateInterface $aggregate)
    {
        $this->checkType($aggregate);
        $aggregate->withRemovedState()->notify();
    }

}