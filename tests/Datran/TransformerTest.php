<?php

namespace Morrelinko\Datran;

use Morrelinko\Datran\Type\ArrayType;
use Morrelinko\Datran\Type\JsonType;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class TransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $json = file_get_contents(__DIR__ . '/resource/basic.json');
        $transformer = new Transformer(
            new JsonType(),
            new ArrayType()
        );

        $array = $transformer->transform($json);
        $this->assertArrayHasKey('name', $array);
    }
}
