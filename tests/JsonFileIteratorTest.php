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
use Tobento\Service\Iterable\JsonFileIterator;
use IteratorAggregate;

/**
 * JsonFileIteratorTest
 */
class JsonFileIteratorTest extends TestCase
{
    public function testImplementsIteratorAggregate()
    {
        $iterator = new JsonFileIterator(
            file: __DIR__.'/src/countries.json',
        );
        
        $this->assertInstanceOf(IteratorAggregate::class, $iterator);
    }
    
    public function testIterationWithCountries()
    {
        $iterator = new JsonFileIterator(
            file: __DIR__.'/src/countries.json',
        );
        
        $items = [];
        
        foreach($iterator as $key => $item) {
            $items[$key] = $item;
        }
        
        $this->assertSame(
            [
                'CH' => ['code' => 'CH', 'name' => 'Schweiz'],
                'DE' => ['code' => 'DE', 'name' => 'Deutschland'],
            ],
            $items
        );
    }
    
    public function testIterationWithColors()
    {
        $iterator = new JsonFileIterator(
            file: __DIR__.'/src/colors.json',
        );
        
        $items = [];
        
        foreach($iterator as $key => $item) {
            $items[$key] = $item;
        }
        
        $this->assertSame(
            [
                0 => 'blue',
                1 => 'red',
            ],
            $items
        );
    }
    
    public function testIterationWithInvalidFileGetsIgnored()
    {
        $iterator = new JsonFileIterator(
            file: __DIR__.'/src/invalid.json',
        );
        
        $items = [];
        
        foreach($iterator as $key => $item) {
            $items[$key] = $item;
        }
        
        $this->assertSame(
            [],
            $items
        );
    }    
}