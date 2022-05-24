<?php declare(strict_types=1);

namespace Tests\unit\Infrastructure;

use PHPUnit\Framework\TestCase;
use xVer\Bundle\DomainBundle\Domain\EntityInterface;
use xVer\Bundle\DomainBundle\Infrastructure\PersistanceInMemory;

/**
 * @covers xVer\Bundle\DomainBundle\Infrastructure\PersistanceInMemory
 */
class PersistanceInMemoryTest extends TestCase
{
    public function testPersistanceInMemory(): void
    {
        $object1 = new class implements EntityInterface { public int $id = 1;
        public function sameId(EntityInterface $otherEntity): bool
        {
            return $this->id === $otherEntity->id;
        }};

        $object2 = new class implements EntityInterface { public int $id = 2;
        public function sameId(EntityInterface $otherEntity): bool
        {
            return $this->id === $otherEntity->id;
        }};

        $stub = $this->getMockForAbstractClass(PersistanceInMemory::class);
        $stub->emPersist($object1);
        $stub->emPersist($object1);
        $stub->emPersist($object2);
        $persistedObject = $stub->getPersistedObjects();
        $this->assertIsArray($persistedObject);
        $this->assertCount(0, $persistedObject);
        $stub->emFlush();
        $this->assertCount(2, $stub->getPersistedObjects());
        $stub->emRemove($object2);
        $stub->emRemove($object2);
        $this->assertCount(2, $stub->getPersistedObjects());
        $stub->emPersist($object2);
        $stub->emFlush();
        $this->assertCount(2, $stub->getPersistedObjects());
        $stub->emRemove($object2);
        $stub->emFlush();
        $this->assertCount(1, $stub->getPersistedObjects());
        $this->assertSame($object1, $stub->getPersistedObjects()[0]);
    }
}
