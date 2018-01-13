<?php

namespace app\Domain\Builders;

use app\Domain\Aspects\UserCard\Contacts;
use app\Domain\Aspects\UserCard\UserCard;

class UserCardBuilder extends AbstractBuilder
{


    public function withContacts(string $email): UserCardBuilder
    {
        /*
         * Тут сохраняем в источнике данных информацию о контактах
         */

        /** @var UserCard $aggregate */
        $aggregate = $this->getAggregate();
        $aggregate = $aggregate->withContacts(new Contacts($email));
        $this->setAggregate($aggregate);
        return $this;
    }

}