<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

final class UuidComparator implements ComparatorInterface
{
    public function support(mixed $expected): bool
    {
        return '<uuid>' === $expected;
    }

    public function compare(mixed $expected, mixed $value): void
    {
        if (true !== \is_string($value)) {
            throw new \Exception(sprintf('The value %s is not an uuid', $value));
        }

        if (empty($value)) {
            throw new \Exception(sprintf('The value %s is empty', $value));
        }
    }
}
