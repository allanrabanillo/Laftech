<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InandOut_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        $this->db->select('job_no,customers.c_id,c_name,item_desc,partno,date_in,status,images');
        $this->db->from('in_and_out');
        $this->db->join('customers', 'customers.c_id = in_and_out.c_id');
        // $this->db->group_by("parts.p_id");
        $query = $this->db->get();

        return $query->result();
    }

    public function get_job($id = null)
    {
        return $row = $this->db->get_where('in_and_out', array('job_no' => $id))->row();
    }

    public function create($data)
    {
        $query = $this->db->insert('in_and_out',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }


     
    

    

    



}
