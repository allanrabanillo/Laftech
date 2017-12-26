<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function get_count_record($table)
    {
        $query = $this->db->count_all($table);

        return $query;
    }

    public function top_user_login()
    {
        $query = $this->db->query("SELECT * FROM users order by last_login desc limit 5;");

        return $query->result();
    }


    public function disk_totalspace($dir = DIRECTORY_SEPARATOR)
    {
        return disk_total_space($dir);
    }


    public function disk_freespace($dir = DIRECTORY_SEPARATOR)
    {
        return disk_free_space($dir);
    }


    public function disk_usespace($dir = DIRECTORY_SEPARATOR)
    {
        return $this->disk_totalspace($dir) - $this->disk_freespace($dir);
    }


    public function disk_freepercent($dir = DIRECTORY_SEPARATOR, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->disk_freespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }


    public function disk_usepercent($dir = DIRECTORY_SEPARATOR, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->disk_usespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }


    public function memory_usage()
    {
        return memory_get_usage();
    }


    public function memory_peak_usage($real = TRUE)
    {
        if ($real)
        {
            return memory_get_peak_usage(TRUE);
        }
        else
        {
            return memory_get_peak_usage(FALSE);
        }
    }


    public function memory_usepercent($real = TRUE, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->memory_usage() * 100) / $this->memory_peak_usage($real), 0).$unit;
    }

    public function get_count_critical_parts()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        
        // $this->db->select('count(parts.p_id) as total');
        // $this->db->from('parts');
        // $this->db->join('stocks', 'stocks.p_id = parts.p_id','left');


        // $this->db->group_by("parts.p_id");
                // $this->db->where('SUM(COALESCE((stocks.qty-stocks.qtyout), 0 )) <', 'parts.p_c_level');
        $query = $this->db->query('SELECT p_id,p_c_level, COALESCE((SELECT SUM(COALESCE((qty-qtyout), 0 )) from stocks where stocks.p_id = parts.p_id),0) as balance from parts WHERE p_c_level >= COALESCE((SELECT SUM(COALESCE((qty-qtyout), 0 )) from stocks where stocks.p_id = parts.p_id),0)');

        return $query->num_rows();
    }

    public function get_count_outofstock_parts()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        
        // $this->db->select('count(parts.p_id) as total');
        // $this->db->from('parts');
        // $this->db->join('stocks', 'stocks.p_id = parts.p_id','left');


        // $this->db->group_by("parts.p_id");
                // $this->db->where('SUM(COALESCE((stocks.qty-stocks.qtyout), 0 )) <', 'parts.p_c_level');
        $query = $this->db->query('SELECT p_id,p_c_level, COALESCE((SELECT SUM(COALESCE((qty-qtyout), 0 )) from stocks where stocks.p_id = parts.p_id),0) as balance from parts WHERE COALESCE((SELECT SUM(COALESCE((qty-qtyout), 0 )) from stocks where stocks.p_id = parts.p_id),0) = 0');

        return $query->num_rows();
    }

    public function get_count_pending_request()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        
        // $this->db->select('count(parts.p_id) as total');
        // $this->db->from('parts');
        // $this->db->join('stocks', 'stocks.p_id = parts.p_id','left');


        // $this->db->group_by("parts.p_id");
                // $this->db->where('SUM(COALESCE((stocks.qty-stocks.qtyout), 0 )) <', 'parts.p_c_level');
        $query = $this->db->query('SELECT r_id from requests WHERE admin_approval = "0" ');

        return $query->num_rows();
    }



    public function get_count_jobs()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        
        // $this->db->select('count(parts.p_id) as total');
        // $this->db->from('parts');
        // $this->db->join('stocks', 'stocks.p_id = parts.p_id','left');


        // $this->db->group_by("parts.p_id");
                // $this->db->where('SUM(COALESCE((stocks.qty-stocks.qtyout), 0 )) <', 'parts.p_c_level');
        $query = $this->db->query('select distinct job_no from in_and_out');

        return $query->num_rows();
    }

     public function get_forinv_count_jobs()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        
        // $this->db->select('count(parts.p_id) as total');
        // $this->db->from('parts');
        // $this->db->join('stocks', 'stocks.p_id = parts.p_id','left');


        // $this->db->group_by("parts.p_id");
                // $this->db->where('SUM(COALESCE((stocks.qty-stocks.qtyout), 0 )) <', 'parts.p_c_level');
        $query = $this->db->query("select distinct job_no from in_and_out where invno !='' and invno IS NOT NULL ");

        return $query->num_rows();
    }

    public function get_fortest_count_jobs()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        
        // $this->db->select('count(parts.p_id) as total');
        // $this->db->from('parts');
        // $this->db->join('stocks', 'stocks.p_id = parts.p_id','left');


        // $this->db->group_by("parts.p_id");
                // $this->db->where('SUM(COALESCE((stocks.qty-stocks.qtyout), 0 )) <', 'parts.p_c_level');
        $query = $this->db->query("select distinct job_no from in_and_out where status ='FORTEST' ");

        return $query->num_rows();
    }

    public function get_announcements(){
        $query = $this->db->query("SELECT * FROM announcements order by a_date desc limit 5;");

        return $query->result();
    }
}
