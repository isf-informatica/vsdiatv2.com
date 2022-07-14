<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\Mfa_Library as Mfa_Library;
use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Register_Model as Register_Model;

helper('common');

class Register_Controller extends ResourceController{
    
    public function __construct(){

        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->Mfa_Library = new Mfa_Library();    
        $this->Aws_Library = new Aws_Library();
        $this->Register_Model = new Register_Model();
    }

    //Login User
    public function login_user()
    {
        $data = $this->request->getPost();

        if($data['login_token'] == $this->session->get('login_token'))
        {
            $result = $this->Register_Model->login_user($data['login_email']);

            if($result)
            {
                if($result['status'] == 'Unverified' || $result['status'] == 'Document Unverified')
                {
                    if($result['status'] == 'Unverified')
                    {
                        $approval = 'Account approval pending';
                    }
                    if($result['status'] == 'Document Unverified')
                    {
                        $approval = "Document approval pending";
                    }

                    $approval = $approval;
                    $array = array(
                        'Response' => 'OK',
                        'data'     => $approval,
                        'status'   => 500
                    );
                }
                else
                {
                    if (password_verify($data['login_password'], $result['pass'])) 
                    {
                        $insert = $this->Register_Model->record_login($result['id'], $this->request->getIPAddress());

                        if($data['captcha'] == 1)
                        {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6LeTr3MeAAAAALfq_n6s2pqJXYAgdqT7_RqMYkz1', 'response' => $data['captcha_token_v3'])));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $captcha_response_v3 = json_decode(curl_exec($ch));
                            curl_close($ch);


                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6Le6f3keAAAAALOcqrcv4qp1onnxS9dN7y8Pex-u', 'response' => $data['captcha_token_v2'])));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $captcha_response_v2 = json_decode(curl_exec($ch));
                            curl_close($ch);
                        }

                        $mfa = json_decode(get_security_name('MFA') , true)['data']['status'];

                        if($mfa == 1)
                        {
                            $user_data = array(
                                'id'            => $result['id'],
                                'reg_id'        => $result['reg_id'],
                                'username'      => $result['username'],
                                'email'         => $result['email'],
                                'permissions'   => $result['permissions'],
                                'status'        => $result['status'],
                                'mfa_status'    => $result['mfa_status'],
                            );
                        }
                        else
                        {
                            $user_data = array(
                                'id'            => $result['id'],
                                'reg_id'        => $result['reg_id'],
                                'username'      => $result['username'],
                                'email'         => $result['email'],
                                'permissions'   => $result['permissions'],
                                'status'        => $result['status'],
                                'mfa_status'    => 1,
                            );
                        }

                        if($result['permissions'] == 'Admin')
                        {
                            $access =  $this->Register_Model->get_admin_access($result['id']);
                            $this->session->set('region_type', $access['region_type']);

                            if($access['region_type'] == 'Country')
                            {
                                $region_name = $access['region_country'];
                            }
                            elseif($access['region_type'] == 'State')
                            {
                                $region_name = $access['region_state'];
                            }
                            elseif($access['region_type'] == 'City')
                            {
                                $region_name = $access['region_city'];
                            }

                            $this->session->set('region_name', $region_name);
                        }
                        elseif ($result['permissions'] == 'Classroom') 
                        {
                           $access =  $this->Register_Model->get_classroom_id($result['id']);
                           $this->session->set('classroom_id', $access['id']); 
                        }
                        elseif ($result['permissions'] == 'Student') 
                        {
                           $access =  $this->Register_Model->get_classroom_batch_id($result['id']);
                           $this->session->set('classroom_id', $access); 
                        }

                        if($result['profile_image'] == NULL || $result['profile_image'] == 'NULL' || $result['profile_image'] == '')
                        {
                            $user_data['profile_image'] = base_url().'/public/Easylearn/images/no_profile.jpg';
                        }
                        else
                        {
                            $user_data['profile_image'] = $result['profile_image'];
                        }

                        if($data['captcha'] == 1)
                        {
                            if($captcha_response_v3->success == true && $captcha_response_v2->success == true )
                            {
                                if($mfa == 1)
                                {
                                    if($user_data['mfa_status'] == 1)
                                    {
                                        $this->session->set('user1', $user_data);
                                        $array = array(
                                            'Response' => 'OK',
                                            'data'     => 'MFA',
                                            'status'   => 200
                                        );
                                    }
                                    else
                                    {
                                        $this->session->set('logged_in', TRUE);
                                        $this->session->set('user', $user_data);
        
                                        $array = array(
                                            'Response' => 'OK',
                                            'data'     => 'TRUE',
                                            'status'   => 200
                                        );
                                    }
                                }
                                else
                                {
                                    $this->session->set('logged_in', TRUE);
                                    $this->session->set('user', $user_data);
    
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
                                    'data'     => 'Captcha Verification failed. Please Retry',
                                    'status'   => 500
                                );
                            }
                        }
                        else
                        {
                            if($mfa == 1)
                            {
                                if($user_data['mfa_status'] == 1)
                                {
                                    $this->session->set('user1', $user_data);
                                    $array = array(
                                        'Response' => 'OK',
                                        'data'     => 'MFA',
                                        'status'   => 200
                                    );
                                }
                                else
                                {
                                    $this->session->set('logged_in', TRUE);
                                    $this->session->set('user', $user_data);
    
                                    $array = array(
                                        'Response' => 'OK',
                                        'data'     => 'TRUE',
                                        'status'   => 200
                                    );
                                }
                            }
                            else
                            {
                                $this->session->set('logged_in', TRUE);
                                $this->session->set('user', $user_data);

                                $array = array(
                                    'Response' => 'OK',
                                    'data'     => 'TRUE',
                                    'status'   => 200
                                );
                            }
                        }
                    }
                    else
                    {
                        $array = array(
                            'Response' => 'OK',
                            'data'     => 'Password Does Not Match',
                            'status'   => 500
                        );
                    }
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Account does not Exists!',
                    'status'   => 500
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

    //Validate Qr Code
    public function validate_qr()
    {
        $code = $_POST['otp'];

        $secret = $this->Register_Model->retrive_qr($this->session->get('user1')['id']);

        if($secret)
        {
            $status = $this->Mfa_Library->validate_qr($code, $secret['secret']);

            if($status)
            {
                $this->session->set('logged_in', TRUE);
                $this->session->set('user', $this->session->get('user1'));

                $array = array(
                    'Response' => 'OK',
                    'data'     => 'TRUE',
                    'status'   => 500,
                );
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'OTP does not match',
                    'status'   => 500,
                );
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'No Data',
                'status'   => 500,
            );
        }
        echo json_encode($array);
    }

    //Send OTP
    public function forget_email_send_otp()
    {
        $email = $_POST['email'];
        $data = $this->Register_Model->check_email($email);

        if($data)
        {
            $otp = random_int(100000, 999999);
            $this->session->set('forget_otp', $otp);
            $this->session->set('forget_pass_user', $email);
            
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
                                                                <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style=" text-decoration:underline; color:#40aceb;" style="font:bold 18px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                              Email:<br>'.$email.' <br><br>Did you forget your password? <br>Recover it with the OTP below<br>'.$otp.'
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
            
            $this->email->setSubject('OTP verification from EASYLEARN');
            $this->email->setMessage($message);
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
                'data'     => 'FALSE',
                'status'   => 200
            );
        }

        echo json_encode($array);
    }

    //Check OTP
    public function check_otp()
    {
        $code = $_POST['otp'];
 
        if($code == $this->session->get('forget_otp'))
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $this->session->get('forget_pass_user'),
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

    //Change Password Form
    public function new_pwd_form()
    {
        $data = $this->request->getPost();

        if(($data['edit_new_pwd_token'] == $this->session->get('edit_new_pwd_token')) && $data['edit_new_pwd_token'] != NULL)
        {
            if($this->session->get('forget_pass_user') == $data['email'])
            {
                $newpwd = array(
                    'pass' => password_hash($data['pass'], PASSWORD_BCRYPT),
                );
                
                $result = $this->Register_Model->new_pwd_form($newpwd, $data['email']);

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
                    'data'     => 'FALSE',
                    'status'   => 500
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

    //Check Email
    public function check_email()
    {
        $email = $_POST['email'];
        $data = $this->Register_Model->check_email($email);

        if ($data) {
            $array = array(
                'Response' => 'OK',
                'data' => 'TRUE',
                'status' => 200,
            );
        } else {
            $array = array(
                'Response' => 'OK',
                'data' => 'FALSE',
                'status' => 200,
            );
        }
        echo json_encode($array);
    }

    //Jr College register
    public function jr_clg_register(){

        $data = $this->request->getPost();
        
        if(($data['jr_college_token'] == $this->session->get('jr_college_token')) && $data['jr_college_token'] != NULL)
        {
            $result = $this->Register_Model->check_email($data['jr_college_administratoremail']);

            if(!$result){

                $jr_logo = $this->Aws_Library->aws_store($_FILES['jr_college_logo']);
                $jr_img = $this->Aws_Library->aws_store($_FILES['jr_college_image']);

                $jr_clg = array(

                    'unique_id'  => date("YmdHis"),
                    'clg_name'  => $data['jr_college_name'],
                    'clg_type'  => $data['college_type'],
                    'clg_board_type'  => $data['college_board_type'],
                    'clg_medium'  => $data['jr_college_medium'],
                    'clg_code'  => $data['jr_college_code'],
                    'is_coed'   => $data['is_coed'],
                    'clg_gender_type'  => $data['jr_college_gender_type'],
                    'clg_logo'  => $jr_logo,
                    'clg_image'  => $jr_img,
                    'phone_1'  => $data['jr_college_contactnumber1'],
                    'phone_2'  => $data['jr_college_contactnumber2'],
                    'clg_streams'  => $data['jr_stream'],
                    'clg_descp'  => $data['jr_college_description'],
                    'admin_name'  => $data['jr_college_administratorname'],
                    'admin_email'  => $data['jr_college_administratoremail'],
                    'addr1'  => $data['jr_college_addressline1'],
                    'addr2'  => $data['jr_college_addressline2'],
                    'country'  => $data['jr_college_country'],
                    'state'  => $data['jr_college_state'],
                    'city'  => $data['jr_college_city'],
                    'pcode'  => $data['jr_college_postal_code'],
                    'status' => 'Unverified',
                    'added_by' => 0,
                    'updated_by' => 0,
                    'is_del' => 0,
                );

                $accounts = array(
                    'unique_id'  => date("YmdHis"),
                    'email' => $data['jr_college_administratoremail'],
                    'username' => $data['jr_college_administratorname'],
                    'pass' => password_hash($data['jrclg_pwd'], PASSWORD_BCRYPT),
                    'permissions' => 'Jr College',
                    'status' => 'Unverified',
                    'mfa_status' => 0,
                    'added_by' => 0,
                    'updated_by' => 0,
                    'is_del' => 0
                );

                $account_details = array(
                    'contact_number' => $data['jr_college_contactnumber1'],
                    'profile_image' => $jr_img,
                    'description' => $data['jr_college_description'],
                    'layout_pref' => 'English',
                    'language_pref' => 'Menu Layout',
                    'added_by' => 0,
                    'updated_by' => 0,
                    'is_del' => 0
                );

                $registration = array(
                    'type' => 'Jr College',
                    'is_del' => 0
                );

                $result = $this->Register_Model->jr_clg_register($jr_clg,$registration,$accounts,$account_details);

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
                    'data'     => 'Email already Exists',
                    'status'   => 500
                );

            }

        }else{

            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross site request blocked!',
                'status'   => 500
            );

        }
        echo json_encode($array);
    }

    //Register Mentor 
    public function register_mentor(){

        $data = $this->request->getPost();

        if($data['m_token'] == $this->session->get('mentor_token'))
        {
            $skills = [];
            $decode = json_decode($data['m_skills'], true);

            foreach ($decode as $de)
            {
                array_push($skills,$de['value']);
            }
            $m_pic    = $this->Aws_Library->aws_store($_FILES['m_pic']);
            $m_resume = $this->Aws_Library->aws_store($_FILES['m_resume']);

            $mentor = array(
                'unique_id'          => date('YmdHis'),
                'account_id'         => 0,
                'mentor_name'        => $data['m_name'],
                'experience'         => $data['m_exp'],
                'dob'                => $data['m_dob'],
                'field_of_expertise' => $data['m_expt'],
                'skills'             => json_encode($skills),
                'description'        => $data['m_descp'],
                'email'              => $data['m_email'],
                'contact_number1'    => $data['m_con1'],
                'contact_number2'    => $data['m_con2'],
                'address_line1'      => $data['m_addr1'],
                'address_line2'      => $data['m_addr2'],
                'state'              => $data['m_st'],
                'pincode'            => $data['m_pcode'],
                'country'            => $data['m_country'],
                'city'               => $data['m_city'],
                'photo_url'          => $m_pic,
                'resume_url'         => $m_resume,
                'status'             => 'Unverified',
                'added_by'           => 0,
                'updated_by'         => 0,
                'is_del'             => 0
            );

            $accounts = array(
                'unique_id'   => date('YmdHis'),
                'reg_id'      => 0,
                'username'    => $data['m_name'],
                'email'       => $data['m_email'],
                'pass'        => password_hash($data['m_pass'], PASSWORD_BCRYPT),
                'permissions' => 'Mentor',
                'status'      => 'Unverified',
                'added_by'    => 0,
                'updated_by'  => 0,
                'is_del'      => 0
            );

            $account_details = array(
                'account_id'     => 0,
                'contact_number' => $data['m_con1'],
                'description'    => $data['m_descp'],
                'profile_image'  => $m_pic,
                'layout_pref'    => 'Menu Layout',
                'language_pref'  => 'English',
                'added_by'       => 0,
                'updated_by'     => 0,
                'is_del'         => 0
            );
            
            $result = $this->Register_Model->register_mentor($mentor, $accounts, $account_details);

            if($result)
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
}