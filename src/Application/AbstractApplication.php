<?php

namespace xVer\Bundle\DomainBundle\Application;

use xVer\Bundle\DomainBundle\Domain\EntityObjectRepositoryLoaderInterface;

abstract class AbstractApplication
{
    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        protected EntityObjectRepositoryLoaderInterface $repoLoader
    ) {
    }
}
