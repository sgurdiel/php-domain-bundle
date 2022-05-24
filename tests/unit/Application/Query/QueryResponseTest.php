<?php declare(strict_types=1);

namespace Tests\unit\Application\Query;

use PHPUnit\Framework\TestCase;
use xVer\Bundle\DomainBundle\Application\Query\QueryResponse;

/**
 * @covers xVer\Bundle\DomainBundle\Application\Query\QueryResponse
 */
class QueryResponseTest extends TestCase
{
    public function testQueryResponse(): void
    {
        $objects = [new \stdClass, new \stdClass, new \stdClass];
        $queryResponse = new QueryResponse($objects, 2, 0);
        $this->assertIsArray($queryResponse->getObjects());
        $this->assertCount(2, $queryResponse->getObjects());
        $this->assertTrue($queryResponse->getNextPage());
        $this->assertFalse($queryResponse->getPrevPage());
        $this->assertSame(0, $queryResponse->getPage());

        $objects = [3];
        $queryResponse = new QueryResponse($objects, 1, 3);
        $this->assertIsArray($queryResponse->getObjects());
        $this->assertCount(1, $queryResponse->getObjects());
        $this->assertFalse($queryResponse->getNextPage());
        $this->assertTrue($queryResponse->getPrevPage());
        $this->assertSame(3, $queryResponse->getPage());

        $objects = [1, 2, 3, 4];
        $queryResponse = new QueryResponse($objects, null, 0);
        $this->assertIsArray($queryResponse->getObjects());
        $this->assertCount(4, $queryResponse->getObjects());
        $this->assertFalse($queryResponse->getNextPage());
        $this->assertFalse($queryResponse->getPrevPage());
        $this->assertSame(0, $queryResponse->getPage());
    }
}
