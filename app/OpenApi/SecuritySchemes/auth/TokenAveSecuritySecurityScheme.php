<?php

namespace App\OpenApi\SecuritySchemes\auth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;
use Vyuldashev\LaravelOpenApi\Factories\SecuritySchemeFactory;

class TokenAveSecuritySecurityScheme extends SecuritySchemeFactory
{
    public function build(): SecurityScheme
    {
        return SecurityScheme::create('TokenAveSecurity')
            ->type(SecurityScheme::TYPE_API_KEY)
            ->in(SecurityScheme::IN_HEADER)
            ->name('Authorization')
            ->description('Authorization ave token.');
    }
}
