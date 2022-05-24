<?php

namespace xVer\Bundle\DomainBundle\Domain;

interface EntityObjectRepositoryInterface
{
    public function flush(): void;

    public function beginTransaction(): void;

    public function commit(): void;

    public function rollBack(): void;
}
