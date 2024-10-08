<?php

namespace App\OpenApi\Parameters\user;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class LoginParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::header()
                ->name('Authorization')
                ->example('Basic ZGVzYXJyb2xsbzhAYXZlb25saW5lLmNvOk00cjFhajA1Myo=')
                ->description('Parameter description')
                ->required(true),
        ];
    }
}
