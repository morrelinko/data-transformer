<?php

use Morrelinko\DataTransformer\Builder\CollectionBuilder;
use Morrelinko\DataTransformer\Transformer;
use Morrelinko\DataTransformer\Type\ArrayType;
use Morrelinko\DataTransformer\Type\JsonType;

require_once __DIR__ . '/../vendor/autoload.php';

$transformer = new Transformer(
    new JsonType(),
    new ArrayType()
);

$data = file_get_contents('./facebook-page-album-photos.json');
$builder = new CollectionBuilder();
$builder
    ->map('id')
    ->map('name', 'title')->remove('name')
    ->map('type')
    ->map('description')
    ->map('cover_photo')
    ->map('privacy')
    ->map('photos.data', 'photos')->collection('photos', function (CollectionBuilder $builder) {
        $builder
            ->map('name', 'caption')->remove('name')
            ->map('created_time', 'created_at')->remove('created_time')
            ->remove('album');
    });

$out = $transformer->transform($data, $builder);

$content = "<?php\r\n\r\nreturn " . var_export($out, true);
file_put_contents('facebook-page-album-photos.php', $content);

echo '<pre>' . print_r($out, true) . '</pre>';

?>

<form method="post">
    <label>
        <textarea name=""></textarea>
    </label>
</form>