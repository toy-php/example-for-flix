<?php

namespace app\Domain\Factories;

use app\Domain\Aspects\UserCard\UserCard;
use app\Domain\Builders\UserCardBuilder;
use app\Domain\Mappers\UserCardMapper;

class UserCardFactory
{

    /**
     * @param string $login
     * @param string $password
     * @return UserCardBuilder
     * @throws \app\Domain\Base\Exceptions\Exception
     */
    static public function create(string $login, string $password): UserCardBuilder
    {
        /*
         * В источнике данных создаем запись и получаем идентификатор
         */
        $id = 2;

        $mapper = new UserCardMapper(UserCard::class);
        $mapper->setAggregate(new UserCard($id, $login, $password));
        return new UserCardBuilder($mapper);
    }


}