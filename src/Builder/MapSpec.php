<?php

namespace Morrelinko\Datran\Builder;

use Morrelinko\Datran\Toolbox\ArrayUtils;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class MapSpec implements SpecInterface
{
    public function __construct($find, $key)
    {
        if (!$key) {
            $key = $find;
        }

        $this->find = $find;
        $this->key = $key;
    }

    public function apply(&$input)
    {
        $input[$this->key] = ArrayUtils::get($input, $this->find);
    }
}
