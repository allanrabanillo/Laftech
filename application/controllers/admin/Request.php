<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');
        $this->load->model('admin/parts_model');
        $this->load->model('admin/request_model');
        $this->load->model('admin/categories_model');
        $this->load->model('admin/receiving_model');
        $this->load->model('admin/inandout_model');
        /* Title Page :: Common */
        $this->page_title->push('Request','Create a new request.');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Request', 'admin/request');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Get all categories */
            $this->data['requests'] = $this->request_model->get_all();
            foreach ($this->data['requests'] as $k => $request)
            {
                $this->data['requests'][$k]->tech = $this->ion_auth->user($request->tech_id)->result();
				if($request->tech_approval == 1){
					if($request->admin_approval == 1){
						$this->data['requests'][$k]->status = 'Admin-Approved';
						$this->data['requests'][$k]->color = 'green';
					}else{
						$this->data['requests'][$k]->status = 'Tech-Approved';
						$this->data['requests'][$k]->color = 'green';
					}
				}else{
					$this->data['requests'][$k]->status = 'Pending';
					$this->data['requests'][$k]->color = 'orange';
				}
            }
            /* Load Template */
            $this->template->admin_render('admin/request/index', $this->data);
        }
	}


	public function create()
	{

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'New request', 'admin/request/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		// $tables = $this->config->item('tables', 'ion_auth');
        $cat = $this->categories_model->get_all();
        

		/* Validate form input */
		$this->form_validation->set_rules('job_no', 'Job No', 'required');
		$this->form_validation->set_rules('test_no', 'Test No', 'required|numeric');

	

		// if ($this->form_validation->run() == TRUE)
		// {
		// 	$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
		// 	$email    = strtolower($this->input->post('email'));
		// 	$password = $this->input->post('password');

			
		
		$this->data['message'] = '';
		
		$data = array(
				'job_no' => $this->input->post('job_no'),
				'test_no'  => $this->input->post('test_no'),
                'admin_approval'  => '0',
                'tech_approval'  => '0',
                'tech_id'  => $this->ion_auth->user()->row()->id,
                'r_date'  => date('Y-m-d H:i:s'),
                
			);

		if ($this->form_validation->run() == TRUE )
		{
			if($this->inandout_model->check_jobno($this->input->post('job_no'))){
				if($this->inandout_model->check_testno($this->input->post('job_no'))){
					if($last_id = $this->request_model->create($data)){
						$this->logme("New Request has been created. (RQ: ".$last_id.").",$this->ion_auth->user()->row()->id,"Request");
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect('admin/request/item_list/'.$last_id, 'refresh');
					}
				}else{
					$this->data['message'] .= 'Please input a valid test no.';
				}

			}else{
				$this->data['message'] .= 'Please input a valid job no.';
			}
			
			
            
		}
		
            $this->data['message'] .= validation_errors();

			 $this->data['job_no'] = array(
				'name'  => 'job_no',
				'id'    => 'jobno2',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('job_no'),
			);

			$this->data['test_no'] = array(
				'name'  => 'test_no',
				'id'    => 'test_no2',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('test_no'),
			);

           	

            /* Load Template */
            $this->template->admin_render('admin/request/create', $this->data);
        
	}


	public function delete($id)
	{
        $data = array(
			'r_id' => $id
		);

		$request = $this->request_model->get_request($id);
		
		$mes = '';
		if($request->tech_approval != 1){

			if($this->ion_auth->is_admin()){
			$this->request_model->delete($data);
			$mes = 'success';
			}else{
				if($request->tech_id != $this->ion_auth->user()->row()->id){
					$mes = 'Your not the owner of this request.';
				}else{
					$this->logme("Request has been deleted. (RQ: ".$id.").",$this->ion_auth->user()->row()->id,"Request");
					$this->request_model->delete($data);
					$mes = 'success';
				}
			}
		}else{
			$mes = "Please disapproved this request first.";
		}
		

		echo $mes;
	}


	public function edit($id)
	{
        $id = (int) $id;

		if ( ! $this->ion_auth->logged_in() OR ! $id OR empty($id) )
		{
			redirect('admin/request', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Request Info', 'admin/request/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
		/* Data */
		$request = $this->request_model->get_request($id);
        // $cat = $this->categories_model->get_all();
        
		/* Validate form input */
		$this->form_validation->set_rules('job_no', 'lang:Description', 'required');
		$this->form_validation->set_rules('test_no', 'Test No', 'required|numeric');
        // $this->form_validation->set_rules('p_critical', 'lang:Critical Level', 'required|numeric|greater_than[0]');
        // $this->form_validation->set_rules('p_category', 'lang:Category', 'required');
	

		if (isset($_POST) && ! empty($_POST))
		{
          

					if ($this->form_validation->run() == TRUE)
					{
						 if(isset($_POST) && ! empty($_POST) && $this->inandout_model->check_jobno($this->input->post('job_no')) == false){

                			$this->data['message'] .= 'Please input a valid Job No.';

            			}else{
							if(!$this->inandout_model->check_testno($this->input->post('job_no'))){
								$this->data['message'] .= 'Please input a valid Test No.';
							}else{
								$data = array(
								'job_no' => $this->input->post('job_no'),
								'test_no'  => $this->input->post('test_no')
								);
								if($this->request_model->update($id,$data)){
									$this->logme("Request has been updated. (RQ: ".$id.").",$this->ion_auth->user()->row()->id,"Request");
									$this->data['message_suc'] .= 'Update Successful.';
								}else{
									$this->data['message'] .= 'Something went wrong.';
								}

							}
							

						
						
					}
			
				}else{
						$this->data['message'] = validation_errors();
				}
		}

		// set the flash data error message if there is one
	

		// pass the user to the view
		$this->data['request_items'] = $this->request_model->get_request_items($id);
		foreach ($this->data['request_items'] as $k => $request)
        {
            $this->data['request_items'][$k]->parts = $this->parts_model->get_all($request->p_id);
			foreach ($this->data['request_items'][$k]->parts as $r => $part)
			{
				$this->data['request_items'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
			}
        }
		
		
		$this->data['requests'] = $this->request_model->get_all($id);
		foreach ($this->data['requests'] as $k => $request)
        {
		
			foreach ( $this->ion_auth->user($request->tech_id)->result() as $tech)
        	{
				$this->data['requests'][$k]->tech = $tech->first_name." ".$tech->last_name;
			}
			if($request->admin_id !=0){
				foreach ( $this->ion_auth->user($request->admin_id)->result() as $admin)
				{
					$this->data['requests'][$k]->admin = $admin->first_name." ".$admin->last_name;
				}
			}
			

        }
		
		
			$this->data['rqno'] = $id;

			if(!$this->ion_auth->is_admin() && $request->tech_id != $this->ion_auth->user()->row()->id){
				$this->data['job_no'] = array(
				'name'  => 'job_no',
				'id'    => 'jobno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('job_no',$request->job_no),
				'disabled' => true
				);
				$this->data['test_no'] = array(
					'name'  => 'test_no',
					'id'    => 'test_no',
					'type'  => 'text',
					'class' => 'form-control',
					'value' => $this->form_validation->set_value('test_no',$request->test_no),
					'disabled' => true
				);
			}else{
				$this->data['job_no'] = array(
				'name'  => 'job_no',
				'id'    => 'jobno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('job_no',$request->job_no),
				);
				$this->data['test_no'] = array(
					'name'  => 'test_no',
					'id'    => 'test_no',
					'type'  => 'text',
					'class' => 'form-control',
					'value' => $this->form_validation->set_value('test_no',$request->test_no),
				);
			}

		    
            
        /* Load Template */
		$this->template->admin_render('admin/request/edit', $this->data);
	}

	public function item_remove($id,$rqno){

		$data = array(
			'r_item_id' => $id
		);

		$request = $this->request_model->get_request($rqno);
		$request_item = $this->request_model->get_request_itm($id);

		
		$mes = '';
		if($this->ion_auth->is_admin()){
			$this->logme("Request item has been removed. (RQ: ".$rqno." | Part Desc: ".$request_item->p_desc." | Qty: ".$request_item->qty." ).",$this->ion_auth->user()->row()->id,"Request");
			$this->request_model->item_delete($data);
			$mes = 'success';
		}else{
			if($request->tech_id != $this->ion_auth->user()->row()->id){
				$mes = 'Your not the owner of this request.';
			}else{
				$this->request_model->item_delete($data);
				$mes = 'success';
			}
		}

		echo $mes;
		
	}

	public function item_list($id){
		 $id = (int) $id;

		if ( ! $this->ion_auth->logged_in() OR ! $id OR empty($id) )
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Item List', 'admin/request/item_list');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
		/* Data */
		$request = $this->request_model->get_request($id);
        // $cat = $this->categories_model->get_all();
        
		/* Validate form input */
		$this->form_validation->set_rules('p_name', 'lang:Description', 'required');
		$this->form_validation->set_rules('p_qty', 'lang:Qty', 'required|numeric');

		
     
		$this->data['message'] = '';
		$this->data['message_suc'] = '';

		if (isset($_POST) && ! empty($_POST) && !empty($this->input->post('p_id')))
		{
			if($this->ion_auth->is_admin()){ // if admin
				if(isset($_POST) && ! empty($_POST) && $this->parts_model->check_part($this->input->post('p_name')) == false){

                $this->data['message'] .= 'Please input a valid Part Desc.';

            	}else{
					if ($this->form_validation->run() == TRUE)
					{
						$data = array(

						'r_id' => $id,
						'p_id' => $this->input->post('p_id'),
						'qty'  => $this->input->post('p_qty'),
						);

						
						if($this->request_model->item_create($data))
						{
							$this->logme("Request item has been added. (RQ: ".$rqno." | Part Desc: ".$this->input->post('p_name')." | Qty: ".$this->input->post('p_qty')." ).",$this->ion_auth->user()->row()->id,"Request");
							$this->session->set_flashdata('message', $this->ion_auth->messages());

						
								$this->data['message_suc'] .= 'Item has been added.';
							
						}
						else
						{
							$this->session->set_flashdata('message', $this->ion_auth->errors());

							
								
								$this->data['message'] .= 'Failed to add the item.';
							
						}
					}
				}
			}else{ // else tecnician
				if($request->tech_id != $this->ion_auth->user()->row()->id){
					$this->data['message'] = "Your not the owner of this request";
				}else{
					if(isset($_POST) && ! empty($_POST) && $this->parts_model->check_part($this->input->post('p_name')) == false){

                	$this->data['message'] .= 'Please input a valid Part Desc.';

            		}else{
						if ($this->form_validation->run() == TRUE)
						{
							$data = array(

							'r_id' => $id,
							'p_id' => $this->input->post('p_id'),
							'qty'  => $this->input->post('p_qty'),
							);

							
							if($this->request_model->item_create($data))
							{
								$this->logme("Request item has been added. (RQ: ".$id." | Part Desc: ".$this->input->post('p_name')." | Qty: ".$this->input->post('p_qty')." ).",$this->ion_auth->user()->row()->id,"Request");
								$this->session->set_flashdata('message', $this->ion_auth->messages());

							
									$this->data['message_suc'] .= 'Item has been added.';
								
							}
							else
							{
								$this->session->set_flashdata('message', $this->ion_auth->errors());

								
									
									$this->data['message'] .= 'Failed to add the item.';
								
							}
						}
					}
				}
			}
			
           
		}

		// set the flash data error message if there is one
		$this->data['message'] .= validation_errors();

		// pass the user to the view
		$this->data['request_items'] = $this->request_model->get_request_items($id);
		foreach ($this->data['request_items'] as $k => $request)
        {
            $this->data['request_items'][$k]->parts = $this->parts_model->get_all($request->p_id);
			foreach ($this->data['request_items'][$k]->parts as $r => $part)
			{
				$this->data['request_items'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
			}
        }
		
		$this->data['requests'] = $this->request_model->get_all($id);
		foreach ($this->data['requests'] as $k => $request)
        {
		
			foreach ( $this->ion_auth->user($request->tech_id)->result() as $tech)
        	{
				$this->data['requests'][$k]->tech = $tech->first_name." ".$tech->last_name;
			}
			if($request->admin_id !=0){
				foreach ( $this->ion_auth->user($request->admin_id)->result() as $admin)
				{
					$this->data['requests'][$k]->admin = $admin->first_name." ".$admin->last_name;
				}
			}
			

        }

		
		
			$this->data['rqno'] = $id;

	
			$this->data['p_qty'] = array(
				'name'  => 'p_qty',
				'id'    => 'p_qty',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_qty'),
			);

			$this->data['p_name'] = array(
				'name'  => 'p_name',
				'id'    => 'p_name2',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_name'),
			);
			
            $this->data['p_id'] = array(
				'name'  => 'p_id',
				'id'    => 'p_id2',
                'type'  => 'hidden',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('p_id'),
			);
           
	
        /* Load Template */
		$this->template->admin_render('admin/request/item_list', $this->data);
	}


	public function getjobs($keyword){
    
        $data=$this->inandout_model->getjobs($keyword);        
        echo json_encode($data);
    }

	public function get_testno($keyword){
    
        $data=$this->inandout_model->get_testno($keyword);        
        echo json_encode($data);
    }
	public function getpartsname(){
        $keyword=$this->input->post('keyword');
        $data=$this->receiving_model->GetRow($keyword);        
        echo json_encode($data);
    }




	public function approval($id = NULL)
	{
		if ( ! $this->ion_auth->logged_in())
		{
            return show_error('Please login.');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Request Approval', 'admin/request/approval');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('confirm', 'lang:deactivate_validation_confirm_label', 'required');
		$this->form_validation->set_rules('id', 'lang:deactivate_validation_user_id_label', 'required|alpha_numeric');

		$id = (int) $id;

		$this->data['message'] = '';
		$this->data['message_suc'] = '';
		
		$request = $this->request_model->get_request($id);
	
		
		if ($this->form_validation->run() === TRUE)
		{

			if($this->ion_auth->is_admin()){ // admin approval
				if($request->tech_approval !="1"){
					$this->data['message'] = "This request is not yet approved by the owner of the request.";
				}else{
					if ($this->input->post('confirm') == 'yes')
					{
						if ($this->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
						{
							$this->data['message'] = $this->lang->line('error_csrf');
						}

						if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
						{
							if(!$this->request_model->approve_admin($id)){
								$this->data['message'] = '<p>Approved Failed.<br><h5>Cause(s):</h5><h5><i class="fa fa-remove"></i> Not enough stocks in the inventory. Please check your inventory.</h5><h5><i class="fa fa-remove"></i> Failed loading the modules. Please try to refresh the program.</h5></p>';
							}else{
								$this->logme("Request has been approved by the admin. (RQ: ".$id.").",$this->ion_auth->user()->row()->id,"Request");
								$this->data['message_suc'] = 'Approved Successful.';
							}

						} 
					}else if ($this->input->post('confirm') == 'no'){

						if ($this->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
						{
							$this->data['message'] = $this->lang->line('error_csrf'); 
						}

						if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
						{
							
							if(!$this->request_model->reject_admin($id)){
								$this->data['message'] = 'Reject Failed.';
							}else{
								$this->logme("Request has been rejected by the admin. (RQ: ".$id.").",$this->ion_auth->user()->row()->id,"Request");
								$this->data['message_suc'] = 'Reject Successful.';
							}
						}
					}
				}
			}else{ // tech approval
				if($request->admin_approval == 1 OR $request->admin_approval == "1"){
					$this->data['message'] = "This request is already approved by the administrator.";
				}else{
					if ($this->input->post('confirm') == 'yes')
					{
						if ($this->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
						{
							$this->data['message'] = $this->lang->line('error_csrf');
						}

						if ($this->ion_auth->logged_in())
						{
							if(!$this->request_model->approve_tech($id)){
								$this->data['message'] = 'Approved Failed.';
							}else{
								$this->logme("Request has been approved by the owner. (RQ: ".$id.").",$this->ion_auth->user()->row()->id,"Request");
								$this->data['message_suc'] = 'Approved Successful.';
							}

						} 
					}else if ($this->input->post('confirm') == 'no'){

						if ($this->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
						{
							$this->data['message'] = $this->lang->line('error_csrf'); 
						}

						if ($this->ion_auth->logged_in())
						{
							
							if(!$this->request_model->reject_tech($id)){
								$this->data['message'] = 'Reject Failed.';
							}else{
								$this->logme("Request has been rejected by the owner. (RQ: ".$id.").",$this->ion_auth->user()->row()->id,"Request");
								$this->data['message_suc'] = 'Reject Successful.';
							}
						} 
					}	
				}
			}
           
			
			
		}

		
		$this->data['request'] = $this->request_model->get_request($id);
		$user = $this->ion_auth->user($id)->row();
		$this->data['requests'] = $this->request_model->get_all($id);
		foreach ($this->data['requests'] as $k => $request)
        {
		
			foreach ( $this->ion_auth->user($request->tech_id)->result() as $tech)
        	{
				$this->data['requests'][$k]->tech = $tech->first_name." ".$tech->last_name;
			}
			if($request->admin_id !=0){
				foreach ( $this->ion_auth->user($request->admin_id)->result() as $admin)
				{
					$this->data['requests'][$k]->admin = $admin->first_name." ".$admin->last_name;
				}
			}
			

        }
		$request = $this->request_model->get_request($id);
		$this->data['tech_id'] = $request->tech_id;

		$this->data['csrf']       = $this->_get_csrf_nonce();
		$this->data['id']         = $id;

		 $this->template->admin_render('admin/request/approval', $this->data);
	}


	public function profile($id)
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/groups/profile');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Data */
        $id = (int) $id;

        $this->data['user_info'] = $this->ion_auth->user($id)->result();
        foreach ($this->data['user_info'] as $k => $user)
        {
            $this->data['user_info'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        /* Load Template */
		$this->template->admin_render('admin/users/profile', $this->data);
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}


	public function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
