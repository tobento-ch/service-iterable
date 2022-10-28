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

namespace Tobento\Service\Tag\Test;

use PHPUnit\Framework\TestCase;
use Tobento\Service\Iterable\Iter;
use ArrayIterator;
use Iterator;

/**
 * IterTest
 */
class IterTest extends TestCase
{
    public function testToArrayMethodWithArray()
    {
        $array = Iter::toArray(
            iterable: ['key' => 'value']
        );
        
        $this->assertTrue(is_array($array));
    }
    
    public function testToArrayMethodWithArrayIterator()
    {
        $array = Iter::toArray(
            iterable: new ArrayIterator(['key' => 'value'])
        );
        
        $this->assertTrue(is_array($array));
    }
    
    public function testToIteratorMethodWithArray()
    {
        $iterator = Iter::toIterator(
            iterable: ['key' => 'value']
        );
        
        $this->assertInstanceOf(Iterator::class, $iterator);
    }
    
    public function testToIteratorMethodWithArrayIterator()
    {
        $iterator = Iter::toIterator(
            iterable: new ArrayIterator(['key' => 'value'])
        );
        
        $this->assertInstanceOf(Iterator::class, $iterator);
    }    
}