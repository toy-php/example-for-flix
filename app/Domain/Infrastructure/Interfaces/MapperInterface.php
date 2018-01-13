<?php

namespace app\Domain\Infrastructure\Interfaces;

use app\Domain\Base\Interfaces\AggregateInterface;
use app\Domain\Base\Interfaces\CollectionInterface;
use SplSubject;

interface MapperInterface extends \SplObserver
{

    /**
     * Найти по идентификатору
     * @param int $id
     * @return MapperInterface
     */
    public function byId(int $id): MapperInterface;

    /**
     * Установить агрегат
     * @param AggregateInterface $aggregate
     * @return $this
     */
    public function setAggregate(AggregateInterface $aggregate): MapperInterface;

    /**
     * Получить агрегат
     * @return AggregateInterface|null
     */
    public function getAggregate(): ?AggregateInterface;

    /**
     * Получить коллекцию агрегатов
     * @return CollectionInterface|AggregateInterface[]
     */
    public function getCollection(): CollectionInterface;

    /**
     * Обновить состояние источника данных
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject);

}