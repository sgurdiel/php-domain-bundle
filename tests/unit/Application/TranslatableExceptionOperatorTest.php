<?php declare(strict_types=1);

namespace Tests\unit\Application;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use xVer\Bundle\DomainBundle\Application\TranslatableExceptionOperator;
use xVer\Bundle\DomainBundle\Domain\DomainException;
use xVer\Bundle\DomainBundle\Domain\TranslationVO;

/**
 * @covers xVer\Bundle\DomainBundle\Application\TranslatableExceptionOperator
 * @uses xVer\Bundle\DomainBundle\Domain\DomainException
 */
class TranslatableExceptionOperatorTest extends TestCase
{
    public function testExceptionIsTranslatable(): void
    {
        $this->assertTrue(TranslatableExceptionOperator::exceptionIsTranslatable(new DomainException($this->createStub(TranslationVO::class))));
        $this->assertFalse(TranslatableExceptionOperator::exceptionIsTranslatable(new \Exception('')));
    }

    public function testMessageIsTranslatable(): void
    {
        $this->assertTrue(TranslatableExceptionOperator::messageIsTranslatable($this->createStub(TranslationVO::class)));
        $this->assertFalse(TranslatableExceptionOperator::messageIsTranslatable(''));
    }

    public function testGetTranslationParameters(): void
    {
        $parameters = [];
        /** @var TranslationVO&MockObject */
        $translationVOMock = $this->createMock(TranslationVO::class);
        $translationVOMock->expects($this->once())->method('getParameters')->willReturn($parameters);
        $de = new DomainException($translationVOMock);
        $this->assertEquals($parameters, TranslatableExceptionOperator::getTranslationParameters($de));
    }

    public function testGetTranslationVO(): void
    {
        $translationVOMock = $this->createStub(TranslationVO::class);
        $de = new DomainException($translationVOMock);
        $this->assertInstanceOf(TranslationVO::class, TranslatableExceptionOperator::getTranslationVO($de));
        $this->assertSame($translationVOMock, TranslatableExceptionOperator::getTranslationVO($de));
    }

    public function testGetTranslationVOId(): void
    {
        /** @var TranslationVO&MockObject */
        $translationVOMock = $this->createMock(TranslationVO::class);
        $translationVOMock->expects($this->once())->method('getId')->willReturn('testId');
        $this->assertSame('testId', TranslatableExceptionOperator::getTranslationVOId($translationVOMock));
    }

    public function testGetTranslationVOParameters(): void
    {
        $parameters = [];
        /** @var TranslationVO&MockObject */
        $translationVOMock = $this->createMock(TranslationVO::class);
        $translationVOMock->expects($this->once())->method('getParameters')->willReturn($parameters);
        $this->assertEquals($parameters, TranslatableExceptionOperator::getTranslationVOParameters($translationVOMock));
    }

    public function testGetTranslationVODomain(): void
    {
        /** @var TranslationVO&MockObject */
        $translationVOMock = $this->createMock(TranslationVO::class);
        $translationVOMock->expects($this->once())->method('getDomain')->willReturn('testDomain');
        $this->assertSame('testDomain', TranslatableExceptionOperator::getTranslationVODomain($translationVOMock));
    }
}