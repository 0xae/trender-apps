<?php
namespace app\models;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class HttpReq extends \yii\base\Object {
    public static function get($url) {
    	try {
			$ch = curl_init($url);            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $body = curl_exec($ch);

            if (!curl_errno($ch)) {
              switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK
                  break;
                default:
                    // XXX
                    throw new HttpException($http_code, 'Error accessing: ' . $url . '  Details: ' . $body. '<br/>-------<br/>' . curl_error($ch));
              }
            }

            if ($body) $json=json_decode($body);
            if (!$json) return $body;
    	} finally {
    		if ($ch) curl_close($ch);
    	}

        return $json;
    }

    public static function post($url, $data)  {
        return self::postData(CURLOPT_POST, $url, $data);
    }

    public static function put($url, $data)  {
        return self::postData(CURLOPT_PUT, $url, $data);
    }

    private static function postData($method, $url, $data) {
        try {
            $ch = curl_init($url);            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, $method, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $body = curl_exec($ch);

            if (!curl_errno($ch)) {
              switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK
                  break;
                default:
                    // XXX
                    throw new HttpException($http_code, '('.$data.')Error accessing: ' . $url . '  Details: ' . $body. '<br/>-------<br/>' . curl_error($ch));
              }
            }
            $json=json_decode($body);
        } finally {
            if ($ch) curl_close($ch);
        }
        return $json;
    }
}

