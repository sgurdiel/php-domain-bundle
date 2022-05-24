<?php

namespace xVer\Bundle\DomainBundle\Domain;

interface EntityObjectRepositoryLoaderInterface
{
    /**
     * @template TRepo of EntityObjectRepositoryInterface
     *
     * @param class-string<TRepo> $repoInterface
     *
     * @return TRepo
     */
    public function load(string $repoInterface): EntityObjectRepositoryInterface;
}
