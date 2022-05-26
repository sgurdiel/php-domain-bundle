<?php declare(strict_types=1);

namespace Tests\unit\Domain;

use PHPUnit\Framework\TestCase;
use xVer\Bundle\DomainBundle\Domain\DomainException;
use xVer\Bundle\DomainBundle\Domain\TranslationVO;

/**
 * @covers xVer\Bundle\DomainBundle\Domain\DomainException
 * @uses xVer\Bundle\DomainBundle\Domain\TranslationVO
 */
class DomainExceptionTest extends TestCase
{
    public function testThrowException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('testException');

        throw new DomainException(new TranslationVO('testException', [], TranslationVO::DOMAIN_VALIDATORS));
    }

    public function testThrowableIsCatched(): void
    {
        try {
            throw new DomainException(new TranslationVO('testException', [], TranslationVO::DOMAIN_VALIDATORS));
        } catch (\Throwable $th) {
            $this->assertTrue(true);
        }
    }

    public function testDomainException(): void
    {
        try {
            $translationVO = new TranslationVO('testException', [], TranslationVO::DOMAIN_VALIDATORS);
            $domainException = new DomainException($translationVO, '');
            throw $domainException;
        } catch (\Throwable $th) {
            $this->assertSame($translationVO, $domainException->getTranslationVO());
            $this->assertNull($domainException->getObjectProperty());
        }
    }
}
