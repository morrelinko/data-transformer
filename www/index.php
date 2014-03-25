<?php

use Morrelinko\Datran\Builder\CollectionBuilder;
use Morrelinko\Datran\Transformer;
use Morrelinko\Datran\Type\ArrayType;
use Morrelinko\Datran\Type\JsonType;

require_once __DIR__ . '/../vendor/autoload.php';

$data = file_get_contents('./sample.json');

$transformer = new Transformer(
    new JsonType(),
    new ArrayType()
);

$builder = new CollectionBuilder();

// For each item in collection, map 'name' to 'full_name'
/**/
$builder
    ->map('id', 'user_id')->remove('id')
    ->map('about', 'description')
    ->map('name', 'full_name')
    ->collection('friends', function (CollectionBuilder $builder) {
        $builder->map('name', 'full_name')->remove('name');
    });
/**/
$out = $transformer->transform($data, $builder);

$content = "<?php\r\n\r\nreturn " . var_export($out, true);
//file_put_contents('sample.php', $content);

echo '<pre>' . print_r($out, true) . '</pre>';
