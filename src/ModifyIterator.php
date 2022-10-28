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
 * ModifyIterator
 */
class ModifyIterator implements Iterator
{
    /**
     * @var Iterator
     */
    protected Iterator $iterator;
    
    /**
     * @var callable
     */
    protected $modifier;

    /**
     * Create a new ModifyIterator.
     *
     * @param iterable $iterable
     * @param callable $modifier Modifies the current item from iterator.
     */
    public function __construct(
        iterable $iterable,
        callable $modifier
    ) {
        $this->iterator = Iter::toIterator(iterable: $iterable);
        $this->modifier = $modifier;
    }
    
    public function rewind()
    {
        $this->iterator->rewind();
    }

    public function current()
    {
        $callable = $this->modifier;
        return $callable($this->iterator->current());
    }

    public function key()
    {
        return $this->iterator->key();
    }

    public function next()
    {
        $this->iterator->next();
    }

    public function valid()
    {
        return $this->iterator->valid();
    }
}