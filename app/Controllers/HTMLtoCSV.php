<?php

namespace App\Controllers;

require_once APPPATH.'ThirdParty/HTMLtoCSV/simple_html_dom.php';

use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Register_Model as Register_Model;
use App\Models\Easylearn\HTMLtoCSV_Model as HTMLtoCSV_Model;

class HTMLtoCSV extends BaseController
{
    public function __construct()
    {
        $this->HTMLtoCSV_Model = new HTMLtoCSV_Model();
        $this->Aws_Library     = new Aws_Library();
        $this->Register_Model  = new Register_Model();
    }

    //Check Email
    public function check_email()
    {
        $email = $_POST['email'];
        $data = $this->Register_Model->check_email($email);

        if($data)
        {
            return TRUE;
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

    public function Download_Student_Template()
    {
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=Student_Template.csv');

        $file = fopen('php://output','w');
        $header = array("Sr No.","Student Name", "Student Email", "Student Description");
        
        fputcsv($file,$header);
        fclose($file);
        
        exit;
    }

    public function multi_student_insert()
    {
        $permissions = $this->session->get('user')['permissions'];
        $multi_student_data = $this->request->getPost();

        if(isset($_FILES['multi_data_file']))
        {
            $output = ''; 
            $allowed_ext = array("csv");  
            $file_name = explode(".", $_FILES["multi_data_file"]["name"]);
            $extension = end($file_name); 

            if(in_array($extension, $allowed_ext))
            {
                $file_data = fopen($_FILES["multi_data_file"]["tmp_name"], 'r');  
                $insert_data = [];        
                $not_insert_data = [];

                $error = ['Sr No.', 'Student Name', 'Student Email', 'Error Message'];
                array_push($not_insert_data, $error);

                while($row = fgetcsv($file_data))
                {
                    $row = array_map("utf8_encode", $row);
                    if($row[0] != 'Sr No.')
                    {
                        if( ($row[0] != "" || $row[0] != null) &&
                            ($row[1] != "" || $row[1] != null) && 
                            ($row[2] != "" && $row[2] != null && filter_var($row[2], FILTER_VALIDATE_EMAIL))
                        )
                        {
                            $data = $this->Register_Model->check_email($row[2]);

                            if(!$data)
                            {
                                $array = array(
                                    'student_name'         => $row[1],                    
                                    'student_emailid'      => $row[2],
                                    'student_description'  => $row[3]
                                );
                                array_push($insert_data, $array);
                            }
                            else
                            {
                                $error = [$row[0], $row[1], $row[2], "Student Email Already Exists!"];
                                array_push($not_insert_data, $error);
                            }
                        }
                        else
                        {
                            $error = [$row[0], $row[1], $row[2], "Inproper Data"];
                            array_push($not_insert_data, $error);
                        }
                    }
                }
                if($permissions == 'School' || $permissions == 'Jr College')
                {
                    $result =  $this->HTMLtoCSV_Model->insert_multi_student($insert_data, $this->session->get('user')['reg_id'], $this->session->get('user')['id']);
                }
                elseif($permissions == 'Classroom')
                {
                    $result =  $this->HTMLtoCSV_Model->insert_multi_student_classroom($insert_data, $this->session->get('user')['reg_id'], $this->session->get('user')['id'],$this->session->get('classroom_id'));
                }

                if($result)
                {
                    $array = array(
                        'Response'   => 'OK',
                        'data'       => $result,
                        'not_insert' => $not_insert_data,
                        'status'     => 200,
                    );  
                }
                else
                {
                    $array = array(
                        'Response'   => 'OK',
                        'data'       => 0,
                        'not_insert' => $not_insert_data,
                        'status'     => 200,
                    ); 
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Insert Proper File',
                    'status'   => 200
                ); 
            }

        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Insert Proper Data',
                'status'   => 200
            ); 
        }

        echo json_encode($array);
    }

    //MCQ Template
    public function Download_Question_Template()
    {
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename=Download_Question_Template.csv');

        $fp = fopen("php://output", "w");

        $array = ['Sr. No.', 'Question Title', 'Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5', 'Option 6', 'Option 7', 'Option 8', 'Option 9', 'Option 10', 'Answer Option'];
        fputcsv($fp, $array);

        fclose($fp);
        exit;
    }

    //MCQ Question Upload
    public function add_multiple_question()
    {
        $data = $this->request->getPost();

        if(($data['add_question_token'] == $this->session->get('add_question_token')) && $data['add_question_token'] != NULL)
        {
            if(isset($_FILES['question_csv']))
            {
                $output = '';  
                $allowed_ext = array("csv");  
                $file_name = explode(".", $_FILES["question_csv"]["name"]);
                $extension = end($file_name); 

                if(in_array($extension, $allowed_ext))
                {
                    $file_data = fopen($_FILES["question_csv"]["tmp_name"], 'r');  
                    $insert_data = [];

                    while($row = fgetcsv($file_data))
                    {
                        $row = array_map("utf8_encode", $row);
    
                        $array = array(
                            'exam_id'          => 0,
                            'question_title'   => $row[1],
                            'question_image'   => '',
                            'option_1'         => $row[2],
                            'option_2'         => $row[3],
                            'option_3'         => $row[4],
                            'option_4'         => $row[5],
                            'option_5'         => $row[6],
                            'option_6'         => $row[7],
                            'option_7'         => $row[8],
                            'option_8'         => $row[9],
                            'option_9'         => $row[10],
                            'option_10'        => $row[11],
                            'answer_option'    => $row[12],
                            'added_on'         => date('Y-m-d H:i:s'),
                            'added_by'         => $this->session->get('user')['id'],
                            'user_time'        => $data['user_time'],
                            'updated_by'       => $this->session->get('user')['id'],
                            'update_user_time' => $data['user_time'],
                            'is_del'           => 0
                        );

                        array_push($insert_data, $array);
                    }

                    $result = $this->HTMLtoCSV_Model->add_multiple_question($insert_data, $data['unique_id']);

                    if($result)
                    {
                        $array = array(
                            'Response' => 'OK',
                            'data'     => 'TRUE',
                            'count'    => $result,
                            'status'   => 200
                        );
                    }
                    else
                    {
                        $array = array(
                            'Response' => 'OK',
                            'data'     => 'Could Not be Added',
                            'status'   => 500
                        );
                    }
                }
                else
                {
                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'CSV Error!',
                        'status'   => 500
                    );
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'No file is selected!',
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

    //Sentance Question Upload
    public function Download_Sentence_Question_Template()
    {
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename=Download_Question_Template.csv');

        $fp = fopen("php://output", "w");

        $array = ['Sr. No.', 'Question', 'Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5'];
        fputcsv($fp, $array);

        fclose($fp);
        exit;
    }

    //MCQ Sentence Question Upload
    public function add_multiple_sentence_question()
    {
        $data = $this->request->getPost();

        if(($data['add_sentence_token'] == $this->session->get('add_sentence_token')) && $data['add_sentence_token'] != NULL)
        {
            if(isset($_FILES['question_csv']))
            {
                $output = '';  
                $allowed_ext = array("csv");  
                $file_name = explode(".", $_FILES["question_csv"]["name"]);
                $extension = end($file_name); 

                if(in_array($extension, $allowed_ext))
                {
                    $file_data = fopen($_FILES["question_csv"]["tmp_name"], 'r');  
                    $insert_data = [];

                    while($row = fgetcsv($file_data))
                    {
                        $row = array_map("utf8_encode", $row);

                        if(substr_count($row[1], "--input--") > 0 && substr_count($row[1], "--input--") <= 5)
                        {
                            $question_title = str_replace("--input--", '<input type="text" class="ans-input" style="border:none;border-bottom: 1px solid #555;" disabled="">&nbsp;', $row[1]);
        
                            $array = array(
                                'exam_id'          => 0,
                                'question_title'   => $question_title,
                                'question_image'   => '',
                                'option_1'         => $row[2],
                                'option_2'         => $row[3],
                                'option_3'         => $row[4],
                                'option_4'         => $row[5],
                                'option_5'         => $row[6],
                                'added_on'         => date('Y-m-d H:i:s'),
                                'added_by'         => $this->session->get('user')['id'],
                                'user_time'        => $data['user_time'],
                                'updated_by'       => $this->session->get('user')['id'],
                                'update_user_time' => $data['user_time'],
                                'is_del'           => 0
                            );

                            array_push($insert_data, $array);
                        }
                    }

                    $result = $this->HTMLtoCSV_Model->add_multiple_sentence_question($insert_data, $data['unique_id']);

                    if($result)
                    {
                        $array = array(
                            'Response' => 'OK',
                            'data'     => 'TRUE',
                            'count'    => $result,
                            'status'   => 200
                        );
                    }
                    else
                    {
                        $array = array(
                            'Response' => 'OK',
                            'data'     => 'Could Not be Added',
                            'status'   => 500
                        );
                    }
                }
                else
                {
                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'CSV Error!',
                        'status'   => 500
                    );
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'No file is selected!',
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

    //Assign Student Template
    public function Download_Assign_Student_Template()
    {
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=Assign_Student_Template.csv');

        $file = fopen('php://output','w');
        $header = array("Sr No.", "Student Email");
        
        fputcsv($file,$header);
        fclose($file);
        
        exit;
    }

    //Assign Student Classroom
    public function csv_assign_student_classroom()
    {
        $data = $this->request->getPost();
        $id = $this->session->get('user')['id'];

        if(isset($_FILES['multi_data_file']))
        {
            $output      = ''; 
            $allowed_ext = array("csv");  
            $file_name   = explode(".", $_FILES["multi_data_file"]["name"]);
            $extension   = end($file_name); 

            if(in_array($extension, $allowed_ext))
            {
                $file_data = fopen($_FILES["multi_data_file"]["tmp_name"], 'r');  
                $insert_data = [];        

                while($row = fgetcsv($file_data))
                {
                    $row = array_map("utf8_encode", $row);
                    if( ($row[0] != "" || $row[0] != null) &&
                        ($row[1] != "" || $row[1] != null)
                    )
                    {
                        if($row[0] != 'Sr No.')
                        {
                            $array = array(
                                'sr_no'         => $row[0],
                                'student_email' => $row[1],
                            );
                            array_push($insert_data, $array);
                        }
                    }
                }
                $result =  $this->HTMLtoCSV_Model->csv_assign_student_classroom($insert_data, $data['unique_id'], $id);

                if($result)
                {                    
                    $array = array(
                        'Response'     => 'OK',
                        'data'         => $result['i'],
                        'not_inserted' => $result['not_inserted'],
                        'status'       => 200,
                    );  
                    
                }
                else
                {
                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'Batch is not Available',
                        'status'   => 200
                    ); 
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Insert Proper File',
                    'status'   => 200
                ); 
            }

        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Insert Proper Data',
                'status'   => 200
            ); 
        }

        echo json_encode($array);
    }

    //Assign Student
    public function csv_assign_student()
    {
        $data = $this->request->getPost();
        $id = $this->session->get('user')['id'];

        if(isset($_FILES['multi_data_file']))
        {
            $output = ''; 
            $allowed_ext = array("csv");  
            $file_name = explode(".", $_FILES["multi_data_file"]["name"]);
            $extension = end($file_name); 

            if(in_array($extension, $allowed_ext))
            {
                $file_data = fopen($_FILES["multi_data_file"]["tmp_name"], 'r');  
                $insert_data = [];        

                while($row = fgetcsv($file_data))
                {
                    $row = array_map("utf8_encode", $row);
                    if( ($row[0] != "" || $row[0] != null) &&
                        ($row[1] != "" || $row[1] != null)
                    )
                    {
                        if($row[0] != 'Sr No.')
                        {
                            $array = array(
                                'sr_no'         => $row[0],
                                'student_email' => $row[1],
                            );
                            array_push($insert_data, $array);
                        }
                    }
                }
                $result =  $this->HTMLtoCSV_Model->csv_assign_student($insert_data, $data['another_batch'], $data['unique_id'], $id);

                if($result)
                {                    
                    $array = array(
                        'Response'     => 'OK',
                        'data'         => $result['i'],
                        'not_inserted' => $result['not_inserted'],
                        'status'       => 200,
                    );  
                    
                }
                else
                {
                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'Batch is not Available',
                        'status'   => 200
                    ); 
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Insert Proper File',
                    'status'   => 200
                ); 
            }

        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Insert Proper Data',
                'status'   => 200
            ); 
        }

        echo json_encode($array);
    }

    //Download Topic Template
    public function download_topic_template(){
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename=topic_Template.csv');

        $fp = fopen("php://output", "w");

        $array = ['Sr No','Topic Name','Sub Topic','Chapter	Topic','Image Link','Topic Docs Link','Video Link','Lab Video Link','Topic Description'];
        fputcsv($fp, $array);

        fclose($fp);
        exit;
    }

    public function add_mtopic()
    {
        $data = $this->request->getPost();
        
        if(($data['add_mtopic_token'] == $this->session->get('add_mtopic_token')) && $data['add_mtopic_token'] != NULL)
        {
            if(isset($_FILES['mtopic_file']))
            {
                $output = '';  
                $allowed_ext = array("csv");  
                $file_name = explode(".", $_FILES["mtopic_file"]["name"]);
                $extension = end($file_name); 

                if(in_array($extension, $allowed_ext))
                {
                    $file_data = fopen($_FILES["mtopic_file"]["tmp_name"], 'r');  
                    $insert_data = [];

                    $not_insert_data= [['Sr. No.', 'Topic Name', 'Topic Image', 'Topic Docs Link', 'Video Link', 'Error']];

                    while($row = fgetcsv($file_data))
                    {
                        $row = array_map("utf8_encode", $row);
                        
                        if($row[1] !='Topic Name')
                        {
                            if($row[1] !='' && $row[1] != NULL)
                            {
                                if(($row[6] != '' && $row[6] != NULL) || ($row[5] != '' && $row[5] != NULL))
                                {
                                    $rand = mt_rand(10000,99999);
                                    $array = array(
                                        'unique_id'         => date("YmdHis").$rand,
                                        'course_id'         => $data['course_id'],
                                        'topic_name'        => $row[1],
                                        'sub_topic'         => $row[2],
                                        'chapter'           => $row[3],
                                        'topic_image'       => $row[4],
                                        'topic_docs'        => $row[5],
                                        'video_links'       => $row[6],
                                        'lab_video_links'   => $row[7],
                                        'topic_description' => $row[8],
                                        'topic_visibility'  => 1,
                                        'added_by'          => $this->session->get('user')['id'],
                                        'updated_by'        => $this->session->get('user')['id'],
                                        'is_del'            => 0
                                    );
                                    array_push($insert_data,$array);
                                }
                                else
                                {
                                    $error = [$row[0], $row[1], $row[4], $row[5], $row[6], 'Either Document Link or Video Link is Must'];
                                    array_push($not_insert_data, $error);
                                }
                            }
                            else
                            {
                                $error = [$row[0], $row[1], $row[4], $row[5], $row[6], 'Topic Name Cannot Be Blank'];
                                array_push($not_insert_data, $error);
                            }
                        }
                    }

                    if(count($insert_data) > 0)
                    {
                        $result = $this->HTMLtoCSV_Model->add_mtopic($insert_data);
                    }

                    if($result)
                    {
                        $array = array(
                            'Response'    => 'OK',
                            'data'        => $result,
                            'not_insert'  => $not_insert_data,
                            'status'      => 200
                        );
                    }
                    else
                    {
                        $array = array(
                            'Response'   => 'OK',
                            'data'       => 'Error Occured',
                            'not_insert' => $not_insert_data,
                            'status'     => 200
                        );
                    }
                }
                else
                {

                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'CSV Error!',
                        'status'   => 500
                    );
                }
            }
            else
            {
                
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'No file is selected!',
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

    public function download_lab_template()
    {
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=Multiple_Lab_Instance_Template.csv');

        $file = fopen('php://output','w');
        $header = array("Sr No.", "Lab Name", "Lab IP", "username", "password", "Student Email", "Description");
        
        fputcsv($file,$header);
        fclose($file);
        
        exit;
    }

    public function add_mlab_instance()
    {
        $data = $this->request->getPost();

        if(isset($_FILES['mlab_file']))
        {
            $output = ''; 
            $allowed_ext = array("csv");  
            $file_name = explode(".", $_FILES["mlab_file"]["name"]);
            $extension = end($file_name); 

            if(in_array($extension, $allowed_ext))
            {
                $file_data = fopen($_FILES["mlab_file"]["tmp_name"], 'r');  
                $insert_data = [];        
                $not_insert_data = [['Sr. No.','Lab IP','Email','Error']];

                while($row = fgetcsv($file_data))
                {
                    $row = array_map("utf8_encode", $row);

                    if($row[0]!='Sr No.')
                    {
                        if($row[0]!='' && $row[1]!='' && $row[2]!='')
                        {
                            $lab = array(
                                'sr_no'           => $row[0],
                                'email'           => $row[5],
                                'reg_id'          => $this->session->get('user')['reg_id'],
                                'lab_name'        => $row[1],
                                'lab_ip'          => $row[2],
                                'lab_username'    => $row[3],
                                'lab_password'    => $row[4],
                                'lab_description' => $row[6],
                                'is_del'          => 0
                            );
                            array_push($insert_data, $lab);
                        }
                        else
                        {
                            $error = array($row[0], $row[2], $row[5], 'Invalid Data');
                            array_push($not_insert_data, $error);
                        }
                    }
                }
                $result = $this->HTMLtoCSV_Model->add_lab_instance($insert_data, $data['batch_id']);

                if($result[0] > 0)
                {
                    foreach($result[1] as $dat)
                    {
                        array_push($not_insert_data, $dat);
                    }

                    $array = array(
                        'Response'   => 'OK',
                        'data'       => 'TRUE',
                        'inserted'   => $result[0],
                        'not_insert' => $not_insert_data,
                        'status'     => 200
                    );
                }
                else
                {
                    foreach($result[1] as $dat)
                    {
                        array_push($not_insert_data,$dat);
                    }
                    $array = array(
                        'Response' => 'OK',
                        'data'     => 'Not Inserted any data from csv!',
                        'not_insert' => $not_insert_data,
                        'status'   => 200
                    );
                }
            }
            else
            {
                $array = array(
                    'Response' => 'OK',
                    'data'     => 'Insert Proper Data',
                    'status'   => 200
                ); 
            }
        }
        else
        {
            $array = array(
                'Response' => 'OK',
                'data'     => 'Insert Proper Data',
                'status'   => 200
            ); 
        }
        echo json_encode($array);
    }
}
?>