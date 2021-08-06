PHP Hydrator
=

A simple library that uses the hydration pattern to fill objects given different sources of data.

## Content

* [What is Data Hydration](#what-is-data-hydration)
* [Installation](#installation)
* [Usage](#usage)


### What is Data Hydration


Data hydration is the import of data into an object. When an object is waiting for data to fill it, this object is waiting to be hydrated. The source of that hydration can be a data lake or other data source. There are a number of data hydration methods to properly select and fill objects with the appropriate data

### Installation

```php
composer require didix16/php-hydrator
```

### Usage

```php

class MyModel  {

    private $property1;

    private $property2;

    ...
}

// this is an hydrator based on PHP reflection
$hydrator = new ReflectionHydrator();
$model = new MyModel();

$hydrator->hydrate([
    'property1' => 'value1',
    'propery2' => 'value2'
], $model);

//$model->getProperty1() === 'value1'
//$model->getProperty2() === 'value2'
```

```php
class MyModel implements  \ArrayAccess {

    protected $property1;

    protected $property2;

    // Implementation of ArrayAccess interface methods
    ...
}

// this is an hydrator based on object array serialization
$hydrator = new ArraySerializableHydrator();

$model = new MyModel();

$hydrator->hydrate([
    'property1' => 'value1',
    'propery2' => 'value2'
], $model);

//$model->getProperty1() === 'value1'
//$model->getProperty2() === 'value2'

```