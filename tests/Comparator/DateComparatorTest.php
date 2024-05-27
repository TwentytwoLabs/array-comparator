<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\DateComparator;

final class DateComparatorTest extends TestCase
{
    public function testShouldNotSupportComparator(): void
    {
        $comparator = $this->getComparator();
        $this->assertFalse($comparator->support('<foo>'));
    }

    public function testShouldSupportComparator(): void
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('<date>'));
    }

    public function testShouldCompareValidData(): void
    {
        $comparator = $this->getComparator();
        $comparator->compare('<date>', '2021-09-22');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider getBadValue
     */
    public function testShouldNotCompareValidData(string $value): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('The node value is \'"%s"\'', $value));

        $comparator = $this->getComparator();
        $comparator->compare('<date>', $value);
    }

    /**
     * @return array<int, string[]>
     */
    public static function getBadValue(): array
    {
        return [
            ['ven. 10 juin 2022 10:31:26 CEST'],
            ['2021-09-22T14:45:59+02:00'],
            [' 2021-09-22'],
        ];
    }

    private function getComparator(): DateComparator
    {
        return new DateComparator();
    }
}
