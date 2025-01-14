<?php declare(strict_types=1);

namespace Aeviiq\Collection;

use Aeviiq\Collection\Exception\InvalidArgumentException;
use Aeviiq\Collection\Exception\LogicException;

interface CollectionInterface extends SortableInterface, \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @return array<string|int, mixed>
     */
    public function toArray(): array;

    /**
     * @return mixed The first element in the collection or null if there is none.
     */
    public function first();

    /**
     * @return mixed The last element in the collection or null if there is none.
     */
    public function last();

    /**
     * @param mixed $element The value of the element you wish to remove.
     *                       This removes an element by value. To remove it by index use offsetUnset().
     */
    public function remove($element): void;

    /**
     * @param \Closure $closure
     *
     * @return array
     */
    public function map(\Closure $closure): array;

    /**
     * @param \Closure $closure
     */
    public function filter(\Closure $closure): CollectionInterface;

    /**
     * Merges the input with the collection. This can take an array with valid values or
     * an instance of the collection itself.
     *
     * @param array<string|int, mixed>|CollectionInterface $input
     *
     * @throws InvalidArgumentException When the $input is not of the expected type(s).
     */
    public function merge($input): void;

    /**
     * @return bool Whether or not the collection is empty
     */
    public function isEmpty(): bool;

    /**
     * @param mixed $element
     *
     * @return bool Whether or not the collection contains the element.
     */
    public function contains($element): bool;

    /**
     * Clears the collection
     */
    public function clear(): void;

    /**
     * @return array<string|int, int|string>
     */
    public function getKeys(): array;

    /**
     * @return array<int, mixed>
     */
    public function getValues(): array;

    /**
     * @return mixed The one element that was found using the closure.
     *
     * @throws LogicException When none or multiple results were found.
     */
    public function getOneBy(\Closure $closure);

    /**
     * @return mixed The one element that was found using the closure or null if none was found.
     *
     * @throws LogicException When multiple results were found.
     */
    public function getOneOrNullBy(\Closure $closure);

    /**
     * @param array<string|int, mixed> $values
     *
     * @throws InvalidArgumentException When the given values are not of the expected type.
     */
    public function exchangeArray(array $values): void;

    /**
     * @param mixed $value
     */
    public function append($element): void;

    /**
     * @param string $iteratorClass
     *
     * @throws InvalidArgumentException When the given iterator class does not implement ArrayAccess.
     */
    public function setIteratorClass(string $iteratorClass): void;

    /**
     * @return CollectionInterface
     */
    public function copy(): CollectionInterface;
}
