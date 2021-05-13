<?php


namespace App\Modules\QiNiu;

class Token
{
    private $accessKey;

    private $secretKey;

    public function __construct($accessKey, $secretKey)
    {
        $this->accessKey = $accessKey;

        $this->secretKey = $secretKey;
    }

    /**
     * 上传策略
     *
     * @var array
     */
    private static $policyFields = array(
        'callbackUrl',
        'callbackBody',
        'callbackHost',
        'callbackBodyType',
        'callbackFetchKey',

        'returnUrl',
        'returnBody',

        'endUser',
        'saveKey',
        'insertOnly',

        'detectMime',
        'mimeLimit',
        'fsizeMin',
        'fsizeLimit',

        'persistentOps',
        'persistentNotifyUrl',
        'persistentPipeline',

        'deleteAfterDays',
        'fileType',
        'isPrefixalScope',
    );

    /**
     * 生成七牛云上传TOKEN
     *
     * @param  string  $bucket
     * @param  null    $key
     * @param  int     $expires
     * @param  null    $policy
     * @param  bool    $strictPolicy
     *
     * @return string
     */
    public function uploadToken(string $bucket, $key = null, $expires = 3600, $policy = null, $strictPolicy = true)
    {
        $deadline         = time() + $expires;
        $scope            = $bucket;
        $args             = self::copyPolicy($args, $policy, $strictPolicy);
        $args['scope']    = $scope;
        $args['deadline'] = $deadline;
        $b                = json_encode($args);
        $encodedData      = self::base64UrlSafeEncode($b);
        $hmac             = hash_hmac('sha1', $encodedData, $this->secretKey, true);

        return $this->accessKey . ':' . self::base64UrlSafeEncode($hmac) . ':' . $encodedData;
    }

    /**
     * @param $policy
     * @param $originPolicy
     * @param $strictPolicy
     *
     * @return array
     */
    private static function copyPolicy(&$policy, $originPolicy, $strictPolicy)
    {
        if ($originPolicy === null) {
            return array();
        }
        foreach ($originPolicy as $key => $value) {
            if ( ! $strictPolicy || in_array((string)$key, self::$policyFields, true)) {
                $policy[$key] = $value;
            }
        }

        return $policy;
    }

    public static function base64UrlSafeEncode($data)
    {
        $find = array('+', '/');

        $replace = array('-', '_');

        return str_replace($find, $replace, base64_encode($data));
    }
}