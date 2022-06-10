<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\UuidComparator;

/**
 * Class UuidComparatorTest.
 *
 * @codingStandardsIgnoreFile
 *
 * @SuppressWarnings(PHPMD)
 */
class UuidComparatorTest extends TestCase
{
    public function testShouldNotSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertFalse($comparator->support('<foo>'));
    }

    public function testShouldSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('<uuid>'));
    }

    public function testShouldCompareValidData()
    {
        $comparator = $this->getComparator();
        $comparator->compare('<uuid>', 'Lorem Ipsum');
        $this->assertTrue(true);
    }

    public function testShouldNotCompareValidData()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The value 3 is not an uuid');

        $comparator = $this->getComparator();
        $comparator->compare('<uuid>', 3);
    }

    public function testShouldNotCompareValidDataBecauseValueIsEmpty()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The value  is empty');

        $comparator = $this->getComparator();
        $comparator->compare('<uuid>', '');
    }

    private function getComparator(): UuidComparator
    {
        return new UuidComparator();
    }
}
