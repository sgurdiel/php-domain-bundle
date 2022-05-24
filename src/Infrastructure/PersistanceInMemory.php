<?php

namespace xVer\Bundle\DomainBundle\Infrastructure;

use xVer\Bundle\DomainBundle\Domain\EntityInterface;

abstract class PersistanceInMemory implements PersistanceInterface
{
    /** @var EntityInterface[] */
    private array $persistedObjects = [];
    /** @var EntityInterface[] */
    private array $createObjectsPending = [];
    /** @var EntityInterface[] */
    private array $updateObjectsPending = [];
    /** @var EntityInterface[] */
    private array $deleteObjectsPending = [];
    private int $lastExistPointer = 0;

    public function emPersist(EntityInterface $object): self
    {
        if ($this->checkExists($object, $this->persistedObjects)) {
            $this->updateObjectsPending[$this->lastExistPointer] = $object;
            if ($this->checkExists($object, $this->deleteObjectsPending)) {
                unset($this->deleteObjectsPending[$this->lastExistPointer]);
            }
        } else {
            if ($this->checkExists($object, $this->createObjectsPending)) {
                $this->createObjectsPending[$this->lastExistPointer] = $object;
            } else {
                $this->createObjectsPending[] = $object;
            }
        }

        return $this;
    }

    public function emFlush(): self
    {
        foreach ($this->deleteObjectsPending as $item) {
            if ($this->checkExists($item, $this->persistedObjects)) {
                unset($this->persistedObjects[$this->lastExistPointer]);
            }
        }
        foreach ($this->createObjectsPending as $item) {
            $this->persistedObjects[] = $item;
        }
        foreach ($this->updateObjectsPending as $item) {
            if ($this->checkExists($item, $this->persistedObjects)) {
                $this->persistedObjects[$this->lastExistPointer] = $item;
            }
        }
        $this->updateObjectsPending = [];
        $this->createObjectsPending = [];
        $this->deleteObjectsPending = [];

        return $this;
    }

    public function emRemove(EntityInterface $object): self
    {
        if ($this->checkExists($object, $this->persistedObjects)) {
            if ($this->checkExists($object, $this->deleteObjectsPending)) {
                $this->deleteObjectsPending[$this->lastExistPointer] = $object;
            } else {
                $this->deleteObjectsPending[] = $object;
            }
        }
        return $this;
    }

    /**
     * @param EntityInterface[] $haystack
     */
    private function checkExists(EntityInterface $needle, array $haystack): bool
    {
        $found = false;
        foreach ($haystack as $key => $item) {
            if ($needle->sameId($item)) {
                $this->lastExistPointer = (int) $key;
                $found = true;
                break;
            }
        }
        return $found;
    }

    /**
     * @return EntityInterface[]
     */
    public function getPersistedObjects(): array
    {
        return $this->persistedObjects;
    }

    public function beginTransaction(): void
    {
    }

    public function commit(): void
    {
    }

    public function rollback(): void
    {
    }
}
