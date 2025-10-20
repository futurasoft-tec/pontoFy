<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Services\RedirectUserService;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        return app(RedirectUserService::class)->handle();
    }
}
