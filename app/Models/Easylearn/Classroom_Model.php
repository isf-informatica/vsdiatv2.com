<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Classroom_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    //Get Documents
    public function getdocuments($id = NULL)
    {
        $builder = $this->db->table('el_documents');
        $builder->select('id,doc_name,documents,DATE_FORMAT(added_on, "%d-%m-%Y") as added_on');
        $builder->where('account_id',$id);
        $builder->where('is_del',0);
        $builder->orderBy("id", "DESC");
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array) $query->getResult();
            return $data;  
        }
        else
        {
            return FALSE;
        }
    }

    //Add Document
    public function add_doc($doc = NULL)
    {
        $builder = $this->db->table('el_documents');
        $query = $builder->insert($doc);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Document
    public function del_doc($id = NULL)
    {
        $builder = $this->db->table('el_documents');
        $builder->where('id', $id);
        $query = $builder->update(array('is_del'=> 1 ));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Traing Material
    public function get_training_material()
    {

        $builder = $this->db->table('el_training_material');
        $builder->select('training_id, document_name, training_image, training_material, training_description');
        $builder->where('is_del',0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Add Training Material
    public function add_tm($tm = NULL)
    {
        $builder = $this->db->table('el_training_material');
        $query = $builder->insert($tm);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //get Training Material
    public function get_tm_id($id = NULL)
    {
        $builder = $this->db->table('el_training_material');
        $builder->select('training_id,document_name,training_description');
        $builder->where('training_id',$id);
        $builder->where('is_del',0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array) $query->getRow();
            return $data;    
        }
        else
        {
            return FALSE;
        }
    }

    //Edit Training Material
    public function edit_tm($tm = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_training_material');
        $builder->where('training_id',$id);
        $query = $builder->update($tm);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Training Material
    public function del_tm($id = NULL)
    {
        $builder = $this->db->table('el_training_material');
        $builder->where('training_id',$id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function Add_Classroom($ClassroomData = NULL,$id=NULL,$reg_id=NULL)
    {
        //Checking Account Table for the email exists or not
        $builder = $this->db->table('el_accounts');
        $builder->select('id','email');
        $builder->where('email', $ClassroomData['administrator_email']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return FALSE;
        }
        else
        {
            //Add in accounts table
            $data = array(
                'unique_id'     =>  date("YmdHis"),
                'reg_id'        =>  $reg_id,
                'username'      =>  $ClassroomData['classroom_name'],
                'email'         =>  $ClassroomData['administrator_email'],
                'pass'          =>  password_hash($ClassroomData['administrator_password'], PASSWORD_BCRYPT),
                'permissions'   =>  'Classroom',
                'status'        =>  'Verified',
                'added_by'      =>  $id,
                'updated_by'    =>  $id,
                'is_del'        =>  0,
            );

            $builder1 = $this->db->table('el_accounts');
            $dataInserted = $builder1->insert($data);
            $CurrentClassroomID = $this->db->insertID();

            //Add in Student Table
            $Classroomdata = array(
                'unique_id'                 => date("YmdHis"),
                'account_id'                => $CurrentClassroomID,
                'reg_id'                    => $reg_id,
                'classroom_name'            => $ClassroomData['classroom_name'],
                'classroom_image'           => $ClassroomData['classroom_image'],
                'phone_number'              => $ClassroomData['classroom_phone'],
                'administration_name'       => $ClassroomData['administrator_name'],
                'administration_email'      => $ClassroomData['administrator_email'],
                'classroom_description'     => $ClassroomData['classroom_descp'],
                'added_by'                  => $id,
                'updated_by'                => $id,
                'is_del'                    => 0
            );

            $classroombuilder = $this->db->table('el_classroom');
            $ClassroomInserted = $classroombuilder->insert($Classroomdata);

            //Add student in accounts details table
            $Classroom_Acc_Details = array(
                'account_id'     => $CurrentClassroomID,
                'contact_number' => $ClassroomData['classroom_phone'],
                'description'    => $ClassroomData['classroom_descp'],
                'profile_image'  => $ClassroomData['classroom_image'],
                'layout_pref'    => 'Menu',
                'language_pref'  => 'English',
                'added_by'       => $id,
                'updated_by'     => 0,
                'is_del'         => 0
            );
            $Classroom_ac_builder = $this->db->table('el_account_details');
            $Classroom_ac_inserted = $Classroom_ac_builder->insert($Classroom_Acc_Details);

            if($dataInserted && $ClassroomInserted && $Classroom_ac_inserted){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
    }
         
    //Add Single Student
    public function Add_Single_Student($SingleStudentData = NULL, $image = NULL, $reg_id = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('id','email');
        $builder->where('email', $SingleStudentData['studentEmailID']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() == 0)
        {

            //Add in accounts table
            $data = array(
                'unique_id'   => date("YmdHis"),
                'reg_id'      => $reg_id,
                'username'    => $SingleStudentData['studentName'],
                'email'       => $SingleStudentData['studentEmailID'],
                'pass'        => password_hash("vsdiat", PASSWORD_BCRYPT),
                'permissions' => 'Student',
                'status'      => 'Verified',
                'mfa_status'  => 0,
                'added_by'    => $id,
                'updated_by'  => $id,
                'is_del'      => 0,
            );

            $builder1 = $this->db->table('el_accounts');
            $dataInserted = $builder1->insert($data);
            $CurrentStudentID = $this->db->insertID();

            //Add in Student Table
            $Studentdata = array(
                'unique_id'           => date("YmdHis"),
                'account_id'          => $CurrentStudentID,
                'parent_id'           => 0,
                'student_name'        => $SingleStudentData['studentName'],
                'student_emailid'     => $SingleStudentData['studentEmailID'],
                'added_by'            => $id,
                'updated_by'          => $id,
                'is_del'              => 0,
            );

            $Studentbuilder = $this->db->table('el_student');
            $StudentInserted = $Studentbuilder->insert($Studentdata);

            //Add student in accounts details table
            $Student_Acc_Details = array(
                'account_id'     => $CurrentStudentID,
                'contact_number' => '',
                'description'    => $SingleStudentData['studentDescription'],
                'profile_image'  => $image,
                'layout_pref'    => 'Menu',
                'language_pref'  => 'English',
                'added_by'       => $id,
                'updated_by'     => $id,
                'is_del'         => 0
            );

            $Student_ac_builder = $this->db->table('el_account_details');
            $Student_ac_inserted = $Student_ac_builder->insert($Student_Acc_Details);

            if($dataInserted && $StudentInserted && $Student_ac_inserted)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Add Single Student Classroom
    public function Add_Single_Student_Classroom($SingleStudentData = NULL, $image = NULL, $reg_id = NULL, $id = NULL,$classroom_id=NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('id','email');
        $builder->where('email', $SingleStudentData['studentEmailID']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() == 0)
        {
            //Add in accounts table
            $data = array(
                'unique_id'   => date("YmdHis"),
                'reg_id'      => $reg_id,
                'username'    => $SingleStudentData['studentName'],
                'email'       => $SingleStudentData['studentEmailID'],
                'pass'        => password_hash("vsdiat", PASSWORD_BCRYPT),
                'permissions' => 'Student',
                'status'      => 'Verified',
                'mfa_status'  => 0,
                'added_by'    => $id,
                'updated_by'  => $id,
                'is_del'      => 0,
            );

            $builder1 = $this->db->table('el_accounts');
            $dataInserted = $builder1->insert($data);
            $CurrentStudentID = $this->db->insertID();

            //Add in Student Table
            $Studentdata = array(
                'unique_id'           => date("YmdHis"),
                'account_id'          => $CurrentStudentID,
                'student_emailid'     => $SingleStudentData['studentEmailID'],
                'student_description' => $SingleStudentData['studentDescription'],
                'added_by'            => $id,
                'updated_by'          => $id,
                'is_del'              => 0,
            );

            $Studentbuilder = $this->db->table('el_student');
            $StudentInserted = $Studentbuilder->insert($Studentdata);

            //Add student in accounts details table
            $Student_Acc_Details = array(
                'account_id'     => $CurrentStudentID,
                'contact_number' => '',
                'description'    => $SingleStudentData['studentDescription'],
                'profile_image'  => $image,
                'layout_pref'    => 'Menu',
                'language_pref'  => 'English',
                'added_by'       => $id,
                'updated_by'     => $id,
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

            if($dataInserted && $StudentInserted && $Student_ac_inserted && $assign_classroom_inserted)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Get student Reg
    public function get_student_reg($id = NULL)
    {
        $builder = $this->db->table('el_student');
        $builder->select('el_accounts.id, el_student.unique_id, student_name, student_emailid');
        $builder->join('el_accounts', 'el_accounts.id = el_student.account_id');
        $builder->where('el_accounts.reg_id', $id);
        $builder->where('el_student.is_del', 0);
        $builder->orderBy('el_student.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Classroom student
    public function get_student_reg_classroom($id = NULL)
    {
        $builder = $this->db->table('el_classroom_assignment');
        $builder->select('el_student.unique_id, student_name, student_emailid');
        $builder->join('el_student', 'el_student.account_id = el_classroom_assignment.account_id');
        $builder->where('el_classroom_assignment.classroom_id', $id);
        $builder->where('el_student.is_del', 0);
        $builder->where('el_classroom_assignment.is_del', 0);
        $builder->orderBy('el_classroom_assignment.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }
    
    //Get All Student
    public function get_student()
    {
        $builder = $this->db->table('el_student');
        $builder->select('unique_id, student_name, student_emailid');
        $builder->where('is_del', 0);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Student by id
    public function get_student_by_id($id = NULL)
    {
        $builder = $this->db->table('el_student');
        $builder->select('el_student.unique_id, el_student.student_name, el_student.student_emailid, el_student.student_description,  el_account_details.profile_image');
        $builder->join('el_account_details', 'el_account_details.account_id = el_student.account_id');
        $builder->where('el_student.unique_id', $id);
        $builder->where('el_student.is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Update Student
    // public function update_student($student_data = NULL, $unique_id = NULL)
    // {
    //     $builder = $this->db->table('el_student');
    //     $builder->where('unique_id', $unique_id);
    //     $query = $builder->update($student_data);
        
    //     if($query)
    //     {
    //         return TRUE;
    //     }
    //     else
    //     {
    //         return FALSE;
    //     }
    // }

    public function update_student($unique_id=NULL,$student_data=NULL,$account_student=NULL,$account_parent=NULL,$student_details=NULL,$parent_details=NULL)
    {

        $builder = $this->db->table('el_student');
        $builder->select('account_id,parent_emailid');
        $builder->where('unique_id', $unique_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            $account_id = $rowData['account_id'];
            $parent_email=$rowData['parent_emailid'];
            $builder = $this->db->table('el_student');
            $builder->where('unique_id', $unique_id);
            $query1 = $builder->update($student_data);
            if($query1)
            {
                $builder = $this->db->table('el_account_details');
                $builder->where('account_id', $account_id);
                $builder->where('is_del', 0);
                $query2 = $builder->update($student_details);
                if($query2){
                    $builder = $this->db->table('el_accounts');
                    $builder->where('id', $account_id);
                    $builder->where('is_del', 0);
                    $query3 = $builder->update($account_student);
                    if($query3){
                        $builder = $this->db->table('el_accounts');
                        $builder->select('id');
                        $builder->where('email', $parent_email);
                        $builder->where('is_del', 0);
                        $query4 = $builder->get();
                        if($query4->getNumRows()>0)
                        {
                            $parentData = (array)$query4->getRow();
                            $parent_id = $parentData['id'];
                            $builder = $this->db->table('el_accounts');
                            $builder->where('id', $parent_id);
                            $builder->where('is_del', 0);
                            $query5 = $builder->update($account_parent);
                            if($query5)
                            {
                                $builder = $this->db->table('el_account_details');
                                $builder->where('account_id', $parent_id);
                                $builder->where('is_del', 0);
                                $query6 = $builder->update($parent_details);
                                if($query6)
                                {
                                    return TRUE;
                                }
                                else{
                                    return FALSE;
                                }
                            }
                            else{
                                return FALSE;
                            }
                        }
                        else{
                            return FALSE;
                        }   
                    }
                    else{
                        return FALSE;
                    }
                }
                else{
                    return FALSE;
                }
            }
            else 
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Student
    public function delete_student($id = NULL)
    {
        $builder = $this->db->table('el_student');
        $builder->select('account_id');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_student');
            $builder1->where('unique_id', $id);
            $query1 = $builder1->update(array('is_del' => 1));

            if($query1)
            {
                $builder2 = $this->db->table('el_accounts');
                $builder2->where('id', $data['account_id']);
                $query2 = $builder2->update(array('is_del' => 1));

                if($query2)
                {
                    $builder3 = $this->db->table('el_account_details');
                    $builder3->where('account_id', $data['account_id']);
                    $query3 = $builder3->update(array('is_del' => 1));

                    if($query3)
                    {
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //get Classroom Status
    public function get_classroom_status($id = NULL) 
    {

        $builder = $this->db->table('el_classroom');
        $builder->select('id');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All Students for Classroom
    public function get_all_students_for_classroom($reg_id = NULL) 
    {
        $builder = $this->db->table('el_accounts');
        $builder ->select('id, email, username');

        $subQuery = $this->db->table('el_classroom_assignment')->select('account_id')->where('is_del', 0);

        $builder->whereNotIn('id', $subQuery);
        $builder->where('reg_id', $reg_id);
        $builder->where('permissions', 'Student');
        $builder->where('is_del', 0);
        $builder->orderBy('el_accounts.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();

            return $data;
        }
        else{
            return FALSE;
        }
    }

    //Assign Classroom Students
    public function assign_classroom_students($data = NULL)
    {
        $i =0;

        $builder = $this->db->table('el_classroom');
        $builder->select('id');
        $builder->where('unique_id', $data['unique_id']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            
            $classroom_id = $rowData['id'];
            $assign_data  = [];

            foreach(json_decode($data['selected_id'], true) as $student_id)
            {
                $builder = $this->db->table('el_classroom_assignment');
                $builder->where('classroom_id' , $classroom_id);
                $builder->where('account_id' ,  $student_id);
                $builder->where('is_del',0);
                $query = $builder->get();

                if($query->getNumRows() == 0)
                {
                    $assign_data['account_id']   = $student_id;
                    $assign_data['classroom_id'] = $classroom_id;
                    $assign_data['added_by']     = $data['added_by'];
                    $assign_data['updated_by']   = $data['updated_by'];

                    $builder2 = $this->db->table('el_classroom_assignment');
                    $query2 = $builder2->insert($assign_data);

                    if($query2)
                    {
                        $i++;
                    }

                }
            }

            return $i;
        }
        else
        {
            return FALSE;
        }
    }

    //Assigned Students of Classroom
    public function assigned_classroom_memberlist($unique_id = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder ->select('el_classroom_assignment.id, el_classroom_assignment.account_id, email, username');
        $builder->join('el_classroom_assignment', 'el_classroom_assignment.account_id = el_accounts.id');
        $builder->join('el_classroom', 'el_classroom.id = el_classroom_assignment.classroom_id');
        $builder->where('el_classroom.unique_id', $unique_id);
        $builder->where('el_classroom_assignment.is_del', 0);
        $builder->where('el_classroom.is_del', 0);
        $builder->where('el_accounts.is_del', 0);
        $builder->orderBy('el_classroom_assignment.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Assign member classroom
    public function delete_assignmember_classroom($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_classroom_assignment');
        $builder->where('id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Classroom
    public function get_classroom($id = NULL)
    {
        $builder = $this->db->table('el_classroom');
        $builder->select('el_classroom.id, el_classroom.unique_id, classroom_name, administration_email, administration_name, classroom_description');
        $builder->where('el_classroom.is_del', 0);
        $builder->orderBy('el_classroom.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Classroom By School
    public function get_classroom_by_school($id = NULL)
    {
        $builder = $this->db->table('el_classroom');
        $builder->select('el_classroom.id, el_classroom.unique_id, classroom_name, administration_email, administration_name, classroom_description');
        $builder->join('el_accounts', 'el_accounts.id = el_classroom.account_id');
        $builder->where('el_accounts.reg_id', $id);
        $builder->where('el_accounts.is_del', 0);
        $builder->where('el_classroom.is_del', 0);
        $builder->orderBy('el_classroom.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Classroom Details
    public function get_classroom_details($id){
        $builder = $this->db->table('el_classroom');
        $builder->select('id,unique_id,classroom_name,classroom_image,administration_name,administration_email,classroom_description,phone_number');
        $builder->where('unique_id',$id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    public function edit_classroom($id=NULL,$classroom_data=NULL,$classroom_acc=NULL,$classroom_details=NULL){

        $builder = $this->db->table('el_classroom');
        $builder->select('account_id');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            $account_id = $rowData['account_id'];
            $builder = $this->db->table('el_classroom');
            $builder->where('unique_id', $id);
            $query1 = $builder->update($classroom_data);
            if($query1)
            {
                $builder = $this->db->table('el_account_details');
                $builder->where('account_id', $account_id);
                $builder->where('is_del', 0);
                $query2 = $builder->update($classroom_details);
                if($query2){
                    $builder = $this->db->table('el_accounts');
                    $builder->where('id', $account_id);
                    $builder->where('is_del', 0);
                    $query3 = $builder->update($classroom_acc);
                    if($query3){
                        return TRUE;
                    }
                    else{
                        return FALSE;
                    }
                }
                else{
                    return FALSE;
                }
            }
            else 
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }
    //Get All Courses for Classroom
    public function get_all_courses_for_classroom($unique_id = NULL, $reg_id = NULL) 
    {
        $builder = $this->db->table('el_classroom');
        $builder->select('id');
        $builder->where('unique_id', $unique_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_courses');
            $builder1->select('id, course_name');
            $subQuery = $this->db->table('el_classroom_course')->select('course_id')->where('classroom_id', $data['id'])->where('is_del', 0);
            
            $builder1->whereNotIn('id', $subQuery);
            $builder1->where('reg_id', $reg_id);
            $builder1->where('is_del', 0);
            $builder1->orderBy('id', 'DESC');
            $query1 = $builder1->get();

            if($query1->getNumRows() > 0)
            {
                $data = $query1->getResult();
                return $data;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Assign Classroom Courses
    public function assign_classroom_course($data = NULL)
    {
        $i =0;

        $builder = $this->db->table('el_classroom');
        $builder->select('id');
        $builder->where('unique_id', $data['unique_id']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            
            $classroom_id = $rowData['id'];
            $assign_data  = [];

            foreach(json_decode($data['selected_id'], true) as $course_id)
            {
                $builder = $this->db->table('el_classroom_course');
                $builder->where('classroom_id' , $classroom_id);
                $builder->where('course_id' ,  $course_id);
                $builder->where('is_del',0);
                $query = $builder->get();

                if($query->getNumRows() == 0)
                {
                    $assign_data['course_id']    = $course_id;
                    $assign_data['classroom_id'] = $classroom_id;
                    $assign_data['added_by']     = $data['added_by'];
                    $assign_data['updated_by']   = $data['updated_by'];

                    $builder2 = $this->db->table('el_classroom_course');
                    $query2 = $builder2->insert($assign_data);

                    if($query2)
                    {
                        $i++;
                    }

                }
            }

            return $i;
        }
        else
        {
            return FALSE;
        }
    }

    //Assigned Students of Classroom
    public function assigned_classroom_courselist($unique_id = NULL)
    {
        $builder = $this->db->table('el_courses');
        $builder ->select('el_classroom_course.id, el_classroom_course.course_id, course_name');
        $builder->join('el_classroom_course', 'el_classroom_course.course_id = el_courses.id');
        $builder->join('el_classroom', 'el_classroom.id = el_classroom_course.classroom_id');
        $builder->where('el_classroom.unique_id', $unique_id);
        $builder->where('el_classroom_course.is_del', 0);
        $builder->where('el_classroom.is_del', 0);
        $builder->where('el_courses.is_del', 0);
        $builder->orderBy('el_classroom_course.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Assigned Courses of Classroom
    public function delete_assigncourse_classroom($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_classroom_course');
        $builder->where('id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //delete Classroom
    public function delete_classroom($array=NULL,$data=NULL){

        $builder = $this->db->table('el_classroom');
        $builder->select('account_id');
        $builder->where('unique_id', $data['id']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            $account_id = $rowData['account_id'];
            $builder = $this->db->table('el_classroom');
            $builder->where('unique_id', $data['id']);
            $query1 = $builder->update($array);
            if($query1)
            {
                $builder = $this->db->table('el_account_details');
                $builder->where('account_id', $account_id);
                $builder->where('is_del', 0);
                $query2 = $builder->update($array);
                if($query2){
                    $builder = $this->db->table('el_accounts');
                    $builder->where('id', $account_id);
                    $builder->where('is_del', 0);
                    $query3 = $builder->update($array);
                    if($query3){
                        return TRUE;
                    }
                    else{
                        return FALSE;
                    }
                }
                else{
                    return FALSE;
                }
            }
            else 
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Add Batch
    public function add_batch($batch_data = NULL)
    {
        $builder = $this->db->table('el_batches');
        $batch_insert = $builder->insert($batch_data);

        if($batch_insert)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Batch Reg
    public function get_batches_reg($id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id, el_batches.unique_id, classroom_name, batch_name, DATE_FORMAT(start_date, "%d-%m-%Y") as start_date,DATE_FORMAT(end_date, "%d-%m-%Y") as end_date,description, visibility, batch_image');
        $builder->join('el_classroom', 'el_classroom.id = el_batches.classroom_id');
        $builder->where('el_batches.reg_id', $id);
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_classroom.is_del', 0);
        $builder->orderBy('el_batches.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Batch Classroom
    public function get_batches_classroom($id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id, el_batches.unique_id, classroom_name, batch_name, DATE_FORMAT(start_date, "%d-%m-%Y") as start_date,DATE_FORMAT(end_date, "%d-%m-%Y") as end_date,description, visibility, batch_image');
        $builder->join('el_classroom', 'el_classroom.id = el_batches.classroom_id');
        $builder->where('classroom_id', $id);
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_classroom.is_del', 0);
        $builder->orderBy('el_batches.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }
    
    //Get Batch
    public function get_batches()
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id, el_batches.unique_id, classroom_name, batch_name, DATE_FORMAT(start_date, "%d-%m-%Y") as start_date,DATE_FORMAT(end_date, "%d-%m-%Y") as end_date, description, visibility, batch_image');
        $builder->join('el_classroom', 'el_classroom.id = el_batches.classroom_id');
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_classroom.is_del', 0);
        $builder->orderBy('el_batches.id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }
    
    //Get Batch by ID
    public function get_batch_by_id($id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('unique_id, classroom_id, batch_name, DATE_FORMAT(start_date, "%d-%m-%Y") as start_date, DATE_FORMAT(end_date, "%d-%m-%Y") as end_date, batch_image, description, visibility');
        $builder->where('unique_id',$id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = $query->getRow();
            return $data;
        }
        else
        {
            return False;
        }

    }
    
    //Show Hide Batch
    public function show_hide_batch($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->where('unique_id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Edit Batch
    public function edit_batch($id = NULL, $batch_data = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->where('unique_id', $id);
        $query = $builder->update($batch_data);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return false;
        }
    }

    //Delete Batch
    public function delete_batch($array=NULL, $data=NULL){

        $builder = $this->db->table('el_batches');
        $builder->select('account_id');
        $builder->where('unique_id', $data['id']);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Batch users
    public function get_batch_users_byunique($unique_id = NULL) 
    {
        $builder = $this->db->table('el_batches');
        $builder->select('classroom_id');
        $builder->where('unique_id', $unique_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_classroom_assignment');
            $builder1->select('el_accounts.id, el_accounts.email, el_accounts.username');
            $builder1->join('el_accounts', 'el_accounts.id = el_classroom_assignment.account_id');

            $subQuery = $this->db->table('el_batch_assignment')->select('account_id')->where('is_del', 0);

            $builder1->whereNotIn('el_classroom_assignment.account_id', $subQuery);
            $builder1->where('el_classroom_assignment.classroom_id', $data['classroom_id']);
            $builder1->where('el_classroom_assignment.is_del', 0);
            $builder1->where('el_accounts.is_del', 0);
            $query1 = $builder1->get();
            
            if($query1->getNumRows() > 0)
            {
                $data1 = $query1->getResult();

                return $data1;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    public function get_allbatch_users_byunique($unique_id = NULL) 
    {
        $builder = $this->db->table('el_batches');
        $builder->select('id, classroom_id');
        $builder->where('unique_id', $unique_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_classroom_assignment');
            $builder1->select('el_accounts.id, el_accounts.email, el_accounts.username');
            $builder1->join('el_accounts', 'el_accounts.id = el_classroom_assignment.account_id');

            $subQuery = $this->db->table('el_batch_assignment')->select('account_id')->where('batch_id', $data['id'])->where('is_del', 0);

            $builder1->whereNotIn('el_classroom_assignment.account_id', $subQuery);
            $builder1->where('el_classroom_assignment.classroom_id', $data['classroom_id']);
            $builder1->where('el_classroom_assignment.is_del', 0);
            $builder1->where('el_accounts.is_del', 0);
            $query1 = $builder1->get();
            
            if($query1->getNumRows() > 0)
            {
                $data1 = $query1->getResult();

                return $data1;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //get Batch Status
    public function get_batch_status($id = NULL) 
    {
        $builder = $this->db->table('el_batches');
        $builder->select('id');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Get All News
    public function get_news($reg_id = null)
    {

        $builder = $this->db->table('el_news');
        $builder->select('id,unique_id,topic,topic_img,news,DATE_FORMAT(start_date, "%d-%m-%Y") as start_date,DATE_FORMAT(end_date, "%d-%m-%Y") as end_date');
        $builder->where('reg_id',$reg_id);
        $builder->where('is_del',0);

        $query = $builder->get();

        if($query->getNumRows()>0){

            return (array)$query->getResult();

        }else{

            return FALSE;

        }
        
    }

    //Add News
    public function add_news($news = NULL)
    {

        $builder = $this->db->table('el_news');
        $query = $builder->insert($news);

        if($query){

            return TRUE;

        }else{

            return FALSE;

        }

    }

    //get news by id
    public function get_news_id($id = NULL)
    {

        $builder = $this->db->table('el_news');
        $builder->select('id,topic,topic_img,news,DATE_FORMAT(start_date, "%d-%m-%Y") as start_date,DATE_FORMAT(end_date, "%d-%m-%Y") as end_date');
        $builder->where('id',$id);
        $query = $builder->get();

        if($query->getNumRows()>0){

            return (array)$query->getRow();

        }else{

            return FALSE;

        }
        

    }

    //delete news by id
    public function del_news($id = NULL)
    {

        $builder = $this->db->table('el_news');
        $builder->where('id',$id);
        $query = $builder->update(array('is_del'=> 1 ));

        if($query){

            return TRUE;

        }else{

            return FALSE;

        }
    }

    //Edit News By Id
    public function edit_news($news = NULL, $id = NULL)
    {
        
        $builder = $this->db->table('el_news');
        $builder->where('id',$id);
        $query = $builder->update($news);

        if($query){

            return TRUE;

        }else{

            return FALSE;

        }

    }

    //Get All Announcements
    public function get_anc($reg_id = null)
    {

        $builder = $this->db->table('el_announcements');
        $builder->select('id,unique_id,announcement_topic,announcement,DATE_FORMAT(announcement_date, "%d-%m-%Y") as announcement_date,DATE_FORMAT(announcement_time, "%h:%i %p") as announcement_time ');
        $builder->where('reg_id',$reg_id);
        $builder->where('is_del',0);
        $query = $builder->get();

        if($query->getNumRows()>0){

            return (array)$query->getResult();

        }else{

            return FALSE;

        }

    }

    //Add Announcements
    public function add_anc($anc = NULL)
    {

        $builder = $this->db->table('el_announcements');
        $query = $builder->insert($anc);
        if($query){

            return TRUE;

        }else{

            return FALSE;

        }
        
    }

    //Get Announcements By Id
    public function get_anc_id($id = NULL)
    {

        $builder = $this->db->table('el_announcements');
        $builder->select('id,announcement_topic,announcement,DATE_FORMAT(announcement_date, "%d-%m-%Y") as announcement_date,DATE_FORMAT(announcement_time, "%h:%i %p") as announcement_time ');
        $builder->where('id',$id);
        $query = $builder->get();

        if($query->getNumRows()>0){

            return (array)$query->getRow();

        }else{

            return FALSE;

        }


    }

    //Edit Announcements By Id
    public function edit_anc($anc = NULL, $id = NULL)
    {

        $builder = $this->db->table('el_announcements');
        $builder->where('id',$id);
        $query = $builder->update($anc);

        if($query){

            return TRUE;

        }else{

            return FALSE;

        }

    }

    //Delete Announcements By Id
    public function del_anc($id = NULL)
    {

        $builder = $this->db->table('el_announcements');
        $builder->where('id',$id);
        $query = $builder->update(array('is_del'=>1));

        if($query){

            return TRUE;

        }else{

            return FALSE;

        }

    }

    //Get Batch Member
    public function get_batch_member($data = NULL) 
    {

        $builder = $this->db->table('el_batches');
        $builder->select('id');
        $builder->where('unique_id', $data['unique_id']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow(); 
            $batch_id = $rowData['id'];

            $builder = $this->db->table('el_batch_assignment');
            $builder ->select('el_batch_assignment.id, el_accounts.email, el_accounts.username, el_batch_assignment.account_id');
            $builder->join('el_batches', 'el_batches.id = el_batch_assignment.batch_id');
            $builder->join('el_accounts', 'el_accounts.id = el_batch_assignment.account_id');
            $builder->where('el_batch_assignment.batch_id', $batch_id );
            $builder->where('el_batch_assignment.is_del', 0);
            $builder->where('el_accounts.is_del', 0);
            $builder->orderBy('el_batch_assignment.id', 'DESC');

            $query = $builder->get();

            if($query->getNumRows() >= 0)
            {
                $data = $query->getResult();
                return $data;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Assign Batch Students
    public function assign_batchStudents($data = NULL)
    {
        $i =0;

        $builder = $this->db->table('el_batches');
        $builder->select('id, classroom_id');
        $builder->where('unique_id', $data['unique_id']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            $batch_id = $rowData['id'];
            $classroom_id = $rowData['classroom_id'];

            $assign_data = [];

            foreach(json_decode($data['selected_id'], true) as $student_id)
            {
                $builder = $this->db->table('el_batch_assignment');
                $builder->where('batch_id', $batch_id);
                $builder->where('account_id', $student_id);
                $builder->where('is_del', 0);
                $query = $builder->get();

                if($query->getNumRows() == 0)
                {
                    $assign_data['account_id']   = $student_id;
                    $assign_data['classroom_id'] = $classroom_id;
                    $assign_data['batch_id']     = $batch_id;
                    $assign_data['added_by']     = $data['added_by'];
                    $assign_data['updated_by']   = $data['updated_by'];

                    $builder2 = $this->db->table('el_batch_assignment');
                    $query2 = $builder2->insert($assign_data);

                    if($query2)
                    {
                        $i++;
                    }

                }
            }
            return $i;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Assign Member
    public function delete_assignmember($array = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_batch_assignment');
        $builder->where('id', $id);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Add Fee Structure
    public function add_fee_structure($data)
    {

        $builder = $this->db->table('el_fee_structure');
        $query = $builder->insert($data);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Check Fee Structure
    public function  check_fee_structure($batch_id,$term)
    {

        $builder = $this->db->table('el_fee_structure');
        $builder->select('id');
        $builder->where('batch_id',$batch_id);
        $builder->where('term',$term);
        $builder->where('is_del',0);
        $query = $builder->get();

        if($query->getNumRows() > 0){

            return TRUE;

        }else{

            return FALSE;

        }

    }
    
    //Batch Course by unique ID
    public function get_batch_course_byunique($unique_id = NULL) 
    {
        $builder = $this->db->table('el_batches');
        $builder->select('id, classroom_id');
        $builder->where('unique_id', $unique_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_classroom_course');
            $builder1->select('el_courses.id, el_courses.course_name');
            $builder1->join('el_courses', 'el_courses.id = el_classroom_course.course_id');

            $subQuery = $this->db->table('el_batch_course')->select('course_id')->where('is_del', 0);

            $builder1->whereNotIn('el_classroom_course.course_id', $subQuery);
            $builder1->where('el_classroom_course.classroom_id', $data['classroom_id']);
            $builder1->where('el_classroom_course.is_del', 0);
            $builder1->where('el_courses.is_del', 0);
            $query1 = $builder1->get();
            
            if($query1->getNumRows() > 0)
            {
                $data1 = $query1->getResult();

                return $data1;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Get Batch Course
    public function get_batch_course($unique_id = NULL) 
    {
        $builder = $this->db->table('el_batches');
        $builder->select('id');
        $builder->where('unique_id', $unique_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData  = (array)$query->getRow();
            $batch_id = $rowData['id'];

            $builder  = $this->db->table('el_batch_course');
            $builder->join('el_batches', 'el_batches.id = el_batch_course.batch_id');
            $builder->join('el_courses', 'el_courses.id = el_batch_course.course_id');
            $builder->select('el_batch_course.id, el_batch_course.course_id, el_courses.course_name');
            $builder->where('el_batch_course.batch_id', $batch_id );
            $builder->where('el_batches.is_del', 0);
            $builder->where('el_batch_course.is_del', 0);
            $builder->where('el_courses.is_del', 0);
            $builder->orderBy('el_batch_course.id', 'DESC');

            $query = $builder->get();


            if($query->getNumRows() >= 0)
            {
                $data = $query->getResult();
                return $data;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //assign batch course
    public function assign_batchcourses($data=NULL)
    {
        $i =0;

        $builder = $this->db->table('el_batches');
        $builder->select('id, classroom_id');
        $builder->where('unique_id', $data['unique_id']);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            $batch_id = $rowData['id'];
            $classroom_id = $rowData['classroom_id'];
            $assign_data = [];

            foreach(json_decode($data['selected_id'], true) as $course_id)
            {
                $builder = $this->db->table('el_batch_course');
                $builder->where('batch_id'   , $batch_id);
                $builder->where('classroom_id', $classroom_id);
                $builder->where('course_id'  , $course_id);
                $builder->where('is_del'     , 0);
                $query = $builder->get();

                if($query->getNumRows() == 0)
                {
                    $assign_data['course_id']    = $course_id;
                    $assign_data['batch_id']     = $batch_id;
                    $assign_data['classroom_id'] = $classroom_id;
                    $assign_data['added_by']     = $data['added_by'];
                    $assign_data['updated_by']   = $data['updated_by'];

                    $builder2 = $this->db->table('el_batch_course');
                    $query2 = $builder2->insert($assign_data);

                    if($query2)
                    {
                        $i++;
                    }
                }
            }
            return $i;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Assign Course
    public function delete_assigncourse($array = NULL, $data = NULL)
    {
        $builder = $this->db->table('el_batch_course');
        $builder->where('id', $data['id']);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    } 

    //Get All Fee Structure
    public function get_fee_structure($reg_id)
    {

        $builder = $this->db->table('el_fee_structure');
        $builder->select('el_fee_structure.id,el_batches.batch_name,el_fee_structure.term');
        $builder->join('el_batches', 'el_batches.id = el_fee_structure.batch_id');
        $builder->where('el_batches.reg_id',$reg_id);
        $query = $builder->get();

        if($query->getNumRows() > 0){

            return (array)$query->getResult();

        }else{

            return FALSE;

        }

    }

    //Get Fee Structure By Id
    public function get_batch_fee_by_id($id)
    {

        $builder = $this->db->table('el_fee_structure');
        $builder->where('id',$id);
        $query = $builder->get();

        if($query->getNumRows() > 0){
            $data = (array)$query->getRow();
            $data['fee_details'] = json_decode($data['fee_details']);
            return $data;

        }else{

            return FALSE;

        }
    }

    //Add Schedule
    public function add_schedule($schedule = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('classroom_id');
        $builder->where('id', $schedule['batch_id']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            $schedule['classroom_id'] = $data['classroom_id'];

            $builder1 = $this->db->table('el_schedule');
            $result1 = $builder1->insert($schedule);
    
            if($result1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }

        }
    }

    //Load Schedule
    public function load_schedule(){

        $builder = $this->db->table('el_schedule');
        $builder->select('el_schedule.id,title,lecturer_id,el_schedule.start_date,start_time,end_time,class_name,meet_url');
        $builder->join('el_batches', 'el_batches.id = el_schedule.batch_id');
        $builder->where('el_schedule.is_del', 0);
        $builder->where('el_batches.is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }
    
    public function load_schedule_reg($reg_id = NULL)
    {
        $builder = $this->db->table('el_schedule');
        $builder->select('el_schedule.id,title,lecturer_id,el_schedule.start_date,start_time,end_time,class_name,meet_url');
        $builder->join('el_batches', 'el_batches.id = el_schedule.batch_id');
        $builder->where('el_schedule.reg_id', $reg_id);
        $builder->where('el_schedule.is_del', 0);
        $builder->where('el_batches.is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    public function load_schedule_classroom($classroom_id = NULL)
    {
        $builder = $this->db->table('el_schedule');
        $builder->select('el_schedule.id,title,lecturer_id,el_schedule.start_date,start_time,end_time,class_name,meet_url');
        $builder->join('el_batches', 'el_batches.id = el_schedule.batch_id');
        $builder->where('el_schedule.classroom_id', $classroom_id);
        $builder->where('el_schedule.is_del', 0);
        $builder->where('el_batches.is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Load Schedule By id
    public function load_schedule_id($id)
    {
        $builder = $this->db->table('el_schedule');
        $builder->select('el_schedule.id, el_schedule.title, el_schedule.lecturer_id, DATE_FORMAT(el_schedule.start_time, "%h:%i %p") as start_time, DATE_FORMAT(el_schedule.end_time, "%h:%i %p") as end_time, el_schedule.class_name, el_schedule.meet_url, batch_id');
        $builder->where('el_schedule.id',$id);
        $builder->where('el_schedule.is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Drag Schedule
    public function drag_schedule($id = NULL, $start_date = NULL)
    {
        $builder = $this->db->table('el_schedule');
        $builder->where('id', $id);
        $query = $builder->update(array('start_date'=> $start_date));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Remove Schedule
    public function remove_schedule($id = NULL)
    {
        $builder = $this->db->table('el_schedule');
        $builder->where('id', $id);
        $query = $builder->update(array('is_del'=> 1));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Edit Schedule
    public function edit_schedule($id = NULL, $schedule = NULL)
    {
        $builder = $this->db->table('el_schedule');
        $builder->where('id', $id);
        $query = $builder->update($schedule);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }

    //Get All Schedule Attendance List
    public function get_all_schedule_attendance_list()
    {
        $builder = $this->db->table('el_schedule');
        $builder->selectCount('el_schedule_attendance.id');
        $builder->select('el_schedule.schedule_id, el_schedule.title, DATE_FORMAT(el_schedule.start_date, "%d-%m-%Y")  AS start_date, DATE_FORMAT(el_schedule.start_time, "%h:%i %p") as start_time, DATE_FORMAT(el_schedule.end_time, "%h:%i %p") as end_time');
        $builder->join('el_schedule_attendance', 'el_schedule_attendance.schedule_id = el_schedule.schedule_id AND el_schedule_attendance.is_del = 0');
        $builder->where('el_schedule.is_del', 0);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get All Schedule Attendance List Reg
    public function get_all_schedule_attendance_list_reg($reg_id = NULL)
    {
        $builder = $this->db->table('el_schedule');
        $builder->selectCount('el_schedule_attendance.id');
        $builder->select('el_schedule.schedule_id, el_schedule.title, DATE_FORMAT(el_schedule.start_date, "%d-%m-%Y")  AS start_date, DATE_FORMAT(el_schedule.start_time, "%h:%i %p") as start_time, DATE_FORMAT(el_schedule.end_time, "%h:%i %p") as end_time');
        $builder->join('el_schedule_attendance', 'el_schedule_attendance.schedule_id = el_schedule.schedule_id AND el_schedule_attendance.is_del = 0', 'left');
        $builder->groupBy('el_schedule.schedule_id');
        $builder->where('el_schedule.reg_id', $reg_id);
        $builder->where('el_schedule.is_del', 0);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get All Schedule Attendance List Reg
    public function get_all_schedule_attendance_list_classroom($classroom_id = NULL)
    {
        $builder = $this->db->table('el_schedule');
        $builder->selectCount('el_schedule_attendance.id');
        $builder->select('el_schedule.schedule_id, el_schedule.title, DATE_FORMAT(el_schedule.start_date, "%d-%m-%Y")  AS start_date, DATE_FORMAT(el_schedule.start_time, "%h:%i %p") as start_time, DATE_FORMAT(el_schedule.end_time, "%h:%i %p") as end_time');
        $builder->join('el_schedule_attendance', 'el_schedule_attendance.schedule_id = el_schedule.schedule_id AND el_schedule_attendance.is_del = 0');
        $builder->where('el_schedule.classroom_id', $classroom_id);
        $builder->where('el_schedule.is_del', 0);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Schedule Attendance List
    public function get_schedule_attendance_list($id = NULL)
    {
        $builder = $this->db->table('el_schedule_attendance');
        $builder->select('el_schedule_attendance.id, username, email, permissions, time_min');
        $builder->join('el_accounts', 'el_accounts.id = el_schedule_attendance.account_id');
        $builder->where('el_schedule_attendance.schedule_id', $id);
        $builder->where('el_schedule_attendance.is_del', 0);
        $builder->where('el_accounts.is_del', 0);
        $builder->orderBy('id', 'DESC');

        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();

            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Attendance Students
    public function get_attendance_students($id = NULL)
    {
        $builder = $this->db->table('el_schedule_attendance');
        $builder->select('account_id');
        $builder->where('schedule_id', $id); 
        $builder->where('is_del', 0);

        $builder1 = $this->db->table('el_batch_assignment');
        $builder1->select('el_accounts.id, username, email');
        $builder1->join('el_accounts', 'el_accounts.id = el_batch_assignment.account_id');
        $builder1->join('el_schedule', 'el_schedule.batch_id = el_batch_assignment.batch_id');
        $builder1->where('el_schedule.schedule_id', $id);
        $builder1->where('el_batch_assignment.is_del', 0);
        $builder1->where('el_accounts.is_del', 0);
        $builder1->where('el_schedule.is_del', 0);
        $builder1->whereNotIn('el_accounts.id', $builder);
        $query = $builder1->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Add Attendance
    public function add_attendance($data = NULL, $id = NULL)
    {
        $students = json_decode($data['selected_id']);
        $i = 0;

        foreach($students as $student)
        {
            $builder = $this->db->table('el_schedule_attendance');
            $builder->where('schedule_id', $data['unique_id']);
            $builder->where('account_id', $student);
            $query = $builder->get();

            if($query->getNumRows() == 0)
            {
                $array = array(
                    'schedule_id' => $data['unique_id'],
                    'account_id'     => $student,
                    'time_min'    => $data['attendance_status'],
                    'is_del'      => 0
                );

                $builder = $this->db->table('el_schedule_attendance');
                $query = $builder->insert($array);

                if($query)
                {
                    $i++;
                }
            }
        }
        return $i;
    }

    //Delete Schedule Attendance
    public function delete_schedule_attendance($id = NULL)
    {
        $builder = $this->db->table('el_schedule_attendance');
        $builder->where('id', $id);
        $query = $builder->update(array('is_del'=> 1 ));

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //Add Hostel
    public function add_hostel($hostel = NULL)
    {

        $builder = $this->db->table('el_hostel');
        $query = $builder->insert($hostel);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Record Lecture Attendance
    public function record_schedule_attendance($id = NULL, $unique_id = NULL)
    {
        $builder = $this->db->table('el_schedule_attendance');
        $builder->where('account_id', $id);
        $builder->where('schedule_id', $unique_id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            if($data['time_min'] == 'Present' || $data['time_min'] == 'Absent')
            {
                return TRUE;
            }
            else
            {
                $builder1 = $this->db->table('el_schedule_attendance');
                $builder1->where('account_id', $id);
                $builder1->where('schedule_id', $unique_id);
                $query1 = $builder1->update(array('time_min' => $data['time_min'] +1));

                if($query1)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            $array = array(
                'account_id'  => $id,
                'schedule_id' => $unique_id,
                'time_min'    => 1,
                'is_del'      => 0
            );

            $builder1 = $this->db->table('el_schedule_attendance');
            $query1 = $builder1->insert($array);

            if($query1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }

    //Add Lab Instance
    public function add_lab_instance($lab = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('classroom_id');
        $builder->where('id', $lab['batch_id']);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();
            $lab['classroom_id'] = $data['classroom_id'];

            $builder1 = $this->db->table('el_lab_instance');
            $builder1->where('batch_id', $lab['batch_id']);
            $builder1->where('account_id', $lab['account_id']);
            $query1 = $builder1->get();

            if($query1->getNumRows() == 0)
            {
                $builder = $this->db->table('el_lab_instance');
                $inserted = $builder->insert($lab);

                if($inserted)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Get Batch users by id
    public function get_batch_users_byid($id = NULL) 
    {
        $builder = $this->db->table('el_batch_assignment');
        $builder ->select('el_accounts.id, el_accounts.email, el_accounts.username');
        $builder->join('el_batches', 'el_batches.id = el_batch_assignment.batch_id');
        $builder->join('el_accounts', 'el_accounts.id = el_batch_assignment.account_id');
        $builder->where('el_batch_assignment.batch_id', $id);
        $builder->where('el_batch_assignment.is_del', 0);
        $builder->where('el_accounts.is_del', 0);
        $builder->where('el_batches.is_del', 0);
        $builder->orderBy('el_batch_assignment.id', 'DESC');

        $query = $builder->get();

        if($query->getNumRows() >= 0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Hostel Details
    public function get_hostel($reg_id = NULL){

        $builder = $this->db->table('el_hostel');
        $builder->select('id,unique_id,hostel_name,hostel_type,no_of_rooms,ppl_capacity_per_rm');
        $builder->where('reg_id',$reg_id);
        $builder->where('is_del',0);
        $builder->orderBy('added_on','DESC');

        $query = $builder->get();

        if($query->getNumRows() > 0){

            return (array)$query->getResult();

        }else{

            return FALSE;

        }

    }

    //Get Hostel By Id
    public function get_hostel_by_id($unique_id,$reg_id){

        $builder = $this->db->table('el_hostel');
        $builder->select('id,unique_id,hostel_name,hostel_type,no_of_rooms,ppl_capacity_per_rm');
        $builder->where('reg_id',$reg_id);
        $builder->where('unique_id',$unique_id);
        $query = $builder->get();

        if($query->getNumRows() > 0){

            return (array)$query->getRow();

        }else{

            return FALSE;

        }

    }

    //Edit Hostel 
    public function edit_hostel($hostel,$id){

        $builder = $this->db->table('el_hostel');
        $builder->where('id',$id);
        $query = $builder->update($hostel);

        if($query)
        {

            return TRUE;

        }
        else{

            return FALSE;
            
        }
        
    }

    //Delete Hostel
    public function del_hostel($id){

        $builder = $this->db->table('el_hostel');
        $builder->where('id',$id);
        $query = $builder->update(array('is_del' => 1));
        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE; 
        }

    }

    //get Lab Instance
    public function get_lab_instance()
    {
        $builder = $this->db->table('el_lab_instance');
        $builder->select('el_accounts.username, batch_name, el_lab_instance.id, lab_name,lab_ip, lab_username, lab_password, account_id, lab_description');
        $builder->join('el_accounts', 'el_accounts.id = el_lab_instance.account_id');
        $builder->join('el_batches', 'el_batches.id = el_lab_instance.batch_id');
        $builder->where('el_lab_instance.is_del', 0);
        $builder->where('el_accounts.is_del', 0);
        $builder->where('el_batches.is_del', 0);
        $builder->orderBy('el_lab_instance.id', 'DESC');
        $query = $builder->get();

        $data = (array)$query->getResult();
        return $data;
    }

    //get Lab Instance
    public function get_lab_instance_id($id = NULL)
    {
        $builder = $this->db->table('el_lab_instance');
        $builder->select('id, batch_id, lab_name, lab_ip, lab_username, lab_password, account_id, lab_description');
        $builder->where('id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        $data = (array)$query->getRow();
        return $data;
    }

    //Edit Lab Instance
    public function edit_lab_instance($lab = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_lab_instance');
        $builder->where('id', $id);
        $query = $builder->update($lab);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return false;
        }
    }

    //Delete Lab Instance
    public function del_lab_instance($id)
    {
        $builder = $this->db->table('el_lab_instance');
        $builder->where('id', $id);
        $query = $builder->update(array('is_del' => 1));

        if($query)
        {
            return TRUE;
        }
        else{
            return FALSE;   
        }

    }

    //Get Assign Rooms
    public function get_assign_rooms($hostel_id){

        
        $builder = $this->db->table('el_hostel_students');
        $builder->select('el_hostel_students.id,el_hostel_students.room_no,el_student.student_name,el_student.student_emailid,el_student.student_gender,el_hostel_students.compartment,el_hostel_students.start_date,el_hostel_students.end_date');
        $builder->join('el_hostel', 'el_hostel.id = el_hostel_students.hostel_id');
        $builder->join('el_student', 'el_student.account_id = el_hostel_students.student_id');
        $builder->where('el_hostel_students.hostel_id',$hostel_id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            return (array)$query->getResult();
        }
        else
        {
            return FALSE;   
        }
    }

    //Get Room Students 
    public function get_room_students($room_no,$hostel_id){

        $builder = $this->db->table('el_hostel_students');
        $builder->select('compartment,student_id');
        $builder->where('hostel_id',$hostel_id);
        $builder->where('room_no',$room_no);
        $query = $builder->get();
        if($query->getNumRows() > 0)
        {
            return (array)$query->getResult();
        }
        else
        {
            return FALSE;         
        }

    }

    //Assign Room Student
    public function assign_room_student($assign){

        $builder = $this->db->table('el_hostel_students');
        $query = $builder->insert($assign);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Load Schedule
    public function load_schedule_student($id = NULL, $classroom_id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id');
        $builder->join('el_batch_assignment', 'el_batch_assignment.batch_id = el_batches.id');
        $builder->where('el_batches.visibility', 1);
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_batches.classroom_id', $classroom_id);
        $builder->where('el_batch_assignment.account_id', $id);
        $builder->where('el_batch_assignment.is_del', 0);

        $builder1 = $this->db->table('el_schedule');
        $builder1->select('el_schedule.id,title,lecturer_id,el_schedule.start_date,start_time,end_time,class_name,meet_url');
        $builder1->join('el_batches', 'el_batches.id = el_schedule.batch_id');
        $builder1->whereIn('el_batches.id', $builder);
        $builder1->where('el_schedule.is_del', 0);
        $builder1->where('el_batches.is_del', 0);
        $query1 = $builder1->get();

        if($query1->getNumRows()>0)
        {
            $data = (array)$query1->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    //Get Lab Student
    public function get_labs_student($id = NULL, $classroom_id = NULL)
    {
        $builder = $this->db->table('el_batches');
        $builder->select('el_batches.id');
        $builder->join('el_batch_assignment', 'el_batch_assignment.batch_id = el_batches.id');
        $builder->where('el_batches.visibility', 1);
        $builder->where('el_batches.is_del', 0);
        $builder->where('el_batches.classroom_id', $classroom_id);
        $builder->where('el_batch_assignment.account_id', $id);
        $builder->where('el_batch_assignment.is_del', 0);

        $builder1 = $this->db->table('el_lab_instance');
        $builder1->select('lab_ip, lab_username, lab_password');
        $builder1->join('el_batches', 'el_batches.id = el_lab_instance.batch_id');
        $builder1->whereIn('el_batches.id', $builder);
        $builder1->where('el_lab_instance.is_del', 0);
        $builder1->where('el_batches.is_del', 0);
        $query1 = $builder1->get();

        if($query1->getNumRows()>0)
        {
            $data = (array)$query1->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    public function student_availability($reg_id){

        $builder1 = $this->db->table('el_student');

        $subQuery = $this->db->table('el_hostel_students')->select('student_id')->where('reg_id', $reg_id);

        $builder1->whereNotIn('account_id',$subQuery);
        
        $query1 = $builder1->get();

        if($query1->getNumRows() > 0)
        {
            return (array)$query1->getResult();
        }
        else
        {
            return FALSE;         
        }
    }

    //Get Room Student
    public function get_room_student($id){

        $builder = $this->db->table('el_hostel_students');
        $builder->select('el_hostel_students.id, el_hostel_students.room_no, el_student.account_id, el_student.student_name, el_student.student_emailid, el_student.student_gender, el_hostel_students.compartment, el_hostel_students.start_date, el_hostel_students.end_date');
        $builder->join('el_student', 'el_student.account_id = el_hostel_students.student_id');
        $builder->where('el_hostel_students.id',$id);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            return (array)$query->getRow();
        }
        else
        {
            return FALSE;         
        }

    }

    public function get_mentor_details(){
        $builder = $this->db->table('el_mentor_registration');
        $builder->select('id,unique_id,mentor_name,email');
        $builder->where('status', 'Verified');
        $builder->where('is_del', 0);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = $query->getResult();
            return $data;
        }
        else
        {
            return False;
        }
    }

    public function get_mentor_by_id($id){

        $builder = $this->db->table('el_mentor_registration');
        $builder->select('el_mentor_registration.id,el_mentor_registration.unique_id,el_mentor_registration.mentor_name,el_mentor_registration.email,el_account_details.profile_image');
        $builder->join('el_account_details', 'el_account_details.account_id = el_mentor_registration.account_id');
        $builder->where('unique_id',$id);
        $builder->where('el_account_details.is_del', 0);
        $builder->where('el_mentor_registration.is_del', 0);
        $query = $builder->get();
        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();
            return $data;
        }
        else
        {
            return False;
        }

    }

    //Delete Mentor
    public function delete_mentor($array = NULL, $data = NULL)
    {
        $builder = $this->db->table('el_mentor_registration');
        $builder->select('account_id'); 
        $builder->where('unique_id', $data['id']);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            $account_id = $rowData['account_id'];

            $builder = $this->db->table('el_mentor_registration');
            $builder->where('unique_id', $data['id']);
            $query1 = $builder->update($array);
            if($query1)
            {
                $builder = $this->db->table('el_accounts');
                $builder->where('id',$account_id);
                $query2 = $builder->update($array);
                if($query2)
                {
                    $builder = $this->db->table('el_account_details');
                    $builder->where('account_id',$account_id);
                    $query3 = $builder->update($array);
                    if($query3){
                        return TRUE;
                    }
                    else{
                        return FALSE;
                    }
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //get Mentor Status
    public function get_mentor_status($id = NULL) 
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('id');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Mentor Course by unique ID
    public function get_mentor_course_byunique($unique_id = NULL) 
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('id');
        $builder->where('unique_id', $unique_id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_courses');
            $builder1->select('id, course_name');

            $subQuery = $this->db->table('el_mentor_course')->select('course_id')->where('mentor_id', $data['id'])->where('is_del', 0);

            $builder1->whereNotIn('id', $subQuery);
            $builder1->where('is_del', 0);
            $query1 = $builder1->get();
            
            if($query1->getNumRows() > 0)
            {
                $data1 = $query1->getResult();

                return $data1;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //assign mentor course
    public function assign_mentorcourses($data=NULL)
    {
        $i =0;

        $builder = $this->db->table('el_accounts');
        $builder->select('id');
        $builder->where('unique_id', $data['unique_id']);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData = (array)$query->getRow();
            $mentor_id = $rowData['id'];
            $assign_data = [];

            foreach(json_decode($data['selected_id'], true) as $course_id)
            {
                $builder = $this->db->table('el_mentor_course');
                $builder->where('mentor_id'   , $mentor_id);
                $builder->where('course_id'   , $course_id);
                $builder->where('is_del'      , 0);
                $query = $builder->get();

                if($query->getNumRows() == 0)
                {
                    $assign_data['course_id']    = $course_id;
                    $assign_data['mentor_id']    = $mentor_id;
                    $assign_data['added_by']     = $data['added_by'];
                    $assign_data['updated_by']   = $data['updated_by'];

                    $builder2 = $this->db->table('el_mentor_course');
                    $query2 = $builder2->insert($assign_data);

                    if($query2)
                    {
                        $i++;
                    }
                }
            }
            return $i;
        }
        else
        {
            return FALSE;
        }
    }

    //Get Mentor Course
    public function get_mentor_course($unique_id = NULL) 
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('id');
        $builder->where('unique_id', $unique_id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $rowData  = (array)$query->getRow();
            $mentor_id = $rowData['id'];

            $builder  = $this->db->table('el_mentor_course');
            $builder->join('el_accounts', 'el_accounts.id = el_mentor_course.mentor_id');
            $builder->join('el_courses', 'el_courses.id = el_mentor_course.course_id');
            $builder->select('el_mentor_course.id, el_mentor_course.course_id, el_courses.course_name');
            $builder->where('el_mentor_course.mentor_id', $mentor_id);
            $builder->where('el_courses.is_del', 0);
            $builder->where('el_mentor_course.is_del', 0);
            $builder->where('el_accounts.is_del', 0);
            $builder->orderBy('el_mentor_course.id', 'DESC');

            $query = $builder->get();

            if($query->getNumRows() >= 0)
            {
                $data = $query->getResult();
                return $data;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Assign Course
    public function delete_assignmentorcourse($array = NULL, $data = NULL)
    {
        $builder = $this->db->table('el_mentor_course');
        $builder->where('id', $data['id']);
        $query = $builder->update($array);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}