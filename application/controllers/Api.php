<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->helper('url');
		$this->load->helper('text');
	}

	public function getManufacturer()
	{
	    header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: authorization, Content-Type");

		$posts = array();
			$manufacturers = $this->api_model->get_manufacturer();
			
			foreach($manufacturers as $manufacturer) {
				$posts[] = array(
					'manufacturer_id' => $manufacturer->manufacturer_id,
					'manufacturer_name' => $manufacturer->manufacturer_name,
				);
			}
			
			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 

	}

    public function getInventoryList()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: authorization, Content-Type");
		$posts = array();
			$inventorylist = $this->api_model->get_inventory_list();
			foreach($inventorylist as $inventory) {
				$posts[] = array(
				'model_id' => $inventory->model_id,
				'model_count' => $inventory->model_count,
				'manufacturer_name' => $inventory->manufacturer_name,
				'model_name' => $inventory->model_name,
				'color' => $inventory->color,
				'manufacturing_year' => $inventory->manufacturing_year,
				'registration_number' => $inventory->registration_number,
				'note' => $inventory->note,	
				'image' => base_url('media/images/'.$inventory->image),
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		
	}
	
	public function createManufacturer()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
		header("Access-Control-Allow-Headers: authorization, Content-Type");
			$manufacturer = $this->input->post('manufacturer');
	        	$manufacturerData = array(
					'manufacturer_name' => $manufacturer
				);
				$id = $this->api_model->insertManufacturer($manufacturerData);
				$response = array(
					'status' => 'success'
				);
			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		
	}
	
	public function createModel()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
		header("Access-Control-Allow-Headers: authorization, Content-Type");
		
			$manufacturer_id = $this->input->post('manufacturer_id');
			$modelname = $this->input->post('modelname');
			$color = $this->input->post('color');
			$manufacturingyear = $this->input->post('manufacturingyear');
			$registrationnumber = $this->input->post('registrationnumber');
			$note = $this->input->post('note');
             $filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['image']['name']) {

				$config['upload_path']          = './media/images/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('image')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$modelData = array(			
                    'manufacturer_id' => $manufacturer_id,					
					'model_name' => $modelname,
					'color' => $color,
					'manufacturing_year' => $manufacturingyear,
					'registration_number' => $registrationnumber,
					'note' => $note,
					'image' => $filename				
				);

				$id = $this->api_model->insertModel($modelData);
				$response = array(
					'status' => 'success'
				);
			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		
	}
	}
	
	public function deleteModel($id)
	{
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: authorization, Content-Type");

			$this->api_model->deleteModel($id);
			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		
	}
}
