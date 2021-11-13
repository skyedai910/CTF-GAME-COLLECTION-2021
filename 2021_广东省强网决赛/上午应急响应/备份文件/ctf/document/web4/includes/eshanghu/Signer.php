<?php

/*
 *
 * O泡易支付系统
 */


class Signer
{
    /**
     * 获取签名.
     *
     * @param array  $data
     * @param string $appSecret
     *
     * @return string
     */
    public static function getSign(array $data, $appSecret)
    {
        ksort($data);
        $rows = [];
        foreach ($data as $key => $value) {
            if (! $value || $key == 'sign') {
                continue;
            }
            $rows[] = "{$key}={$value}";
        }
        $s = implode('&', $rows);
        $s .= $appSecret;

        return strtoupper(md5($s));
    }

    /**
     * 验证签名.
     *
     * @param array $data
     * @param $sign
     * @param $appSecret
     *
     * @return bool
     */
    public static function verify(array $data, $sign, $appSecret)
    {
        return strtoupper($sign) === self::getSign($data, $appSecret);
    }
}
?>