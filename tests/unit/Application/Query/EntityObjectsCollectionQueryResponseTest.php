<?php declare(strict_types=1);

namespace Tests\unit\Application\Query;

use PHPUnit\Framework\TestCase;
use xVer\Bundle\DomainBundle\Application\Query\EntityObjectsCollectionQueryResponse;
use xVer\Bundle\DomainBundle\Domain\EntityObjectInterface;
use xVer\Bundle\DomainBundle\Domain\EntityObjectsCollection;

/**
 * @covers xVer\Bundle\DomainBundle\Application\Query\EntityObjectsCollectionQueryResponse
 * @uses xVer\Bundle\DomainBundle\Domain\EntityObjectsCollection
 */
class EntityObjectsCollectionQueryResponseTest extends TestCase
{
    // public function testGetCollectionReturnType(): void
    // {
    //     $collectionStub = $this->createStub(EntityObjectsCollection::class);
    //     /** @var EntityObjectsCollectionQueryResponse */
    //     $queryResponse = new EntityObjectsCollectionQueryResponse($collectionStub);
    //     $this->assertSame($collectionStub, $queryResponse->getCollection());
    //     $this->assertInstanceOf(EntityObjectsCollection::class, $queryResponse->getCollection());
    // }

    /**
     * @dataProvider dataQueryResponse
     */
    public function testQueryResponse($arrayItemsAmount, $limit, $page, $count, $hasPrevPage, $hasNextPage): void
    {
        $entitiesArray = [];
        for ($i=0; $i < $arrayItemsAmount; $i++) { 
            $entitiesArray[] = $this->createStub(EntityObjectInterface::class);
        }
        $entityObjectsCollection = new EntityObjectsCollection($entitiesArray);
        $queryResponse = new EntityObjectsCollectionQueryResponse(
            $entityObjectsCollection,
            $limit,
            $page
        );
        $this->assertInstanceOf(EntityObjectsCollection::class, $queryResponse->getCollection());
        $this->assertSame($count, $queryResponse->getCollection()->count());
        $this->assertSame($page, $queryResponse->getPage());
        $this->assertSame($hasPrevPage, $queryResponse->getHasPrevPage());
        $this->assertSame($hasNextPage, $queryResponse->getHasNextPage());
    }

    public static function dataQueryResponse(): array
    {
        return [
            [0, 2, 0, 0, false, false],
            [3, 2, 0, 2, false, true],
            [3, 2, 1, 2, true, true],
            [1, 2, 2, 1, true, false],
            [5, 5, 0, 5, false, false],
        ];
    }
}
