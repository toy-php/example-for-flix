<?php

namespace app\Domain\Factories;

use app\Domain\Aspects\UserCard\UserCard;
use app\Domain\Builders\UserCardBuilder;

class UserCardFactory
{

    static public function create(string $login, string $password): UserCardBuilder
    {
        /*
         * В источнике данных создаем запись и получаем идентификатор
         */
        $id = 2;
        return new UserCardBuilder(new UserCard($id, $login, $password));
    }
}