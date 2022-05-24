<?php

namespace xVer\Bundle\DomainBundle\Infrastructure\Account;

use xVer\Bundle\DomainBundle\Domain\Account\AccountInterface;
use xVer\Bundle\DomainBundle\Infrastructure\RepositoryInterface;

interface AccountRepositoryInterface extends RepositoryInterface
{
    public function findByIdentifier(string $identifier): ?AccountInterface;
}
