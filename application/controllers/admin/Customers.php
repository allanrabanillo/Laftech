<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');
        $this->load->model('admin/customers_model');
        /* Title Page :: Common */
        $this->page_title->push('Customers','Create or Update customer details.');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Customers', 'admin/customers');
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
            $this->data['customers'] = $this->customers_model->get_all();

            /* Load Template */
            $this->template->admin_render('admin/customers/index', $this->data);
        }
	}


	public function create()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create customer', 'admin/categories/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		// $tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('c_name', 'Company Name', 'required');
		$this->form_validation->set_rules('c_person', 'Contact Person', 'required');
		$this->form_validation->set_rules('c_contactno', 'Contact No', 'numeric');
		$this->form_validation->set_rules('c_email', 'Email Address', 'valid_email');
	

		// if ($this->form_validation->run() == TRUE)
		// {
		// 	$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
		// 	$email    = strtolower($this->input->post('email'));
		// 	$password = $this->input->post('password');

			$data = array(
				'c_name' => $this->input->post('c_name'),
				'c_person'  => $this->input->post('c_person'),
				'c_address'  => $this->input->post('c_address'),
				'c_contactno'  => $this->input->post('c_contactno'),
				'email'  => $this->input->post('c_email'),

				
			);
		

		if ($this->form_validation->run() == TRUE && $this->customers_model->create($data))
		{
			$this->logme("New customer created (Name: ".$this->input->post('c_name')."|Contact Person: ".$this->input->post('c_person')."|Address: ".$this->input->post('c_address')."|Contact No: ".$this->input->post('c_contactno')."|Email : ".$this->input->post('c_email').").",$this->ion_auth->user()->row()->id,"Customers");
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/customers', 'refresh');
		}
		else
		{
            $this->data['message'] = validation_errors();

			$this->data['c_name'] = array(
				'name'  => 'c_name',
				'id'    => 'c_name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('c_name'),
			);
			$this->data['c_person'] = array(
				'name'  => 'c_person',
				'id'    => 'c_person',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('c_person'),
			);
			$this->data['c_address'] = array(
				'name'  => 'c_address',
				'id'    => 'c_address',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('c_address'),
			);
			$this->data['c_contactno'] = array(
				'name'  => 'c_contactno',
				'id'    => 'c_contactno',
				'type'  => 'phone',
				'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('c_contactno'),
			);
			$this->data['c_email'] = array(
				'name'  => 'c_email',
				'id'    => 'c_email',
				'type'  => 'email',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('c_email'),
			);
		

            /* Load Template */
            $this->template->admin_render('admin/customers/create', $this->data);
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

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Edit customer', 'admin/customer/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
		/* Data */
		$customer = $this->customers_model->get_customer($id);
        
		/* Validate form input */
		$this->form_validation->set_rules('c_name', 'Company Name', 'required');
		$this->form_validation->set_rules('c_person', 'Contact Person', 'required');
		$this->form_validation->set_rules('c_contactno', 'Contact No', 'numeric');
		$this->form_validation->set_rules('c_email', 'Email Address', 'valid_email');
	

		if (isset($_POST) && ! empty($_POST))
		{
           
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'c_name' => $this->input->post('c_name'),
					'c_person'  => $this->input->post('c_person'),
					'c_address'  => $this->input->post('c_address'),
					'c_contactno'  => $this->input->post('c_contactno'),
					'email'  => $this->input->post('c_email'),				
				);

                
                if($this->customers_model->update($id, $data))
			    {
					$this->logme("Customer detail updated FROM (Name: ".$customer->c_name."|Contact Person: ".$customer->c_person."|Address: ".$customer->c_address."|Contact No: ".$customer->c_contactno."|Email : ".$customer->email.") TO (Name: ".$this->input->post('c_name')."|Contact Person: ".$this->input->post('c_person')."|Address: ".$this->input->post('c_address')."|Contact No: ".$this->input->post('c_contactno')."|Email : ".$this->input->post('c_email').").",$this->ion_auth->user()->row()->id,"Customers");
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

				    if ($this->ion_auth->is_admin())
					{
						redirect('admin/customers', 'refresh');
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
                        
						redirect('admin/customers', 'refresh');
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
	

		$this->data['c_name'] = array(
			'name'  => 'c_name',
			'id'    => 'c_name',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('c_name',$customer->c_name),
		);
		$this->data['c_person'] = array(
			'name'  => 'c_person',
			'id'    => 'c_person',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('c_person',$customer->c_person),
		);
		$this->data['c_address'] = array(
			'name'  => 'c_address',
			'id'    => 'c_address',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('c_address',$customer->c_address),
		);
		$this->data['c_contactno'] = array(
			'name'  => 'c_contactno',
			'id'    => 'c_contactno',
			'type'  => 'phone',
			'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('c_contactno',$customer->c_contactno),
		);
		$this->data['c_email'] = array(
			'name'  => 'c_email',
			'id'    => 'c_email',
			'type'  => 'email',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('c_email',$customer->email),
		);
	
        /* Load Template */
		$this->template->admin_render('admin/customers/edit', $this->data);
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
