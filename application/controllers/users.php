<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model('Blogger');
		// $users = $this->Blogger->get_all_users();
		// var_dump($users);
	}

	public function update_user_info()
	{
		echo 'got into update user info';
	}

	public function update_description()
	{
		echo 'got into update description';
	}

	public function return_to_dashboard()
	{
		echo 'got into return to dashboard';
	}

	public function update_password()
	{
		echo 'got into udpate password';
	}
}