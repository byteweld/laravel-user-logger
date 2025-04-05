<?php

declare(strict_types=1);

namespace Byteweld\LaravelUserLogger\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Byteweld\LaravelUserLogger\Models\UserLog logFromRequest(\Illuminate\Http\Request $request)
 * 
 * @see \Byteweld\LaravelUserLogger\UserLogger
 */
class UserLogger extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user-logger';
    }
}