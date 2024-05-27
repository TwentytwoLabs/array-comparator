<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\IntegerComparator;

final class IntegerComparatorTest extends TestCase
{
    public function testShouldNotSupportComparator(): void
    {
        $comparator = $this->getComparator();
        $this->assertFalse($comparator->support('<foo>'));
    }

    public function testShouldSupportComparator(): void
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('<int>'));
    }

    public function testShouldCompareValidData(): void
    {
        $comparator = $this->getComparator();
        $comparator->compare('<int>', 3);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider getBadValues
     */
    public function testShouldNotCompareValidData(mixed $value): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('The value %s is not an integer', $value));

        $comparator = $this->getComparator();
        $comparator->compare('<int>', $value);
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function getBadValues(): array
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
