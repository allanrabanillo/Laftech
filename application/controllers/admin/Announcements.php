<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');
        $this->load->model('admin/announcements_model');
        /* Title Page :: Common */
        $this->page_title->push('Annoucements','Create, Update and Delete announcements');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Annoucements', 'admin/announcements');
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
            $this->data['announcements'] = $this->announcements_model->get_all();

            /* Load Template */
            $this->template->admin_render('admin/announcements/index', $this->data);
        }
	}


	public function create()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create announcement', 'admin/announcements/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		// $tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('a_title', 'Title', 'required|is_unique[announcements.a_title]');
		$this->form_validation->set_rules('a_message', 'Message', 'required');
	

		// if ($this->form_validation->run() == TRUE)
		// {
		// 	$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
		// 	$email    = strtolower($this->input->post('email'));
		// 	$password = $this->input->post('password');

			$data = array(
				'a_title' => $this->input->post('a_title'),
				'a_message'  => $this->input->post('a_message'),
		
				
			);
		

		if ($this->form_validation->run() == TRUE && $this->announcements_model->create($data))
		{
			$this->logme("New announcement created (Title: ".$this->input->post('a_title')."|Message: ".$this->input->post('a_message').").",$this->ion_auth->user()->row()->id,"Announcements");
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/announcements', 'refresh');
		}
		else
		{
            $this->data['message'] = validation_errors();

			$this->data['a_title'] = array(
				'name'  => 'a_title',
				'id'    => 'a_title',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('a_title'),
			);
			$this->data['a_message'] = array(
				'name'  => 'a_message',
				'id'    => 'a_message',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('a_message'),
			);
		

            /* Load Template */
            $this->template->admin_render('admin/announcements/create', $this->data);
        }
	}


	public function delete($id)
	{
        $announcement = $this->announcements_model->get_ann($id);
        $data = array(
			'a_id' => $id
		);
		$mes = '';

		if($this->ion_auth->is_admin()){
			if(!$this->announcements_model->delete($data,$id)){
				$mes = "Unable to remove announcement.";
			}else{
				$this->logme("Announcement deleted (Title: ".$announcement->a_title." |  Message: ".$announcement->a_message.").",$this->ion_auth->user()->row()->id,"Announcements");
				$mes = 'success';
			}
			
		}else{
			$mes = "You need administrator rights to delete announcement.";
		}
		
		

		echo $mes;
	}


	public function edit($id)
	{
        $id = (int) $id;

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Edit announcement', 'admin/announcements/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
		/* Data */
		$announcement = $this->announcements_model->get_ann($id);
        
		/* Validate form input */
		$this->form_validation->set_rules('a_title', 'Title', 'required');
		$this->form_validation->set_rules('a_message', 'Message', 'required');
	

		if (isset($_POST) && ! empty($_POST))
		{
           
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'a_title' => $this->input->post('a_title'),
					'a_message'  => $this->input->post('a_message'),
					
				);

                
                if($this->announcements_model->update($id, $data))
			    {
					$this->logme("Announcement updated FROM (Title: ".$announcement->a_title."|Message: ".$announcement->a_message.") TO (Title: ".$this->input->post('a_title')."|Message: ".$this->input->post('a_message').").",$this->ion_auth->user()->row()->id,"Announcements");
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

				    if ($this->ion_auth->is_admin())
					{
						redirect('admin/announcements', 'refresh');
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
                        
						redirect('admin/announcements', 'refresh');
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
		
		

		$this->data['a_title'] = array(
				'name'  => 'a_title',
				'id'    => 'a_title',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('a_title',$announcement->a_title),
			);
			$this->data['a_message'] = array(
				'name'  => 'a_message',
				'id'    => 'a_message',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('a_message',$announcement->a_message),
			);
	
        /* Load Template */
		$this->template->admin_render('admin/announcements/edit', $this->data);
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
