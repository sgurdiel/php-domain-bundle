<?php

namespace xVer\Bundle\DomainBundle\Application\Query;

class QueryResponse
{
    private bool $nextPage = false;
    private bool $prevPage = false;

    /**
     * @param Object[] $objects
     */
    public function __construct(private array $objects, ?int $limit, private int $page = 0)
    {
        if (!is_null($limit) && count($this->objects) > $limit) {
            $this->nextPage = true;
            $this->objects = array_slice($this->objects, 0, -1);
        }
        $this->prevPage = ($this->page > 0);
    }

    /**
     * @return Object[]
     */
    public function getObjects(): array
    {
        return $this->objects;
    }

    public function getNextPage(): bool
    {
        return $this->nextPage;
    }

    public function getPrevPage(): bool
    {
        return $this->prevPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
