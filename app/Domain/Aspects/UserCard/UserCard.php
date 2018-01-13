<?php

namespace app\Domain\Aspects\UserCard;

use app\Domain\Base\Aggregate;

/**
 * Class UserCard
 * @package app\Domain\Aspects\UserCard
 *
 * Тут описание нужно чтобы IDE понимала
 *
 * Гетеры опиывать можно как свойства
 * @property string $login
 * @property string $password
 * @property Contacts $contacts
 *
 * Остальные методы
 * @method UserCard withLogin(string $login)
 * @method bool hasLogin()
 * @method UserCard withPassword(string $login)
 * @method bool hasPassword()
 * @method UserCard withContacts(Contacts $contacts)
 * @method bool hasContacts()
 */
class UserCard extends Aggregate
{

    /**
     * Тут описание нужно для проверки типа передаваемых данных
     *
     * Определяем тип данных, будет происходить проверка типа в методе with
     * @var string
     */
    protected $login;

    /**
     * Можно не определять тип, тогда проверки не будет
     */
    protected $password;

    /**
     * Можно определять инстанс
     * @var Contacts
     */
    protected $contacts;

    /**
     * UserCard constructor.
     *
     * Так же тип данных задается через конструктор
     * Передав двнные в объект определенного типа,
     * потом происходит проверка типа новых данных с существующими
     * этому типу проверки отдается бОльший приоритет, чем типу указанному в док блоке
     *
     * @param int $id
     * @param string $login
     * @param string $password
     */
    public function __construct(int $id, string $login, string $password)
    {
        parent::__construct($id);
        $this->login = $login;
        $this->password = $password;
    }

}