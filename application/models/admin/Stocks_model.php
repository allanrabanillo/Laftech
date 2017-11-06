<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        $this->db->select('parts.p_id,SUM(COALESCE((qty-qtyout), 0 )) as balance');
        $this->db->from('parts');
        $this->db->join('stocks', 'stocks.p_id = parts.p_id','left');
        $this->db->group_by("parts.p_id");
        $query = $this->db->get();

        return $query->result();
    }

    

    

    



}
