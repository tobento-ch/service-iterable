# Iterable Service

Iterable helper and common iterators used in other services.

## Table of Contents

- [Getting started](#getting-started)
    - [Requirements](#requirements)
    - [Highlights](#highlights)
- [Documentation](#documentation)
    - [Iterable](#iterable)
    - [Iterators](#iterators)
        - [Chunk Iterator](#chunk-iterator)
        - [Modify Iterator](#modify-iterator)
        - [Item Factory Iterator](#item-factory-iterator)
        - [Json File Iterator](#json-file-iterator)
- [Credits](#credits)
___

# Getting started

Add the latest version of the iterable service project running this command.

```
composer require tobento/service-iterable
```

## Requirements

- PHP 8.0 or greater

## Highlights

- Framework-agnostic, will work with any project
- Decoupled design

# Documentation

## Iterable

**toArray**

Converts any iterable to an array.

```php
use Tobento\Service\Iterable\Iter;

$iterable = ['key' => 'value'];

$array = Iter::toArray(iterable: $iterable);
```

**toIterator**

Converts any iterable to an iterator.

```php
use Tobento\Service\Iterable\Iter;
use Iterator;

$iterable = ['key' => 'value'];

$iterator = Iter::toIterator(iterable: $iterable);

var_dump($iterator instanceof Iterator);
// bool(true)
```

## Iterators

### Chunk Iterator

```php
use Tobento\Service\Iterable\ChunkIterator;

$iterator = new ChunkIterator(
    iterable: range(1, 10),
    chunkLength: 2,
);

foreach($iterator as $chunk) {} // [1, 2], [3, 4], ...
```

### Modify Iterator

```php
use Tobento\Service\Iterable\ModifyIterator;

$iterator = new ModifyIterator(
    iterable: range(1, 5),
    modifier: function(int $number): int {
        return $number * 10;
    }
);

foreach($iterator as $number) {} // 10, 20, ...
```

### Item Factory Iterator

You may use the item factory iterator to seed items and use the [Seeder Service](https://github.com/tobento-ch/service-seeder) to generate fake data.

```php
use Tobento\Service\Iterable\ItemFactoryIterator;
use Tobento\Service\Seeder\Str;
use Tobento\Service\Seeder\Arr;

$callable = function(): array {
    return [
        'name' => Str::string(10),
        'color' => Arr::item(['green', 'red', 'blue']),
    ];
};

$iterator = new ItemFactoryIterator(
    factory: $callable,
    create: 10
);
```

### Json File Iterator

```php
use Tobento\Service\Iterable\JsonFileIterator;

$iterator = new JsonFileIterator(
    file: 'private/src/file.json',
);

foreach($iterator as $key => $item) {}
```

For large files you may consider [Json Maschine](https://github.com/halaxa/json-machine).

# Credits

- [Tobias Strub](https://www.tobento.ch)
- [All Contributors](../../contributors)