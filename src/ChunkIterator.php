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

use IteratorAggregate;
use Iterator;
use Generator;

/**
 * ChunkIterator
 */
class ChunkIterator implements IteratorAggregate
{
    /**
     * @var Iterator
     */
    protected Iterator $iterator;
    
    /**
     * Create a new ChunkIterator.
     *
     * @param iterable $iterable
     * @param int $chunkLength
     */
    public function __construct(
        iterable $iterable,
        protected int $chunkLength,
    ) {
        $this->iterator = Iter::toIterator(iterable: $iterable);
    }
    
    /**
     * Returns the generator.
     *
     * @return Generator
     *
     * @psalm-suppress UnusedVariable
     */
    public function getIterator(): Generator
    {
        $chunk = [];

        for($i = 0; $this->iterator->valid(); $i++){
            $chunk[] = $this->iterator->current();
            $this->iterator->next();
            if(count($chunk) === $this->chunkLength){
                yield $chunk;
                $chunk = [];
            }
        }

        if(count($chunk)){
            yield $chunk;
        }
    }
}