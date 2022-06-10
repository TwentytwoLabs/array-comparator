<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator;

use TwentytwoLabs\ArrayComparator\Comparator\ComparatorChain;

/**
 * Trait AsserterTrait.
 */
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

    private function assertValuesOfJson(array $expectedItem, array $item)
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

    private function assertKeysOfJson(array $expectedKeys, array $columns, $parent = null)
    {
        $keysMissing = array_diff($expectedKeys, $columns);
        $keys = array_diff($columns, $expectedKeys);

        $message = null;
        $messageParent = null === $parent ? '' : sprintf(' in parent %s', $parent);

        if (!empty($keys)) {
            $message = sprintf('Keys [%s] must not be present %s', implode(', ', $keys), $messageParent);
        }

        if (!empty($keysMissing)) {
            $message = sprintf('%sKeys [%s] are missing %s', null !== $message ? $message.' and ' : '', implode(', ', $keysMissing), $messageParent);
        }

        if (null !== $message) {
            throw new \Exception($message);
        }
    }
}
