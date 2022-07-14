<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Admin_Model as Admin_Model;

class Admin_Controller extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();

        $this->Aws_Library = new Aws_Library();
        $this->Admin_Model = new Admin_Model();
    }

    //Add Admin
    public function manage_admin_form()
    {
        $data = $this->request->getPost();
        
        if($data['manage_admin_form_token'] == $this->session->get('manage_admin_form_token'))
        {
            $check = $this->Admin_Model->check_email($data['email_id']);

            if($check)
            {
                if(isset($_FILES['image']))
                {
                    $image =  $this->Aws_Library->aws_store($_FILES['image']);
                }

                if(isset($_FILES['document']))
                {
                    $document=  $this->Aws_Library->aws_store($_FILES['document']);
                }

                $admin_data = array(
                    'unique_id'         => date("YmdHis"),
                    'account_id'        => 0,
                    'name'              => $data['name'],
                    'phone'             => $data['phone'],
                    'dob'               => $data['dob'],
                    'gender'            => $data['gender'],
                    'email_id'          => $data['email_id'],
                    'image'             => $image,
                    'document'          => $document,
                    'region_type'       => $data['region_type'],
                    'region_country'    => $data['region_country'],
                    'region_state'      => $data['region_state'],
                    'region_city'       => $data['region_city'],
                    'description'       => $data['description'],
                    'added_by'          => $this->session->get('user')['id'],
                    'updated_by'        => $this->session->get('user')['id'],
                    'is_del'            => 0
                );

                $accounts = array(
                    'unique_id'   => date("YmdHis"),
                    'reg_id'      => 0,
                    'username'    => $data['name'],
                    'email'       => $data['email_id'],
                    'pass'        => password_hash($data['password'], PASSWORD_BCRYPT),
                    'permissions' => 'Admin',
                    'status'      => 'Verified',
                    'mfa_status'  => 0,
                    'added_by'    => $this->session->get('user')['id'],
                    'updated_by'  => $this->session->get('user')['id'],
                    'is_del'      => 0
                );

                $account_details = array(
                    'account_id'        => 0,
                    'contact_number'    => $data['phone'],
                    'description'       => $data['description'],
                    'profile_image'     => $image,
                    'layout_pref'       => 'Menu',
                    'language_pref'     => 'English',
                    'added_by'          => $this->session->get('user')['id'],
                    'updated_by'        => $this->session->get('user')['id'],
                    'is_del'            => 0
                );

                $result = $this->Admin_Model->manage_admin_form($admin_data, $accounts, $account_details);

                if($result)
                {
                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'TRUE',
                        'status'   => 200
                    );

                    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                      <head>
                        <title>MENTORBOX</title>
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
                          a:hover{text-decoration:none !important;}
                          .nav a:hover{text-decoration:underline !important;}
                          .title a:hover{text-decoration:underline !important;}
                          .title-2 a:hover{text-decoration:underline !important;}
                          .btn:hover{opacity:0.8;}
                          .btn a:hover{text-decoration:none !important;}
                          .btn{
                          -webkit-transition:all 0.3s ease;
                          -moz-transition:all 0.3s ease;
                          -ms-transition:all 0.3s ease;
                          transition:all 0.3s ease;
                          }
                          table td {border-collapse: collapse !important;}
                          .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
                          @media only screen and (max-width:500px) {
                          table[class="flexible"]{width:100% !important;}
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
                          td[class="aligncenter"]{text-align:center !important;}
                          th[class="flex"]{
                          display:block !important;
                          width:100% !important;
                          }
                          td[class="wrapper"]{padding:0 !important;}
                          td[class="holder"]{padding:30px 15px 20px !important;}
                          td[class="nav"]{
                          padding:20px 0 0 !important;
                          text-align:center !important;
                          }
                          td[class="h-auto"]{height:auto !important;}
                          td[class="description"]{padding:30px 20px !important;}
                          td[class="i-120"] img{
                          width:120px !important;
                          height:auto !important;
                          }
                          td[class="footer"]{padding:5px 20px 20px !important;}
                          td[class="footer"] td[class="aligncenter"]{
                          line-height:25px !important;
                          padding:20px 0 0 !important;
                          }
                          tr[class="table-holder"]{
                          display:table !important;
                          width:100% !important;
                          }
                          th[class="thead"]{display:table-header-group !important; width:100% !important;}
                          th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
                          }
                          .btn {
                              text-decoration: none !important;
                              outline: none !important;
                              -webkit-transition: all .3s ease-in-out;
                              -moz-transition: all .3s ease-in-out;
                              -ms-transition: all .3s ease-in-out;
                              -o-transition: all .3s ease-in-out;
                              transition: all .3s ease-in-out;
                          }
                          .btn-light {
                              padding: 0 20px;
                              margin-left: 15px;
                          }
                          
                          .btn-light {
                              padding: 13px 40px;
                              font-size: 18px;
                              border: 2px solid #ffffff !important;
                              color: #ffffff;
                              background-color: transparent;
                          }
                          .btn-light:hover,
                          .btn-light:focus {
                              border-color: rgba(255, 255, 255, 0.6);
                              color: rgba(255, 255, 255, 0.6);
                          }
                          
                          .btn-light{
                            background-color: #f4b50a !important;
                            color: #ffffff !important;
                            border: 2px solid #f4b50a !important;
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
                                                    Welcome
                                              </td>
                                           </tr>
                                           <tr>
                                              <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                 Your account is verified. To proceed click on button below:<br><br><a href="'.base_url().'login" style="margin-top: 2px;" class="btn btn-light btn-radius btn-brd grd1">Login</a>
                                              </td>
                                           </tr>
                                           <tr>
                                                <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#173965; padding:0 0 23px;">
                                                    Your Account has been Registered for Easylearn, Use below login credentials for Login In<br>
                                                    Username: '.$data['email_id'].' <br>
                                                    Password: '.$data['password'].'

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
          
                    $this->email->setTo($data['email_id']);
                    $this->email->setFrom('info@isfedutech.com' , 'Easylearn');
                    
                    $this->email->setSubject('WELCOME TO EASYLEARN');
                    $this->email->setMessage($message);
                    $this->email->send();
                }
                else
                {
                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'Something Wents Wrong!',
                        'status'   => 500
                    );
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Email ID Already Exists!',
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

    //Get all Admin
    public function get_all_admin()
    {
        $result = $this->Admin_Model->get_all_admin();
    
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

    //get Admin by ID
    public function get_admin_by_id()
    {
        $id = $_POST['id'];
        $result = $this->Admin_Model->get_admin_by_id($id);
    
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

    //Edit Admin
    public function edit_admin_form()
    {
        $data = $this->request->getPost();
        
        if($data['edit_admin_form_token'] == $this->session->get('edit_admin_form_token'))
        {
            $admin_data = array(
                'name'              => $data['name'],
                'phone'             => $data['phone'],
                'region_type'       => $data['region_type'],
                'region_country'    => $data['region_country'],
                'region_state'      => $data['region_state'],
                'region_city'       => $data['region_city'],
                'description'       => $data['description'],
                'updated_by'        => $this->session->get('user')['id'],
            );

            if(isset($_FILES['image']))
            {
                $admin_data['image'] =  $this->Aws_Library->aws_store($_FILES['image']);
            }
            
            $result = $this->Admin_Model->edit_admin_form($admin_data, $data['id']);

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
                    'data'     => 'Something Wents Wrong!',
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

    //delete Admin By ID
    public function delete_admin()
    {
        $id = $_POST['id'];
        $result = $this->Admin_Model->delete_admin($id);
    
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
                'data'     => 'Error Occured',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }
}