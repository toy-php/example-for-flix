<?php

namespace app\Domain\Repositories;

use app\Domain\Aspects\UserCard\UserCard;
use app\Domain\Infrastructure\Interfaces\MapperInterface;
use app\Domain\Infrastructure\IoC\Interfaces\IoCInterface;
use app\Domain\Infrastructure\Repository;
use app\Domain\Mappers\UserCardMapper;
use app\Domain\Repositories\Interfaces\UserCardRepositoryInterface;

class UserCardRepository extends Repository implements UserCardRepositoryInterface
{

    /**
     * Зарегистрировать инфраструктурный сервис
     * в контейнере зависимостей
     * @param IoCInterface $c
     * @return void
     */
    static public function register(IoCInterface $c)
    {
        $c[UserCardRepositoryInterface::class] = function (){
            return new static();
        };
    }

    /**
     * Получить класс агрегата
     * @return string
     */
    public function getAggregateClass(): string
    {
        return UserCard::class;
    }

    /**
     * Найти агрегат
     * @return MapperInterface|UserCardMapper
     */
    public function find(): MapperInterface
    {
        return new UserCardMapper($this->getAggregateClass());
    }
}