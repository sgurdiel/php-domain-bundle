<?php

namespace xVer\Bundle\DomainBundle\Domain;

class TranslationVO
{
    public const DOMAIN_MESSAGES = 'messages';
    public const DOMAIN_VALIDATORS = 'validators';
    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(private string $id, private array $parameters = [], private string $domain = self::DOMAIN_MESSAGES)
    {
        if (!in_array($domain, [self::DOMAIN_MESSAGES, self::DOMAIN_VALIDATORS])) {
            throw new \InvalidArgumentException();
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
