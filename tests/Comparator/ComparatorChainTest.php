<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\ComparatorChain;
use TwentytwoLabs\ArrayComparator\Comparator\ComparatorInterface;

final class ComparatorChainTest extends TestCase
{
    public function testShouldCompare(): void
    {
        $comparator1 = $this->createMock(ComparatorInterface::class);
        $comparator1->expects($this->once())->method('support')->with('<string>')->willReturn(false);
        $comparator1->expects($this->never())->method('compare');

        $comparator2 = $this->createMock(ComparatorInterface::class);
        $comparator2->expects($this->once())->method('support')->with('<string>')->willReturn(true);
        $comparator2->expects($this->once())->method('compare')->with('<string>', 'foo');

        $comparator3 = $this->createMock(ComparatorInterface::class);
        $comparator3->expects($this->never())->method('support');
        $comparator3->expects($this->never())->method('compare');

        $comparatorChain = $this->getComparatorChain();
        $comparatorChain
            ->addComparators($comparator1)
            ->addComparators($comparator2)
            ->addComparators($comparator3)
            ->compare('<string>', 'foo')
        ;
    }

    private function getComparatorChain(): ComparatorChain
    {
        return new ComparatorChain();
    }
}
