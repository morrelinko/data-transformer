<?php

namespace Morrelinko\Datran;

use Morrelinko\Datran\Builder\Builder;
use Morrelinko\Datran\Type\TypeInterface;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
class Transformer
{
    /**
     * @var Type\TypeInterface
     */
    protected $fromType;

    /**
     * @var Type\TypeInterface
     */
    protected $toType;

    /**
     * Constructor
     *
     * @param TypeInterface $from
     * @param TypeInterface $to
     */
    public function __construct(TypeInterface $from, TypeInterface $to)
    {
        $this->fromType = $from;
        $this->toType = $to;
    }

    /**
     * @param $input
     * @param \Morrelinko\Datran\Builder\Builder $builder
     * @return mixed
     */
    public function transform($input, Builder $builder = null)
    {
        $input = $this->fromType->decode($input);

        if ($builder) {
            $builder->build($input);
        }

        return $this->toType->encode($input);
    }
}
