<?php

namespace App\Tools;

class Rc4cryptAve
{
    private static function seed(): string
    {
        return 'C4mpr4nd0f4c1l';
    }

    private static function encrypt(string $seed, string $data): string
    {
        $key[] = '';
        $box[] = '';
        $cipher = '';
        $seed_length = strlen($seed);
        $data_length = strlen($data);

        for ($i = 0; $i < 256; $i++) {
            $key[$i] = ord($seed[$i % $seed_length]);
            $box[$i] = $i;
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $key[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $data_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;

            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;

            $k = $box[(($box[$a] + $box[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }

        return $cipher;
    }

    private static function decrypt($seed, $data): string
    {
        return self::encrypt($seed, $data);
    }

    public static function encryptPass(string $password): string
    {
        return urlencode(self::encrypt(self::seed(), $password));
    }

    public static function decryptPass(string $passwordEnc): string
    {
        return self::decrypt(self::seed(), urldecode($passwordEnc));
    }
}
