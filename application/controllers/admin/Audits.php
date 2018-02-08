<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audits extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push("Audit Trail","Traces the detailed transactions");
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, "Audit Trail", 'admin/audits');

        $this->load->model('admin/audits_model');
    }


	public function index()
	{
		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $audits = $this->audits_model->get_all();
            $this->data['audits'] = $this->audits_model->get_all();
            /* Load Template */
            $this->template->admin_render('admin/audits/index', $this->data);
        }
	}
}
