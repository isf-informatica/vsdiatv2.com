<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Admin_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    //Check Email
    public function check_email($email = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $builder->select('email');
        $builder->where('email', $email);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //Add Admin
    public function manage_admin_form($admin_data = NULL, $accounts = NULL, $account_details = NULL)
    {
        $builder = $this->db->table('el_accounts');
        $query = $builder->insert($accounts);

        if($query)
        {
            $account_id                    = $this->db->insertID();
            $admin_data['account_id']      = $account_id;
            $account_details['account_id'] = $account_id;

            $builder1 = $this->db->table('el_admin');
            $query1 = $builder1->insert($admin_data);

            if($query1)
            {
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

    //Get All Admins
    public function get_all_admin()
    {
        $builder = $this->db->table('el_admin');
        $builder->select('unique_id, name, email_id, region_type, region_country, region_state, region_city');
        $builder->where('is_del', 0);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return $query->getResult();
        }
        else
        {
            return FALSE;
        }
    }

    //get Admin by ID
    public function get_admin_by_id($id = NULL)
    {
        $builder = $this->db->table('el_admin');
        $builder->select('unique_id, name, phone, DATE_FORMAT(dob, "%d-%m-%Y") as dob, gender, email_id, image, document, region_type, region_country, region_state, region_city, description');
        $builder->where('unique_id', $id);
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

    //Edit Admin
    public function edit_admin_form($admin_data = NULL, $id = NULL)
    {
        $builder = $this->db->table('el_admin');
        $builder->where('unique_id', $id);
        $query = $builder->update($admin_data);

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Delete Admin
    public function delete_admin($id = NULL)
    {
        $builder = $this->db->table('el_admin');
        $builder->select('account_id');
        $builder->where('unique_id', $id);
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            $data = (array)$query->getRow();

            $builder1 = $this->db->table('el_admin');
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
            return TRUE;
        }
    }
}