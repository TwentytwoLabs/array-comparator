<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\DateComparator;
use TwentytwoLabs\ArrayComparator\Comparator\DateTimeComparator;
use TwentytwoLabs\ArrayComparator\Comparator\StringComparator;

/**
 * Class StringComparatorTest.
 *
 * @codingStandardsIgnoreFile
 *
 * @SuppressWarnings(PHPMD)
 */
class StringComparatorTest extends TestCase
{
    public function testShouldNotSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertFalse($comparator->support('<foo>'));
    }

    public function testShouldSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('<string>'));
    }

    public function testShouldCompareValidData()
    {
        $comparator = $this->getComparator();
        $comparator->compare('<string>', 'Lorem Ipsum');
        $this->assertTrue(true);
    }

    public function testShouldNotCompareValidData()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The value 3 is not a string');

        $comparator = $this->getComparator();
        $comparator->compare('<string>', 3);
    }

    public function testShouldNotCompareValidDataBecauseValueIsEmpty()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The value  is empty');

        $comparator = $this->getComparator();
        $comparator->compare('<string>', '');
    }

    private function getComparator(): StringComparator
    {
        return new StringComparator();
    }
}
