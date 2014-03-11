<?php

namespace Morrelinko\DataTransformer\Type;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class ArrayType implements TypeInterface
{
    public function decode($input)
    {
        return (array) $input;
    }

    public function encode($input)
    {
        return (array) $input;
    }
}
