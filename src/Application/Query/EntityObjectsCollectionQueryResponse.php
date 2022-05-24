<?php

namespace xVer\Bundle\DomainBundle\Application\Query;

use xVer\Bundle\DomainBundle\Domain\EntityObjectInterface;
use xVer\Bundle\DomainBundle\Domain\EntityObjectsCollection;

/**
 * @template TEntity of EntityObjectInterface
 */
class EntityObjectsCollectionQueryResponse
{
    private bool $hasNextPage = false;
    private bool $hasPrevPage = false;

    /**
     * @param EntityObjectsCollection<TEntity> $collection
     */
    public function __construct(
        protected EntityObjectsCollection $collection,
        int $limit = 0,
        private readonly int $page = 0
    ) {
        if (0 < $limit && $this->collection->count() > $limit) {
            /** @var EntityObjectsCollection<TEntity> */
            $this->collection = new EntityObjectsCollection($this->collection->slice(0, $limit));
            $this->hasNextPage = true;
        }
        $this->hasPrevPage = $this->page > 0;
    }

    /**
     * @return EntityObjectsCollection<TEntity>
     */
    public function getCollection(): EntityObjectsCollection
    {
        return $this->collection;
    }

    public function getHasNextPage(): bool
    {
        return $this->hasNextPage;
    }

    public function getHasPrevPage(): bool
    {
        return $this->hasPrevPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
