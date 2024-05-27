<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator;

use TwentytwoLabs\ArrayComparator\Comparator\ComparatorChain;

trait AsserterTrait
{
    private ComparatorChain $comparatorChain;

    /**
     * @codeCoverageIgnore
     */
    public function setComparatorChain(ComparatorChain $comparatorChain): self
    {
        $this->comparatorChain = $comparatorChain;

        return $this;
    }

    /**
     * @param array<int|string, mixed> $expectedItem
     * @param array<int|string, mixed> $item
     * @throws \Exception
     */
    private function assertValuesOfJson(array $expectedItem, array $item): void
    {
        foreach ($expectedItem as $key => $expected) {
            if (\is_array($expected)) {
                $this->assertKeysOfJson(array_keys($expected), array_keys($item[$key]), $key);
                $this->assertValuesOfJson($expected, $item[$key]);
            } else {
                $this->comparatorChain->compare($expected, $item[$key]);
            }
        }
    }

    /**
     * @param array<int|string, mixed> $expectedKeys
     * @param array<int|string, mixed> $columns
     *
     * @throws \Exception
     */
    private function assertKeysOfJson(array $expectedKeys, array $columns, ?string $parent = null): void
    {
        $keysMissing = array_diff($expectedKeys, $columns);
        $keys = array_diff($columns, $expectedKeys);

        $message = null;
        $messageParent = null === $parent ? '' : sprintf(' in parent %s', $parent);

        if (!empty($keys)) {
            $message = sprintf('Keys [%s] must not be present %s', implode(', ', $keys), $messageParent);
        }

        if (!empty($keysMissing)) {
            $message = sprintf(
                '%sKeys [%s] are missing %s',
                null !== $message ? $message . ' and ' : '',
                implode(', ', $keysMissing),
                $messageParent
            );
        }

        if (null !== $message) {
            throw new \Exception($message);
        }
    }
}
