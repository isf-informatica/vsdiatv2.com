<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Classroom_Model as Classroom_Model;

class Classroom_Controller extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->Aws_Library = new Aws_Library();
        $this->Classroom_Model = new Classroom_Model();
    }

    //Speech to Text
    public function speech_to_text()
    {
        if(isset($_FILES['audio']))
        {
            $allowed_ext = array("mp3", "mp4", "wav");  
            $file_name = explode(".", $_FILES["audio"]["name"]);
            $extension = end($file_name); 

            if(in_array($extension, $allowed_ext))
            {
                $audio = $this->Aws_Library->aws_store($_FILES['audio']);
                $url = $this->Aws_Library->speech_to_text($audio);

                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $headers = array(
                    "Content-Type: application/json"
                );
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                //for debug only!
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
                $resp = curl_exec($curl);
                curl_close($curl); 

                $data = json_decode($resp, true);
                $text = $data['results']['transcripts'][0]['transcript'];
                $items = $data['results']['items'];
                $i = 0;
                $confidence = 0;

                foreach($items as $item)
                {
                    $confidence = $confidence + $item['alternatives'][0]['confidence'];
                    $i++;
                }

                $confidence = round(($confidence/$i)*100);

                $array = array(
                    'text'       => $text,
                    'confidence' => $confidence
                );

                echo json_encode($array);
            }
            else
            {
                echo "Choose vaild audio file";
            }
        }
        else
        {
            echo "Choose audio file to continue";
        }
    }

    //Text to Speech
    public function text_to_speech()
    {
        $text = $_POST['text'];
        $result = $this->Aws_Library->text_to_speech($text);

        if($result)
        {
            echo $result;
        }
        else
        {
            echo 'FALSE';
        }
    }

    //Get Documents
    public function getdocuments()
    {
        $id = $_POST['id'];

        $result = $this->Classroom_Model->getdocuments($id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }

    //Add Documents
    public function add_doc()
    {
        $data = $this->request->getPost();

        if(($data['doc_token'] == $this->session->get('doc_token')) && $data['doc_token'] != NULL)
        {
            $doc = array(
                'account_id' => $this->session->get('user')['id'],
                'doc_name'   => $data['doc_nm'],
                'documents'  =>  $this->Aws_Library->aws_store($_FILES['document_file']),
                'added_by'   => $this->session->get('user')['id'],
                'updated_by' => $this->session->get('user')['id']
            );

            $result = $this->Classroom_Model->add_doc($doc);
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );

            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 200
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }
    
    //Delete Document
    public function del_doc()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->del_doc($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }

    //Get Training Material
    public function get_training_material()
    {
        $result = $this->Classroom_Model->get_training_material();

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }

    //Add Training Material
    public function add_tm()
    {
        $data = $this->request->getPost();

        if(($data['tm_token'] == $this->session->get('tm_token')) && $data['tm_token'] != NULL)
        {
            $tm_img = $this->Aws_Library->aws_store($_FILES['tm_img']);
            $tm_doc = $this->Aws_Library->aws_store($_FILES['training_material']);

            $tm = array(
                'document_name'        => $data['doc_nm'],
                'training_image'       => $tm_img,
                'training_material'    => $tm_doc,
                'training_description' => $data['training_descp'],
                'added_by'             => $this->session->get('user')['id'],
                'updated_by'           => $this->session->get('user')['id']
            );

            $result = $this->Classroom_Model->add_tm($tm);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get Training Material by id
    public function get_tm_id()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->get_tm_id($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => FALSE,
                'status'   => 200
            );
        }
        echo json_encode($array);
    }

    //Edit Training Material
    public function edit_tm()
    {
        $data = $this->request->getPost();

        if(($data['edit_tm_token'] == $this->session->get('edit_tm_token')) && $data['edit_tm_token'] != NULL)
        {
            $tm = array(
                'document_name'        => $data['doc_nm'],
                'training_description' => $data['training_descp'],
                'updated_by'           => $this->session->get('user')['id']
            );

            if(isset($_FILES['tm_img']))
            {
                $tm['training_image'] = $this->Aws_Library->aws_store($_FILES['tm_img']);
            }

            if(isset($_FILES['training_material']))
            {
                $tm['training_material'] = $this->Aws_Library->aws_store($_FILES['training_material']);
            }
            
            $result = $this->Classroom_Model->edit_tm($tm,$data['tm_id']);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array); 
    }

    //Delete Training Material
    public function del_tm()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->del_tm($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }

    public function Add_Classroom()
    {
        $ClassroomData = $this->request->getPost();
        if (($ClassroomData['manage_classroom_form_token'] == $this->session->get('manage_classroom_form_token')) && ($this->session->get('manage_classroom_form_token') != null)) {
            if(isset($_FILES['classroom_image']))
            {
                $ClassroomData['classroom_image'] = $this->Aws_Library->aws_store($_FILES['classroom_image']);
            }
            $data = $this->Classroom_Model->Add_Classroom($ClassroomData,$this->session->get('user')['id'],$this->session->get('user')['reg_id']);
            //print_r($ClassroomData);
            //echo $ClassroomData;
            if ($data == true) {
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
                                                                        Your Account has been Registered for Easylearn, Use below login credentials for Login In<br>
                                                                        Username: ' . $ClassroomData['administrator_email'] . ' <br>
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
                </html>
                ';

                $this->email->setTo($ClassroomData['administrator_email']);
                $this->email->setFrom('info@isfedutech.com', 'Easylearn');

                $this->email->setSubject('WELCOME TO EASYLEARN');
                $this->email->setMessage($message);
                $this->email->send();

                $array = array(
                    'Response' => 'OK',
                    'data' => 'TRUE',
                    'status' => 200,
                );
            } else {
                $array = array(
                    'Response' => 'OK',
                    'data' => 'Email Already Exists',
                    'status' => 500,
                );
            }
        } else {
            $array = array(
                'Response' => 'OK',
                'data' => 'Something Wents Wrong!',
                'status' => 500,
            );
        }
        echo json_encode($array);
    }

    //Add Student
    public function Add_Student()
    {
        $SingleStudentData = $this->request->getPost();
        $permissions = $this->session->get('user')['permissions'];

        if(($SingleStudentData['student_add_token'] == $this->session->get('student_add_token')) && ($this->session->get('student_add_token') != NULL))
        {
            $image = $this->Aws_Library->aws_store($_FILES['studentImage']);
            if($permissions == 'School' || $permissions == 'Jr College')
            {
                $data = $this->Classroom_Model->Add_Single_Student($SingleStudentData, $image, $this->session->get('user')['reg_id'], $this->session->get('user')['id']);
            }
            elseif ($permissions == 'Classroom') {
                $data = $this->Classroom_Model->Add_Single_Student_Classroom($SingleStudentData, $image, $this->session->get('user')['reg_id'], $this->session->get('user')['id'],$this->session->get('classroom_id'));
            }

            
            //print_r($SingleStudentData);
            //echo $SingleStudentData;
            if($data == TRUE)
            {
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
                                                                        Your Account has been Registered for Easylearn, Use below login credentials for Login In<br>
                                                                        Username: '.$SingleStudentData['studentEmailID'].' <br>
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
                </html>
                ';

                $message1 = '
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
                                                                        Your Account has been Registered for Easylearn, Use below login credentials for Login In<br>
                                                                        Username: '.$SingleStudentData['studentParentEmailID'].' <br>
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
                </html>
                ';

                $this->email->setTo($SingleStudentData['studentEmailID']);
                $this->email->setFrom('info@isfedutech.com' , 'Easylearn');
                $this->email->setSubject('WELCOME TO EASYLEARN');
                $this->email->setMessage($message);
                $this->email->send();

                $this->email->setTo($SingleStudentData['studentParentEmailID']);
                $this->email->setFrom('info@isfedutech.com' , 'Easylearn');
                $this->email->setSubject('WELCOME TO EASYLEARN');
                $this->email->setMessage($message1);
                $this->email->send();

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Student Already Exists',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get All Student
    public function get_student()
    {
        if(isset($_POST['permissions']))
        {
            $permissions  = $_POST['permissions'];
            $reg_id       = $_POST['reg_id'];
            $classroom_id = $_POST['classroom_id'];
        }
        else
        {
            $permissions  = $this->session->get('user')['permissions'];
            $reg_id       = $this->session->get('user')['reg_id'];
            $classroom_id = $this->session->get('classroom_id');
        }

        if($permissions == 'Admin' || $permissions == 'SuperAdmin')
        {
            $result = $this->Classroom_Model->get_student();
        }
        elseif ($permissions == 'School' || $permissions == 'Jr College')
        {
            $result = $this->Classroom_Model->get_student_reg($reg_id);
        }
        elseif ($permissions == 'Classroom')
        {
           $result = $this->Classroom_Model->get_student_reg_classroom($classroom_id);
        }

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //get Student by id
    public function student_by_id()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->get_student_by_id($data['id']);

        if($result)
        {
            if($result['profile_image'] == NULL || $result['profile_image'] == 'NULL' || $result['profile_image'] == '')
            {
                $result['profile_image'] = base_url().'/public/Easylearn/images/no_profile.jpg';
            }
            else
            {
                $result['profile_image'] = $result['profile_image'];
            }

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No data',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }

    //Update Student
    public function update_student()
    {
        $data = $this->request->getPost();
        if(($data['edit_student_token'] == $this->session->get('edit_student_token')) && $data['edit_student_token'] != NULL)
        {
            $unique_id = $data['unique_id'];

            $array = array(
                'parent_name'         => $data['parent_name'],
                'parent_contactno'    => $data['parent_contactno'],
                'parent_occupation'   => $data['parent_occupation'],
                'parent_address'      => $data['parent_address'],
                'student_name'        => $data['student_name'],
                'student_rollno'      => $data['student_rollno'],
                'student_contactno'   => $data['student_contactno'],
                'student_bloodgroup'  => $data['student_bloodgroup'],
                'student_description' => $data['student_description'],
                'updated_by'          => $this->session->get('user')['id']
            );

            $account_student=array(
                'username'            => $data['student_name'],
                'updated_by'          => $this->session->get('user')['id']
            );

            $account_parent=array(
                'username'            => $data['parent_name'],
                'updated_by'          => $this->session->get('user')['id']
            );

            $student_details=array(
                'description'       => $data['student_description'],
                'contact_number'    => $data['student_contactno'],
                'updated_by'          => $this->session->get('user')['id'],
            );

            $parent_details=array(
                'contact_number'      => $data['parent_contactno'],
                'updated_by'          => $this->session->get('user')['id'],
            );

            $result = $this->Classroom_Model->update_student($unique_id,$array,$account_student,$account_parent,$student_details,$parent_details);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => "TRUE",
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Something Went Wrong!',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get All Classroom
    public function get_classroom()
    {
        if(isset($_POST['permissions']))
        {
            $permissions = $_POST['permissions'];
            $reg_id      = $_POST['reg_id'];
        }
        else
        {
            $permissions = $this->session->get('user')['permissions'];
            $reg_id      = $this->session->get('user')['reg_id'];
        }

        if($permissions == 'Admin' || $permissions == 'SuperAdmin')
        {
            $result = $this->Classroom_Model->get_classroom();
        }
        else
        {
            $result = $this->Classroom_Model->get_classroom_by_school($reg_id);
        }

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    public function get_classroom_details()
    {
        if($_POST['id']){
            $result = $this->Classroom_Model->get_classroom_details($_POST['id']);
            if(count($result)>=0)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => $result,
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Something Went Wrong!',
                    'status'   => 500
                );
            }
        
        }
        else{
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    public function delete_student()
    {
        $unique_id = $_POST['id'];

        $result = $this->Classroom_Model->delete_student($unique_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => "TRUE",
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Went Wrong!',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Get Batch Status
    public function get_classroom_status()
    {
        $id = $_POST['id'];

        $result = $this->Classroom_Model->get_classroom_status($id);
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get All Students for Classroom
    public function get_all_students_for_classroom()
    {
        $reg_id    = $this->session->get('user')['reg_id'];
        $result    = $this->Classroom_Model->get_all_students_for_classroom($reg_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Assign Classroom Students
    public function assign_classroom_students()
    {
        $data = $this->request->getPost();
        $data['added_by']     = $this->session->get('user')['id'];
        $data['updated_by']   = $this->session->get('user')['id'];
        $data['added_on']     = date('Y-m-d H:i:s');

        $result = $this->Classroom_Model->assign_classroom_students($data);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 500
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Assigned Students of Classroom
    public function assigned_classroom_memberlist()
    {
        $unique_id= $_POST['unique_id'];

        $result = $this->Classroom_Model->assigned_classroom_memberlist($unique_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Delete Assigned Students of Classroom
    public function delete_assignmember_classroom()
    {
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Classroom_Model->delete_assignmember_classroom($array, $_POST['id']);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Assign Classroom Courses
    public function get_all_courses_for_classroom()
    {
        $unique_id = $_POST['unique_id'];
        $reg_id    = $this->session->get('user')['reg_id'];
        $result    = $this->Classroom_Model->get_all_courses_for_classroom($unique_id, $reg_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Assign Classroom Course
    public function assign_classroom_course()
    {
        $data = $this->request->getPost();
        $data['added_by']     = $this->session->get('user')['id'];
        $data['updated_by']   = $this->session->get('user')['id'];
        $data['added_on']     = date('Y-m-d H:i:s');

        $result = $this->Classroom_Model->assign_classroom_course($data);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 500
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Assigned Courses of Classroom
    public function assigned_classroom_courselist()
    {
        $unique_id= $_POST['unique_id'];

        $result = $this->Classroom_Model->assigned_classroom_courselist($unique_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Delete Assigned Courses of Classroom
    public function delete_assigncourse_classroom()
    {
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Classroom_Model->delete_assigncourse_classroom($array, $_POST['id']);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    public function edit_classroom()
    {
        $data = $this->request->getPost();

        if($data['edit_classroom_token'] == $this->session->get('edit_classroom_token'))
        {

            $classroom_data = array(
                'classroom_name'             =>  $data['cls_name'],
                'administration_name'        =>  $data['adm_name'],
                'phone_number'               =>  $data['cls_phone'],
                'classroom_description'      =>  $data['cls_desc'],
                'updated_by'                 =>  $this->session->get('user')['id']
            );

            $classroom_details=array(
                'contact_number'             =>  $data['cls_phone'],
                'description'                =>  $data['cls_desc'],
                'updated_by'                 => $this->session->get('user')['id']
            );

            $classroom_acc=array(
                'username'                   =>  $data['cls_name'],
                'updated_by'                 =>  $this->session->get('user')['id']
            );

            if(isset($_FILES['cls_img'])){
                $event_img = $this->Aws_Library->aws_store($_FILES['cls_img']);
                $classroom_data['classroom_image'] = $event_img;
                $classroom_details['profile_image'] = $event_img;
            }
            
            $result = $this->Classroom_Model->edit_classroom($data['id'],$classroom_data,$classroom_acc,$classroom_details);
            if($result){
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }else{
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }else{
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Delete Classroom
    public function delete_classroom()
    {
        $data = $this->request->getPost();
        //$id         = $_POST['id'];
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Classroom_Model->delete_classroom($array, $data);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Batch
    public function add_batch()
    {
        $data = $this->request->getPost();

        if($data['batch_token'] == $this->session->get('batch_token'))
        {

            $batch_data = array(
                'unique_id'    => date("YmdHis")+1,
                'classroom_id' => $data['classroom_id'],
                'reg_id'       => $this->session->get('user')['reg_id'],
                'batch_name'   => $data['batch_nm'],
                'batch_image'  =>  $this->Aws_Library->aws_store($_FILES['batch_img']),
                'start_date'   => $data['startDate'],
                'end_date'     => $data['endDate'],
                'description'  =>  $data['batch_descp'],
                'added_by'     => $this->session->get('user')['id'],
                'updated_by'   => $this->session->get('user')['id'] 
            );
            $result = $this->Classroom_Model->add_batch($batch_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //get Batches
    public function get_batches()
    {
        if(isset($_POST['permissions']))
        {
            $permissions  = $_POST['permissions'];
            $reg_id       = $_POST['reg_id'];
            $classroom_id = $_POST['classroom_id'];
        }
        else
        {
            $permissions  = $this->session->get('user')['permissions'];
            $reg_id       = $this->session->get('user')['reg_id'];
            $classroom_id = $this->session->get('classroom_id');
        }
        if($permissions == 'Admin')
        {
            $result = $this->Classroom_Model->get_batches();
        }
        elseif($permissions == 'School')
        {
            $result = $this->Classroom_Model->get_batches_reg($reg_id);
        }
        elseif($permissions == 'Classroom')
        {
            $result = $this->Classroom_Model->get_batches_classroom($classroom_id);
        }

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get Batch by ID
    public function batch_by_id()
    {
        $data = $this->request->getPost();

        $result = $this->Classroom_Model->get_batch_by_id($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }
    
    //Get All News
    public function get_news()
    {
        $result = $this->Classroom_Model->get_news($this->session->get('user')['reg_id']);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
            
        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }

        echo json_encode($array);

    }

    //Add News
    public function add_news()
    {

        $data = $this->request->getPost();

        if(($data['news_token'] == $this->session->get('news_token')) && ($this->session->get('news_token') != NULL))
        {
           
            $news = array(

                'unique_id'             => date('YmdHis').mt_rand(10000,99999),
                'reg_id'                => $this->session->get('user')['reg_id'],
                'topic'                 => $data['topic_nm'],
                'topic_img'             => $this->Aws_Library->aws_store($_FILES['topic_img']),
                'news'                  => $data['news_text'],
                'start_date'            => $data['start_date'],
                'end_date'              => $data['end_date'],
                'added_by'              => $this->session->get('user')['id'],
                'updated_by'            => $this->session->get('user')['id'],
                'is_del'                => 0
                
            );
            

            $result = $this->Classroom_Model->add_news($news);

            if($result){

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );

            }else{

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 200
                );

            }

        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );

        }

        echo json_encode($array);

    }

    //Get News By Id
    public function get_news_id()
    {

        $data = $this->request->getPost();
        $result = $this->Classroom_Model->get_news_id($data['id']);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No data',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Disable Enable Batch
    public function show_hide_batch()
    {
        $id         = $_POST['id'];
        $visibility = $_POST['visibility'];

        $array = array(
            'visibility' => $visibility,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Classroom_Model->show_hide_batch($array, $id);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }
       echo json_encode($array);
    }

    //Delete News By Id
    public function del_news()
    {

        $data = $this->request->getPost();
        $result = $this->Classroom_Model->del_news($data['id']);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Edit Batch
    public function edit_batch()
    {
        $data = $this->request->getPost();

        if($data['batch_token'] == $this->session->get('edit_batch_token'))
        {
            $batch_data = array(
                'batch_name'   => $data['batch_nm'],
                'classroom_id' => $data['classroom_id'],
                'start_date'   => $data['startDate'],
                'end_date'     => $data['endDate'],
                'description'  =>  $data['batch_descp'],
                'updated_by'   => $this->session->get('user')['id']
            );

            if(isset($_FILES['batch_img']))
            {
                $event_img = $this->Aws_Library->aws_store($_FILES['batch_img']);
                $batch_data['batch_image'] = $event_img;
            }
            $result = $this->Classroom_Model->edit_batch($data['id'],$batch_data);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Something Wents Wrong!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Delete batch
    public function delete_batch()
    {
        $data = $this->request->getPost();
        
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Classroom_Model->delete_batch($array, $data);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    public function get_batch_users_byunique()
    {
        $unique_id = $_POST['unique_id'];
        $result    = $this->Classroom_Model->get_batch_users_byunique($unique_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }
        

       echo json_encode($array);
    }

    //Edit News By Id
    public function edit_news()
    {

        $data = $this->request->getPost();

        if(($data['edit_news_token'] == $this->session->get('edit_news_token')) && ($this->session->get('edit_news_token') != NULL))
        {
            
            $news = array(

                'topic' => $data['topic_nm'],
                'news' => $data['news_text'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'updated_by' => $this->session->get('user')['id'],

            );

            

            if(isset($_FILES['topic_img'])){

                $news['topic_img'] = $this->Aws_Library->aws_store($_FILES['topic_img']);

            }

            $result = $this->Classroom_Model->edit_news($news,$data['id']);

            if($result){

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );

            }else{

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 200
                );

            }

        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
            
        }
        
       echo json_encode($array);

    }

    //Get All Announcements
    public function get_anc()
    {

        $result = $this->Classroom_Model->get_anc($this->session->get('user')['reg_id']);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    public function get_allbatch_users_byunique()
    {
        $unique_id = $_POST['unique_id'];
        $result = $this->Classroom_Model->get_allbatch_users_byunique($unique_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }

        echo json_encode($array);

    }
    
    //Add Announcements
    public function add_anc()
    {

        $data = $this->request->getPost();
        if(($data['anc_token'] == $this->session->get('anc_token')) && ($this->session->get('anc_token') != NULL))
        {
            $anc = array(

                'unique_id'            => date('YmdHis').mt_rand(10000,99999),
                'reg_id'               => $this->session->get('user')['reg_id'],
                'announcement_topic'   => $data['topic'],
                'announcement_date'    => $data['anc_date'],
                'announcement_time'    => $data['anc_time'],
                'announcement'         => $data['announcements'],
                'added_by'             => $this->session->get('user')['id'],
                'updated_by'           => $this->session->get('user')['id'],
                'is_del'               => 0,

            );

            $result = $this->Classroom_Model->add_anc($anc);

            if($result){

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );

            }else{

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 200
                );

            }

        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
            
        }

        echo json_encode($array);

    }

    // get announcements by id
    public function get_anc_id()
    {

        $data = $this->request->getPost();

        $result = $this->Classroom_Model->get_anc_id($data['id']);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Get Batch Status
    public function get_batch_status()
    {
        $id = $_POST['id'];

        $result = $this->Classroom_Model->get_batch_status($id);
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {

            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }

        echo json_encode($array);

    }

    //Edit announcements by id
    public function edit_anc()
    {

        $data = $this->request->getPost();
        if(($data['edit_anc_token'] == $this->session->get('edit_anc_token')) && ($this->session->get('edit_anc_token') != NULL))
        {

            $anc = array(

                'announcement_topic'   => $data['topic'],
                'announcement_date'    => $data['anc_date'],
                'announcement_time'    => $data['anc_time'],
                'announcement'         => $data['announcements'],
                'updated_by'           => $this->session->get('user')['id'],
                'is_del'               => 0,

            );

            $result = $this->Classroom_Model->edit_anc($anc,$data['id']);

            if($result){

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );

            }else{

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 200
                );

            }

        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
            
        }

        echo json_encode($array);

    }

    //Delete Announcements By Id
    public function del_anc()
    {

        $data = $this->request->getPost();

        $result = $this->Classroom_Model->del_anc($data['id']);
        
        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Get Batch members
    public function get_batch_member()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->get_batch_member($data);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Assign Batch Students
    public function assign_batchStudents()
    {
        $data = $this->request->getPost();

        $data['added_by']     = $this->session->get('user')['id'];
        $data['updated_by']   = $this->session->get('user')['id'];
        $data['added_on']     = date('Y-m-d H:i:s');

        $result = $this->Classroom_Model->assign_batchStudents($data);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 500
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Delete Batch Member
    public function delete_assignmember()
    {
        $id         = $_POST['id'];

        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Classroom_Model->delete_assignmember($array, $id);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Fee Structure
    public function add_fee_structure()
    {

        $data = $this->request->getPost();

        $fee_structure = array();

        $fee_s = json_decode($data['fee_structure']);
        foreach ($fee_s as $key => $value) {

            array_push($fee_structure,(array)$value);

        }

        $fee_details = array(
            'unique_id'     => date('YmdHis'),
            'batch_id'  => $data['batch_id'],
            'term'  => $data['term'] ,
            'fee_details'   => json_encode($fee_structure),
            'total_fees'    => $data['total_price'],
            'added_by'      => $this->session->get('user')['id'],
            'updated_by'    => $this->session->get('user')['id'],
            'is_del'        => 0,
        );

        $result = $this->Classroom_Model->check_fee_structure($data['batch_id'],$data['term']);

        if(!$result){

            $result = $this->Classroom_Model->add_fee_structure($fee_details);
            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }

        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Already Exits',
                'status'   => 200
            );
        }

        echo json_encode($array);
       
    }

    //Get All Structure
    public function get_fee_structure(){

        $reg_id =  $this->session->get('user')['reg_id'];
        $result = $this->Classroom_Model->get_fee_structure($reg_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
    
    //Batch Course by unique ID
    public function get_batch_course_byunique()
    {
        $unique_id = $_POST['unique_id'];
        $result = $this->Classroom_Model->get_batch_course_byunique($unique_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get Batch Course
    public function get_batch_course()
    {
        $unique_id = $_POST['unique_id'];

        $result = $this->Classroom_Model->get_batch_course($unique_id);
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Assign batch course
    public function assign_batchcourses()
    {
        $data = $this->request->getPost();
        $data['added_by']     = $this->session->get('user')['id'];
        $data['updated_by']   = $this->session->get('user')['id'];

        $result = $this->Classroom_Model->assign_batchcourses($data);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 500
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Delete Assign Course
    public function delete_assigncourse()
    {
        $data = $this->request->getPost();
        
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );

        $data = $this->Classroom_Model->delete_assigncourse($array, $data);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get Fee Structure by Id
    public function get_batch_fee_by_id()
    {

        $data = $this->request->getPost();
        $result = $this->Classroom_Model->get_batch_fee_by_id($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Add Schedule
    public function add_schedule()
    {
        $data = $this->request->getPost();

        if(($data['add_schedule_token'] == $this->session->get('add_schedule_token')) && $data['add_schedule_token'] != NULL)
        {
            $date = date("Ymd", strtotime($data['lecture_date'])).date("His", strtotime($data['start_time'])).rand(1000,9999);

            $schedule = array(
                'schedule_id'        => $date,
                'reg_id'             => $this->session->get('user')['reg_id'],
                'batch_id'           => $data['batch_name'],
                'lecturer_id'        => $data['lecturer_name'],
                'classroom_id'       => 0,
                'title'              => $data['lec_name'],
                'class_name'         => $data['lecture_color'],
                'start_date'         => $data['lecture_date'],
                'start_time'         => date("H:i:s", strtotime($data['start_time'])), 
                'end_time'           => date("H:i:s", strtotime($data['end_time'])),
                'meet_url'           => base_url().'/videoconference?id='.$date,
                'added_by'           => $this->session->get('user')['id'],
                'updated_by'         => $this->session->get('user')['id'],
                'is_del'             => 0
            );

            $result = $this->Classroom_Model->add_schedule($schedule);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        
            echo json_encode($array);
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
            echo json_encode($array);
        }

    }

    //Load Schedule
    public function load_schedule()
    {
        if(isset($_POST['permissions']))
        {
            $permissions  = $_POST['permissions'];
            $reg_id       = $_POST['reg_id'];
            $classroom_id = $_POST['classroom_id'];
        }
        else
        {
            $permissions  = $this->session->get('user')['permissions'];
            $reg_id       = $this->session->get('user')['reg_id'];
            $classroom_id = $this->session->get('classroom_id');
        }
        if($permissions == 'Admin')
        {
            $result = $this->Classroom_Model->load_schedule();
        }
        elseif($permissions == 'School')
        {
            $result = $this->Classroom_Model->load_schedule_reg($reg_id);
        }
        elseif($permissions == 'Classroom')
        {
            $result = $this->Classroom_Model->load_schedule_classroom($classroom_id);
        }

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Load Event By ID
    public function load_schedule_id()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->load_schedule_id($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Drag Schedule
    public function drag_schedule(){
        $data = $this->request->getPost();

        $result = $this->Classroom_Model->drag_schedule($data['id'], $data['start_date']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Remove Schedule
    public function remove_schedule()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->remove_schedule($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }

    //Edit Schedule
    public function edit_schedule()
    {
        $data = $this->request->getPost();

        if(($data['edit_schedule_token'] == $this->session->get('edit_schedule_token')) && $data['edit_schedule_token'] != NULL)
        {            
            $schedule = array(
                'title'       => $data['schedule_name'],
                'class_name'  => $data['schedule_color'],
                'lecturer_id' => $data['schedule_mentor'],
                'start_time'  => date("H:i:s", strtotime($data['schedule_start_time'])),
                'end_time'    => date("H:i:s", strtotime($data['schedule_end_time'])),
                'updated_by'  => $this->session->get('user')['id'],
            );

            $result = $this->Classroom_Model->edit_schedule($data['id'], $schedule);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        
            echo json_encode($array);
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
            echo json_encode($array);
        }
    }

    //Get All Schedule Attendance List
    public function get_all_schedule_attendance_list()
    {
        if(isset($_POST['permissions']))
        {
            $permissions  = $_POST['permissions'];
            $reg_id       = $_POST['reg_id'];
            $classroom_id = $_POST['classroom_id'];
        }
        else
        {
            $permissions  = $this->session->get('user')['permissions'];
            $reg_id       = $this->session->get('user')['reg_id'];
            $classroom_id = $this->session->get('classroom_id');
        }
        if($permissions == 'Admin')
        {
            $result = $this->Classroom_Model->get_all_schedule_attendance_list();
        }
        elseif($permissions == 'School')
        {
            $result = $this->Classroom_Model->get_all_schedule_attendance_list_reg($reg_id);
        }
        elseif($permissions == 'Classroom')
        {
            $result = $this->Classroom_Model->get_all_schedule_attendance_list_classroom($classroom_id);
        }

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }

    //Get Schedule Attendance List
    public function get_schedule_attendance_list()
    {   
        $id = $_POST['unique_id'];
        $result = $this->Classroom_Model->get_schedule_attendance_list($id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }

    //Get Attendance Students
    public function get_attendance_students()
    {   
        $id = $_POST['unique_id'];
        $result = $this->Classroom_Model->get_attendance_students($id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }

    //Add Attendance
    public function add_attendance()
    {
        $data = $this->request->getPost();

        if(($data['attendance_token'] == $this->session->get('attendance_token')) && $data['attendance_token'] != NULL)
        {
            $reg_id      = $this->session->get('user')['reg_id'];
            $data = $this->request->getPost();

            $result = $this->Classroom_Model->add_attendance($data, $reg_id);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => $result,
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Student Attendance Already Marked',
                    'status'   => 500
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Delete Schedule Attendance
    public function delete_schedule_attendance()
    {
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->delete_schedule_attendance($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }

    //Record Lecture Attendance
    public function record_schedule_attendance()
    {
        $id = $this->session->get('user')['id'];
        $unique_id = $_POST['unique_id'];

        $result = $this->Classroom_Model->record_schedule_attendance($id, $unique_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }
    
    //Add Hostel
    public function add_hostel()
    {

        $data = $this->request->getPost();
        if(($data['hostel_add_token'] == $this->session->get('hostel_add_token')) && $data['hostel_add_token'] != NULL)
        {
            $hostel = array(
                'unique_id'                 => date('YmdHis'),
                'reg_id'                    => $this->session->get('user')['reg_id'],
                'hostel_name'               => $data['hostel_nm'],
                'hostel_type'               => $data['hostel_type'],
                'no_of_rooms'               => $data['no_of_rooms'],
                'ppl_capacity_per_rm'       => $data['room_capcity'],
                'added_by'                  => $this->session->get('user')['id'],
                'updated_by'                => $this->session->get('user')['id'],
                'is_del'                    => 0,
            );

            $result = $this->Classroom_Model->add_hostel($hostel);

            if($result){

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }

        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }

        echo json_encode($array);

    }

    //Add Lab Instance
    public function add_lab_instance()
    {
        $data = $this->request->getPost();

        if(($data['lab_instance_token'] == $this->session->get('lab_instance_token')) && $data['lab_instance_token'] != NULL)
        {   
            $lab = array(
                'lab_name'        => $data['lab_instance_name'],
                'lab_ip'          => $data['lab_instance_ip'],
                'reg_id'          => $this->session->get('user')['reg_id'],
                'classroom_id'    => 0,
                'batch_id'        => $data['batch_id'],
                'lab_username'    => $data['lab_username'],
                'lab_password'    => $data['lab_pwd'],
                'account_id'      => $data['student_nm'],
                'lab_description' => $data['lab_instance_descp'],
                'added_by'        => $this->session->get('user')['id'],
                'updated_by'      => $this->session->get('user')['id'],
                'is_del'          => 0
            );

            $result = $this->Classroom_Model->add_lab_instance($lab);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Lab Instance Already Exists',
                    'status'   => 200
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get Batch users by id
    public function get_batch_users_byid()
    {
        $id = $_POST['id'];
        $result    = $this->Classroom_Model->get_batch_users_byid($id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Get Hostel Details
    public function get_hostel()
    {

        $result = $this->Classroom_Model->get_hostel($this->session->get('user')['reg_id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }
        echo json_encode($array);
    }

    //Get Hostel By Id
    public function get_hostel_by_id(){
        $data = $this->request->getPost();
        $result = $this->Classroom_Model->get_hostel_by_id($data['unique_id'],$this->session->get('user')['reg_id']);
        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }
        echo json_encode($array);

    }

    //Get Lab Instance
    public function get_lab_instance()
    {
        $result = $this->Classroom_Model->get_lab_instance();

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 200
            );

        }
        echo json_encode($array);

    }

    //Edit Hostel
    public function edit_hostel(){
        $data = $this->request->getPost();

        if(($data['hostel_edit_token'] == $this->session->get('hostel_edit_token')) && $data['hostel_edit_token'] != NULL)
        {
            $id = $data['id'];

            $hostel = array(

                'hostel_name'               => $data['hostel_nm'],
                'hostel_type'               => $data['hostel_type'],
                'no_of_rooms'               => $data['no_of_rooms'],
                'ppl_capacity_per_rm'       => $data['room_capcity'],
                'updated_by'                => $this->session->get('user')['id'],
                
            );

            $result = $this->Classroom_Model->edit_hostel($hostel,$id);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'FALSE',
                    'status'   => 500
                );
            }
        }
        else{
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }

    //Get Lab Instance by id
    public function get_lab_instance_id()
    {
        $id = $_POST['id'];
        $result = $this->Classroom_Model->get_lab_instance_id($id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }

    //Edit Lab Instance
    public function edit_lab_instance()
    {
        $data = $this->request->getPost();

        if(($data['edit_lab_instance_token'] == $this->session->get('edit_lab_instance_token')) && $data['edit_lab_instance_token'] != NULL)
        {
            $lab = array(
                'lab_name'        => $data['lab_instance_name'],
                'lab_ip'          => $data['lab_instance_ip'],
                'lab_username'    => $data['lab_username'],
                'lab_password'    => $data['lab_pwd'],
                'batch_id'        => $data['batch_id'],
                'account_id'      => $data['student_nm'],
                'lab_description' => $data['lab_instance_descp'],
                'updated_by'      => $this->session->get('user')['id'],
                'is_del'          => 0
            );

            $result = $this->Classroom_Model->edit_lab_instance($lab, $data['id']);

            if($result)
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 200
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Not Updated',
                    'status'   => 200
                );
            }


                   
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked!',
                'status'   => 500
            );
        }
    
        echo json_encode($array);
    }

    //Delete Hostel
    public function del_hostel()
    {

        $data = $this->request->getPost();

        $result = $this->Classroom_Model->del_hostel($data['id']);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //delete Lab Instance
    public function del_lab_instance()
    {
        $id = $_POST['id'];
        $result = $this->Classroom_Model->del_lab_instance($id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Not Deleted',
                'status'   => 200
            );
        }
        echo json_encode($array);
    }
    

    //Get Assign Rooms
    public function get_assign_rooms(){

        $hostel_id = $_POST['hostel_id'];
        $result = $this->Classroom_Model->get_assign_rooms($hostel_id);

        // print_r($result);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);

    }

    //Get Room Students 
    public function get_room_students(){

        $data = $this->request->getPost();

        $result = $this->Classroom_Model->get_room_students($data['room_no'],$data['hostel_id']);
        
        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);

    }

    //Assign Room Student
    public function assign_room_student(){

        $data = $this->request->getPost();
        $assign = array(

            'unique_id' => date('YmdHis'),
            'reg_id' => $this->session->get('user')['reg_id'], 
            'hostel_id' => $data['hostel_id'],
            'room_no' => $data['room_no'],
            'student_id' => $data['student_id'],
            'compartment' => $data['cmpt_no'],
            'start_date' => $data['check_in'],
            'end_date' => $data['check_out'],
            'added_by' => $this->session->get('user')['id'], 
            'updated_by' => $this->session->get('user')['id'],
            'is_del' => 0
        );
        $result = $this->Classroom_Model->assign_room_student($assign);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => 'TRUE',
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);

    }

    //Load Schedule
    public function load_schedule_student()
    {
        $id           = $this->session->get('user')['id'];
        $classroom_id = $this->session->get('classroom_id');

        $result = $this->Classroom_Model->load_schedule_student($id, $classroom_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //get_student_availability
    public function student_availability(){

        if(isset($_POST['reg_id'])){

            $reg_id = $_POST['reg_id'];

        }else{

            $reg_id = $this->session->get('user')['reg_id'];
            
        }

        $result = $this->Classroom_Model->student_availability($reg_id);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);

    }

    //get room student
    public function get_room_student(){

        $data = $this->request->getPost();
        $result = $this->Classroom_Model->get_room_student($data['id']);

        if($result){

            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Get Lab Student
    public function get_labs_student()
    {
        $id            = $_POST['id'];
        $classroom_id  = $_POST['classroom_id'];

        $result = $this->Classroom_Model->get_labs_student($id, $classroom_id);

        if($result)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $result,
                'status'   => 200
            );
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'False',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
}