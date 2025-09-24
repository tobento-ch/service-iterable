<?php

/**
 * TOBENTO
 *
 * @copyright   Tobias Strub, TOBENTO
 * @license     MIT License, see LICENSE file distributed with this source code.
 * @author      Tobias Strub
 * @link        https://www.tobento.ch
 */

declare(strict_types=1);
 
namespace Tobento\Service\Iterable;

use Iterator;

/**
 * @implements Iterator<array-key, mixed>
 */
class ItemFactoryIterator implements Iterator
{
    /**
     * @var callable
     */
    protected $factory;
    
    /**
     * @var int
     */
    protected int $position = 0;
    
    /**
     * Create a new ItemFactoryIterator.
     *
     * @param callable $factory
     * @param int $create The number of items to create.
     */
    public function __construct(
        callable $factory,
        protected int $create = 10
    ) {
        $this->factory = $factory;
    }
    
    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): mixed
    {
        return call_user_func($this->factory);
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return $this->position < $this->create;
    }
}