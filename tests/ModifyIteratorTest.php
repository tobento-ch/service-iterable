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
use Tobento\Service\Iterable\ModifyIterator;
use Iterator;

/**
 * ModifyIteratorTest
 */
class ModifyIteratorTest extends TestCase
{
    public function testImplementsIterator()
    {
        $iterator = new ModifyIterator(
            iterable: range(1, 5),
            modifier: function(int $number): int {
                return $number * 10;
            }
        );
        
        $this->assertInstanceOf(Iterator::class, $iterator);
    }

    public function testModifiesNumbers()
    {
        $iterator = new ModifyIterator(
            iterable: range(1, 3),
            modifier: function(int $number): int {
                return $number * 10;
            }
        );
        
        $items = [];
        
        foreach($iterator as $item) {
            $items[] = $item;
        }
        
        $this->assertSame([10, 20, 30], $items);
    }
    
    public function testModifiesItems()
    {
        $iterator = new ModifyIterator(
            iterable: [
                ['key' => 'foo', 'name' => 'Foo'],
                ['key' => 'bar', 'name' => 'Bar'],
            ],
            modifier: function(array $item): array {
                $item['name'] = 'modified';
                return $item;
            }
        );
        
        $items = [];
        
        foreach($iterator as $item) {
            $items[] = $item;
        }
        
        $this->assertSame(
            [
                ['key' => 'foo', 'name' => 'modified'],
                ['key' => 'bar', 'name' => 'modified'],
            ],
            $items
        );
    }    
}