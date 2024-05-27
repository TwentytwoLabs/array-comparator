<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

final class ArrayComparator implements ComparatorInterface
{
    public function support(mixed $expected): bool
    {
        return '<array>' === $expected;
    }

    public function compare(mixed $expected, mixed $value): void
    {
        if (true !== \is_array($value)) {
            throw new \Exception(sprintf('The value %s is not an array', $value));
        }

        if (empty($value)) {
            throw new \Exception('Array is empty');
        }
    }
}
