Data Transformer
==================

Utility for converting from one data format to another

### Installation


### Transform

```php
<?php

use Morrelinko\DataTransformer\Transformer;
use Morrelinko\DataTransformer\Type\ArrayType;
use Morrelinko\DataTransformer\Type\JsonType;

$json = '{
    "id": 0,
    "guid": "d66bac58-06a0-498d-9692-8fd186549887",
    "isActive": false,
    "balance": "$3,547.00",
    "picture": "http://placehold.it/32x32",
    "age": 30
}';

$transformer = new Transformer(
    $from = new JsonType(),
    $to = new ArrayType()
);

$output = $transformer->transform($data);
var_export($output);

// Output
array(
    "id" => 0,
    "guid" => "d66bac58-06a0-498d-9692-8fd186549887",
    "isActive" => false,
    "balance" => "$3,547.00",
    "picture" => "http://placehold.it/32x32",
    "age" => 30
);

```

### Transform + Builder

```php
<?php

use Morrelinko\DataTransformer\Builder\ItemBuilder;
use Morrelinko\DataTransformer\Transformer;
use Morrelinko\DataTransformer\Type\ArrayType;
use Morrelinko\DataTransformer\Type\JsonType;

$json = '{
    "id": 0,
    "guid": "d66bac58-06a0-498d-9692-8fd186549887",
    "isActive": false,
    "balance": "$3,547.00",
    "picture": "http://placehold.it/32x32",
    "age": 30,
    "name": "Leola Orr",
    "gender": "female"
}';

$transformer = new Transformer(
    $from = new JsonType(),
    $to = new ArrayType()
);

$builder = new ItemBuilder();
$builder
    ->map('picture', 'photo')->remove('picture')
    ->map('name', 'full_name')->remove('name');

$output = $transformer->transform($data, $builder);
var_export($output);

// Output
array(
    "id" => 0,
    "guid" => "d66bac58-06a0-498d-9692-8fd186549887",
    "isActive" => false,
    "balance" => "$3,547.00",
    "photo" => "http://placehold.it/32x32",
    "age" => 30,
    "full_name" => "Leola Orr",
    "gender" => "female"
);

```

Converting from JSON to Serialize Form

```php
<?php

use Morrelinko\DataTransformer\Transformer;
use Morrelinko\DataTransformer\Type\JsonType;
use Morrelinko\DataTransformer\Type\SerializeType;

require_once __DIR__ . '/../vendor/autoload.php';

$data = '{
        "id": 0,
        "guid": "d66bac58-06a0-498d-9692-8fd186549887",
        "isActive": false,
        "balance": "$3,547.00",
        "picture": "http://placehold.it/32x32",
        "age": 30,
        "name": "Leola Orr",
        "gender": "female",
        "company": "Satiance",
        "email": "leolaorr@satiance.com",
        "phone": "+1 (907) 468-3394",
        "address": "229 Belmont Avenue, Smeltertown, Delaware, 9835"
}';

$transformer = new Transformer(
    $from = new JsonType(),
    $to = new SerializeType()
);

$output = $transformer->transform($data);
var_dump($output);
