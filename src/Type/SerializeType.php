<?php

namespace Morrelinko\DataTransformer\Type;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class SerializeType implements TypeInterface
{
    public function decode($input)
    {
        return unserialize($input);
    }

    public function encode($input)
    {
        return serialize($input);
    }
}
