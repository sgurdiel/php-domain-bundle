<?php declare(strict_types=1);

namespace Tests\unit\Domain;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use xVer\Bundle\DomainBundle\Domain\TranslationVO;

/**
 * @covers xVer\Bundle\DomainBundle\Domain\TranslationVO
 */
class TranslationVOTest extends TestCase
{
    public function testTranslationVO(): void
    {
        $translationVO = new TranslationVO('testTranslation', [], TranslationVO::DOMAIN_VALIDATORS);
        $this->assertSame('testTranslation', $translationVO->getId());
        $this->assertIsArray($translationVO->getParameters());
        $this->assertCount(0, $translationVO->getParameters());
        $this->assertSame(TranslationVO::DOMAIN_VALIDATORS, $translationVO->getDomain());
    }

    public function testInvalidDomainThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $translationVO = new TranslationVO('testTranslation', [], '');
    }
}
