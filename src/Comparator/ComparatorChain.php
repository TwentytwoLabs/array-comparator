<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * class ComparatorChain.
 */
class ComparatorChain
{
    /** @var ComparatorInterface[] */
    private array $comparators = [];

    public function compare($expected, $value)
    {
        foreach ($this->comparators as $comparator) {
            if ($comparator->support($expected)) {
                $comparator->compare($expected, $value);
            }
        }
    }

    public function addComparators(ComparatorInterface $comparator): self
    {
        $this->comparators[] = $comparator;

        return $this;
    }
}
