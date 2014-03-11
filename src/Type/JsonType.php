<?php

namespace Morrelinko\DataTransformer\Type;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class JsonType implements TypeInterface
{
    public function decode($input)
    {
        return json_decode($input, true);
    }

    public function encode($input)
    {
        return json_encode($input);
    }
}
