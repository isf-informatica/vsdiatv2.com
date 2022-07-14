<?php

namespace App\Libraries;

require APPPATH.'../vendor/autoload.php';
use PHPGangsta_GoogleAuthenticator;

class Mfa_Library{

    public function __construct()
    {
        $this->ga = new PHPGangsta_GoogleAuthenticator();
    }
    
    public function generate_qr()
    {
        $secret = $this->ga->createSecret();
        $qrCodeUrl = $this->ga->getQRCodeGoogleUrl('easylearnv3.net.in ('.$_SESSION['user']['email'].')', $secret);

        return $qrCodeUrl;
    }

    public function validate_qr($code = Null, $secret = Null)
    {
        $checkResult = $this->ga->verifyCode($secret, $code, 1);

        if($checkResult)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}