<?php

namespace app\Domain\Infrastructure\Helpers;

class PageLimit
{

    public $offset;
    public $limit;

    public function __construct(int $page, int $limit, int $maxLimit = 50)
    {
        $this->limit = $this->getLimit($limit, $maxLimit);
        $this->offset = $this->getOffset($page, $this->limit);
    }

    /**
     * Получить лимит
     * @param int $limit
     * @param int $maxLimit
     * @return int
     */
    protected function getLimit(int $limit, int $maxLimit = 50): int
    {
        return ($limit > 0 and $limit < $maxLimit) ? $limit : $maxLimit;
    }

    /**
     * Получить сдвиг
     * @param int $page
     * @param int $limit
     * @return int
     */
    protected function getOffset(int $page, int $limit): int
    {
        return $page * $limit;
    }

}