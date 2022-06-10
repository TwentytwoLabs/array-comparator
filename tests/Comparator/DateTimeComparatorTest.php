<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\DateTimeComparator;

/**
 * Class DateTimeComparatorTest.
 *
 * @codingStandardsIgnoreFile
 *
 * @SuppressWarnings(PHPMD)
 */
class DateTimeComparatorTest extends TestCase
{
    public function testShouldNotSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertFalse($comparator->support('<foo>'));
    }

    public function testShouldSupportComparator()
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('<dateTime>'));
    }

    public function testShouldCompareValidData()
    {
        $comparator = $this->getComparator();
        $comparator->compare('<dateTime>', '2021-09-22T14:45:59+02:00');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider getBadValue
     */
    public function testShouldNotCompareValidData($value)
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('The node value is \'"%s"\'', $value));

        $comparator = $this->getComparator();
        $comparator->compare('<dateTime>', $value);
    }

    public function getBadValue(): array
    {
        return [
            ['ven. 10 juin 2022 10:31:26 CEST'],
            [' 2021-09-22T14:45:59+02:00'],
            ['2021-09-22T14:45:59+02:00 '],
            [' 2021-09-22'],
        ];
    }

    private function getComparator(): DateTimeComparator
    {
        return new DateTimeComparator();
    }
}
