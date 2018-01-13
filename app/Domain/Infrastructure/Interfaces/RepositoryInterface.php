<?php

namespace app\Domain\Infrastructure\Interfaces;

use app\Domain\Base\Interfaces\AggregateInterface;

interface RepositoryInterface extends InfrastructureInterface
{

    /**
     * Найти агрегат
     * @return MapperInterface
     */
    public function find(): MapperInterface;

    /**
     * Сохранить агрегат
     * @param AggregateInterface $aggregate
     * @return void
     */
    public function save(AggregateInterface $aggregate);

    /**
     * Удалить агрегат
     * @param AggregateInterface $aggregate
     * @return void
     */
    public function remove(AggregateInterface $aggregate);


}