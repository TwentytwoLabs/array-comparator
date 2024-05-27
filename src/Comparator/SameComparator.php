<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

final class SameComparator implements ComparatorInterface
{
    public function support(mixed $expected): bool
    {
        return true;
    }

    public function compare(mixed $expected, mixed $value): void
    {
        if ($expected !== $value) {
            throw new \Exception(sprintf('The value %s is different to %s', $expected, $value));
        }
    }
}
