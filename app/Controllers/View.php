<?php

namespace App\Controllers;

class View extends BaseController
{
    public function page($page = 'home')
    {
        if($this->session->has('logged_in'))
        {
            if($page == '')
            {
                $page = 'dashboard';
            }

            if($this->session->get('user')['status'] == 'Document Upload')
            {
                $access=['docupload'];
                $page = 'docupload';
            }

            if($this->session->get('user')['status']== 'Verified')
            {
                $all_access = ['dashboard', 'profile', 'whiteboard', 'internalwhiteboard', 'internalwhiteboard1', 'Notebook', 'Mathstool', 'Physicstool', 'Chemistrytool', 'text_speech', 'manage_document', 'videoconference'];

                if($this->session->get('user')['mfa_status'] == 0)
                {
                    $access=['mfa'];
                    $page = 'mfa';
                }
                else
                {
                    if($this->session->get('user')['permissions'] == 'Super admin')
                    {
                        $current_access = ['manageadmin', 'manageconfigurations', 'managesettings', 'managesecurity', 'managesliders', 'manageaboutus', 'managefeatures', 'managebenefits', 'manageservices', 'manageteam', 'managenewsfeed', 'managetestimonials', 'managedocuments'];
                    }
                    
                    if($this->session->get('user')['permissions'] == 'Admin')
                    {
                        $current_access = ['schoolrequests','jrcollegerequests', 'mentorRequests'];
                    }

                    if($this->session->get('user')['permissions'] == 'School' || $this->session->get('user')['permissions'] == 'Jr College')
                    {
                        $current_access = ['manage_training_material', 'manageClassroom', 'manageStudents', 'addStudents', 'studentView', 'assignClassroom', 'manageCourses', 'view_course', 'view_topic', 'add_topic', 'view_topic_by_id', 'assignClassroomcourse', 
                            'manageBatch','managenews','manageannouncements', 'assignBatch','feeStructure','addfeestructure', 'assignCourse','manageExam','manageHostel', 'manageLectures', 'manageAttendance', 'schedule_attendance', 'managelabinstance','assignHostelStudent'];
                    }
                    
                    if($this->session->get('user')['permissions'] == 'Classroom')
                    {
                        $current_access = ['manageStudents','studentView','addStudents','manageBatch','assignBatch','manageCourses','view_course','view_topic','add_topic','view_topic_by_id','manageExam'];
                    }

                    if($this->session->get('user')['permissions'] == 'Student')
                    {
                        $current_access = ['course_content', 'lectures'];
                    }

                    if($this->session->get('user')['permissions'] == 'Mentor')
                    {
                        $current_access = [];
                    }
                }

                $access = array_merge($all_access, $current_access);
            }
        }
        else
        {
            if($page == '')
            {
                $page = 'home';
            }

            $access = ['home','login','signup'];
        }

        if(in_array($page,$access))
        {
            return view('Easylearn/'.$page);
        }
        else
        {
            return view('errors/html/error_404');
        }
    }
}