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
use IteratorAggregate;
use IteratorIterator;
use Traversable;

/**
 * TraversableIterator
 */
class TraversableIterator implements Iterator
{
    /**
     * @var Iterator
     */    
    protected Iterator $innerIterator;
    
    /**
     * Create a new TraversableIterator.
     *
     * @param Traversable $traversable
     */
    public function __construct(
        protected Traversable $traversable,
    ) {
        $this->innerIterator = $this->createInnerIterator();
    }
    
    /**
     * Create inner iterator.
     *
     * @return Iterator
     */
    protected function createInnerIterator(): Iterator
    {
        if ($this->traversable instanceof Iterator) {
            return $this->traversable;
        }
        
        if ($this->traversable instanceof IteratorAggregate) {
            return new TraversableIterator($this->traversable->getIterator());
        }
        
        return new IteratorIterator($this->traversable);
    }
    
    public function rewind()
    {
        $this->innerIterator = $this->createInnerIterator();
        $this->innerIterator->rewind();
    }

    public function current()
    {
        return $this->innerIterator->current();
    }

    public function key()
    {
        return $this->innerIterator->key();
    }

    public function next()
    {
        $this->innerIterator->next();
    }

    public function valid()
    {
        return $this->innerIterator->valid();
    }
}