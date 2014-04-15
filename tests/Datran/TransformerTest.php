<?php

namespace Morrelinko\Datran;

use Morrelinko\Datran\Builder\CollectionBuilder;
use Morrelinko\Datran\Builder\ItemBuilder;
use Morrelinko\Datran\Type\ArrayType;
use Morrelinko\Datran\Type\JsonType;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class TransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Transformer
     */
    protected $transformer;

    public function setUp()
    {
        $this->transformer = new Transformer(
            new JsonType(),
            new ArrayType()
        );
    }

    public function testBasic()
    {
        $json = $this->getJsonData('basic.json');
        $array = $this->transformer->transform($json);

        $this->assertArrayHasKey('name', $array);
    }

    public function testWithBuilder()
    {
        $json = $this->getJsonData('basic.json');
        $builder = (new ItemBuilder())->map('name', 'full_name')->remove('name');
        $array = $this->transformer->transform($json, $builder);

        $this->assertArrayNotHasKey('name', $array);
        $this->assertArrayHasKey('full_name', $array);
        $this->assertEquals('John Doe', $array['full_name']);
    }

    public function testDeepMap()
    {
        $json = $this->getJsonData('advance.json');
        $builder = (new ItemBuilder())->map('address.title', 'address_title')->remove('address');
        $array = $this->transformer->transform($json, $builder);

        $this->assertArrayHasKey('address_title', $array);
        $this->assertEquals('Hebert Macaulay, 232', $array['address_title']);
        $this->assertArrayNotHasKey('address', $array);
    }

    public function testCollection()
    {
        $json = $this->getJsonData('advance.json');

        // Our root json is an item,
        $builder = new ItemBuilder();

        // it has a collection/list called friends
        $builder->collection('friends', function (CollectionBuilder $builder) {
            // For all friends item, change 'name' to 'full_name'
            $builder->map('name', 'full_name');
        });

        $array = $this->transformer->transform($json, $builder);

        $this->assertArrayHasKey('full_name', $array['friends'][0]);
    }

    protected function getJsonData($file)
    {
        return file_get_contents(__DIR__ . '/resource/' . $file);
    }
}
