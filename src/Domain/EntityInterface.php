<?php

namespace xVer\Bundle\DomainBundle\Domain;

interface EntityInterface
{
    public function sameId(EntityInterface $otherEntity): bool;
}
