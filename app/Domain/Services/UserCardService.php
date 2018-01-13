<?php

namespace app\Domain\Services;

use app\Domain\Aspects\UserCard\UserCard;
use app\Domain\Infrastructure\IoC\Interfaces\IoCInterface;
use app\Domain\Mappers\UserCardMapper;
use app\Domain\Repositories\Interfaces\UserCardRepositoryInterface;
use app\Domain\Services\Interfaces\UserCardServiceInterface;

class UserCardService implements UserCardServiceInterface
{

    protected $userCardRepository;

    public function __construct(UserCardRepositoryInterface $userCardRepository)
    {
        $this->userCardRepository = $userCardRepository;
    }

    /**
     * Найти по идентификатору
     * @param int $id
     * @param callable $function через функцию указываем с какими сущностями собрать агрегат
     * @return UserCard|null
     */
    public function getById(int $id, callable $function = null): ?UserCard
    {
        $function = $function ?: function(UserCardMapper $mapper){
            return $mapper;
        };

        $mapper = $this->userCardRepository->find()->byId($id);
        return $function($mapper)->getAggregate();
    }

    /**
     * Зарегистрировать инфраструктурный сервис
     * в контейнере зависимостей
     * @param IoCInterface $c
     * @return void
     */
    static public function register(IoCInterface $c)
    {
        $c[UserCardServiceInterface::class] = function (IoCInterface $c){
            $userCardRepository = $c[UserCardRepositoryInterface::class];
            return new static($userCardRepository);
        };
    }
}