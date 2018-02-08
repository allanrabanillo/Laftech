<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($id = null)
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        // $this->db->select('job_no,customers.c_id,c_name,item_desc,partno,date_in,status,images,drawing');
        // $this->db->from('in_and_out');
        // $this->db->join('customers', 'customers.c_id = in_and_out.c_id');
        // // $this->db->group_by("parts.p_id");
        // $query = $this->db->get();

        // return $query->result();

        if($id != null){
            $this->db->where('r_id', $id);
        }
        $query = $this->db->get('requests');

        return $query->result();
    }

     public function get_pending($id = null)
    {
        //SELECT parts.p_id,COALESCE((qty - qtyout), 0 ) as balance from parts left outer join stocks on stocks.p_id = parts.p_id GROUP BY parts.p_id
        // $this->db->select('job_no,customers.c_id,c_name,item_desc,partno,date_in,status,images,drawing');
        // $this->db->from('in_and_out');
        // $this->db->join('customers', 'customers.c_id = in_and_out.c_id');
        // // $this->db->group_by("parts.p_id");
        // $query = $this->db->get();

        // return $query->result();

        if($id != null){
            $this->db->where('r_id', $id);
        }
        $this->db->where("tech_approval = '0' ");
        $query = $this->db->get('requests');

        return $query->result();
    }

    public function get_request($id = null)
    {
        return $row = $this->db->get_where('requests', array('r_id' => $id))->row();
    }
    public function get_request_itm($id = null)
    {
        $this->db->select('parts.p_desc,request_items.qty');
        $this->db->from('request_items');
        $this->db->where("request_items.r_item_id",$id);
        $this->db->join('parts', 'parts.p_id = request_items.p_id');
        return $row = $this->db->get()->row();
    }

    public function create($data)
    {
        $query = $this->db->insert('requests',$data);
         $last_id = $this->db->insert_id();
        return ($this->db->affected_rows() != 1) ? false : $last_id;
    }

    public function item_create($data)
    {
        $query = $this->db->insert('request_items',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function item_delete($data)
    {
        $query = $this->db->delete('request_items',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update($id,$data)
    {
        $this->db->where('r_id', $id);
        $this->db->update('requests',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function delete($data){
         $query = $this->db->delete('requests',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_history($id=null)
    {
        if($id != null){
            $this->db->where('job_no', $id);
        }
        $query = $this->db->get('job_history');

        return $query->result();
    }

    public function get_traveller($id=null)
    {
        if($id != null){
            $this->db->where('job_no', $id);
        }
        $query = $this->db->get('job_traveler');

        return $query->result();
    }


    public function getjobs($keyword) {        
        $this->db->select('job_no,status');
        $this->db->where('job_no !=', $keyword);
        $this->db->from('in_and_out');
        return $this->db->get()->result_array();
    }


    public function check_jobno($keyword){
        $this->db->where('job_no', $keyword);
        $query = $this->db->get('in_and_out');
        
        return ($query->num_rows() > 0) ? true : false;
    }

    public function check_jobno_exist($keyword,$old){
        $this->db->where('job_no', $keyword);
        $this->db->where('old_job_no', $old);
        $query = $this->db->get('job_history');
        
        return ($query->num_rows() > 0) ? true : false;
    }

    public function check_testno_exist($keyword,$old){
        $this->db->where('job_no', $keyword);
        $this->db->where('test_no', $old);
        $query = $this->db->get('job_traveler');
        
        return ($query->num_rows() > 0) ? true : false;
    }


    public function history($data)
    {
        $query = $this->db->insert('job_history',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function insertTraveller($data)
    {
        $query = $this->db->insert('job_traveler',$data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_request_items($id=null)
    {
        if($id != null){
            $this->db->where('r_id', $id);
        }
        $query = $this->db->get('request_items');

        return $query->result();
    }

    public function approve_admin($id=null,$admin=1){ 

        $this->db->trans_begin();
        $this->db->set('admin_approval', '1', FALSE);
        $this->db->set('admin_id', $admin, FALSE);
        $this->db->where('r_id', $id);
        $this->db->update('requests');
        if($this->db->affected_rows() !=1){
             $this->db->trans_rollback();
             return false;
        }
        $query = $this->db->query("SELECT * FROM request_items where r_id = $id");
        if($query->num_rows() > 0){
            foreach($query->result_array() as $row){
                $r_item_id = $row['r_item_id'];
                $p_id = $row['p_id'];
                $qtyneed = $row['qty'];
                $getstocks = $this->db->query("SELECT s_id,qty-qtyout as balance FROM stocks where p_id = $p_id and qty-qtyout != 0 order by s_date asc");
                 $numrows = $getstocks->num_rows(); 
                 
                 if( $numrows == 0){
                    $this->db->trans_rollback();
                    return false; // not enough stock to complete the request
                 }
                 foreach($getstocks->result_array() as $row2){
                   
                    if($qtyneed != 0){
                        $stock_id = $row2['s_id'];
                        $balance = $row2['balance'];
                        if($qtyneed >= $balance){
                            $entyQty = $balance;
                            $qtyneed = $qtyneed - $balance;
                        }else{
                            $entyQty = $qtyneed;
                            $qtyneed = $qtyneed - $entyQty;
                        }

                        $updateStocks = $this->db->query("UPDATE stocks SET qtyout = qtyout + $entyQty where s_id = $stock_id");
                        if($this->db->affected_rows() > 0){
                            $data = array(
                                'r_id' => $id,
                                'r_item_id' => $r_item_id,
                                's_id' => $stock_id,
                                'p_id' => $p_id,
                                'qty' => $entyQty,
                                'out_date' => date('Y-m-d H:i:s'),
                                'out_by' => $admin
                            );
                            $updateItemListOut = $this->db->insert("request_items_out",$data);
                            if($this->db->affected_rows() > 0){
                                 $numrows--;
                                if($qtyneed != 0 && $numrows == 0){
                                    $this->db->trans_rollback(); // not enought inventory
                                    return false;
                                }
                            }else{
                                $this->db->trans_rollback(); // failed to update the item out
                                return false;
                            }
                           
                        }else{
                             $this->db->trans_rollback(); // failed to update the stocks
                             return false;
                        }
                    }
                 }
                
            }
        }else{
            $this->db->trans_rollback();
            return false; // no items in the request
        }

        $this->db->trans_commit();
        return true;
        
    }

    
    public function reject_admin($id=null){
        $this->db->set('admin_approval', '0', FALSE);
        $this->db->where('r_id', $id);
        $this->db->update('requests');

        if($this->db->affected_rows() !=1){
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_begin();
        $query = $this->db->query("SELECT * FROM request_items_out where r_id = $id");
        if($query->num_rows() > 0){
            foreach($query->result_array() as $row){
                $item_out_id = $row['r_item_out_id'];
                $s_id = $row['s_id'];
                $qtyback = $row['qty'];

                $updatestock = $this->db->query("UPDATE stocks set qtyout = qtyout - $qtyback where s_id = $s_id");
                if($this->db->affected_rows() == 0){
                     $this->db->trans_rollback();
                    return false; // failed to update the stocks back
                }
                $deleteItemOut = $this->db->query("DELETE FROM request_items_out where r_item_out_id = $item_out_id and r_id = $id");
                if($this->db->affected_rows() == 0){
                     $this->db->trans_rollback();
                    return false; // failed to delete the item out
                }
            }
        
        }else{
            $this->db->trans_rollback();
            return false; // no items in the request
        }
        $this->db->trans_commit();
        return true;

       
    }
    
    public function approve_tech($id=null){
        $this->db->set('tech_approval', '1', FALSE);
        $this->db->where('r_id', $id);
        $this->db->update('requests');

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function reject_tech($id=null){
        $this->db->set('tech_approval', '0', FALSE);
        $this->db->where('r_id', $id);
        $this->db->update('requests');

        return ($this->db->affected_rows() != 1) ? false : true;
    }

     
    

    

    



}
