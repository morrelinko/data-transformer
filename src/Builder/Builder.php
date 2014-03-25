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
        $this->specs[] = new RemoveSpec($key);

        return $this;
    }

    public function map($find, $key = null)
    {
        if (!$key) {
            $key = $find;
        }

        $this->specs[] = new MapSpec($find, $key);

        return $this;
    }

    public function item($key, $callback)
    {
        $this->specs[] = new ItemSpec($key, $callback);

        return $this;
    }

    public function collection($key, $callback)
    {
        $this->specs[] = new CollectionSpec($key, $callback);

        return $this;
    }

    abstract public function build(array &$input);
}
