<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class HTMLtoCSV_Model extends Model
{
    protected $db;

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function student_email($email = NULL){
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="https://www.w3.org/1999/xhtml">
            <head>
                <title>EASYLEARN</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <style type="text/css">
                    * {
                        -ms-text-size-adjust:100%;
                        -webkit-text-size-adjust:none;
                        -webkit-text-resize:100%;
                        text-resize:100%;
                    }
                    a{
                        outline:none;
                        color:#40aceb;
                        text-decoration:underline;
                    }
                    a:hover{
                        text-decoration:none !important;
                    }
                    .nav a:hover{
                        text-decoration:underline !important;
                    }
                    .title a:hover{
                        text-decoration:underline !important;
                    }
                    .title-2 a:hover{
                        text-decoration:underline !important;
                    }
                    .btn:hover{
                        opacity:0.8;
                    }
                    .btn a:hover{
                        text-decoration:none !important;
                    }
                    .btn{
                        -webkit-transition:all 0.3s ease;
                        -moz-transition:all 0.3s ease;
                        -ms-transition:all 0.3s ease;
                        transition:all 0.3s ease;
                    }
                    table td {
                        border-collapse: collapse !important;
                    }
                    .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{
                        line-height:inherit;
                    }
                    @media only screen and (max-width:500px) {
                        table[class="flexible"]{
                            width:100% !important;
                        }
                        table[class="center"]{
                            float:none !important;
                            margin:0 auto !important;
                        }

                        *[class="hide"]{
                            display:none !important;
                            width:0 !important;
                            height:0 !important;
                            padding:0 !important;
                            font-size:0 !important;
                            line-height:0 !important;
                        }
                        td[class="img-flex"] img{
                            width:100% !important;
                            height:auto !important;
                        }
                        td[class="aligncenter"]{
                            text-align:center !important;
                        }
                        th[class="flex"]{
                            display:block !important;
                            width:100% !important;
                        }
                        td[class="wrapper"]{
                            padding:0 !important;
                        }
                        td[class="holder"]{
                            padding:30px 15px 20px !important;
                        }
                        td[class="nav"]{
                            padding:20px 0 0 !important;
                            text-align:center !important;
                        }
                        td[class="h-auto"]{
                            height:auto !important;
                        }
                        td[class="description"]{
                            padding:30px 20px !important;
                        }
                        td[class="i-120"] img{
                            width:120px !important;
                            height:auto !important;
                        }
                        td[class="footer"]{
                            padding:5px 20px 20px !important;
                        }
                        td[class="footer"] td[class="aligncenter"]{
                            line-height:25px !important;
                            padding:20px 0 0 !important;
                        }
                        tr[class="table-holder"]{
                            display:table !important;
                            width:100% !important;
                        }
                        th[class="thead"]{
                            display:table-header-group !important; 
                            width:100% !important;
                        }
                        th[class="tfoot"]{
                            display:table-footer-group !important; 
                            width:100% !important;
                        }
                    }
                </style>
            </head>

            <body style="margin:0; padding:0;" bgcolor="#eaeced">
                <table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
                    <!-- fix for gmail -->
                    <tr>
                        <td class="hide">
                            <table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
                                <tr>
                                    <td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="wrapper" style="padding:10px 10px;">
                            <!-- module 1 -->
                            <table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td data-bgcolor="bg-module" bgcolor="#eaeced">
                                        <table class="flexible" width="500" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                            <!-- <tr>
                                                <td style="background: #173965">
                                                    <img src="../assets/images/mentor-logo.png">
                                                </td>
                                            </tr> -->

                                            <tr>
                                                <td class="img-flex"><img src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/Video-conferencing.png" style="vertical-align:top;" width="500" height="300" alt="" /></td>
                                            </tr>

                                            <tr>
                                                <td data-bgcolor="bg-block" class="holder" style="padding:58px 48px 52px;background-color:#fff;color:#173965;">
                                                    <table width="100%" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#173965;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#f4b50a; padding:0 0 24px;">
                                                                WELCOME TO <br>EASYLEARN
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                                Your Account Has Been Added
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="start" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                                Email: <span>'.$email.'</span><br>
                                                                Password: easylearn 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:14px/15px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 5px;">
                                                                <br><br>Follow us today on our social network:
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <hr>
                                                                <a href="https://www.facebook.com/ISF-Analytica-and-Informatica-232880530938158" target="_blank" rel="noopener"><img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/facebook_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.instagram.com/isf_analytica_informatica/" target="_blank" rel="noopener"><img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/instagram_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.linkedin.com/company/14527413/admin/" target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/linkedin.png" width="35" height="35" /></a>
                                                                <a href="https://twitter.com/AnalyticaIsf" target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/twitter_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.youtube.com/channel/UC5-S1eiLCQm7yT10hmuAKNQ?view_as=subscriber"  target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/youtube_small.png" width="35" height="35" /></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <!-- fix for gmail --> 
                </table>
            </body>
        </html>';

        $this->email->setTo($email);
        $this->email->setFrom('info@isfedutech.com' , 'Easylearn');
        
        $this->email->setSubject('WELCOME TO EASYLEARN');
        $this->email->setMessage($message);
        $this->email->send();

    }

    public function existparent_email($email = NULL, $student_name = NULL){
        $message = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="https://www.w3.org/1999/xhtml">
            <head>
                <title>EASYLEARN</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <style type="text/css">
                    * {
                        -ms-text-size-adjust:100%;
                        -webkit-text-size-adjust:none;
                        -webkit-text-resize:100%;
                        text-resize:100%;
                    }
                    a{
                        outline:none;
                        color:#40aceb;
                        text-decoration:underline;
                    }
                    a:hover{
                        text-decoration:none !important;
                    }
                    .nav a:hover{
                        text-decoration:underline !important;
                    }
                    .title a:hover{
                        text-decoration:underline !important;
                    }
                    .title-2 a:hover{
                        text-decoration:underline !important;
                    }
                    .btn:hover{
                        opacity:0.8;
                    }
                    .btn a:hover{
                        text-decoration:none !important;
                    }
                    .btn{
                        -webkit-transition:all 0.3s ease;
                        -moz-transition:all 0.3s ease;
                        -ms-transition:all 0.3s ease;
                        transition:all 0.3s ease;
                    }
                    table td {
                        border-collapse: collapse !important;
                    }
                    .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{
                        line-height:inherit;
                    }
                    @media only screen and (max-width:500px) {
                        table[class="flexible"]{
                            width:100% !important;
                        }
                        table[class="center"]{
                            float:none !important;
                            margin:0 auto !important;
                        }

                        *[class="hide"]{
                            display:none !important;
                            width:0 !important;
                            height:0 !important;
                            padding:0 !important;
                            font-size:0 !important;
                            line-height:0 !important;
                        }
                        td[class="img-flex"] img{
                            width:100% !important;
                            height:auto !important;
                        }
                        td[class="aligncenter"]{
                            text-align:center !important;
                        }
                        th[class="flex"]{
                            display:block !important;
                            width:100% !important;
                        }
                        td[class="wrapper"]{
                            padding:0 !important;
                        }
                        td[class="holder"]{
                            padding:30px 15px 20px !important;
                        }
                        td[class="nav"]{
                            padding:20px 0 0 !important;
                            text-align:center !important;
                        }
                        td[class="h-auto"]{
                            height:auto !important;
                        }
                        td[class="description"]{
                            padding:30px 20px !important;
                        }
                        td[class="i-120"] img{
                            width:120px !important;
                            height:auto !important;
                        }
                        td[class="footer"]{
                            padding:5px 20px 20px !important;
                        }
                        td[class="footer"] td[class="aligncenter"]{
                            line-height:25px !important;
                            padding:20px 0 0 !important;
                        }
                        tr[class="table-holder"]{
                            display:table !important;
                            width:100% !important;
                        }
                        th[class="thead"]{
                            display:table-header-group !important; 
                            width:100% !important;
                        }
                        th[class="tfoot"]{
                            display:table-footer-group !important; 
                            width:100% !important;
                        }
                    }
                </style>
            </head>

            <body style="margin:0; padding:0;" bgcolor="#eaeced">
                <table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
                    <!-- fix for gmail -->
                    <tr>
                        <td class="hide">
                            <table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
                                <tr>
                                    <td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="wrapper" style="padding:10px 10px;">
                            <!-- module 1 -->
                            <table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td data-bgcolor="bg-module" bgcolor="#eaeced">
                                        <table class="flexible" width="500" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                            <!-- <tr>
                                                <td style="background: #173965">
                                                    <img src="../assets/images/mentor-logo.png">
                                                </td>
                                            </tr> -->

                                            <tr>
                                                <td class="img-flex"><img src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/Video-conferencing.png" style="vertical-align:top;" width="500" height="300" alt="" /></td>
                                            </tr>

                                            <tr>
                                                <td data-bgcolor="bg-block" class="holder" style="padding:58px 48px 52px;background-color:#fff;color:#173965;">
                                                    <table width="100%" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#173965;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#f4b50a; padding:0 0 24px;">
                                                                WELCOME TO <br>EASYLEARN
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                                Your Child '.$student_name.' account has been added Successfully <br> Connected With Your easylearn Email ID <br>'.$email.'
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:14px/15px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 5px;">
                                                                <br><br>Follow us today on our social network:
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <hr>
                                                                <a href="https://www.facebook.com/ISF-Analytica-and-Informatica-232880530938158" target="_blank" rel="noopener"><img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/facebook_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.instagram.com/isf_analytica_informatica/" target="_blank" rel="noopener"><img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/instagram_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.linkedin.com/company/14527413/admin/" target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/linkedin.png" width="35" height="35" /></a>
                                                                <a href="https://twitter.com/AnalyticaIsf" target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/twitter_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.youtube.com/channel/UC5-S1eiLCQm7yT10hmuAKNQ?view_as=subscriber"  target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/youtube_small.png" width="35" height="35" /></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <!-- fix for gmail --> 
                </table>
            </body>
        </html>';
        $this->email->setTo($email);
        $this->email->setFrom('info@isfedutech.com' , 'Easylearn');
        
        $this->email->setSubject('WELCOME TO EASYLEARN');
        $this->email->setMessage($message);
        $this->email->send(); 
    }

    public function parent_email($email = NULL, $student_name = NULL){

        $message = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="https://www.w3.org/1999/xhtml">
            <head>
                <title>EASYLEARN</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <style type="text/css">
                    * {
                        -ms-text-size-adjust:100%;
                        -webkit-text-size-adjust:none;
                        -webkit-text-resize:100%;
                        text-resize:100%;
                    }
                    a{
                        outline:none;
                        color:#40aceb;
                        text-decoration:underline;
                    }
                    a:hover{
                        text-decoration:none !important;
                    }
                    .nav a:hover{
                        text-decoration:underline !important;
                    }
                    .title a:hover{
                        text-decoration:underline !important;
                    }
                    .title-2 a:hover{
                        text-decoration:underline !important;
                    }
                    .btn:hover{
                        opacity:0.8;
                    }
                    .btn a:hover{
                        text-decoration:none !important;
                    }
                    .btn{
                        -webkit-transition:all 0.3s ease;
                        -moz-transition:all 0.3s ease;
                        -ms-transition:all 0.3s ease;
                        transition:all 0.3s ease;
                    }
                    table td {
                        border-collapse: collapse !important;
                    }
                    .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{
                        line-height:inherit;
                    }
                    @media only screen and (max-width:500px) {
                        table[class="flexible"]{
                            width:100% !important;
                        }
                        table[class="center"]{
                            float:none !important;
                            margin:0 auto !important;
                        }

                        *[class="hide"]{
                            display:none !important;
                            width:0 !important;
                            height:0 !important;
                            padding:0 !important;
                            font-size:0 !important;
                            line-height:0 !important;
                        }
                        td[class="img-flex"] img{
                            width:100% !important;
                            height:auto !important;
                        }
                        td[class="aligncenter"]{
                            text-align:center !important;
                        }
                        th[class="flex"]{
                            display:block !important;
                            width:100% !important;
                        }
                        td[class="wrapper"]{
                            padding:0 !important;
                        }
                        td[class="holder"]{
                            padding:30px 15px 20px !important;
                        }
                        td[class="nav"]{
                            padding:20px 0 0 !important;
                            text-align:center !important;
                        }
                        td[class="h-auto"]{
                            height:auto !important;
                        }
                        td[class="description"]{
                            padding:30px 20px !important;
                        }
                        td[class="i-120"] img{
                            width:120px !important;
                            height:auto !important;
                        }
                        td[class="footer"]{
                            padding:5px 20px 20px !important;
                        }
                        td[class="footer"] td[class="aligncenter"]{
                            line-height:25px !important;
                            padding:20px 0 0 !important;
                        }
                        tr[class="table-holder"]{
                            display:table !important;
                            width:100% !important;
                        }
                        th[class="thead"]{
                            display:table-header-group !important; 
                            width:100% !important;
                        }
                        th[class="tfoot"]{
                            display:table-footer-group !important; 
                            width:100% !important;
                        }
                    }
                </style>
            </head>

            <body style="margin:0; padding:0;" bgcolor="#eaeced">
                <table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
                    <!-- fix for gmail -->
                    <tr>
                        <td class="hide">
                            <table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
                                <tr>
                                    <td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="wrapper" style="padding:10px 10px;">
                            <!-- module 1 -->
                            <table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td data-bgcolor="bg-module" bgcolor="#eaeced">
                                        <table class="flexible" width="500" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                            <!-- <tr>
                                                <td style="background: #173965">
                                                    <img src="../assets/images/mentor-logo.png">
                                                </td>
                                            </tr> -->

                                            <tr>
                                                <td class="img-flex"><img src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/Video-conferencing.png" style="vertical-align:top;" width="500" height="300" alt="" /></td>
                                            </tr>

                                            <tr>
                                                <td data-bgcolor="bg-block" class="holder" style="padding:58px 48px 52px;background-color:#fff;color:#173965;">
                                                    <table width="100%" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#173965;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#f4b50a; padding:0 0 24px;">
                                                                WELCOME TO <br>EASYLEARN
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                                Your Child '.$student_name.' account has been added Successfully <br> Connected With Your easylearn Email ID <br>'.$email.'
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="start" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                                Email: <span>'.$email.'</span><br>
                                                                Password: easylearn 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:14px/15px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 5px;">
                                                                <br><br>Follow us today on our social network:
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <hr>
                                                                <a href="https://www.facebook.com/ISF-Analytica-and-Informatica-232880530938158" target="_blank" rel="noopener"><img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/facebook_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.instagram.com/isf_analytica_informatica/" target="_blank" rel="noopener"><img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/instagram_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.linkedin.com/company/14527413/admin/" target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/linkedin.png" width="35" height="35" /></a>
                                                                <a href="https://twitter.com/AnalyticaIsf" target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/twitter_small.png" width="35" height="35" /></a>
                                                                <a href="https://www.youtube.com/channel/UC5-S1eiLCQm7yT10hmuAKNQ?view_as=subscriber"  target="_blank" rel="noopener">
                                                                <img class="temp" src="https://s3.ap-south-1.amazonaws.com/mentorboxfiles/Files/email/youtube_small.png" width="35" height="35" /></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <!-- fix for gmail --> 
                </table>
            </body>
        </html>';
        $this->email->setTo($email);
        $this->email->setFrom('info@isfedutech.com' , 'Easylearn');
        
        $this->email->setSubject('WELCOME TO EASYLEARN');
        $this->email->setMessage($message);
        $this->email->send(); 
    }

    public function insert_multi_student($insert_data = NULL, $reg_id = NULL, $id = NULL)
    {
        $inserted = 0;

        foreach($insert_data as $dat)
        {
            $builder = $this->db->table('el_accounts');
            $builder->select('id','email');
            $builder->where('email', $dat['parent_emailid']);
            $query = $builder->get();

            if($query->getNumRows()>0)
            {
                $rand = rand(1000,9999);

                $rowData = (array)$query->getRow();
                $CurrentParentID = $rowData['id'];

                //Add in accounts table
                $data = array(
                    'unique_id'   => date("YmdHis").$rand,
                    'reg_id'      => $this->session->get('user')['reg_id'],
                    'username'    => $dat['student_name'],
                    'email'       => $dat['student_emailid'],
                    'pass'        => password_hash("easylearn", PASSWORD_BCRYPT),
                    'permissions' => 'Student',
                    'status'      => 'Verified',
                    'added_by'    => $this->session->get('user')['id'],
                    'updated_by'  => $this->session->get('user')['id'],
                    'is_del'      => 0,
                );

                $builder1 = $this->db->table('el_accounts');
                $dataInserted = $builder1->insert($data);
                $CurrentStudentID = $this->db->insertID();

                //Add in Student Table
                $Studentdata = array(
                    'unique_id'           => date("YmdHis").$rand,
                    'account_id'          => $CurrentStudentID,
                    'parent_id'           => $CurrentParentID,
                    'student_name'        => $dat['student_name'],
                    'student_gender'      => $dat['student_gender'],
                    'student_dob'         => $dat['student_dob'],
                    'student_emailid'     => $dat['student_emailid'],
                    'student_nationality' => $dat['student_nationality'],
                    'student_contactno'   => $dat['student_contactno'],
                    'student_rollno'      => $dat['student_rollno'],
                    'student_bloodgroup'  => $dat['student_bloodgroup'],
                    'student_image'       => $dat['student_image'],
                    'student_description' => $dat['student_description'],
                    'parent_name'         => $dat['parent_name'],
                    'parent_emailid'      => $dat['parent_emailid'],
                    'parent_contactno'    => $dat['parent_contactno'],
                    'parent_occupation'   => $dat['parent_occupation'],
                    'parent_address'      => $dat['parent_address'],
                    'added_by'            => $this->session->get('user')['id'],
                    'updated_by'          => $this->session->get('user')['id'],
                    'is_del'              => 0,
                );

                $Studentbuilder = $this->db->table('el_student');
                $StudentInserted = $Studentbuilder->insert($Studentdata);

                //Add student in accounts details table
                $Student_Acc_Details = array(
                    'account_id'     => $CurrentStudentID,
                    'contact_number' => $dat['student_contactno'],
                    'description'    => $dat['student_description'],
                    'profile_image'  => $dat['student_image'],
                    'layout_pref'    => 'Menu',
                    'language_pref'  => 'English',
                    'added_by'       => $this->session->get('user')['id'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'         => 0
                );

                $Student_ac_builder = $this->db->table('el_account_details');
                $Student_ac_inserted = $Student_ac_builder->insert($Student_Acc_Details);

                $this->student_email($dat['student_emailid']);
                $this->existparent_email($dat['parent_emailid'],$dat['student_name']);

                if($dataInserted && $StudentInserted && $Student_ac_inserted)
                {
                    $inserted += 1;
                }
                else
                {
                    $not_inserted += 1;
                }
            }
            else
            {
                $rand = rand(1000,9999);
                
                //Add parent in accounts table
                $Parentdata = array(
                    'unique_id'   => date("YmdHis").$rand,
                    'reg_id'      => $this->session->get('user')['reg_id'],
                    'username'    => $dat['parent_name'],
                    'email'       => $dat['parent_emailid'],
                    'pass'        => password_hash("easylearn", PASSWORD_BCRYPT),
                    'permissions' => 'Parent',
                    'status'      => 'Verified',
                    'added_by'    => $this->session->get('user')['id'],
                    'updated_by'  => $this->session->get('user')['id'],
                    'is_del'      => 0,
                );

                $Parentbuilder = $this->db->table('el_accounts');
                $ParentdataInserted = $Parentbuilder->insert($Parentdata);
                $CurrentParentID = $this->db->insertID();

                //Add student in accounts details table
                $Parent_Acc_Details = array(
                    'account_id'     => $CurrentParentID,
                    'contact_number' => $dat['parent_contactno'],
                    'description'    => '',
                    'profile_image'  => '',
                    'layout_pref'    => 'Menu',
                    'language_pref'  => 'English',
                    'added_by'       => $this->session->get('user')['id'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'         => 0
                );

                $Parent_ac_builder = $this->db->table('el_account_details');
                $Parent_ac_inserted = $Parent_ac_builder->insert($Parent_Acc_Details);

                //Add in accounts table
                $data = array(
                    'unique_id'   => date("YmdHis")+($rand+1),
                    'reg_id'      => $this->session->get('user')['reg_id'],
                    'username'    => $dat['student_name'],
                    'email'       => $dat['student_emailid'],
                    'pass'        => password_hash("easylearn", PASSWORD_BCRYPT),
                    'permissions' => 'Student',
                    'status'      => 'Verified',
                    'added_by'    => $this->session->get('user')['id'],
                    'updated_by'  => $this->session->get('user')['id'],
                    'is_del'      => 0,
                );

                $builder1 = $this->db->table('el_accounts');
                $dataInserted = $builder1->insert($data);
                $CurrentStudentID = $this->db->insertID();

                 //Add student in accounts details table
                 $Student_Acc_Details = array(
                    'account_id'     => $CurrentStudentID,
                    'contact_number' => $dat['student_contactno'],
                    'description'    => $dat['student_description'],
                    'profile_image'  => $dat['student_image'],
                    'layout_pref'    => 'Menu',
                    'language_pref'  => 'English',
                    'added_by'       => $this->session->get('user')['id'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'         => 0
                );
                $Student_ac_builder = $this->db->table('el_account_details');
                $Student_ac_inserted = $Student_ac_builder->insert($Student_Acc_Details);

                //Add in Student Table
                $Studentdata = array(

                    'unique_id'           => date("YmdHis")+$rand,
                    'account_id'          => $CurrentStudentID,
                    'parent_id'           => $CurrentParentID,
                    'student_name'        => $dat['student_name'],
                    'student_gender'      => $dat['student_gender'],
                    'student_dob'         => $dat['student_dob'],
                    'student_emailid'     => $dat['student_emailid'],
                    'student_nationality' => $dat['student_nationality'],
                    'student_contactno'   => $dat['student_contactno'],
                    'student_rollno'      => $dat['student_rollno'],
                    'student_bloodgroup'  => $dat['student_bloodgroup'],
                    'student_image'       => $dat['student_image'],
                    'student_description' => $dat['student_description'],
                    'parent_name'         => $dat['parent_name'],
                    'parent_emailid'      => $dat['parent_emailid'],
                    'parent_contactno'    => $dat['parent_contactno'],
                    'parent_occupation'   => $dat['parent_occupation'],
                    'parent_address'      => $dat['parent_address'],
                    'added_by'            => $this->session->get('user')['id'],
                    'updated_by'          => $this->session->get('user')['id'],
                    'is_del'              => 0
                );

                $Studentbuilder = $this->db->table('el_student');
                $StudentInserted = $Studentbuilder->insert($Studentdata);

                $inserted += 1 ;

                $this->student_email($dat['student_emailid']);
                $this->parent_email($dat['parent_emailid'],$dat['student_name']);

            }
        }

        if($inserted > 0)
        {
            return $inserted;
        }
        else
        {
            return FALSE;
        }
    }

    public function insert_multi_student_classroom($insert_data = NULL, $reg_id = NULL, $id = NULL,$classroom_id=NULL)
    {
        $inserted = 0;

        foreach($insert_data as $dat)
        {
            $builder = $this->db->table('el_accounts');
            $builder->select('id','email');
            $builder->where('email', $dat['parent_emailid']);
            $query = $builder->get();

            if($query->getNumRows()>0)
            {
                $rand = rand(1000,9999);

                $rowData = (array)$query->getRow();
                $CurrentParentID = $rowData['id'];

                //Add in accounts table
                $data = array(
                    'unique_id'   => date("YmdHis").$rand,
                    'reg_id'      => $this->session->get('user')['reg_id'],
                    'username'    => $dat['student_name'],
                    'email'       => $dat['student_emailid'],
                    'pass'        => password_hash("easylearn", PASSWORD_BCRYPT),
                    'permissions' => 'Student',
                    'status'      => 'Verified',
                    'added_by'    => $this->session->get('user')['id'],
                    'updated_by'  => $this->session->get('user')['id'],
                    'is_del'      => 0,
                );

                $builder1 = $this->db->table('el_accounts');
                $dataInserted = $builder1->insert($data);
                $CurrentStudentID = $this->db->insertID();

                //Add in Student Table
                $Studentdata = array(
                    'unique_id'           => date("YmdHis").$rand,
                    'account_id'          => $CurrentStudentID,
                    'parent_id'           => $CurrentParentID,
                    'student_name'        => $dat['student_name'],
                    'student_gender'      => $dat['student_gender'],
                    'student_dob'         => $dat['student_dob'],
                    'student_emailid'     => $dat['student_emailid'],
                    'student_nationality' => $dat['student_nationality'],
                    'student_contactno'   => $dat['student_contactno'],
                    'student_rollno'      => $dat['student_rollno'],
                    'student_bloodgroup'  => $dat['student_bloodgroup'],
                    'student_image'       => $dat['student_image'],
                    'student_description' => $dat['student_description'],
                    'parent_name'         => $dat['parent_name'],
                    'parent_emailid'      => $dat['parent_emailid'],
                    'parent_contactno'    => $dat['parent_contactno'],
                    'parent_occupation'   => $dat['parent_occupation'],
                    'parent_address'      => $dat['parent_address'],
                    'added_by'            => $this->session->get('user')['id'],
                    'updated_by'          => $this->session->get('user')['id'],
                    'is_del'              => 0,
                );

                $Studentbuilder = $this->db->table('el_student');
                $StudentInserted = $Studentbuilder->insert($Studentdata);

                //Add student in accounts details table
                $Student_Acc_Details = array(
                    'account_id'     => $CurrentStudentID,
                    'contact_number' => $dat['student_contactno'],
                    'description'    => $dat['student_description'],
                    'profile_image'  => $dat['student_image'],
                    'layout_pref'    => 'Menu',
                    'language_pref'  => 'English',
                    'added_by'       => $this->session->get('user')['id'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'         => 0
                );

                $Student_ac_builder = $this->db->table('el_account_details');
                $Student_ac_inserted = $Student_ac_builder->insert($Student_Acc_Details);

                $Assign_Student_Classroom = array(
                    'account_id'     => $CurrentStudentID,
                    'classroom_id'   => $classroom_id,
                    'added_by'       => $id,
                    'updated_by'     => $id,
                    'is_del'         => 0
                );

                $assign_classroom_students = $this->db->table('el_classroom_assignment');
                $assign_classroom_inserted = $assign_classroom_students->insert($Assign_Student_Classroom);

                $this->student_email($dat['student_emailid']);
                $this->existparent_email($dat['parent_emailid'],$dat['student_name']);

                if($dataInserted && $StudentInserted && $Student_ac_inserted && $assign_classroom_inserted)
                {
                    $inserted += 1;
                }
                else
                {
                    $not_inserted += 1;
                }
            }
            else
            {
                $rand = rand(1000,9999);
                
                //Add parent in accounts table
                $Parentdata = array(
                    'unique_id'   => date("YmdHis").$rand,
                    'reg_id'      => $this->session->get('user')['reg_id'],
                    'username'    => $dat['parent_name'],
                    'email'       => $dat['parent_emailid'],
                    'pass'        => password_hash("easylearn", PASSWORD_BCRYPT),
                    'permissions' => 'Parent',
                    'status'      => 'Verified',
                    'added_by'    => $this->session->get('user')['id'],
                    'updated_by'  => $this->session->get('user')['id'],
                    'is_del'      => 0,
                );

                $Parentbuilder = $this->db->table('el_accounts');
                $ParentdataInserted = $Parentbuilder->insert($Parentdata);
                $CurrentParentID = $this->db->insertID();

                //Add student in accounts details table
                $Parent_Acc_Details = array(
                    'account_id'     => $CurrentParentID,
                    'contact_number' => $dat['parent_contactno'],
                    'description'    => '',
                    'profile_image'  => '',
                    'layout_pref'    => 'Menu',
                    'language_pref'  => 'English',
                    'added_by'       => $this->session->get('user')['id'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'         => 0
                );

                $Parent_ac_builder = $this->db->table('el_account_details');
                $Parent_ac_inserted = $Parent_ac_builder->insert($Parent_Acc_Details);

                //Add in accounts table
                $data = array(
                    'unique_id'   => date("YmdHis")+($rand+1),
                    'reg_id'      => $this->session->get('user')['reg_id'],
                    'username'    => $dat['student_name'],
                    'email'       => $dat['student_emailid'],
                    'pass'        => password_hash("easylearn", PASSWORD_BCRYPT),
                    'permissions' => 'Student',
                    'status'      => 'Verified',
                    'added_by'    => $this->session->get('user')['id'],
                    'updated_by'  => $this->session->get('user')['id'],
                    'is_del'      => 0,
                );

                $builder1 = $this->db->table('el_accounts');
                $dataInserted = $builder1->insert($data);
                $CurrentStudentID = $this->db->insertID();

                 //Add student in accounts details table
                 $Student_Acc_Details = array(
                    'account_id'     => $CurrentStudentID,
                    'contact_number' => $dat['student_contactno'],
                    'description'    => $dat['student_description'],
                    'profile_image'  => $dat['student_image'],
                    'layout_pref'    => 'Menu',
                    'language_pref'  => 'English',
                    'added_by'       => $this->session->get('user')['id'],
                    'updated_by'     => $this->session->get('user')['id'],
                    'is_del'         => 0
                );
                $Student_ac_builder = $this->db->table('el_account_details');
                $Student_ac_inserted = $Student_ac_builder->insert($Student_Acc_Details);

                //Add in Student Table
                $Studentdata = array(

                    'unique_id'           => date("YmdHis")+$rand,
                    'account_id'          => $CurrentStudentID,
                    'parent_id'           => $CurrentParentID,
                    'student_name'        => $dat['student_name'],
                    'student_gender'      => $dat['student_gender'],
                    'student_dob'         => $dat['student_dob'],
                    'student_emailid'     => $dat['student_emailid'],
                    'student_nationality' => $dat['student_nationality'],
                    'student_contactno'   => $dat['student_contactno'],
                    'student_rollno'      => $dat['student_rollno'],
                    'student_bloodgroup'  => $dat['student_bloodgroup'],
                    'student_image'       => $dat['student_image'],
                    'student_description' => $dat['student_description'],
                    'parent_name'         => $dat['parent_name'],
                    'parent_emailid'      => $dat['parent_emailid'],
                    'parent_contactno'    => $dat['parent_contactno'],
                    'parent_occupation'   => $dat['parent_occupation'],
                    'parent_address'      => $dat['parent_address'],
                    'added_by'            => $this->session->get('user')['id'],
                    'updated_by'          => $this->session->get('user')['id'],
                    'is_del'              => 0
                );

                $Studentbuilder = $this->db->table('el_student');
                $StudentInserted = $Studentbuilder->insert($Studentdata);

                $Assign_Student_Classroom = array(
                    'account_id'     => $CurrentStudentID,
                    'classroom_id'   => $classroom_id,
                    'added_by'       => $id,
                    'updated_by'     => $id,
                    'is_del'         => 0
                );

                $assign_classroom_students = $this->db->table('el_classroom_assignment');
                $assign_classroom_inserted = $assign_classroom_students->insert($Assign_Student_Classroom);

                $inserted += 1 ;

                $this->student_email($dat['student_emailid']);
                $this->parent_email($dat['parent_emailid'],$dat['student_name']);

            }
        }

        if($inserted > 0)
        {
            return $inserted;
        }
        else
        {
            return FALSE;
        }
    }

    //Multiple Question
    public function add_multiple_question($data = NULL, $unique_id = NULL)
    {
        $inserted = 0;
        foreach($data as $dat)
        {
            if($dat['question_title'] == 'Question Title' || ($dat['question_title'] == NULL || $dat['question_title'] == '') || ($dat['option_1'] == NULL || $dat['option_1'] == '') || ($dat['option_2'] == NULL || $dat['option_2'] == '') || ($dat['answer_option'] == NULL || $dat['answer_option'] == ''))
            {
                continue;
            }
            else
            {
                $builder = $this->db->table('el_mcq_exam');
                $builder->select('id');
                $builder->where('unique_id', $unique_id);
                $query = $builder->get();

                if($query->getNumRows() > 0)
                {
                    $id = (array)$query->getRow();

                    $dat['exam_id'] = $id['id'];

                    $builder1 = $this->db->table('el_mcq_question');
                    $query1 = $builder1->insert($dat);

                    if($query1)
                    {
                        $inserted++;
                    }
                }
            }
        }

        return $inserted;
    }

    //Multiple Sentance Question
    public function add_multiple_sentence_question($data = NULL, $unique_id = NULL)
    {
        $inserted = 0;
        foreach($data as $dat)
        {
            if($dat['question_title'] == 'Question' || ($dat['question_title'] == NULL || $dat['question_title'] == '') || ($dat['option_1'] == NULL || $dat['option_1'] == ''))
            {
                continue;
            }
            else
            {
                $builder = $this->db->table('el_mcq_exam');
                $builder->select('id');
                $builder->where('unique_id', $unique_id);
                $query = $builder->get();

                if($query->getNumRows() > 0)
                {
                    $id = (array)$query->getRow();

                    $dat['exam_id'] = $id['id'];

                    $builder1 = $this->db->table('el_sentence_question');
                    $query1 = $builder1->insert($dat);

                    if($query1)
                    {
                        $inserted++;
                    }
                }
            }
        }

        return $inserted;
    }

    //Assign Student Classroom
    public function csv_assign_student_classroom($insert_data = NULL, $unique_id = NULL, $id = NULL)
    {
        $not_inserted = [];
        $error = ['SR NO', 'Email', 'Error Message'];
        array_push($not_inserted, $error);

        $builder = $this->db->table('el_classroom');
        $builder->select('id');
        $builder->where('unique_id', $unique_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData      = (array)$query->getRow();
            $classroom_id = $rowData['id'];
            $i = 0;

            foreach($insert_data as $dat)
            {
                $builder1 = $this->db->table('el_accounts');
                $builder1->select('id');
                $builder1->where('email', $dat['student_email']);
                $builder1->where('is_del', 0);
                $query1 = $builder1->get();

                if($query1->getNumRows()>0)
                {
                    $rowData1  = (array)$query1->getRow();
                    $account_id = $rowData1['id'];

                    $builder2 = $this->db->table('el_classroom_assignment');
                    $builder2->select('id');
                    $builder2->where('account_id', $account_id);
                    $builder2->where('classroom_id', $classroom_id);
                    $builder2->where('is_del', 0);
                    $query2 = $builder2->get();

                    if($query2->getNumRows() == 0)
                    {
                        $array = array(
                            'account_id'   => $account_id,
                            'classroom_id' => $classroom_id,
                            'added_on'     => date('Y-m-d H:i:s'),
                            'added_by'     => $id,
                            'updated_by'   => $id
                        );

                        $builder3 = $this->db->table('el_classroom_assignment');
                        $query3 = $builder3->insert($array);

                        if($query3)
                        {
                            $i++;
                        }
                    }
                    else
                    {
                        $error = [$dat['sr_no'], $dat['student_email'], 'Already Enrolled'];
                        array_push($not_inserted, $error);
                    }
                }
                else
                {
                    $error = [$dat['sr_no'], $dat['student_email'], 'Account does not exist'];
                    array_push($not_inserted, $error);
                }
            }

            $result = array(
                'i'            => $i,
                'not_inserted' => $not_inserted
            );

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    public function csv_assign_student($insert_data = NULL, $another_batch = NULL, $unique_id = NULL, $id = NULL)
    {
        $not_inserted = [];
        $error = ['SR NO', 'Email', 'Error Message'];

        array_push($not_inserted, $error);

        if($another_batch == 1)
        {
            $builder = $this->db->table('el_batches');
            $builder->select('id, classroom_id');
            $builder->where('unique_id', $unique_id);
            $builder->where('is_del', 0);
            $query = $builder->get();
    
            if($query->getNumRows()>0)
            {
                $rowData  = (array)$query->getRow();
                $batch_id = $rowData['id'];
                $classroom_id = $rowData['classroom_id'];

                $i = 0;

                foreach($insert_data as $dat)
                {
                    $builder1 = $this->db->table('el_accounts');
                    $builder1->select('id');
                    $builder1->where('email', $dat['student_email']);
                    $builder1->where('is_del', 0);
                    $query1 = $builder1->get();

                    if($query1->getNumRows()>0)
                    {
                        $rowData1  = (array)$query1->getRow();
                        $account_id = $rowData1['id'];

                        $builder2 = $this->db->table('el_classroom_assignment');
                        $builder2->select('id');
                        $builder2->where('account_id', $account_id);
                        $builder2->where('classroom_id', $classroom_id);
                        $builder2->where('is_del', 0);
                        $query2 = $builder2->get();

                        if($query2->getNumRows() > 0)
                        {
                            $builder2 = $this->db->table('el_batch_assignment');
                            $builder2->select('id');
                            $builder2->where('account_id', $account_id);
                            $builder2->where('batch_id', $batch_id);
                            $builder2->where('is_del', 0);
                            $query2 = $builder2->get();

                            if($query2->getNumRows() == 0)
                            {
                                $array = array(
                                    'account_id'   => $account_id,
                                    'batch_id'     => $batch_id,
                                    'classroom_id' => $classroom_id,
                                    'added_by'     => $id,
                                    'updated_by'   => $id
                                );

                                $builder3 = $this->db->table('el_batch_assignment');
                                $query3 = $builder3->insert($array);

                                if($query3)
                                {
                                    $i++;
                                }
                            }
                            else
                            {
                                $error = [$dat['sr_no'], $dat['student_email'], 'Already Enrolled'];
                                array_push($not_inserted, $error);
                            }
                        }
                        else
                        {
                            $error = [$dat['sr_no'], $dat['student_email'], 'Student Not Enrolled on this Classroom'];
                            array_push($not_inserted, $error);
                        }
                    }
                    else
                    {
                        $error = [$dat['sr_no'], $dat['student_email'], 'Account does not exist'];
                        array_push($not_inserted, $error);
                    }
                }

                $result = array(
                    'i'            => $i,
                    'not_inserted' => $not_inserted
                );

                return $result;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            $builder = $this->db->table('el_batches');
            $builder->select('id, classroom_id');
            $builder->where('unique_id', $unique_id);
            $builder->where('is_del', 0);
            $query = $builder->get();
    
            if($query->getNumRows()>0)
            {
                $rowData  = (array)$query->getRow();
                $batch_id = $rowData['id'];
                $classroom_id = $rowData['classroom_id'];

                $i = 0;

                foreach($insert_data as $dat)
                {
                    $builder1 = $this->db->table('el_accounts');
                    $builder1->select('id');
                    $builder1->where('email', $dat['student_email']);
                    $builder1->where('is_del', 0);
                    $query1 = $builder1->get();

                    if($query1->getNumRows()>0)
                    {
                        $rowData1  = (array)$query1->getRow();
                        $account_id = $rowData1['id'];

                        $builder2 = $this->db->table('el_classroom_assignment');
                        $builder2->select('id');
                        $builder2->where('account_id', $account_id);
                        $builder2->where('classroom_id', $classroom_id);
                        $builder2->where('is_del', 0);
                        $query2 = $builder2->get();

                        if($query2->getNumRows() > 0)
                        {
                            $builder2 = $this->db->table('el_batch_assignment');
                            $builder2->select('id');
                            $builder2->where('account_id', $account_id);
                            $builder2->where('is_del', 0);
                            $query2 = $builder2->get();

                            if($query2->getNumRows() == 0)
                            {
                                $array = array(
                                    'account_id'   => $account_id,
                                    'batch_id'     => $batch_id,
                                    'classroom_id' => $classroom_id,
                                    'added_by'     => $id,
                                    'updated_by'   => $id
                                );

                                $builder3 = $this->db->table('el_batch_assignment');
                                $query3 = $builder3->insert($array);

                                if($query3)
                                {
                                    $i++;
                                }
                            }
                            else
                            {
                                $error = [$dat['sr_no'], $dat['student_email'], 'Already Enrolled'];
                                array_push($not_inserted, $error);
                            }
                        }
                        else
                        {
                            $error = [$dat['sr_no'], $dat['student_email'], 'Student Not Enrolled on this Classroom'];
                            array_push($not_inserted, $error);
                        }
                    }
                    else
                    {
                        $error = [$dat['sr_no'], $dat['student_email'], 'Account does not exist'];
                        array_push($not_inserted, $error);
                    }
                }

                $result = array(
                    'i'            => $i,
                    'not_inserted' => $not_inserted
                );

                return $result;
            }
            else
            {
                return FALSE;
            }
        }
    }

    //auto Enroll Courses
    public function auto_enroll_courses($student_email = NULL, $course_id = NULL, $batch_id = NULL, $id = NULL)
    {
        $not_inserted = [];
        $error = ['SR NO', 'Email', 'Error Message'];
        array_push($not_inserted, $error);

        $builder = $this->db->table('el_batch_course');
        $builder->select('course_id');
        $builder->join('el_batches', 'el_batches.id = el_batch_course.batch_id');
        $builder->where('el_batches.unique_id', $batch_id);
        $builder->where('el_batch_course.is_del', 0);
        $builder->where('el_batches.is_del', 0);
        $builder->whereIn('course_id', $course_id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();

            $i = 0;
            foreach($data as $dat)
            {
                $dat = (array)$dat;

                foreach($student_email as $email)
                {
                    $builder1 = $this->db->table('el_accounts');
                    $builder1->select('el_accounts.id');
                    $builder1->join('el_batch_assignment', 'el_batch_assignment.account_id = el_accounts.id');
                    $builder1->where('el_batch_assignment.is_del', 0);
                    $builder1->where('el_accounts.is_del', 0);
                    $builder1->where('email', $email['email']);
                    $query1 = $builder1->get();

                    if($query1->getNumRows() > 0)
                    {
                        $data1 = (array)$query1->getRow();

                        $builder2 = $this->db->table('el_course_enroll');
                        $builder2->where('user_id', $data1['id']);
                        $builder2->where('course_id', $dat['course_id']);
                        $query2 = $builder2->get();

                        if($query2->getNumRows() == 0)
                        {
                            $array = array(
                                'user_id'   => $data1['id'],
                                'course_id' => $dat['course_id'],
                                'is_del'    => 0
                            );

                            $builder3 = $this->db->table('el_course_enroll');
                            $query3 = $builder3->insert($array);

                            if($query3)
                            {
                                $i++;
                            }
                        }
                        else
                        {
                            $error = [$email['sr_no'], $email['email'], 'Already Enrolled for this course'];
                            array_push($not_inserted, $error);
                        }
                    }
                    else
                    {
                        $error = [$email['sr_no'], $email['email'], 'Account does not exist'];
                        array_push($not_inserted, $error);
                    }
                }
            }

            $result = array(
                'i'            => $i,
                'not_inserted' => $not_inserted
            );

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    public function add_mtopic($topics = NULL)
    {
        $i = 0;
        foreach($topics as $topic)
        {
            $builder = $this->db->table('el_topics');
            $query = $builder->insert($topic);
            $i++;
        }
        return $i;
    }

    public function check_lab_instance($ip , $email, $batch_id)
    {

        $selct_email = $this->db->table('el_accounts');
        $selct_email->select('id');
        $selct_email->where('email', $email);
        $selct_email->where('is_del', 0);
        $query = $selct_email->get();

        if($query->getNumRows() > 0)
        {
            $result = (array) $query->getRow();

            $builder = $this->db->table('el_lab_instance');
            $builder->select('id');
            $builder->where('account_id', $result['id']);
            $builder->where('batch_id', $batch_id);
            $builder->where('is_del', 0);
            $query = $builder->get();

            if($query->getNumRows() > 0)
            {
                return 0;
            }
            else
            {
                return $result['id'];
            }
        }
        else
        {
            return 0;
        }
    }

    public function add_lab_instance($data = NULL, $batch_id = NULL)
    {
        $i = 0;
        $not_inserted = [];

        $builder = $this->db->table('el_batches');
        $builder->select('classroom_id');
        $builder->where('id', $batch_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data1 = (array)$query->getRow();
            $classroom_id = $data1['classroom_id'];

            foreach($data as $dat)
            {
                $sr_no    = $dat['sr_no'];
                $email    = $dat['email'];
                $lab_ip   = $dat['lab_ip'];

                $result = $this->check_lab_instance($lab_ip, $email, $batch_id);

                if($result > 0)
                {
                    $dat['account_id']   = $result;
                    $dat['classroom_id'] = $classroom_id;
                    $dat['batch_id']     = $batch_id;

                    unset($dat['email']);
                    unset($dat['sr_no']);
            
                    $builder = $this->db->table('el_lab_instance');
                    $inserted = $builder->insert($dat);

                    if($inserted)
                    {
                        $i++;
                    }
                    else
                    {
                        $error = [$sr_no, $lab_ip, $email, 'Not Inserted'];
                        array_push($not_inserted, $error);
                    }
                }
                else
                {
                    $error = [$sr_no, $lab_ip, $email, 'Already Exits'];
                    array_push($not_inserted, $error);
                }
            }
            return array($i, $not_inserted);
        }
        else
        {
            return array($i, $not_inserted);
        }
    }

}