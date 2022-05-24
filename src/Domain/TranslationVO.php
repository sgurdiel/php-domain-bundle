<?php

namespace xVer\Bundle\DomainBundle\Domain;

use InvalidArgumentException;

class TranslationVO
{
    final public const DOMAIN_MESSAGES = 'messages';
    final public const DOMAIN_VALIDATORS = 'validators';
    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(
        private readonly string $id,
        private readonly array $parameters = [],
        private readonly string $domain = self::DOMAIN_MESSAGES
    ) {
        if (!in_array($domain, [self::DOMAIN_MESSAGES, self::DOMAIN_VALIDATORS])) {
            throw new InvalidArgumentException();
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }
}
