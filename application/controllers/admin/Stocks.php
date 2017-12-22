<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');
        $this->load->model('admin/stocks_model');
        $this->load->model('admin/parts_model');
        $this->load->model('admin/categories_model');
        /* Title Page :: Common */
        $this->page_title->push('Stocks','Show(s) all the available inventory.');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Stocks', 'admin/receiving');
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
            $this->data['stocks'] = $this->stocks_model->get_all();
            foreach ($this->data['stocks'] as $k => $receive)
            {
                $this->data['stocks'][$k]->parts = $this->parts_model->get_all($receive->p_id);
                    
                    foreach ($this->data['stocks'][$k]->parts as $r => $part)
                    {
                        $stock = $receive->balance;
                        $c_lvl = $part->p_c_level;
                        if($stock > $c_lvl){
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'green';
                        }else if ($stock == $c_lvl ){
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'orange';
                        }else {
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'red';
                        }
                        $this->data['stocks'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
                    }
            }

            /* Load Template */
            $this->template->admin_render('admin/stocks/index', $this->data);
        }
	}

    public function critical()
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
            $this->data['stocks'] = $this->stocks_model->get_critical();
            foreach ($this->data['stocks'] as $k => $receive)
            {
                $this->data['stocks'][$k]->parts = $this->parts_model->get_all($receive->p_id);
                    
                    foreach ($this->data['stocks'][$k]->parts as $r => $part)
                    {
                        $stock = $receive->balance;
                        $c_lvl = $part->p_c_level;
                        if($stock > $c_lvl){
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'green';
                        }else if ($stock == $c_lvl ){
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'orange';
                        }else {
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'red';
                        }
                        $this->data['stocks'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
                    }
            }

            /* Load Template */
            $this->template->admin_render('admin/stocks/index', $this->data);
        }
    }

    public function outofstock()
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
            $this->data['stocks'] = $this->stocks_model->get_outofstock();
            foreach ($this->data['stocks'] as $k => $receive)
            {
                $this->data['stocks'][$k]->parts = $this->parts_model->get_all($receive->p_id);
                    
                    foreach ($this->data['stocks'][$k]->parts as $r => $part)
                    {
                        $stock = $receive->balance;
                        $c_lvl = $part->p_c_level;
                        if($stock > $c_lvl){
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'green';
                        }else if ($stock == $c_lvl ){
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'orange';
                        }else {
                            $this->data['stocks'][$k]->parts[$r]->s_color = 'red';
                        }
                        $this->data['stocks'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
                    }
            }

            /* Load Template */
            $this->template->admin_render('admin/stocks/index', $this->data);
        }
    }


	
}
