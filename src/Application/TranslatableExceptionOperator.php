<?php

namespace xVer\Bundle\DomainBundle\Application;

use xVer\Bundle\DomainBundle\Domain\DomainException;
use xVer\Bundle\DomainBundle\Domain\TranslationVO;

class TranslatableExceptionOperator
{
    public static function exceptionIsTranslatable(\Throwable $th): bool
    {
        return $th instanceof DomainException;
    }

    public static function messageIsTranslatable(mixed $message): bool
    {
        return $message instanceof TranslationVO;
    }

    public static function getTranslationParameters(DomainException $de): array
    {
        return self::getTranslationVOParameters($de->getTranslationVO());
    }

    public static function getTranslationVO(DomainException $de): TranslationVO
    {
        return $de->getTranslationVO();
    }

    public static function getTranslationVOId(TranslationVO $translationVO): string
    {
        return $translationVO->getId();
    }

    public static function getTranslationVOParameters(TranslationVO $translationVO): array
    {
        return $translationVO->getParameters();
    }

    public static function getTranslationVODomain(TranslationVO $translationVO): string
    {
        return $translationVO->getDomain();
    }
}
