<?php

namespace Morrelinko\DataTransformer\Builder;

use Morrelinko\DataTransformer\Toolbox\ArrayUtils;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class MapSpec implements SpecInterface
{
    public function __construct($find, $key)
    {
        $this->find = $find;
        $this->key = $key;
    }

    public function apply(&$input)
    {
        $input[$this->key] = ArrayUtils::get($input, $this->find);
    }
}
