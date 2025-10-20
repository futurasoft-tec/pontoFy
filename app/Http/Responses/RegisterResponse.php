<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use App\Services\RedirectUserService;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        return app(RedirectUserService::class)->handle();
    }
}
