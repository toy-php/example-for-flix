<?php

namespace app\Domain\Services\Interfaces;

use app\Domain\Aspects\UserCard\UserCard;
use app\Domain\Infrastructure\Interfaces\ServiceInterface;

interface UserCardServiceInterface extends ServiceInterface
{

    /**
     * Найти по идентификатору
     * @param int $id
     * @param callable $function через функцию указываем с какими сущностями собрать агрегат
     * @return UserCard|null
     */
    public function getById(int $id, callable $function = null): ?UserCard;

}