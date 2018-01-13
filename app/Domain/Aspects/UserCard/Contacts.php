<?php

namespace app\Domain\Aspects\UserCard;

use app\Domain\Base\ValueObject;

/**
 * Class Contacts
 * @package app\Domain\Aspects\UserCard
 *
 * @property string $email
 *
 * @method Contacts withContacts(string $contacts)
 * @method bool hasContacts()
 *
 */
class Contacts extends ValueObject
{

    /**
     * @var string
     */
    protected $email;

    public function __construct(string $email)
    {
        parent::__construct();
        $this->email = $email;
    }
}