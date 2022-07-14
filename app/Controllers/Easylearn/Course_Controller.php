<?php

namespace App\Controllers\Easylearn;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\Aws_Library as Aws_Library;
use App\Models\Easylearn\Course_Model as Course_Model;

class Course_Controller extends ResourceController
{
    public function __construct()
    {
        $this->request     = \Config\Services::request();
        $this->session     = \Config\Services::session();
        $this->email       = \Config\Services::email();

        $this->Aws_Library = new Aws_Library();
        $this->Course_Model = new Course_Model();
    }

    //Add Course
    public function add_course()
    {
        $data = $this->request->getPost();
        $permissions=$this->session->get('user')['permissions'];

        if(($data['add_course_token'] == $this->session->get('add_course_token')) && $data['add_course_token'] != NULL)
        {
            $course = array(
                'unique_id'               => date('YmdHis'),
                'reg_id'                  => $this->session->get('user')['reg_id'],
                'course_name'             => $data['course_name'],
                'course_image'            => $this->Aws_Library->aws_store($_FILES['course_img']),
                'course_description'      => $data['course_sm_descp'],
                'course_visibility'       => $data['course_visibility'],
                'course_full_description' => $data['course_descp'],
                'language'                => $data['course_lang'],
                'certificate'             => $data['course_certificate'],
                'added_by'                => $this->session->get('user')['id'],
                'updated_by'              => $this->session->get('user')['id'],
                'is_del'                  => 0
            );

            if($permissions == 'School' || $permissions == 'Jr College')
            {
                $result = $this->Course_Model->add_course($course);
            }
            elseif ($permissions == 'Classroom') 
            {
                $result = $this->Course_Model->add_course_by_classroom($course,$this->session->get('classroom_id'),$this->session->get('user')['id']);
            }

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
        else{
            $array = array(
                'Response' => 'OK',
                'data'     => 'Cross Site Request Blocked',
                'status'   => 500
            );

            echo json_encode($array);
        }
    }

    //Get All Course List
    public function course_details_getdata()
    {
        if(isset($_POST['permissions']))
        {
            $permissions  = $_POST['permissions'];
            $reg_id       = $_POST['reg_id'];
            $id           = $_POST['id'];
            $classroom_id = $_POST['classroom_id'];
        }
        else
        {
            $permissions  = $this->session->get('user')['permissions'];
            $reg_id       = $this->session->get('user')['reg_id'];
            $id           = $this->session->get('user')['id'];
            $classroom_id = $this->session->get('classroom_id');
        }

        if($reg_id == 0 && $permissions == ['Admin'])
        {
            $data = $this->Course_Model->course_details_getdata();
        }
        elseif($permissions == ['Student'])
        {
            $data = $this->Course_Model->course_details_getdata_student($id);
        }
        elseif ($permissions == 'School' || $permissions == 'Jr College') 
        {
           $data = $this->Course_Model->course_details_getdata_reg($reg_id);
        }
        elseif($permissions == 'Classroom')
        {
            $data = $this->Course_Model->course_details_getdata_reg_classroom($classroom_id);
        }

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
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

    //Get Classroom Course
    public function get_classroom_course()
    {
        $classroom_id = $this->request->getPost();
        $data = $this->Course_Model->course_details_getdata_reg_classroom($classroom_id['id']);
        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
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


    //update_course_visible
    public function update_course_visible()
    {
        $data = $this->request->getPost();
        $id = $data['unique_id'];
        $course_visibility = $data['course_visibility'];

        $result = $this->Course_Model->update_course_visible($id, $course_visibility);

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

    //Get Course Detail by ID
    public function get_course_details_by_id()
    {
        $data = $this->request->getPost();
        $result = $this->Course_Model->get_course_details_by_id($data['unique_id']);
        
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
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Edit Course
    public function edit_course()
    {
        $data = $this->request->getPost();

        if(($data['edit_course_token'] == $this->session->get('edit_course_token')) && $data['edit_course_token'] != NULL)
        {
            
            $course = array(
                'course_name'             => $data['course_name'],
                'course_description'      => $data['course_sm_descp'],
                'course_visibility'       => $data['course_visibility'],
                'course_full_description' => $data['course_descp'],
                'language'                => $data['course_lang'],
                'certificate'             => $data['course_certificate'],
                'updated_by'              => $this->session->get('user')['id'],
                'course_visibility'       => $data['course_visibility'],
            );

            if(isset($_FILES['course_img']))
            {
                $course['course_image'] = $this->Aws_Library->aws_store($_FILES['course_img']);
            }

            $result = $this->Course_Model->edit_course($course,$data['uniqid']);

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
                'data'     => 'Cross Site Request Blocked',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Delete Course
    public function delete_course()
    {
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );
        $result = $this->Course_Model->delete_course($_POST['unique_id'],$array);

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

    //Get Course Status
    public function get_course_status()
    {
        $result = $this->Course_Model->get_course_status($_POST['id']);

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

    //Get Topic List
    public function gettopiclist(){
        $unique_id = $_POST['unique_id'];

        $data = $this->Course_Model->gettopiclist($unique_id);

        if($data)
        {
            $array = array(
                'Response' => 'OK',
                'data'     => $data,
                'status'   => 200,
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

    //Get Course Name
    public function get_course_name(){

        $result = $this->Course_Model->get_course_name();

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
                'data'     => 'No data',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Add Topic
    public function add_topic()
    {
        $data = $this->request->getPost();
        $topic_doc='';
        $topic_img='';

        if(isset($_FILES['topic_doc']))
        {
            $topic_doc = $this->Aws_Library->aws_store($_FILES['topic_doc']);
        }

        if(isset($_FILES['topic_img']))
        {
            $topic_img = $this->Aws_Library->aws_store($_FILES['topic_img']);
        }

        $topic = array(
            'unique_id'         => date('Ymdhis'),
            'course_id'         => $data['course_id'],
            'topic_name'        => $data['topic_nm'],
            'sub_topic'         => $data['sub_topic'],
            'chapter'           => $data['chap_nm'],
            'topic_image'       => $topic_img,
            'topic_docs'        => $topic_doc,
            'video_links'       => $data['vid_link'],
            'lab_video_links'   => $data['vid_lab_link'],
            'topic_description' => $data['topic_descp'],
            'topic_visibility'  => 1,
            'added_by'          => $this->session->get('user')['id'],
            'updated_by'        => $this->session->get('user')['id'],
            'is_del'            => 0,
        );

        $result = $this->Course_Model->add_topic($topic);

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

    //Get Topic by ID
    public function view_topic_by_id()
    {
        $data = $this->request->getPost();
        $id= $data['unique_id'];
        $result = $this->Course_Model->view_topic_by_id($id);

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

    public function edit_topic()
    {
        $data = $this->request->getPost();
        if(($data['edit_topic_token'] == $this->session->get('edit_topic_token')) && $data['edit_topic_token'] != NULL)
        {
            $topic = array(
                'topic_name'        => $data['topic_nm'],
                'sub_topic'         => $data['sub_topic'],
                'chapter'           => $data['chap_nm'],
                'video_links'       => $data['vid_link'],
                'lab_video_links'   => $data['vid_lab_link'],
                'topic_description' => $data['topic_descp'],
                'updated_by'        => $this->session->get('user')['id'],
            );

            if(isset($_FILES['topic_doc']))
            {
                $topic['topic_docs'] = $this->Aws_Library->aws_store($_FILES['topic_doc']);
            }

            if(isset($_FILES['topic_img']))
            {
                $topic['topic_image'] = $this->Aws_Library->aws_store($_FILES['topic_img']);
            }

            $result = $this->Course_Model->edit_topic($topic, $data['unique_id']);

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
                'data'     => 'Cross Site Request Blocked',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Delete Topic
    public function delete_topic()
    {
        $array = array(
            'is_del' => 1,
            'updated_by' => $this->session->get('user')['id']
        );
        $result = $this->Course_Model->delete_topic($_POST['unique_id'],$array);

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

    //Get Topic Status
    public function get_topic_status()
    {
        $result = $this->Course_Model->get_topic_status($_POST['id']);

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

    //Enrolled courses
    public function enrolledcourse_details_getdata()
    {
        $id           = $_POST['id'];
        $classroom_id = $_POST['classroom_id'];
        $result = $this->Course_Model->enrolledcourse_details_getdata($id, $classroom_id);

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
                'data'     => 'No Data Found',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //Get Topic Name
    public function get_topic_name()
    {
        $id           = $_POST['id'];
        $account_id   = $_POST['account_id'];
        $classroom_id = $_POST['classroom_id'];

        $result = $this->Course_Model->get_topic_name($id, $account_id, $classroom_id);

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

    //Get Topic Name Class
    public function get_topic_name_class()
    {
        $id         = $_POST['id'];
        $account_id = $_POST['account_id'];
        $classroom_id = $_POST['classroom_id'];

        $result = $this->Course_Model->get_topic_name($id, $account_id, $classroom_id);

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

    //Get Topic by ID
    public function get_topic_by_id()
    {
        $data = $this->request->getPost();
        $id= $data['unique_id'];

        if($this->session->get('user')['permissions'] == 'Student')
        {
            $result = $this->Course_Model->get_topic_by_id_student($id);
        }
        else
        {
            $result = $this->Course_Model->get_topic_by_id($id);
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //get Previous Topic
    public function get_prev_topic_by_id()
    {
        $data = $this->request->getPost();
        $id= $data['id'];
        $unique_id = $data['unique_id'];

        if($this->session->get('user')['permissions'] == 'Student')
        {
            $result = $this->Course_Model->get_prev_topic_by_id_student($id, $unique_id);
        }
        else
        {
            $result = $this->Course_Model->get_prev_topic_by_id($id, $unique_id);
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }

        echo json_encode($array);
    }

    //get Next Topic
    public function get_next_topic_by_id()
    {
        $data = $this->request->getPost();
        $id= $data['id'];
        $unique_id = $data['unique_id'];

        if($this->session->get('user')['permissions'] == 2 && $this->session->get('user')['type'] == 2)
        {
            $result = $this->Course_Model->get_next_topic_by_id_student($id, $unique_id);
        }
        else
        {
            $result = $this->Course_Model->get_next_topic_by_id($id, $unique_id);
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
                'data'     => 'FALSE',
                'status'   => 500
            );
        }
        echo json_encode($array);
    }

    //Record Topics Completed
    public function record_topics_completed()
    {
        $id        = $this->session->get('user')['id'];
        $unique_id = $_POST['unique_id'];
        $topic_id  = $_POST['topic_id'];

        if($topic_id == 0)
        {
            $result = 1;
        }
        else
        {
            $result = $this->Course_Model->record_topics_completed($id, $unique_id, $topic_id);
        }
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

    //Record Hours Spent
    public function record_hours_spent()
    {
        $id        = $this->session->get('user')['id'];
        $unique_id = $_POST['unique_id'];
        $topic_id  = $_POST['topic_id'];

        if($topic_id == 0)
        {
            $result = 1;
        }
        else
        {
            $result = $this->Course_Model->record_hours_spent($id, $unique_id, $topic_id);
        }
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
}