<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Register_Model extends Model
{
    protected $db;

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    //Check Email
    public function check_email($email = NULL){
        $builder = $this->db->table('el_accounts');
        $builder->select('email');
        $builder->where('email', $email);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Login User
    public function login_user($email = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('el_accounts.id, reg_id, username, email, pass, permissions, status, mfa_status, el_account_details.profile_image');
        $builder->join('el_account_details', 'el_account_details.account_id = el_accounts.id');
        $builder->where('email', $email);
        $builder->where('el_accounts.is_del', 0);
        $builder->where('el_account_details.is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return (array)$query->getRow();
        }
        else
        {
            return FALSE;
        }
    }

    //record Login
    public function record_login($id = NULL, $ip = NULL)
    {
        $data = array(
            'account_id' => $id,
            'ip_address' => $ip,
        );

        $builder = $this->db->table('el_login_activites');
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

    //Retrive Secret Key
    public function retrive_qr($id = Null)
    {
        $builder = $this->db->table('el_store_secret');
        $builder->select('secret');
        $builder->where('account_id', $id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return (array)$query->getRow();
        }
        else
        {
            return FALSE;
        }
    }

    //Change Password
    public function new_pwd_form($newpwd = NULL, $email = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder->where('email', $email);
        $result = $builder->update($newpwd);

        if($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //get Admin Access
    public function get_admin_access($id = NULL)
    {
        $builder = $this->db->table('el_admin');
        $builder->select('region_type, region_country, region_state, region_city');
        $builder->where('account_id', $id);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return (array)$query->getRow();
        }
        else
        {
            return FALSE;
        }
    }

    //get Classroom id
    public function get_classroom_id($id = NULL)
    {
        $builder = $this->db->table('el_classroom');
        $builder->select('id');
        $builder->where('account_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return (array)$query->getRow();
        }
        else
        {
            return FALSE;
        }
    }

    //School register
    public function school_register($school = NULL, $registration = NULL, $accounts = NULL, $account_details = NULL)
    {
        $builder = $this->db->table('el_school');
        $query = $builder->insert($school);

        if($query)
        {
            $registration['reg_id']  = $this->db->insertID();

            $builder1 = $this->db->table('el_registration');
            $query1 = $builder1->insert($registration);

            if($query1)
            {
                $accounts['reg_id']  = $this->db->insertID();

                $builder2 = $this->db->table('el_accounts');
                $query2 = $builder2->insert($accounts);

                if($query2)
                {
                    $account_details['account_id']  = $this->db->insertID();

                    $builder3 = $this->db->table('el_account_details');
                    $query3 = $builder3->insert($account_details);

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

    //Jr College Register
    public function jr_clg_register($jr_clg = NULL, $registration = NULL, $accounts = NULL, $account_details = NULL)
    {
        $builder = $this->db->table('el_jr_clg');
        $query = $builder->insert($jr_clg);

        if($query){

            $registration['reg_id']  = $this->db->insertID();
            $builder1 = $this->db->table('el_registration');
            $query1 = $builder1->insert($registration);

            if($query1){

                $accounts['reg_id']  = $this->db->insertID();

                $builder2 = $this->db->table('el_accounts');
                $query2 = $builder2->insert($accounts);

                if($query2)
                {
                    $account_details['account_id']  = $this->db->insertID();

                    $builder3 = $this->db->table('el_account_details');
                    $query3 = $builder3->insert($account_details);

                    if($query3)
                    {
                        return TRUE;

                    }else{

                        return FALSE;

                    }
                    
                }else{

                    return FALSE;

                }

            }
            else
            {

                return FALSE;
                
            }

        }else{

            return FALSE;

        }
    }

    //Register Mentor
    public function register_mentor($mentor = NULL, $accounts = NULL, $account_details = NULL)
    {
        if($this->check_email($mentor['email']))
        {
            return FALSE;
        }
        else
        {
            $builder = $this->db->table('el_accounts');
            $query = $builder->insert($accounts);
            $acc_id = $this->db->insertID();
            
            $mentor['account_id'] = $acc_id;

            if($query)
            {
                $builder1 = $this->db->table('el_mentor_registration');
                $query1 = $builder1->insert($mentor);

                if($query1)
                {
                    $account_details['account_id'] = $acc_id;
                    $account_details['added_by']   = $acc_id;
                    $account_details['updated_by'] = $acc_id;

                    $builder2 = $this->db->table('el_account_details');
                    $query2 = $builder2->insert($account_details);

                    if($query2)
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
    }

    //Get Classroom Batch
    public function get_classroom_batch_id($id = NULL)
    {
        $builder = $this->db->table('el_classroom_assignment');
        $builder->select('classroom_id');
        $builder->where('account_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows() > 0)
        {
            $data =  (array)$query->getRow();

            return $data['classroom_id'];
        }
        else
        {
            return 0;
        }
    }
}