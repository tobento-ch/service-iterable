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

use Tobento\Service\Filesystem\JsonFile;
use IteratorAggregate;
use ArrayIterator;
use Traversable;

/**
 * JsonFileIterator
 */
class JsonFileIterator implements IteratorAggregate
{
    /**
     * Create a new JsonFileIterator.
     *
     * @param string $file
     */
    public function __construct(
        protected string $file
    ) {}
    
    /**
     * Returns the iterator.
     *
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator((new JsonFile($this->file))->toArray());
    }
}