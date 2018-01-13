<?php

namespace app\Domain\Builders;

use app\Domain\Base\Interfaces\AggregateInterface;
use app\Domain\Infrastructure\Interfaces\MapperInterface;

abstract class AbstractBuilder
{

    protected $mapper;

    public function __construct(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Установить агрегат
     * @param AggregateInterface $aggregate
     * @return $this|AbstractBuilder
     */
    protected function setAggregate(AggregateInterface $aggregate): AbstractBuilder
    {
        $this->mapper->setAggregate($aggregate);
        return $this;
    }

    /**
     * Получить агрегат
     * @return AggregateInterface
     */
    public function getAggregate(): AggregateInterface
    {
        return $this->mapper->getAggregate();
    }
}