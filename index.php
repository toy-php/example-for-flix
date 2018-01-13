<?php


error_reporting(E_ALL);

ini_set("display_errors", 1);
include 'vendor/autoload.php';


$c = include 'app/Domain/Application/bootstrap.php';

/** @var \app\Domain\Services\Interfaces\UserCardServiceInterface $userCardService */
$userCardService = $c[\app\Domain\Services\Interfaces\UserCardServiceInterface::class];


/*
 * Получаем существующий агрегат
 */
$userCard = $userCardService->getById(1, function (\app\Domain\Mappers\UserCardMapper $mapper){
    return $mapper->withContacts();
});

var_dump($userCard->contacts->email);


/*
 * Создаем новый агрегат
 */

/** @var \app\Domain\Aspects\UserCard\UserCard $userCard */
$userCard = \app\Domain\Factories\UserCardFactory::create('baz', 'secret')
    ->withContacts('baz@bar.com')
    ->getAggregate();

var_dump($userCard->contacts->email);