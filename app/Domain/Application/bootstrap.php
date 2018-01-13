<?php

$c = new \app\Domain\Infrastructure\IoC\IoC();

\app\Domain\Repositories\UserCardRepository::register($c);

\app\Domain\Services\UserCardService::register($c);

return $c;