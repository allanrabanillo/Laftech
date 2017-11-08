<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InandOut extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');
        $this->load->model('admin/inandout_model');
        $this->load->model('admin/customers_model');
        /* Title Page :: Common */
        $this->page_title->push('In and Out');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'In and Out', 'admin/inandout');
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
            $this->data['jobs'] = $this->inandout_model->get_all();
            foreach ($this->data['jobs'] as $k => $job)
            {
                switch(strtoupper($job->status)){
                    case 'GOOD':
                    $this->data['jobs'][$k]->color = 'green';
                    break;
                    case 'FAILED':
                    $this->data['jobs'][$k]->color = 'red';
                    break;
                    case 'UNDERWARRANTY':
                    $this->data['jobs'][$k]->color = '#DCB239';
                    break;
                    case 'FORTEST':
                    $this->data['jobs'][$k]->color = 'orange';
                    break;
                    case 'NAU':
                    $this->data['jobs'][$k]->color = '#aa863a';
                    break;
                }
                
            }
            // foreach ($this->data['stocks'] as $k => $receive)
            // {
            //     $this->data['stocks'][$k]->parts = $this->parts_model->get_all($receive->p_id);
                    
            //         foreach ($this->data['stocks'][$k]->parts as $r => $part)
            //         {
            //             $stock = $receive->balance;
            //             $c_lvl = $part->p_c_level;
            //             if($stock > $c_lvl){
            //                 $this->data['stocks'][$k]->parts[$r]->s_color = 'green';
            //             }else if ($stock == $c_lvl ){
            //                 $this->data['stocks'][$k]->parts[$r]->s_color = 'orange';
            //             }else {
            //                 $this->data['stocks'][$k]->parts[$r]->s_color = 'red';
            //             }
            //             $this->data['stocks'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
            //         }
            // }

            /* Load Template */
            $this->template->admin_render('admin/inandout/index', $this->data);
        }
	}

	public function create(){

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() )
		{
			redirect('auth', 'refresh');
		}


		 /* Breadcrumbs */
		 $this->breadcrumbs->unshift(2, 'New Job', 'admin/inandout/create');
		 $this->data['breadcrumb'] = $this->breadcrumbs->show();
 
		 
		 
		 /* Validate form input */
		 $this->form_validation->set_rules('job_no', 'Job No', 'required');
		//  $this->form_validation->set_rules('item_desc', 'Item Desc', 'required');
		//  $this->form_validation->set_rules('partno', 'Part No', 'required');
		//  $this->form_validation->set_rules('date_in', 'Date In', 'required');
		//  $this->form_validation->set_rules('customer', 'lang:Customer', 'required');

         
        
		$this->data['message'] = '';
		 
		if ($this->form_validation->run() == TRUE)
		{
			if(isset($_POST) && ! empty($_POST) && $this->customers_model->check_customer($this->input->post('customer')) == false){
                $this->data['message'] .= 'Please input a valid Customer.';
            }else{

				if (!empty($_FILES['upload']['name'][0]))
            	{
					
					$images = $this->upload_files('./upload/job_pic/',$this->input->post('job_no'),$_FILES['upload']);
					$filenames = implode(',',$images);

				}else{
					$filenames = '';
				}

						$data = array(
							'job_no'  => $this->input->post('job_no'),
							'item_desc'  => $this->input->post('item_desc'),
							'serialno'  => $this->input->post('serialno'),
							'partno'  => $this->input->post('partno'),
							'modelno'  => $this->input->post('modelno'),
							'refno'  => $this->input->post('refno'),
							'date_in'  => $this->input->post('date_in'),
						
							'drno'  => $this->input->post('drno'),
							'status'  => $this->input->post('status'),
							'dn_no'  => $this->input->post('dn_no'),
							
							'remarks'  => $this->input->post('remarks'),
							'c_id'  => $this->input->post('c_id'),
							'images' => $filenames,
						);


					 	if($this->inandout_model->create($data)){
							$this->session->set_flashdata('message', $this->ion_auth->messages());
            				redirect('admin/inandout', 'refresh');
					 	}else{
							$this->data['message'] .= 'Something went wrong. Please try agian later.';
						}

					
				
			}
        
            // $this->session->set_flashdata('message', $this->ion_auth->messages());
            // redirect('admin/parts', 'refresh');
		}
		else
		{
			$this->data['message'] .= validation_errors();
		}

			$this->data['job_no'] = array(
				'name'  => 'job_no',
				'id'    => 'job_no',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('job_no'),
			);

            $this->data['upload'] = array(
				'name'  => 'upload[]',
				'id'    => 'upload',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('upload'),
				'multiple' => true,
			);

			$this->data['item_desc'] = array(
				'name'  => 'item_desc',
				'id'    => 'item_desc',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('item_desc'),
			);
			$this->data['serialno'] = array(
				'name'  => 'serialno',
				'id'    => 'serialno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('serialno'),
			);
			$this->data['partno'] = array(
				'name'  => 'partno',
				'id'    => 'partno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('partno'),
			);
				$this->data['modelno'] = array(
				'name'  => 'modelno',
				'id'    => 'modelno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('modelno'),
			);
				$this->data['refno'] = array(
				'name'  => 'refno',
				'id'    => 'refno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('refno'),
			);
				$this->data['date_in'] = array(
				'name'  => 'date_in',
				'id'    => 'date_in',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('date_in'),
			);
				$this->data['date_out'] = array(
				'name'  => 'date_out',
				'id'    => 'date_out',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('date_out'),
			);
				$this->data['drno'] = array(
				'name'  => 'drno',
				'id'    => 'drno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('drno'),
			);
			$status = array(""=>"Please select a status","GOOD"=>"GOOD","FAILED"=>"FAILED","UNDERWARRANTY"=>"UNDERWARRANTY","FORTEST"=>"FORTEST","NAU"=>"NAU");	
			$this->data['status'] = array(
				'name'  => 'status',
				'id'    => 'status',
				'class' => 'form-control',
				'options' => $status,
				
			);
				$this->data['dn_no'] = array(
				'name'  => 'dn_no',
				'id'    => 'dn_no',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('dn_no'),
			);
				$this->data['invno'] = array(
				'name'  => 'invno',
				'id'    => 'invno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('invno'),
			);
			$this->data['remarks'] = array(
				'name'  => 'remarks',
				'id'    => 'remarks',
				'type'  => 'text',
				'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('remarks'),
			);
			
			$this->data['customer'] = array(
				'name'  => 'customer',
				'id'    => 'customer',
                'type'  => 'text',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('customer'),
			);

            $this->data['c_id'] = array(
				'name'  => 'c_id',
				'id'    => 'c_id',
                'type'  => 'hidden',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('c_id'),
			);

			
			

			/* Load Template */
			$this->template->admin_render('admin/inandout/create', $this->data);

		

	}

	private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }

    public function getcustomersname(){
        $keyword=$this->input->post('keyword');
        $data=$this->customers_model->GetRow($keyword);        
        echo json_encode($data);
    }

    public function edit($id){
         $id = $id;

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id) )
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Job Info', 'admin/inandout/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
		/* Data */
		$jobs = $this->inandout_model->get_job($id);
      
        
		/* Validate form input */
		$this->form_validation->set_rules('item_desc', 'Item Desc', 'required');
        $this->form_validation->set_rules('partno', 'Part No', 'required');
        $this->form_validation->set_rules('date_in', 'Date In', 'required');
        $this->form_validation->set_rules('customer', 'lang:Customer', 'required');
	

		if (isset($_POST) && ! empty($_POST))
		{
           
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
				'item_desc'  => $this->input->post('item_desc'),
                'serialno'  => $this->input->post('serialno'),
                'partno'  => $this->input->post('partno'),
                'modelno'  => $this->input->post('modelno'),
                'refno'  => $this->input->post('refno'),
                'date_in'  => $this->input->post('date_in'),
                'date_out'  => $this->input->post('date_out'),
                'drno'  => $this->input->post('drno'),
                'status'  => $this->input->post('status'),
                'dn_no'  => $this->input->post('dn_no'),
                'invno'  => $this->input->post('invno'),
                'remarks'  => $this->input->post('remarks'),
                'c_id'  => $this->input->post('customer')
                
			);

                
                if($this->inandout_model->update($id, $data))
			    {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

				    if ($this->ion_auth->is_admin())
					{
						redirect('admin/inandout', 'refresh');
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
                        
						redirect('admin/inandout', 'refresh');
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
		
		    $this->data['job_no'] = $jobs->job_no;
				
			$this->data['item_desc'] = array(
				'name'  => 'item_desc',
				'id'    => 'item_desc',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('item_desc',$jobs->item_desc),
			);
            $this->data['serialno'] = array(
				'name'  => 'serialno',
				'id'    => 'serialno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('serialno',$jobs->serialno),
			);
            $this->data['partno'] = array(
				'name'  => 'partno',
				'id'    => 'partno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('partno',$jobs->partno),
			);
             $this->data['modelno'] = array(
				'name'  => 'modelno',
				'id'    => 'modelno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('modelno',$jobs->modelno),
			);
             $this->data['refno'] = array(
				'name'  => 'refno',
				'id'    => 'refno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('refno',$jobs->refno),
			);
             $this->data['date_in'] = array(
				'name'  => 'date_in',
				'id'    => 'date_in',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('date_in',$jobs->date_in),
			);
             $this->data['date_out'] = array(
				'name'  => 'date_out',
				'id'    => 'date_out',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('date_out',$jobs->date_out),
			);
             $this->data['drno'] = array(
				'name'  => 'drno',
				'id'    => 'drno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('drno',$jobs->drno),
			);
            $status = array(""=>"Please select a status","GOOD"=>"GOOD","FAILED"=>"FAILED","UNDERWARRANTY"=>"UNDERWARRANTY","FORTEST"=>"FORTEST","NAU"=>"NAU");	
			$this->data['status'] = array(
				'name'  => 'status',
				'id'    => 'status',
				'class' => 'form-control',
				'options' => $status,
				'selected' =>$jobs->status,
			);
             $this->data['dn_no'] = array(
				'name'  => 'dn_no',
				'id'    => 'dn_no',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('dn_no',$jobs->dn_no),
			);
             $this->data['invno'] = array(
				'name'  => 'invno',
				'id'    => 'invno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('invno',$jobs->invno),
			);
            $this->data['remarks'] = array(
				'name'  => 'remarks',
				'id'    => 'remarks',
				'type'  => 'text',
				'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('remarks',$jobs->remarks),
			);
            
			$this->data['customer'] = array(
				'name'  => 'customer',
				'id'    => 'customer',
                'type'  => 'text',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('customer'),
			);

            $this->data['c_id'] = array(
				'name'  => 'c_id',
				'id'    => 'c_id',
                'type'  => 'hidden',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('c_id'),
			);

            
            
	
        /* Load Template */
		$this->template->admin_render('admin/inandout/edit', $this->data);
    }


	
}
