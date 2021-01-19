<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/12/22
 * Time: 10:46
 */

namespace App\Http\Middleware;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RSAEncryptMiddleware
{

    public function handle(Request $request, \Closure $next, $guard = null)
    {
        /** @var JsonResponse $response */
        $response = $next($request);

        if ($request->header('x_no_sign')){
            return $response;
        }

        $path = storage_path("app/");
        $key_string = file_get_contents($path. "forecast/forecast.pub");

        $body = json_decode($response->getContent(), true);

        $publicKey = openssl_pkey_get_public($key_string);
        $length = 117;
        $data = json_encode($body['data']);

        $plaintext = str_split($data, $length);
        $ciphertext = '';
        foreach ($plaintext as $m) {
            openssl_public_encrypt($m, $encrypt, $publicKey);
            $ciphertext.= base64_encode($encrypt)."$";
        }

        $ciphertext = substr($ciphertext, 0, -1);

        $body['data'] = $ciphertext;

        return new Response(json_encode($body));
    }
}