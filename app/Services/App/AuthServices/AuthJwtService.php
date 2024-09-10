<?php

namespace App\Services\App\AuthServices;

use App\Services\Interfaces\AuthInterfaces\AuthJwtInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class AuthJwtService implements AuthJwtInterface
{
    private static $secret_key = 'secret_key11';

    private static $encrypt = 'HS512';

    private static $encryptSSL = 'RS256';

    private static $passphrase = 'aguapanelaconlimon';

    public static function SignInCertificated($data, $hours = 24)
    {
        $data = (array) $data;
        $keySSL = openssl_get_privatekey(file_get_contents(__DIR__ . '/../../../keys/privateKey.pem'), self::$passphrase);
        $time = time();
        $dataSecure = self::secured_encrypt($data);
        $token = [
            'iss' => isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '',
            'exp' => $time + (60 * 60 * $hours),
            'aud' => self::Aud(),
            'data' => $dataSecure,
            'statusCliente' => isset($data['statusCliente']) ? $data['statusCliente'] : '',
        ];
        if (isset($data['i_idusuario'])) {
            $token['i_idusuario'] = $data['i_idusuario'];
        }
        if (isset($data['i_idempresa'])) {
            $token['enterprise'] = $data['i_idempresa'];
        }
        if (isset($data['nombreCompleto'])) {
            $token['nombreCompleto'] = $data['nombreCompleto'];
        }

        return JWT::encode($token, $keySSL, self::$encryptSSL);
    }

    public static function SignIn($data, $timeExp)
    {
        try {
            $dataEncrypt = self::secured_encrypt($data);
            $payloadToken = [
                'iss' => $_SERVER['REMOTE_ADDR'],
                'exp' => $timeExp,
                'aud' => self::Aud(),
                'data' => $dataEncrypt,
            ];

            return JWT::encode($payloadToken, self::$secret_key, self::$encrypt);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'status' => 'error de autenticacion',
                    'message' => $e->getMessage(),
                ],
                403
            );
        }
    }

    public static function GetData($token)
    {
        $keyPublic = openssl_get_publickey(file_get_contents(__DIR__ . '/../../../keys/key.public.pem'));

        $dataToken = JWT::decode($token, new Key($keyPublic, self::$encryptSSL));

        $data = self::secured_decrypt($dataToken->data);

        return $data;
    }

    public static function Aud()
    {
        $aud = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        }

        $aud .= isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $aud .= gethostname();

        return md5($aud);
    }

    private static function secured_encrypt($data)
    {
        $first_key = base64_decode(self::$secret_key);
        $second_key = base64_decode(self::$passphrase);
        $cypherMethod = 'AES-256-CBC';

        $dataToEncrypt = serialize($data);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cypherMethod));

        $first_encrypted = openssl_encrypt($dataToEncrypt, $cypherMethod, $first_key, OPENSSL_RAW_DATA, $iv);
        $second_encrypted = hash_hmac('sha256', utf8_encode($first_encrypted), $second_key, true);
        $output = base64_encode($iv . $second_encrypted . $first_encrypted);

        return $output;
    }

    public static function secured_decrypt($inputData)
    {
        $first_key = base64_decode(self::$secret_key);
        $second_key = base64_decode(self::$passphrase);
        $cypherMethod = 'AES-256-CBC';

        $mix = base64_decode($inputData);
        $iv_length = openssl_cipher_iv_length($cypherMethod);
        $ivX = substr($mix, 0, $iv_length);
        $second_encryptedX = substr($mix, $iv_length, 32);
        $first_encryptedX = substr($mix, $iv_length + 32);

        $data = openssl_decrypt($first_encryptedX, $cypherMethod, $first_key, OPENSSL_RAW_DATA, $ivX);
        $second_encrypted_new = hash_hmac('sha256', utf8_encode($first_encryptedX), $second_key, true);

        if ($second_encryptedX == $second_encrypted_new) {
            return unserialize($data);
        }

        return false;
    }


    /**
     * metodo para desencriptar el codigo de seguridad
     * 
     * @param String $token
     * @param Array $toArray
     * @return Object $dataDecript
     */
    public static function getCode($token, $toArray = false)
    {
        $dataToken = JWT::decode($token, new Key(self::$secret_key, self::$encrypt));
        $data = $dataToken->data;
        $dataDecrypt = self::secured_decrypt($data);
        if ($toArray) {
            $dataDecrypt = json_decode(json_encode($dataDecrypt), true);
        }
        return $dataDecrypt;
    }



    public static function AudStrict()
    {
        $aud = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }
        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return md5($aud);
    }
}
