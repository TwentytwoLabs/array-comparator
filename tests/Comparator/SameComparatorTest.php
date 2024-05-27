<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\SameComparator;

final class SameComparatorTest extends TestCase
{
    public function testShouldSupportComparator(): void
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('foo'));
    }

    public function testShouldCompareValidData(): void
    {
        $comparator = $this->getComparator();
        $comparator->compare('foo', 'foo');
        $this->assertTrue(true);
    }

    public function testShouldNotCompareValidDataBecauseValuesAreDifferent(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The value foo is different to bar');

        $comparator = $this->getComparator();
        $comparator->compare('foo', 'bar');
    }

    private function getComparator(): SameComparator
    {
        return new SameComparator();
    }
}
