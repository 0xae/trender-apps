<?php
namespace app\models;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class HttpReq extends \yii\base\Object {
    public static function get($url, $headers=[], $options=[]) {
    	try {
            $headers[] = 'Content-type: application/json';
			$ch = curl_init($url);            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $body = curl_exec($ch);
            $error = curl_errno($ch);
            if (!$error) {
              switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  // OK
                  break;
                case 404: // OK
                    throw new NotFoundHttpException($body);
                default:
                    // XXX
                    throw new HttpException($http_code, $body);
              }
            } else {
                throw new HttpException(503, "GET $url<br/>Could not complete request. {$body}");
            }
            $json=json_decode($body);
    	} finally {
    		if ($ch) {
                curl_close($ch);
            }
    	}

        return $json;
    }

    public static function post($url, $data, $headers=[])  {
        return self::postData(CURLOPT_POST, $url, $data, $headers);
    }

    public static function put($url, $data, $headers=[])  {
        return self::postData(CURLOPT_PUT, $url, $data, $headers);
    }

    private static function postData($method, $url, $data, $headers) {
        try {
            $headers[] = 'Content-type: application/json';
            $ch = curl_init($url);            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, $method, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);            
            $body = curl_exec($ch);
            $error = curl_errno($ch);

            if (!$error) {
              switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK
                  break;
                default:
                    // XXX
                    throw new HttpException($http_code, '('.$data.')Error accessing: ' . $url . '  Details: ' . $body. '<br/>-------<br/>' . curl_error($ch));
              }
            } else {
                throw new HttpException(503, "Could not complete request. {$error}");
            }
            $json=json_decode($body);
        } finally {
            if ($ch) curl_close($ch);
        }

        return $json;
    }
}

