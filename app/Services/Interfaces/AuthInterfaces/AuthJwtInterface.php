<?php

namespace App\Services\Interfaces\AuthInterfaces;

interface AuthJwtInterface
{

    public static function SignInCertificated($data, $hours = 24);

    public static function SignIn($data, $timeExp);

    public static function GetData($token);

    public static function Aud();

    public static function secured_decrypt($inputData);

    /**
     * metodo para desencriptar el codigo de seguridad
     * 
     * @param String $token
     * @param Array $toArray
     * @return Object $dataDecript
     */
    public static function getCode($token, $toArray = false);

    public static function AudStrict();
}
