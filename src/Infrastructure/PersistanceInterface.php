<?php

namespace xVer\Bundle\DomainBundle\Infrastructure;

use xVer\Bundle\DomainBundle\Domain\EntityInterface;

interface PersistanceInterface
{
    public function emPersist(EntityInterface $object): self;

    public function emFlush(): self;

    public function emRemove(EntityInterface $object): self;

    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;
}
