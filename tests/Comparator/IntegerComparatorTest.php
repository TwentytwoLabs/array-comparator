<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\IntegerComparator;

/**
 * Class IntegerComparatorTest.
 *
 * @codingStandardsIgnoreFile
 *
 * @SuppressWarnings(PHPMD)
 */
class IntegerComparatorTest extends TestCase
{
    public function testShouldNotSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertFalse($comparator->support('<foo>'));
    }

    public function testShouldSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('<int>'));
    }

    public function testShouldCompareValidData()
    {
        $comparator = $this->getComparator();
        $comparator->compare('<int>', 3);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider getBadValues
     */
    public function testShouldNotCompareValidData($value)
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('The value %s is not an integer', $value));

        $comparator = $this->getComparator();
        $comparator->compare('<int>', $value);
    }

    public function getBadValues(): array
    {
        return [
            ['3'],
            ['3.0'],
            [3.0],
            [false],
            [true],
        ];
    }

    private function getComparator(): IntegerComparator
    {
        return new IntegerComparator();
    }
}
