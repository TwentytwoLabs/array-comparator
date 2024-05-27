<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

final class IntegerComparator implements ComparatorInterface
{
    public function support(mixed $expected): bool
    {
        return '<int>' === $expected;
    }

    public function compare(mixed $expected, mixed $value): void
    {
        if (true !== \is_int($value)) {
            throw new \Exception(sprintf('The value %s is not an integer', $value));
        }
    }
}
