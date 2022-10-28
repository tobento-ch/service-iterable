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
use Tobento\Service\Iterable\ChunkIterator;
use IteratorAggregate;

/**
 * ChunkIteratorTest
 */
class ChunkIteratorTest extends TestCase
{
    public function testImplementsIteratorAggregate()
    {
        $iterator = new ChunkIterator(
            iterable: [],
            chunkLength: 2,
        );
        
        $this->assertInstanceOf(IteratorAggregate::class, $iterator);
    }
    
    public function testChunk()
    {
        $iterator = new ChunkIterator(
            iterable: range(1, 10),
            chunkLength: 2,
        );
        
        $chunks = [];
        
        foreach($iterator as $chunk) {
            $chunks[] = $chunk;
        }
        
        $this->assertSame(5, count($chunks));
    }
    
    public function testChunkWithHigherChunkLengthAsItems()
    {
        $iterator = new ChunkIterator(
            iterable: range(1, 10),
            chunkLength: 100,
        );
        
        $chunks = [];
        
        foreach($iterator as $chunk) {
            $chunks[] = $chunk;
        }
        
        $this->assertSame(1, count($chunks));        
    }
}