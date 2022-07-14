<?php

namespace App\Models\Easylearn;

use CodeIgniter\Model;

class Settings_Model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    //About us
    public function aboutus_getdata()
    {
        $builder = $this->db->table('el_aboutus');
        $builder->select('*');
        $builder->where('is_del', 0);
        $query = $builder->get();

        if($query->getNumRows()>0)
        {
            return $query->getRow();
        }
        else
        {
            return FALSE;
        }
    }

    //Testimonials
    public function testimonials_getdata()
    {
        $builder = $this->db->table('el_testimonials');
        $builder->select('*');
        $builder->where('is_del', 0);

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

    //Project Documents
    public function project_documents_getdata()
    {
        $builder = $this->db->table('el_project_documents');
        $builder->select('*');
        $builder->where('is_del', 0);

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

    //Product Features
    public function product_features_getdata()
    {
        $builder = $this->db->table('el_features');
        $builder->select('*');
        $builder->where('is_del', 0);

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

    //ISF Services
    public function isf_services_getdata()
    {
        $builder = $this->db->table('el_services');
        $builder->select('*');
        $builder->where('is_del', 0);

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

    //Team
    public function team_getdata()
    {
        $builder = $this->db->table('el_team');
        $builder->select('*');
        $builder->where('is_del', 0);

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

    //Customer Benefits
    public function customer_benefits_getdata()
    {
        $builder = $this->db->table('el_benefits');
        $builder->select('*');
        $builder->where('is_del', 0);

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

    //Get Setting by Name
    public function get_settings_name($name = NULL)
    {
        $builder = $this->db->table('el_settings');
        $builder->select('value');
        $builder->join('el_settings_category', 'el_settings_category.id = el_settings.category_id');
        $builder->where('el_settings.is_del', 0);
        $builder->where('el_settings_category.is_del', 0);
        $builder->where('el_settings_category.category_name', $name);
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
}
