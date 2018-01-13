<?php

namespace app\Domain\Builders;

use app\Domain\Base\Interfaces\AggregateInterface;

abstract class AbstractBuilder
{

    protected $aggregate;

    public function __construct(AggregateInterface $aggregate)
    {
        $this->setAggregate($aggregate);
    }

    /**
     * Установить агрегат
     * @param AggregateInterface $aggregate
     * @return $this|AbstractBuilder
     */
    protected function setAggregate(AggregateInterface $aggregate): AbstractBuilder
    {
        $this->aggregate = $aggregate->withCleanState();
        return $this;
    }

    /**
     * Получить агрегат
     * @return AggregateInterface
     */
    public function getAggregate(): AggregateInterface
    {
        return $this->aggregate;
    }
}