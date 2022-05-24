<?php

namespace xVer\Bundle\DomainBundle\Domain;

interface EntityObjectInterface
{
    public function sameId(EntityObjectInterface $otherEntityObject): bool;
}
