<?php

namespace Phim\Mutation;

interface ImmutableInterface
{

    public function mutate(callable $mutator);
}