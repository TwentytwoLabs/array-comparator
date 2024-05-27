<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

class ComparatorChain
{
    /** @var ComparatorInterface[] */
    private array $comparators = [];

    public function compare(mixed $expected, mixed $value): void
    {
        foreach ($this->comparators as $comparator) {
            if ($comparator->support($expected)) {
                $comparator->compare($expected, $value);
                break;
            }
        }
    }

    public function addComparators(ComparatorInterface $comparator): self
    {
        $this->comparators[] = $comparator;

        return $this;
    }
}
