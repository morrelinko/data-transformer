<?php

namespace Morrelinko\DataTransformer\Builder;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class CollectionBuilder extends Builder
{
    public function build(array &$input)
    {
        foreach ($input as $key => $item) {
            foreach ($this->specs as $spec) {
                $spec->apply($input[$key]);
            }
        }
    }
}
