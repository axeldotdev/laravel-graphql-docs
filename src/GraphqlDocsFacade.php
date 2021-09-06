<?php

namespace Axeldotdev\GraphqlDocs;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Axeldotdev\GraphqlDocs\GraphqlDocs
 */
class GraphqlDocsFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'graphql-docs';
    }
}
