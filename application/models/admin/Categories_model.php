<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id=null)
    {
        if($id != null){
            $this->db->where('cat_id', $id);
        }
        $query = $this->db->get('categories');

        return $query->result();
    }

    public function create($data)
    {
        $query = $this->db->insert('categories',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_cat($id = null)
    {
        return $row = $this->db->get_where('categories', array('cat_id' => $id))->row();
    }

    public function update($id,$data)
    {
        $this->db->where('cat_id', $id);
        $this->db->update('categories',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    



}
