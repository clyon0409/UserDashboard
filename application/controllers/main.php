<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model('Blogger');
		// $users = $this->Blogger->get_all_users();
		// var_dump($users);
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function sign_in()
	{
		$this->load->view('sign_in');
	}

	public function home()
	{
		redirect(base_url());
	}

	public function login_or_register()
	{
		$this->load->library('form_validation');

		if($this->input->post('action') == 'login')
		{ 
			$this->set_rules('login');
			$user = $this->Blogger->get_user_by_email($this->input->post('email'));
		
			if(!empty($user))
			{
				if($this->input->post('password') == $user['password'])
				{
					$temp['user_info']=array('id'=>$user['id'], 
								'first_name'=>$user['first_name'],
								'access_level' =>$user['access_level'],
								'blog_id' =>$user['blogs_id']);

					$this->session->set_userdata('user', $temp);

					$temp['user_info']['last_name'] = $user['last_name'];
					$temp['user_info']['email'] = $user['email'];
					$temp['user_info']['registered_at'] = $user['created_at'];

					$this->load->view('user_information');
				}
				else
				{
					$this->session->set_flashdata('errors', 'You entered an invalid password');
					redirect('sign_in');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', 'Could not find email address');
				redirect('sign_in');
			}
		}

		if($this->input->post('action')  == 'register')
		{
			echo 'process register';
		}
	}

	public function register()
	{
		$this->load->view('register');
	}

	private function set_rules($action)
	{
		if($action == 'register')
		{
			$config = array(
	           'member/signup' => array(
	                                    array(
	                                            'field' => 'first_name',
	                                            'label' => 'First Name',
	                                            'rules' => 'trim|required|alpha'
	                                         ),
	                                    array(
	                                            'field' => 'last_name',
	                                            'label' => 'Last Name',
	                                            'rules' => 'trim|required|alpha'
	                                         ),
	                                    array(
	                                            'field' => 'email',
	                                            'label' => 'Email Address',
	                                            'rules' => 'trim|required|valid_email|is_unique[users.email]'
	                                         ),
	                                    array(
	                                            'field' => 'password',
	                                            'label' => 'Password',
	                                            'rules' => 'trim|required|min_length[8]'
	                                         ),
	                                    array(
	                                            'field' => 'confirm_password',
	                                            'label' => 'Confirm password',
	                                            'rules' => 'trim|required|matches[password]'
	                                         )
	                                    )
	               );
		}
		elseif($action == 'login')
		{
			$config = array(
	           'member/signup' => array(
	                                    array(
	                                            'field' => 'email',
	                                            'label' => 'Email Address',
	                                            'rules' => 'trim|required|valid_email'
	                                         ),
	                                    array(
	                                            'field' => 'password',
	                                            'label' => 'Password',
	                                            'rules' => 'trim|required|min_length[8]'
	                                         )
	                                    )
	               );
		}

		$this->form_validation->set_rules($config['member/signup']);
	}
}

//end of main controller