<?php

namespace xVer\Bundle\DomainBundle\Domain\Account;

use xVer\Bundle\DomainBundle\Domain\EntityInterface;

interface AccountInterface extends EntityInterface
{
    public function getEmail(): string;

    /** 
     * @return array<string>
     */
    public function getRoles(): array;

    public function getPassword(): string;
}