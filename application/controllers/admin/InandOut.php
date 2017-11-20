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
        $this->load->model('admin/parts_model');
        $this->load->model('admin/categories_model');
       
        /* Title Page :: Common */
        $this->page_title->push('In and Out');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'In and Out', 'admin/inandout');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() )
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

		if ( ! $this->ion_auth->logged_in()  )
		{
			redirect('auth', 'refresh');
		}


		 /* Breadcrumbs */
		 $this->breadcrumbs->unshift(2, 'New Job', 'admin/inandout/create');
		 $this->data['breadcrumb'] = $this->breadcrumbs->show();
 
		 
		 
		 /* Validate form input */
		 $this->form_validation->set_rules('job_no', 'Job No', 'required');
		 $this->form_validation->set_rules('item_desc', 'Item Desc', 'required');
		 $this->form_validation->set_rules('partno', 'Part No', 'required');
		 $this->form_validation->set_rules('date_in', 'Date In', 'required');
		 $this->form_validation->set_rules('customer', 'lang:Customer', 'required');

         
        
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
		$this->load->library('image_lib');

		$images = array();
		
		foreach (glob($path.'*'.$title.'*') as $filename) {
			unlink($filename);
		}

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
                
				$image_data =   $this->upload->data();

				// $configer =  array(
				// 'image_library'   => 'gd2',
				// 'source_image'    =>  $image_data['full_path'],
				// 'maintain_ratio'  =>  TRUE,
				// 'width'           =>  500,
				// 'height'          =>  500,
				// );

				// $this->image_lib->clear();
				// $this->image_lib->initialize($configer);
				// $this->image_lib->resize();

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

	public function getjobs($keyword){
    
        $data=$this->inandout_model->getjobs($keyword);        
        echo json_encode($data);
    }

    public function edit($id)
	{

         $id = $id;

		if ( ! $this->ion_auth->logged_in()  OR ! $id OR empty($id) )
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Job Info', 'admin/inandout/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        
        
		/* Validate form input */
		$this->form_validation->set_rules('item_desc', 'Item Desc', 'required');
        $this->form_validation->set_rules('partno', 'Part No', 'required');
        $this->form_validation->set_rules('date_in', 'Date In', 'required');
        $this->form_validation->set_rules('customer2', 'lang:Customer', 'required');
	
		$this->data['message'] = '';
		$this->data['message_suc'] = '';

		if (isset($_POST) && ! empty($_POST))
		{

			if(isset($_POST) && ! empty($_POST) && $this->customers_model->check_customer($this->input->post('customer2')) == false){

                $this->data['message'] .= 'Please input a valid Customer.';

            }else{

				
           
					if ($this->form_validation->run() == TRUE)
					{

						if (!empty($_FILES['upload']['name'][0]))
						{
							
							$images = $this->upload_files('./upload/job_pic/',$id,$_FILES['upload']);
							$filenames = implode(',',$images);

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
								'date_inv'  => $this->input->post('date_inv'),
								'remarks'  => $this->input->post('remarks'),
								'c_id'  => $this->input->post('c_id'),
								'images' => $filenames
							);

						}else{

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
							'date_inv'  => $this->input->post('date_inv'),
							'remarks'  => $this->input->post('remarks'),
							'c_id'  => $this->input->post('c_id'),
							);
						}

						

						
						if($this->inandout_model->update($id, $data))
						{
							$this->session->set_flashdata('message', $this->ion_auth->messages());

							if ($this->ion_auth->is_admin())
							{
								$this->data['message_suc'] .= 'Update Successful.';
							}
							else
							{
								redirect('admin', 'refresh');
							}
						}
						else
						{
							$this->data['message'] .= "Nothing updated.";
						}
					}else{
							$this->data['message'] .= validation_errors();
					}

			}
		}

			// set the flash data error message if there is one
			
		
			

			// pass the user to the view

			/* Data */
			$jobs = $this->inandout_model->get_job($id);
			$customer = $this->customers_model->get_customer($jobs->c_id);
		
		    $this->data['job_no'] = $jobs->job_no;
		    $this->data['job_images'] = $jobs->images;
		

			if($this->ion_auth->is_admin()){
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
			$this->data['invno'] = array(
				'name'  => 'invno',
				'id'    => 'invno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('invno',$jobs->invno),
		
			);
			$this->data['date_inv'] = array(
				'name'  => 'date_inv',
				'id'    => 'date_inv',
				'type'  => 'text',
                'class' => 'form-control',
				'aria-describedby' => 'basic-addon1',
				'value' => $this->form_validation->set_value('date_inv',$jobs->date_inv),
		
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
            
			$this->data['customer2'] = array(
				'name'  => 'customer2',
				'id'    => 'customer2',
                'type'  => 'text',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('customer2',$customer->c_name),
		
			);

            $this->data['c_id'] = array(
				'name'  => 'c_id',
				'id'    => 'c_id',
                'type'  => 'hidden',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('c_id',$jobs->c_id),
				
			);
			}else{
				$this->data['upload'] = array(
				'name'  => 'upload[]',
				'id'    => 'upload',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('upload'),
				'multiple' => true,
				'disabled'=>true
			);
				
			$this->data['item_desc'] = array(
				'name'  => 'item_desc',
				'id'    => 'item_desc',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('item_desc',$jobs->item_desc),
				'disabled'=>true
			);
            $this->data['serialno'] = array(
				'name'  => 'serialno',
				'id'    => 'serialno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('serialno',$jobs->serialno),
				'disabled'=>true
			);
            $this->data['partno'] = array(
				'name'  => 'partno',
				'id'    => 'partno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('partno',$jobs->partno),
				'disabled'=>true
			);
             $this->data['modelno'] = array(
				'name'  => 'modelno',
				'id'    => 'modelno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('modelno',$jobs->modelno),
				'disabled'=>true
			);
             $this->data['refno'] = array(
				'name'  => 'refno',
				'id'    => 'refno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('refno',$jobs->refno),
				'disabled'=>true
			);
             $this->data['date_in'] = array(
				'name'  => 'date_in',
				'id'    => 'date_in',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('date_in',$jobs->date_in),
				'disabled'=>true
			);
             $this->data['date_out'] = array(
				'name'  => 'date_out',
				'id'    => 'date_out',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('date_out',$jobs->date_out),
				'disabled'=>true
			);
			$this->data['invno'] = array(
				'name'  => 'invno',
				'id'    => 'invno',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('invno',$jobs->invno),
				'disabled'=>true
			);
			$this->data['date_inv'] = array(
				'name'  => 'date_inv',
				'id'    => 'date_inv',
				'type'  => 'text',
                'class' => 'form-control',
				'aria-describedby' => 'basic-addon1',
				'value' => $this->form_validation->set_value('date_inv',$jobs->date_inv),
				'disabled'=>true
			);
             $this->data['drno'] = array(
				'name'  => 'drno',
				'id'    => 'drno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('drno',$jobs->drno),
				'disabled'=>true
			);
            $status = array(""=>"Please select a status","GOOD"=>"GOOD","FAILED"=>"FAILED","UNDERWARRANTY"=>"UNDERWARRANTY","FORTEST"=>"FORTEST","NAU"=>"NAU");	
			$this->data['status'] = array(
				'name'  => 'status',
				'id'    => 'status',
				'class' => 'form-control',
				'options' => $status,
				'selected' =>$jobs->status,
				'disabled'=>true
			);
             $this->data['dn_no'] = array(
				'name'  => 'dn_no',
				'id'    => 'dn_no',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('dn_no',$jobs->dn_no),
				'disabled'=>true
			);
             $this->data['invno'] = array(
				'name'  => 'invno',
				'id'    => 'invno',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('invno',$jobs->invno),
				'disabled'=>true
			);
            $this->data['remarks'] = array(
				'name'  => 'remarks',
				'id'    => 'remarks',
				'type'  => 'text',
				'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('remarks',$jobs->remarks),
				'disabled'=>true
			);
            
			$this->data['customer2'] = array(
				'name'  => 'customer2',
				'id'    => 'customer2',
                'type'  => 'text',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('customer2',$customer->c_name),
				'disabled'=>true
			);

            $this->data['c_id'] = array(
				'name'  => 'c_id',
				'id'    => 'c_id',
                'type'  => 'hidden',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('c_id',$jobs->c_id),
				'disabled'=>true
			
			);
			}
			

            
            
	
        /* Load Template */
		$this->template->admin_render('admin/inandout/edit', $this->data);
    }

	public function history($id)
	{

         $id = $id;

		if ( ! $this->ion_auth->logged_in()  OR ! $id OR empty($id) )
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Job History', 'admin/inandout/history');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		
		

		/* Validate form input */
		 $this->form_validation->set_rules('jobno', 'Job No', 'required');
	

         
        
		$this->data['message'] = '';
		$this->data['message_suc'] = '';
		 
		if ($this->form_validation->run() == TRUE)
		{
			if(isset($_POST) && ! empty($_POST) && $this->inandout_model->check_jobno($this->input->post('jobno')) == false){
                $this->data['message'] .= 'Please input a valid Job No.';
            }else{
				if($this->inandout_model->check_jobno_exist($id,$this->input->post('jobno'))){

					$this->data['message'] .= 'Job No: '.$this->input->post('jobno').' already existed.';
					
				}else{
						$data = array(
							'job_no'  => $id,
							'old_job_no'  => $this->input->post('jobno'),
							
						);

					 	if($this->inandout_model->history($data)){
							$this->data['message_suc'] .= 'Job No: '.$this->input->post('jobno').' has been successfully added.';


						}else{
							$this->data['message'] .= 'Failed adding the Job No.';
						}
				}
						
			}
		}else{
			$this->data['message'] .= validation_errors();
		}


		$jobs = $this->inandout_model->get_job($id);
		$this->data['history'] = $this->inandout_model->get_history($id);

		foreach ($this->data['history'] as $k => $history)
        {
                $this->data['history'][$k]->jobs = $this->inandout_model->get_job($history->old_job_no);

				
					switch(strtoupper($this->data['history'][$k]->jobs->status)){
						case 'GOOD':
						$this->data['history'][$k]->jobs->color = 'green';
						break;
						case 'FAILED':
						$this->data['history'][$k]->jobs->color = 'red';
						break;
						case 'UNDERWARRANTY':
						$this->data['history'][$k]->jobs->color = '#DCB239';
						break;
						case 'FORTEST':
						$this->data['history'][$k]->jobs->color = 'orange';
						break;
						case 'NAU':
						$this->data['history'][$k]->jobs->color = '#aa863a';
						break;
					}
				
				
				
				
        }
		
		$this->data['job_no'] = $jobs->job_no;
		$this->data['job_images'] = $jobs->images;

		$this->data['jobno'] = array(
				'name'  => 'jobno',
				'id'    => 'jobno',
                'type'  => 'text',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('jobno'),
		);

		$this->data['jobno_h'] = array(
				'name'  => 'jobno_h',
				'id'    => 'jobno_h',
                'type'  => 'hidden',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('jobno_h',$jobs->job_no),
		);





		$this->template->admin_render('admin/inandout/history', $this->data);
	}


	public function traveller($id)
	{

         $id = $id;

		if ( ! $this->ion_auth->logged_in()  OR ! $id OR empty($id) )
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Job Traveller', 'admin/inandout/traveller');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		 $this->form_validation->set_rules('test_no', 'Test No', 'required|numeric');
		 //$this->form_validation->set_rules('item_desc', 'Item Desc', 'required');

		 $this->data['message'] = '';

		 if ($this->form_validation->run() == TRUE)
		{
			if($this->inandout_model->check_testno_exist($id,$this->input->post('jobno'))){

				$this->data['message'] .= 'Test No already existed.';
			}else{
				$data = array(
							'job_no'  => $id,
							'test_no'  => $this->input->post('test_no'),
							't_remarks'  => $this->input->post('remarks'),
							't_user' => $this->ion_auth->user()->row()->id,
						);

					 	if($this->inandout_model->insertTraveller($data)){
							$this->data['message_suc'] .= 'Test No: '.$this->input->post('test_no').' has been successfully added.';


						}else{
							$this->data['message'] .= 'Failed adding Test: '.$this->input->post('test_no').'.';
						}
			}

		}else{
			$this->data['message'] .= validation_errors();
		}



		$jobs = $this->inandout_model->get_job($id);
		$this->data['travellers'] = $this->inandout_model->get_traveller($id);
		foreach ($this->data['travellers'] as $k => $traveller)
        {
                $this->data['travellers'][$k]->users = $this->ion_auth->user($traveller->t_user)->result();
        }


		$this->data['job_no'] = $jobs->job_no;
		$this->data['job_images'] = $jobs->images;

		$this->data['test_no'] = array(
				'name'  => 'test_no',
				'id'    => 'test_no',
                'type'  => 'text',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('test_no'),
		);

		$this->data['remarks'] = array(
				'name'  => 'remarks',
				'id'    => 'remarks',
				'type'  => 'text',
				'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('remarks'),
			);


		$this->template->admin_render('admin/inandout/traveller', $this->data);
	}

	public function travellertest($id,$testno){
		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}

		$this->breadcrumbs->unshift(2, 'Job Test', 'admin/inandout/traveller');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		 $this->form_validation->set_rules('test_no', 'Test No', 'required|numeric');
		 //$this->form_validation->set_rules('item_desc', 'Item Desc', 'required');

		 $this->data['message'] = '';

		 if ($this->form_validation->run() == TRUE)
		{
			// if($this->inandout_model->check_testno_exist($id,$this->input->post('jobno'))){

			// 	$this->data['message'] .= 'Test No already existed.';
			// }else{
						$data = array(
					
							't_remarks'  => $this->input->post('remarks'),
						);

					 	if($this->inandout_model->updateTraveller($id,$testno,$data)){
							$this->data['message_suc'] .= 'Test No: '.$this->input->post('test_no').' has been successfully updated.';


						}else{
							$this->data['message'] .= 'Failed updating Test: '.$this->input->post('test_no').'.';
						}
			//}

		}else{
			$this->data['message'] .= validation_errors();
		}



		
		
		

		$jobs = $this->inandout_model->get_job($id);
		$traveller = $this->inandout_model->get_test($id,$testno);
		

		$this->data['traveller_items'] = $this->inandout_model->get_traveller_items($id,$testno);
		foreach ($this->data['traveller_items'] as $k => $item)
        {
            $this->data['traveller_items'][$k]->parts = $this->parts_model->get_all($item->p_id);
			foreach ($this->data['traveller_items'][$k]->parts as $r => $part)
			{
				$this->data['traveller_items'][$k]->parts[$r]->categories = $this->categories_model->get_all($part->cat_id);
			}
        }


		$this->data['job_no'] = $jobs->job_no;
		$this->data['job_images'] = $jobs->images;

		$this->data['test_no'] = array(
				'name'  => 'test_no',
				'id'    => 'test_no',
                'type'  => 'text',
				'class' => 'form-control',
                'value' => $this->form_validation->set_value('test_no',$traveller->test_no),
				'readonly' => true
		);

		$this->data['remarks'] = array(
				'name'  => 'remarks',
				'id'    => 'remarks',
				'type'  => 'text',
				'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('remarks',$traveller->t_remarks),
			);
		

		$this->template->admin_render('admin/inandout/travellertest', $this->data);
	}

	public function drawing($id)
	{

         $id = $id;

		if ( ! $this->ion_auth->logged_in()  OR ! $id OR empty($id) )
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Job Drawing', 'admin/inandout/drawing');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		$this->data['message_suc'] = "";
		$this->data['message'] = "";

			if (!empty($_FILES['upload']['name'][0]))
			{
							
				$images = $this->upload_files('./upload/drawing/',$id,$_FILES['upload']);
				$filenames = implode(',',$images);

				$data = array(
					'drawing' => $filenames
				);

				if($this->inandout_model->update($id, $data))
				{
					$this->session->set_flashdata('message', $this->ion_auth->messages());

					if ($this->ion_auth->is_admin())
					{
						$this->data['message_suc'] .= 'Update Successful.';
					}
					else
					{
						redirect('admin', 'refresh');
					}

				}else{
					$this->data['message'] .= "Nothing updated.";
				}

			}

		$jobs = $this->inandout_model->get_job($id);

		$this->data['job_no'] = $jobs->job_no;
		$this->data['job_images'] = $jobs->images;
		$this->data['job_drawing'] = $jobs->drawing;


		$this->data['upload'] = array(
				'name'  => 'upload[]',
				'id'    => 'upload',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('upload'),
				'multiple' => true,
			);

		$this->template->admin_render('admin/inandout/drawing', $this->data);
	}
	
}
