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
use ArrayIterator;
use Iterator;

/**
 * Iter
 */
class Iter
{
    /**
     * Converts any iterable to an array.
     *
     * @return array
     */
    public static function toArray(iterable $iterable): array
    {
        return is_array($iterable) ? $iterable : iterator_to_array($iterable);
    }
    
    /**
     * Converts any iterable to an iterator.
     *
     * @return Iterator
     */
    public static function toIterator(iterable $iterable): Iterator
    {
        if ($iterable instanceof Iterator) {
            return $iterable;
        }

        if (is_array($iterable)) {
            return new ArrayIterator($iterable);
        }

        return new TraversableIterator($iterable);
    }
}