<?php

namespace Morrelinko\DataTransformer\Builder;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class ItemBuilder extends Builder
{
    public function build(array &$input)
    {
        foreach ($this->specs as $spec) {
            $spec->apply($input);
        }
    }
}
