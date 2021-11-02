<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
}

	public function index()
	{
		$this->load->view('index');
	}


	//get user
	public function getUser()
	{
		$data['records'] = $this->User_model->getUserTable();
		echo json_encode($data);
	}
	//add user
	public function addUser()
	{
		$result = '';
		$id = $this->input->post('u_id');
		$name = $this->input->post('u_name');
		$email = $this->input->post('u_email');
		$phone = $this->input->post('u_phone');

		$data = array(
			'user_name' => $name,
			'user_email' => $email,
			'user_phone' => $phone,
			'user_status' => 1,
		);

		if($id){
			$result = $this->User_model->updateUserTable($data,$id);

			if($result){

				$data['message'] = 'User Record Updated';
			}
			else{
	
				$data['error'] = true;
				$date['message'] = 'User Record Not Updated';
			}
        }
		else{
			$result = $this->User_model->addUserTable($data);

			if($result){

				$data['message'] = 'User Record Added';
			}
			else{
	
				$data['error'] = true;
				$date['message'] = 'User Record Not Added';
			}
		}
        

        echo json_encode($data);
	}
	//delete user
	public function deleteUser()
	{
		$id = $this->input->post('u_id');
		if(!empty($id)){
			$result = $this->User_model->deleteUserTable($id);
		}
		if($result){

			$data['message'] = 'User Record Deleted';
		}
		else{

			$data['error'] = true;
			$date['message'] = 'User Record Not Deleted';
		}
		echo json_encode($data);
	}
}
