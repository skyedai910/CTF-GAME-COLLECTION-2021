<?php

/*
 *
 * O泡易支付系统
 */

class Eshanghu
{
    const WECHAT_NATIVE_URL = 'https://api.1shanghu.com/api/v2/wechat/native';
    const QUERY_URL = 'https://api.1shanghu.com/api/query';
    const WECHAT_JSAPI_URL = 'https://api.1shanghu.com/api/v2/wechat/mp';

    public $appKey;
    public $appSecret;
    public $subMchId;
    public $notify;
    public $client;

    public function __construct(array $config)
    {
        $this->appKey = $config['app_key'];
        $this->appSecret = $config['app_secret'];
        $this->subMchId = $config['sub_mch_id'];
        $this->notify = $config['notify'];

    }

    public function create($outTradeNo, $subject, $totalFee, $extra = '')
    {
        $data = [
            'app_key' => $this->appKey,
			'sub_mch_id' => $this->subMchId,
            'out_trade_no' => $outTradeNo,
            'total_fee' => $totalFee,
            'subject' => $subject,
            'notify_url' => $this->notify,
        ];
        $data['sign'] = Signer::getSign($data, $this->appSecret);

        return $this->request(self::WECHAT_NATIVE_URL, $data);
    }

    /**
     * 微信JSAPI支付.
     *
     * @param string $outTradeNo
     * @param string $subject
     * @param int    $totalFee
     * @param string $openid
     * @param string $extra
     */
    public function mp($outTradeNo, $subject, $totalFee, $openid, $extra = '')
    {
        $data = [
            'app_key' => $this->appKey,
			'sub_mch_id' => $this->subMchId,
            'openid' => $openid,
            'out_trade_no' => $outTradeNo,
            'total_fee' => $totalFee,
            'subject' => $subject,
            'notify_url' => $this->notify,
        ];
        $data['sign'] = Signer::getSign($data, $this->appSecret);

        return $this->request(self::WECHAT_JSAPI_URL, $data);
    }

    /**
     * openid获取的url.
     *
     * @param string $callbackUrl
     */
    public function getOpenidUrl(string $callbackUrl)
    {
		$data = [
            'app_key' => $this->appKey,
			'sub_mch_id' => $this->subMchId,
            'callback' => $callbackUrl,
        ];
        $url = 'https://1shanghu.com/v2/wechat/login?'.http_build_query($data);

        return $url;
    }

    /**
     * 回调验证
     *
     * @param array $data
     *
     * @return array
     *
     * @throws SignErrorException
     */
    public function checkSign(array $data)
    {
        if (Signer::verify($data, $data['sign'], $this->appSecret)) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * 使用OrderSn进行查询.
     *
     * @param $orderSn
     *
     * @return mixed
     *
     * @throws EshanghuException
     * @throws HttpRequestErrorException
     */
    public function queryUseOrderSn($orderSn)
    {
        $data = [
            'app_key' => $this->appKey,
            'order_sn' => $orderSn,
        ];

        return $this->query($data);
    }

    /**
     * 使用OutTradeNo进行查询.
     *
     * @param $outTradeNo
     *
     * @return mixed
     *
     * @throws EshanghuException
     * @throws HttpRequestErrorException
     */
    public function queryUseOutTradeNo($outTradeNo)
    {
        $data = [
            'app_key' => $this->appKey,
            'out_trade_no' => $outTradeNo,
        ];

        return $this->query($data);
    }

    /**
     * 订单查询.
     *
     * @param array $data
     *
     * @return mixed
     *
     * @throws EshanghuException
     * @throws HttpRequestErrorException
     */
    public function query(array $data)
    {
        $data['sign'] = Signer::getSign($data, $this->appSecret);

        return $this->request(self::QUERY_URL, $data);
    }

    /**
     * 请求
     *
     * @param $url
     * @param array $data
     *
     * @return mixed
     *
     * @throws EshanghuException
     * @throws HttpRequestErrorException
     */
    public function request($url, array $data)
    {
        $response = $this->post($url,$data);
        if (!$response) {
            sysmsg('无法创建远程支付订单');
        }
        $responseContent = json_decode($response, true);
        return $responseContent;
    }

	private function post($url, $data) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $rst = curl_exec($ch);
        curl_close($ch);

        return $rst;
    }
}
?>