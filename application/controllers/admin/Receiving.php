<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiving extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');
        $this->load->model('admin/receiving_model');
        $this->load->model('admin/parts_model');
        $this->load->model('admin/categories_model');
        /* Title Page :: Common */
        $this->page_title->push('Receiving','Receive a new stock.');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Receiving', 'admin/receiving');
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
            $this->data['receives'] = $this->receiving_model->get_all();
            foreach ($this->data['receives'] as $k => $receive)
            {
                $this->data['receives'][$k]->parts = $this->parts_model->get_all($receive->p_id);
                 
                    foreach ($this->data['receives'][$k]->parts as $r => $part)
                    {
                        $this->data['receives'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
                    }
            }

            /* Load Template */
			
            $this->template->admin_render('admin/receiving/index', $this->data);
        }
	}


	public function create()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'New stock', 'admin/receiving/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		// $tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('p_name', 'lang:Item Name', 'required');
		$this->form_validation->set_rules('qty', 'lang:Quatity', 'required');
	

			$data = array(
				'p_id' => $this->input->post('p_id'),
				'qty'  => $this->input->post('qty'),
				'p_supplier'  => $this->input->post('p_supplier'),
				'qtyout'  => 0,
                's_date' => date('Y-m-d H:i:s'),
                's_by' => $this->ion_auth->user()->row()->username,
			);
		
		if ($this->form_validation->run() == TRUE && $this->parts_model->check_part($this->input->post('p_name'))  && $this->receiving_model->create($data))
		{
			$this->logme("New Stock has been added. (PartNo/Desc: ".$this->input->post('p_name')." | Quantity: ".$this->input->post('qty')." | Supplier: ".$this->input->post('p_supplier')." ).",$this->ion_auth->user()->row()->id,"Receiving");
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/receiving', 'refresh');
		}
		else
		{
            
            $this->data['message'] = validation_errors();
            if(isset($_POST) && ! empty($_POST) && $this->parts_model->check_part($this->input->post('p_name')) == false){
                $this->data['message'] .= 'Please input a valid Part Desc.';
            }
            
			$this->data['p_name'] = array(
				'name'  => 'p_name',
				'id'    => 'p_name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_name'),
			);
			$this->data['p_supplier'] = array(
				'name'  => 'p_supplier',
				'id'    => 'p_supplier',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('p_supplier'),
			);
			$this->data['qty'] = array(
				'name'  => 'qty',
				'id'    => 'qty',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('qty'),
			);
            $this->data['p_id'] = array(
				'name'  => 'p_id',
				'id'    => 'p_id',
                'type'  => 'hidden',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('p_id'),
			);
            /* Load Template */
            $this->template->admin_render('admin/receiving/create', $this->data);
        }
	}




	public function delete($id)
	{

		$received = $this->receiving_model->get_received($id);
        $data = array(
			's_id' => $id
		);
		$mes = '';

		if($this->ion_auth->is_admin()){
			if(!$this->receiving_model->delete($data,$id)){
				$mes = "Unable to undo receive.";
			}else{
				$this->logme("Undo Received (PartNo/Desc: ".$received->p_desc." Quantity: ".$received->qty." DateReceived: ".$received->s_date.").",$this->ion_auth->user()->row()->id,"Receiving");
				$mes = 'success';
			}
			
		}else{
			$mes = "You need administrator rights to undo received.";
		}
		
		

		echo $mes;
	}

     public function getpartsname(){
        $keyword=$this->input->post('keyword');
        $data=$this->receiving_model->GetRow($keyword);        
        echo json_encode($data);
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
