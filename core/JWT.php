<?php
namespace Core;

class JWT
{
    private $secret;
    public function __construct()
    {
        $this->secret = '@!232382@#4#@!2$#%$Fdss';
    }
    public function create($data)
    {
        $header = json_encode(
            array(
                "typ" => "JWT",
                "alg" => "HS256"
            )
        );
        $payloader = json_encode($data);

        $hbase = $this->base64url_encode($header);
        $pbase = $this->base64url_encode($payloader);

        $signature = hash_hmac("sha256", $hbase.".".$pbase, $this->secret, true);
        $sbase = $this->base64url_encode($signature);

        $jwt = $hbase.".".$pbase.".".$sbase;

        return $jwt;
    }

    public function validateJWT($token)
    {
        $json_split = explode('.', $token);

        if (count($json_split) === 3) {
            $signature = hash_hmac("sha256", $json_split[0].".".$json_split[1], $this->secret, true);
            $sbase = $this->base64url_encode($signature);

            if ($sbase == $json_split[2]) {
                $decodeInformation = $this->base64url_decode($json_split[1]);

            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    private function base64url_encode( $data ){
        return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
    }
  
    private function base64url_decode( $data ){
        return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    }
}