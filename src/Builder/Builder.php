<?php

namespace Morrelinko\Datran\Builder;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
abstract class Builder
{
    protected $project = [];

    /**
     * @var SpecInterface[]
     */
    protected $specs = [];

    public function remove($key)
    {
        return $this->addSpec(new RemoveSpec($key));
    }

    public function map($find, $key = null)
    {
        return $this->addSpec(new MapSpec($find, $key));
    }

    public function item($key, $callback)
    {
        return $this->addSpec(new ItemVisitor($key, $callback));
    }

    public function collection($key, $callback)
    {
        return $this->addSpec(new CollectionVisitor($key, $callback));
    }

    public function addSpec(SpecInterface $spec)
    {
        $this->specs[] = $spec;

        return $this;
    }

    abstract public function build(array &$input);
}
