<?php

namespace Tests\unit\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;
use xVer\Bundle\DomainBundle\Domain\EntityObjectInterface;
use xVer\Bundle\DomainBundle\Domain\EntityObjectsCollection;

/**
 * @covers xVer\Bundle\DomainBundle\Domain\EntityObjectsCollection
 */
class EntityObjectsCollectionTest extends TestCase
{
    public function testConstructorArgumentContainsNonObjectThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Found item which is not typed <%s>', EntityObjectInterface::class));
        new EntityObjectsCollection([1]);
    }

    public function testConstructorArgumentContainsNonExpectedInstanceThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Found item which is not typed <%s>', EntityObjectInterface::class));
        new EntityObjectsCollection([new \stdClass]);
    }

    public function testConstructorArgumentIsEmptyArray(): void
    {
        $entityObjectCollectionMock = new EntityObjectsCollection([]);
        $this->assertInstanceOf(EntityObjectsCollection::class, $entityObjectCollectionMock);
        $this->assertInstanceOf(ArrayCollection::class, $entityObjectCollectionMock);
    }

    public function testContructorAndGetters(): void
    {
        $entity1 = $this->createStub(EntityObjectInterface::class);
        $entity2 = $this->createStub(EntityObjectInterface::class);
        $entityObjectsArray = [
            $entity1, $entity2
        ];
        $entityObjectCollection = new EntityObjectsCollection($entityObjectsArray);
        $this->assertInstanceOf(EntityObjectsCollection::class, $entityObjectCollection);
        $this->assertInstanceOf(ArrayCollection::class, $entityObjectCollection);
        $this->assertIsArray($entityObjectCollection->toArray());
        $this->assertSame($entity1, $entityObjectCollection->first());
        $this->assertSame($entity2, $entityObjectCollection->last());
        $this->assertSame($entity1, $entityObjectCollection->offsetGet(0));
        $this->assertSame($entity2, $entityObjectCollection->offsetGet(1));
        $this->assertTrue($entityObjectCollection->contains($entity1));
        $this->assertTrue($entityObjectCollection->contains($entity2));
    }

    public function testOffsetGetWithNonIntThrowsException(): void
    {
        $entityObjectCollection = new EntityObjectsCollection([]);
        $this->expectException(InvalidArgumentException::class);
        $entityObjectCollection->offsetGet('1');
    }

    public function testContainsWithInvalidArgumentThrowsException(): void
    {
        $entityObjectCollection = new EntityObjectsCollection([]);
        $this->expectException(InvalidArgumentException::class);
        $entityObjectCollection->contains('1');
    }

    public function testContainsLateStaticBinding(): void
    {
        $entityObjectCollection = new class extends EntityObjectsCollection{
            public function type(): string { return stdClass::class; }
        };
        $entity = new stdClass;
        $entityObjectCollection->contains($entity);
        $this->expectNotToPerformAssertions();
    }
}
