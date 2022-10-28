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
use Tobento\Service\Iterable\ItemFactoryIterator;
use Iterator;

/**
 * ItemFactoryIteratorTest
 */
class ItemFactoryIteratorTest extends TestCase
{
    public function testImplementsIterator()
    {
        $iterator = new ItemFactoryIterator(
            factory: function() {
                return ['name' => 'red', 'color' => 'blue'];
            },
            create: 10
        );
        
        $this->assertInstanceOf(Iterator::class, $iterator);
    }

    public function testCreatesTheItems()
    {
        $iterator = new ItemFactoryIterator(
            factory: function() {
                return ['name' => 'red', 'color' => 'blue'];
            },
            create: 2
        );
        
        $items = [];
        
        foreach($iterator as $item) {
            $items[] = $item;
        }
        
        $this->assertSame([
            ['name' => 'red', 'color' => 'blue'],
            ['name' => 'red', 'color' => 'blue']
        ], $items);
    }
    
    public function testCreatesTheSpecifiedItems()
    {
        $iterator = new ItemFactoryIterator(
            factory: function() {
                return ['name' => 'red', 'color' => 'blue'];
            },
            create: 10
        );
        
        $items = [];
        
        foreach($iterator as $item) {
            $items[] = $item;
        }
        
        $this->assertSame(10, count($items));
    }
}