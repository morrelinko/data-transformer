<?php

namespace Morrelinko\Datran\Builder;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class CollectionVisitor implements SpecInterface
{
    /**
     * @param int|string $key
     * @param \Closure $callback
     */
    public function __construct($key, $callback)
    {
        $this->key = $key;
        $this->callback = $callback;
    }

    public function apply(&$input)
    {
        $builder = new CollectionBuilder();
        call_user_func($this->callback, $builder);
        $builder->build($input[$this->key]);
    }
}
