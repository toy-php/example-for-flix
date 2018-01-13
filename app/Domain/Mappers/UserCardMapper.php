<?php

namespace app\Domain\Mappers;

use app\Domain\Aspects\UserCard\Contacts;
use app\Domain\Aspects\UserCard\UserCard;
use app\Domain\Base\Exceptions\Exception;
use app\Domain\Base\Interfaces\AggregateInterface;
use app\Domain\Infrastructure\AbstractMapper;
use app\Domain\Infrastructure\Interfaces\MapperInterface;

class UserCardMapper extends AbstractMapper
{

    protected $data = [
        1 => [
            'login' => 'foo',
            'password' => 'secret',
            'contacts' => [
                'email' => 'foo@bar.com'
            ]
        ]
    ];

    /**
     * Сохранить агрегат
     * @param AggregateInterface $aggregate
     * @return void
     */
    protected function save(AggregateInterface $aggregate)
    {
        /*
         * Тут происходит сохранение агрегата
         */
    }

    /**
     * Удалить агрегат
     * @param AggregateInterface $aggregate
     * @return void
     */
    protected function remove(AggregateInterface $aggregate)
    {
        /*
         * Тут происходит сохранение агрегата
         */
    }

    /**
     * Найти по идентификатору
     * @param int $id
     * @return MapperInterface
     * @throws Exception
     */
    public function byId(int $id): MapperInterface
    {
        if (isset($this->data[$id])){
            $data = $this->data[$id];
            $aggregate = new UserCard($id, $data['login'], $data['password']);
            $this->setAggregate($aggregate);
        }
        return $this;
    }

    /**
     * Получить с контактами
     * @return MapperInterface
     * @throws Exception
     */
    public function withContacts(): MapperInterface
    {
        /** @var UserCard $aggregate */
        $aggregate = $this->getAggregate();
        if (empty($aggregate)){
            return $this;
        }
        $id = $aggregate->getId();
        if (isset($this->data[$id]['contacts'])){
            $data = $this->data[$id]['contacts'];
            $contacts = new Contacts($data['email']);
            $aggregate = $aggregate->withContacts($contacts);
            $this->setAggregate($aggregate);
        }
        return $this;
    }

}