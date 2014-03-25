<?php

namespace Morrelinko\Datran\Type;

/**
 * @author Laju Morrison <morrelinko@gmail.com>
 */
interface TypeInterface
{
    public function decode($input);

    public function encode($input);
}
