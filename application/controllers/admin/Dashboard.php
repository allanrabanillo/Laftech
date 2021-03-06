<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper('number');
        $this->load->model('admin/dashboard_model');
      
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Title Page */
            $this->page_title->push(lang('menu_dashboard'));
            $this->data['pagetitle'] = $this->page_title->show();

            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['count_users']       = $this->dashboard_model->get_count_record('users');
            $this->data['count_critical_parts']   = $this->dashboard_model->get_count_critical_parts();
            $this->data['count_outofstock_parts']   = $this->dashboard_model->get_count_outofstock_parts();
            $this->data['count_pending_requests']   = $this->dashboard_model->get_count_pending_request();
            $this->data['count_jobs']   = $this->dashboard_model->get_count_jobs();
            $this->data['count_forinv_jobs']   = $this->dashboard_model->get_forinv_count_jobs();
            $this->data['count_fortest_jobs']   = $this->dashboard_model->get_fortest_count_jobs();
            $this->data['count_groups']      = $this->dashboard_model->get_count_record('groups');
            $this->data['disk_totalspace']   = $this->dashboard_model->disk_totalspace(DIRECTORY_SEPARATOR);
            $this->data['disk_freespace']    = $this->dashboard_model->disk_freespace(DIRECTORY_SEPARATOR);
            $this->data['disk_usespace']     = $this->data['disk_totalspace'] - $this->data['disk_freespace'];
            $this->data['disk_usepercent']   = $this->dashboard_model->disk_usepercent(DIRECTORY_SEPARATOR, FALSE);
            $this->data['memory_usage']      = $this->dashboard_model->memory_usage();
            $this->data['memory_peak_usage'] = $this->dashboard_model->memory_peak_usage(TRUE);
            $this->data['memory_usepercent'] = $this->dashboard_model->memory_usepercent(TRUE, FALSE);
            $this->data['users'] = $this->dashboard_model->top_user_login();
            $this->data['announcements']       = $this->dashboard_model->get_announcements();
            // foreach ($this->data['users'] as $k => $user)
            // {
            //     $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            // }
            /* Load Template */
            $this->template->admin_render('admin/dashboard/index', $this->data);
        }
	}

    public function notification()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Title Page */
            $this->page_title->push(lang('menu_dashboard'));
            $this->data['pagetitle'] = $this->page_title->show();

            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['count_users']       = $this->dashboard_model->get_count_record('users');
            $this->data['count_critical_parts']   = $this->dashboard_model->get_count_critical_parts();
            $this->data['count_outofstock_parts']   = $this->dashboard_model->get_count_outofstock_parts();
            $this->data['count_pending_requests']   = $this->dashboard_model->get_count_pending_request();
            $this->data['count_jobs']   = $this->dashboard_model->get_count_jobs();
            $this->data['count_forinv_jobs']   = $this->dashboard_model->get_forinv_count_jobs();
            $this->data['count_fortest_jobs']   = $this->dashboard_model->get_fortest_count_jobs();
            $this->data['count_groups']      = $this->dashboard_model->get_count_record('groups');
            $this->data['disk_totalspace']   = $this->dashboard_model->disk_totalspace(DIRECTORY_SEPARATOR);
            $this->data['disk_freespace']    = $this->dashboard_model->disk_freespace(DIRECTORY_SEPARATOR);
            $this->data['disk_usespace']     = $this->data['disk_totalspace'] - $this->data['disk_freespace'];
            $this->data['disk_usepercent']   = $this->dashboard_model->disk_usepercent(DIRECTORY_SEPARATOR, FALSE);
            $this->data['memory_usage']      = $this->dashboard_model->memory_usage();
            $this->data['memory_peak_usage'] = $this->dashboard_model->memory_peak_usage(TRUE);
            $this->data['memory_usepercent'] = $this->dashboard_model->memory_usepercent(TRUE, FALSE);
            $this->data['users'] = $this->dashboard_model->top_user_login();
            $this->data['announcements']       = $this->dashboard_model->get_announcements();
            // foreach ($this->data['users'] as $k => $user)
            // {
            //     $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            // }
            /* Load Template */
            $this->template->admin_render('admin/dashboard/index', $this->data);
        }
	}

    public function critical(){

        $data = array( 'result'=> false);

        if($this->dashboard_model->get_count_critical_parts() > 0){
            $data['result'] = true;
        }

        echo json_encode($data);
    }

    public function outofstock(){

        $data = array( 'result'=> false);

        if($this->dashboard_model->get_count_outofstock_parts() > 0){
            $data['result'] = true;
        }

        echo json_encode($data);
    }
}
