<?php

    //About us
    function aboutus_getdata()
    {
        $url = base_url().'/Easylearn/Settings_Controller/aboutus_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Testimonials
    function testimonials_getdata()
    {
        $url = base_url().'/Easylearn/Settings_Controller/testimonials_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Project Documents
    function project_documents_getdata()
    {
        $url = base_url().'/Easylearn/Settings_Controller/project_documents_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Product Features
    function product_features_getdata()
    {
        $url = base_url().'/Easylearn/Settings_Controller/product_features_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //ISF Services
    function isf_services_getdata()
    {
        $url = base_url().'/Easylearn/Settings_Controller/isf_services_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Team
    function team_getdata()
    {
        $url = base_url().'/Easylearn/Settings_Controller/team_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Customer Benefits
    function customer_benefits_getdata()
    {
        $url = base_url().'/Easylearn/Settings_Controller/customer_benefits_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Security by name
    function get_security_name($name = NULL)
    {
        $url = base_url().'/Easylearn/Configuration_Controller/get_security_name';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('name' => $name))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get All Setting Category
    function get_settings_category()
    {
        $url = base_url().'/Easylearn/Configuration_Controller/get_settings_category';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array())
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get All Setting Name
    function get_settings_name($name = NULL)
    {
        $url = base_url().'/Easylearn/Settings_Controller/get_settings_name';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('name' => $name))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Profile by id
    function profile_by_id($id = NULL)
    {
        $url = base_url().'/Easylearn/Dashboard_Controller/profile_by_id';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Documents
    function getdocuments($id = null)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/getdocuments';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id'=>$id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Training Matrial
    function get_training_material()
    {
        $url = base_url().'/Easylearn/Classroom_Controller/get_training_material';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array())
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Student
    function student_detail_by_uniqueid($id=null){
        $url = base_url().'/Easylearn/Classroom_Controller/student_by_id';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Classroom Status
    function get_classroom_status($id = NULL)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/get_classroom_status';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Course Status
    function get_course_status($id = NULL)
    {
        $url = base_url().'/Easylearn/Course_Controller/get_course_status';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Course Name
    function get_course_name()
    {
        $url = base_url().'/Easylearn/Course_Controller/get_course_name';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array())
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Topic Status
    function get_topic_status($id = NULL)
    {
        $url = base_url().'/Easylearn/Course_Controller/get_topic_status';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Topic Status
    function get_classroom($permissions = NULL, $reg_id = NULL)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/get_classroom';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('permissions' => $permissions, 'reg_id' => $reg_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Batch Status
    function get_batch_status($id = NULL)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/get_batch_status';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Batch
    function get_batches($permissions = NULL, $reg_id = NULL, $classroom_id = NULL)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/get_batches';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('permissions' => $permissions,'reg_id' => $reg_id,'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Course Details get data
    function course_details_getdata($permissions = NULL, $reg_id = NULL, $id = NULL,$classroom_id=NULL)
    {
        $url = base_url().'/Easylearn/Course_Controller/course_details_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('permissions' => $permissions, 'reg_id' => $reg_id, 'id' => $id,'classroom_id'=>$classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    // Get Lecturer
    function get_lecturer_name($permissions = NULL, $reg_id = NULL)
    {
        $url = base_url().'/Easylearn/Dashboard_Controller/get_lecturer_name';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('permissions' => $permissions, 'reg_id' => $reg_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Student
    function get_student($permissions = null, $reg_id = null, $classroom_id = null){
        $url = base_url().'/Easylearn/Classroom_Controller/get_student';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('permissions'=> $permissions,'reg_id' => $reg_id, 'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Enrolled Courses
    function enrolledcourse_details_getdata($id = NULL, $classroom_id = NULL)
    {
        $url = base_url().'/Easylearn/Course_Controller/enrolledcourse_details_getdata';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Topic Name
    function get_topic_name($id = NULL, $account_id = NULL, $classroom_id = NULL)
    {
        $url = base_url().'/Easylearn/Course_Controller/get_topic_name';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'account_id' => $account_id, 'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Topic Name Class
    function get_topic_name_class($id = NULL, $account_id = NULL, $classroom_id = NULL)
    {
        $url = base_url().'/Easylearn/Course_Controller/get_topic_name_class';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'account_id' => $account_id, 'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get lab student
    function get_labs_student($id = NULL, $classroom_id = NULL)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/get_labs_student';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }


    function student_availability($reg_id = NULL)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/student_availability';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('reg_id' => $reg_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function exam_detail_id($id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/exam_detail_id';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function mcq_exam_question($id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/mcq_exam_question';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function sent_exam_question($id){

        $url = base_url().'/Easylearn/Exam_Controller/sent_exam_question';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id'=>$id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;

    }

    //Exam Detail By Id
    function exam_detail_id_student($id = NULL, $permissions = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/exam_detail_id_student';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'permissions' => $permissions))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function sentence_exam_overview_student($id = NULL, $exam_id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/sentence_exam_overview_student';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'exam_id' => $exam_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function sentence_exam_question_answer($id = NULL, $exam_id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/sentence_exam_question_answer';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'exam_id' => $exam_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function exam_overview_student($id = NULL, $exam_id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/exam_overview_student';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'exam_id' => $exam_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function mcq_exam_question_answer($id = NULL, $exam_id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/mcq_exam_question_answer';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'exam_id' => $exam_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function check_exam_status($acc_id = NULL,$exam_id = null)
    {
        $url = base_url().'/Easylearn/Exam_Controller/check_exam_status';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $acc_id,'exam_id' => $exam_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function exam_question_student($id = NULL, $exam_id = NULL,$classroom_id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/exam_question_student';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'exam_id' => $exam_id,'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    function exam_sentence_question_student($id = NULL, $exam_id = NULL,$classroom_id = NULL)
    {
        $url = base_url().'/Easylearn/Exam_Controller/exam_sentence_question_student';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id, 'exam_id' => $exam_id, 'classroom_id' => $classroom_id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }

    //Get Mentor Status
    function get_mentor_status($id = NULL)
    {
        $url = base_url().'/Easylearn/Classroom_Controller/get_mentor_status';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(array('id' => $id))
            )
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($url, false, $context);
        
        return $result;
    }


?>