Data Transformer
==================

Utility for converting from one data format to another .

I built this tool working on a project that uses the facebook graph api. Some data from facebook api was generated and

passed to this tool which converts its json response to an array which could be used for working offline.

This tool also includes a Builder to normalize the response from facebook APIs... (For example, changing 'name' field to 'title')

### Installation


### Transform

```php
<?php

use Morrelinko\Datran\Transformer;
use Morrelinko\Datran\Type\ArrayType;
use Morrelinko\Datran\Type\JsonType;

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

$output = $transformer->transform($json);
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

use Morrelinko\Datran\Builder\ItemBuilder;
use Morrelinko\Datran\Transformer;
use Morrelinko\Datran\Type\ArrayType;
use Morrelinko\Datran\Type\JsonType;

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

$output = $transformer->transform($json, $builder);
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

use Morrelinko\Datran\Transformer;
use Morrelinko\Datran\Type\JsonType;
use Morrelinko\Datran\Type\SerializeType;

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

// Output
"string 'a:12:{s:2:"id";i:0;s:4:"guid";s:36:"d66bac58-06a0-498d-9692-8fd186549887";s:8:"isActive";b:0;s:7:"balance";s:9:"$3,547.00";s:7:"picture";s:25:"http://placehold.it/32x32";s:3:"age";i:30;s:4:"name";s:9:"Leola Orr";s:6:"gender";s:6:"female";s:7:"company";s:8:"Satiance";s:5:"email";s:21:"leolaorr@satiance.com";s:5:"phone";s:17:"+1 (907) 468-3394";s:7:"address";s:47:"229 Belmont Avenue, Smeltertown, Delaware, 9835";}' (length=415)"