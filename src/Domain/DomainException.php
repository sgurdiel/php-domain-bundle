<?php

namespace xVer\Bundle\DomainBundle\Domain;

class DomainException extends \DomainException
{
    public function __construct(
        private readonly TranslationVO $translationVO,
        private ?string $objectProperty = null,
        int $code = 0,
        \Throwable $previous = null
    ) {
        if ($this->objectProperty === '') {
            $this->objectProperty = null;
        }
        parent::__construct($this->translationVO->getId(), $code, $previous);
    }

    public function getTranslationVO(): TranslationVO
    {
        return $this->translationVO;
    }

    public function getObjectProperty(): ?string
    {
        return $this->objectProperty;
    }
}
