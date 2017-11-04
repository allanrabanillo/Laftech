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
        $this->page_title->push('Customers');
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
		$this->form_validation->set_rules('category_name', 'lang:category_name', 'required');
		$this->form_validation->set_rules('category_desc', 'lang:category_desc', 'required');
	

		// if ($this->form_validation->run() == TRUE)
		// {
		// 	$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
		// 	$email    = strtolower($this->input->post('email'));
		// 	$password = $this->input->post('password');

			$data = array(
				'cat_name' => $this->input->post('category_name'),
				'cat_desc'  => $this->input->post('category_desc'),
				
			);
		

		if ($this->form_validation->run() == TRUE && $this->categories_model->create($data))
		{
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/categories', 'refresh');
		}
		else
		{
            $this->data['message'] = validation_errors();

			$this->data['category_name'] = array(
				'name'  => 'category_name',
				'id'    => 'category_name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('category_name'),
			);
			$this->data['category_desc'] = array(
				'name'  => 'category_desc',
				'id'    => 'category_desc',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('category_desc'),
			);
		

            /* Load Template */
            $this->template->admin_render('admin/categories/create', $this->data);
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
        $this->breadcrumbs->unshift(2, 'Edit category', 'admin/categories/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
		/* Data */
		$category = $this->categories_model->get_cat($id);
        
		/* Validate form input */
		$this->form_validation->set_rules('category_name', 'lang:category_name', 'required');
		$this->form_validation->set_rules('category_desc', 'lang:category_desc', 'required');
	

		if (isset($_POST) && ! empty($_POST))
		{
           
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'cat_name' => $this->input->post('category_name'),
					'cat_desc'  => $this->input->post('category_desc'),
				);

                
                if($this->categories_model->update($id, $data))
			    {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

				    if ($this->ion_auth->is_admin())
					{
						redirect('admin/categories', 'refresh');
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
                        
						redirect('admin/categories', 'refresh');
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
		$this->data['category_name']        = $category->cat_name;
		$this->data['category_desc']        = $category->cat_desc;
		

		$this->data['category_name'] = array(
			'name'  => 'category_name',
			'id'    => 'category_name',
			'type'  => 'text',
            'class' => 'form-control',
			'value' => $this->form_validation->set_value('category_name', $category->cat_name)
		);
		$this->data['category_desc'] = array(
			'name'  => 'category_desc',
			'id'    => 'category_desc',
			'type'  => 'text',
            'class' => 'form-control',
			'value' => $this->form_validation->set_value('category_desc', $category->cat_desc)
		);
	
        /* Load Template */
		$this->template->admin_render('admin/categories/edit', $this->data);
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
