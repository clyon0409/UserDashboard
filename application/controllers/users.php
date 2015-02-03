<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model('Blogger');
		$this->load->library('form_validation');
		// $users = $this->Blogger->get_all_users();
		// var_dump($users);
	}


	public function edit_profile()
	{
		$data['user'] =$this->Blogger->get_user_by_id($this->session->userdata('user'));
	
		$this->load->view('edit_profile', $data);
	}

	public function go_to_dashboard()
	{
		$data['users'] = $this->Blogger->get_all_users();
		if($this->session->userdata('access_level') == 'admin'){
			$this->load->view('admin_dashboard', $data);
		}else{
			$this->load->view('user_dashboard', $data);
		}

	}
	public function update_user_info()
	{
		//var_dump($this->input->post());
		if(!empty($this->input->post('first_name')))
		{
			$this->form_validation->set_rules('first_name', 'First Name','trim|alpha' );
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('errors',validation_errors());
				redirect('/main/edit_profile');
			}
			$this->Blogger->update_field('users', 'first_name', $this->input->post('first_name'));
			$msg='<p>You have successfully update your first name</p>';
		}


		if(!empty($this->input->post('last_name')))
		{
			$this->form_validation->set_rules('last_name', 'Last Name','trim|alpha' );
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('errors',validation_errors());
				redirect('/main/edit_profile');
			}
			$this->Blogger->update_field('users', 'last_name', $this->input->post('last_name'));
			$msg=$msg.'<p>You have successfully update your last name<p>';
		}
		

		if(!empty($this->input->post('email')))
		{
			$this->form_validation->set_rules('email', 'email','trim|valid_email');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('errors',validation_errors());
				redirect('/main/edit_profile');
			}
			$this->Blogger->update_field('users', 'email', $this->input->post('email'));
			$msg=$msg.'<p>You have successfully update your email</p>';
		}
		
		if (!empty($msg))
		{
			$this->session->set_flashdata('errors',$msg);
		}
		redirect('/main/edit_profile');
	}

	public function update_description()
	{
		$this->Blogger->update_description($this->input->post());
		$this->session->set_flashdata('errors','You have successfully updated your description');
		redirect('/main/edit_profile');
	}


	public function update_password()
	{
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[8]' );
		$this->form_validation->set_rules('confirm_password', 'Confirm Password','trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('errors',validation_errors());
				redirect('/main/edit_profile');
		}

		$this->Blogger->update_password($this->input->post());
		$this->session->set_flashdata('errors','You have successfully updated your password');
		redirect('/main/edit_profile');
	}

	public function show_wall($user_id)
	{
		
		$data['user']=$this->Blogger->get_user_by_id($user_id);
		$data['user']['registered_at'] = $data['user']['created_at'];
		
		$data['user']['posts'] = $this->Blogger->get_all_data_for_a_blog($data['user']['blogs_id']);

		//to do: handle comments
		//var_dump($data); die();

		$this->load->view('user_information', $data);
	}
}