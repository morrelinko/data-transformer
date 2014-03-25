<?php

namespace Morrelinko\Datran\Builder;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class RemoveSpec implements SpecInterface
{
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function apply(&$input)
    {
        unset($input[$this->key]);
    }
}
