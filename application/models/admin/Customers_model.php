<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id=null)
    {
        if($id != null){
            $this->db->where('c_id', $id);
        }
        $query = $this->db->get('customers');

        return $query->result();
    }

    public function create($data)
    {
        $query = $this->db->insert('customers',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_customer($id = null)
    {
        return $row = $this->db->get_where('customers', array('c_id' => $id))->row();
    }

    public function update($id,$data)
    {
        $this->db->where('c_id', $id);
        $this->db->update('customers',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    



}
