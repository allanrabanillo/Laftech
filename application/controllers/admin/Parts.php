<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');
        $this->load->model('admin/parts_model');
        $this->load->model('admin/categories_model');
        /* Title Page :: Common */
        $this->page_title->push('Parts','Create or Update parts details.');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Parts', 'admin/parts');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Get all categories */
            $this->data['parts'] = $this->parts_model->get_all();
            foreach ($this->data['parts'] as $k => $part)
            {
                $this->data['parts'][$k]->categories = $this->categories_model->get_all($part->cat_id);
            }

            /* Load Template */
            $this->template->admin_render('admin/parts/index', $this->data);
        }
	}


	public function create()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create part', 'admin/parts/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		// $tables = $this->config->item('tables', 'ion_auth');
        $cat = $this->categories_model->get_all();
        

		/* Validate form input */
		$this->form_validation->set_rules('p_desc', 'lang:Description', 'required|is_unique[parts.p_desc]');
		$this->form_validation->set_rules('p_boxno', 'lang:Box No', 'required');
        $this->form_validation->set_rules('p_type', 'lang:Type', 'required');
        $this->form_validation->set_rules('p_scode', 'Stock Code', 'is_unique[parts.p_scode]');
        $this->form_validation->set_rules('p_critical', 'Critical Level', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('p_category', 'lang:Category', 'required');
	

		// if ($this->form_validation->run() == TRUE)
		// {
		// 	$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
		// 	$email    = strtolower($this->input->post('email'));
		// 	$password = $this->input->post('password');

			$data = array(
				'p_desc' => $this->input->post('p_desc'),
				'p_boxno'  => $this->input->post('p_boxno'),
                'p_type'  => $this->input->post('p_type'),
                'p_c_level'  => $this->input->post('p_critical'),
                'cat_id'  => $this->input->post('p_category'),
				'p_package' => $this->input->post('p_package'),
				'p_scode' => $this->input->post('p_scode'),
                
			);
		

		if ($this->form_validation->run() == TRUE && $this->parts_model->create($data))
		{
			$this->logme("New Part created (PartNo/Desc: ".$this->input->post('p_desc')."|BoxNo: ".$this->input->post('p_boxno')."|Type: ".$this->input->post('p_type')."|Package:".$this->input->post('p_package')."|Critical Level:".$this->input->post('p_critical').").",$this->ion_auth->user()->row()->id,"Parts");
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/parts', 'refresh');
		}
		else
		{
            $this->data['message'] = validation_errors();

			$this->data['p_desc'] = array(
				'name'  => 'p_desc',
				'id'    => 'p_desc',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_desc'),
			);
			$this->data['p_boxno'] = array(
				'name'  => 'p_boxno',
				'id'    => 'p_boxno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_boxno'),
			);
            $this->data['p_type'] = array(
				'name'  => 'p_type',
				'id'    => 'p_type',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_type'),
			);
			 $this->data['p_package'] = array(
				'name'  => 'p_package',
				'id'    => 'p_package',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_package'),
			);
			 $this->data['p_scode'] = array(
				'name'  => 'p_scode',
				'id'    => 'p_scode',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_scode'),
			);
            $this->data['p_critical'] = array(
				'name'  => 'p_critical',
				'id'    => 'p_critical',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_critical'),
			);

			$options = array();
			$options[''] = 'Please select a category';
            foreach($cat as $category){
                $options[$category->cat_id] = $category->cat_name;
			}
			
			$this->data['p_category'] = array(
				'name'  => 'p_category',
				'id'    => 'p_category',
				'class' => 'form-control',
				'options' => $options,
			);

           	

            /* Load Template */
            $this->template->admin_render('admin/parts/create', $this->data);
        }
	}


	public function delete()
	{
        /* Load Template */
		$this->template->admin_render('admin/users/delete', $this->data);
	}


	public function edit($id)
	{
        $id = (int) $id;

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id) )
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Edit part', 'admin/parts/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
		/* Data */
		$parts = $this->parts_model->get_part($id);
        $cat = $this->categories_model->get_all();
        
		/* Validate form input */
		$this->form_validation->set_rules('p_desc', 'lang:Description', 'required');
		$this->form_validation->set_rules('p_boxno', 'lang:Box No', 'required|numeric');
        $this->form_validation->set_rules('p_type', 'lang:Type', 'required');
        // $this->form_validation->set_rules('p_scode', 'Stock Code', 'edit_unique[parts.p_scode.'.$parts->p_scode.']');
        $this->form_validation->set_rules('p_critical', 'Critical Level', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('p_category', 'lang:Category', 'required');
	

		if (isset($_POST) && ! empty($_POST))
		{
           
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
				'p_desc' => $this->input->post('p_desc'),
				'p_boxno'  => $this->input->post('p_boxno'),
                'p_type'  => $this->input->post('p_type'),
                'p_c_level'  => $this->input->post('p_critical'),
                'cat_id'  => $this->input->post('p_category'),
				'p_package'  => $this->input->post('p_package'),
				'p_scode' => $this->input->post('p_scode'),
                
			);

                
                if($this->parts_model->update($id, $data))
			    {
					$this->logme("Update Part FROM (PartNo/Desc: ".$parts->p_desc."|BoxNo: ".$parts->p_boxno."|Type: ".$parts->p_type."|Package:".$parts->p_package."|Critical Level:".$parts->p_c_level.") TO (PartNo/Desc: ".$this->input->post('p_desc')."|BoxNo: ".$this->input->post('p_boxno')."|Type: ".$this->input->post('p_type')."|Package:".$this->input->post('p_package')."|Critical Level:".$this->input->post('p_critical').").",$this->ion_auth->user()->row()->id,"Parts");
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

				    if ($this->ion_auth->is_admin())
					{
						redirect('admin/parts', 'refresh');
					}
					else
					{
						redirect('admin', 'refresh');
					}
			    }
			    else
			    {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());

				    if ($this->ion_auth->is_admin())
					{
                        
						redirect('admin/parts', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}
			    }
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = validation_errors();

		// pass the user to the view
		
       
		

		    $this->data['p_desc'] = array(
				'name'  => 'p_desc',
				'id'    => 'p_desc',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_desc',$parts->p_desc),
			);
			$this->data['p_boxno'] = array(
				'name'  => 'p_boxno',
				'id'    => 'p_boxno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_boxno',$parts->p_boxno),
			);
            $this->data['p_type'] = array(
				'name'  => 'p_type',
				'id'    => 'p_type',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_type',$parts->p_type),
			);
			$this->data['p_scode'] = array(
				'name'  => 'p_scode',
				'id'    => 'p_scode',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_scode',$parts->p_scode),
			);
			$this->data['p_package'] = array(
				'name'  => 'p_package',
				'id'    => 'p_package',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_package',$parts->p_package),
			);
            $this->data['p_critical'] = array(
				'name'  => 'p_critical',
				'id'    => 'p_critical',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_critical',$parts->p_c_level),
			);
            
			$options = array();
			$options[''] = 'Please select a category';
            foreach($cat as $category){
                $options[$category->cat_id] = $category->cat_name;
			}
			
			$this->data['p_category'] = array(
				'name'  => 'p_category',
				'id'    => 'p_category',
				'class' => 'form-control',
				'options' => $options,
				'selected' =>$parts->cat_id,
			);
            
	
        /* Load Template */
		$this->template->admin_render('admin/parts/edit', $this->data);
	}


	function activate($id, $code = FALSE)
	{
        $id = (int) $id;

		if ($code !== FALSE)
		{
            $activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/users', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('auth/forgot_password', 'refresh');
		}
	}


	public function deactivate($id = NULL)
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
            return show_error('You must be an administrator to view this page.');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_users_deactivate'), 'admin/users/deactivate');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('confirm', 'lang:deactivate_validation_confirm_label', 'required');
		$this->form_validation->set_rules('id', 'lang:deactivate_validation_user_id_label', 'required|alpha_numeric');

		$id = (int) $id;

		if ($this->form_validation->run() === FALSE)
		{
			$user = $this->ion_auth->user($id)->row();

            $this->data['csrf']       = $this->_get_csrf_nonce();
            $this->data['id']         = (int) $user->id;
            $this->data['firstname']  = ! empty($user->first_name) ? htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') : NULL;
            $this->data['lastname']   = ! empty($user->last_name) ? ' '.htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8') : NULL;

            /* Load Template */
            $this->template->admin_render('admin/users/deactivate', $this->data);
		}
		else
		{
            if ($this->input->post('confirm') == 'yes')
			{
                if ($this->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
				{
                    show_error($this->lang->line('error_csrf'));
				}

                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			redirect('admin/users', 'refresh');
		}
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
