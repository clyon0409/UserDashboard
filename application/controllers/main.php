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
			
			if($this->form_validation->run() == FALSE)
			{
				//echo 'form validation returned false';
				//var_dump(validation_errors());
				$this->session->set_flashdata('errors',validation_errors());
				redirect('/main/Sign_in');
			}

			$user = $this->Blogger->get_user_by_email($this->input->post('email'));
			if(!empty($user))
			{

				if($this->input->post('password') == $user['password'])
				{

					$this->save_user_info_redirect($user);
				}
				else
				{
					$this->session->set_flashdata('errors', 'You entered an invalid password');
					redirect('/main/Sign_in');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', 'Account does not exist for email address');
				redirect('/main/Sign_in');
			}
		}

		if($this->input->post('action')  == 'register')
		{
			//echo 'process register';
			$this->set_rules('register');

			if($this->form_validation->run() == FALSE)
			{
				//echo 'form validation returned false';
				//var_dump(validation_errors());die();
				$this->session->set_flashdata('errors',validation_errors());
				redirect('/main/register');
			}
			else
			{
				$user['first_name'] = $this->input->post('first_name');
				$user['last_name'] = $this->input->post('last_name');
				$user['email'] = $this->input->post('email');
				$user['password'] = $this->input->post('password');

				$result = $this->Blogger->add_user($user);

				if ($result)
				{
					$new_user = $this->Blogger->get_user_id($user['email']);
				}else{
					$this->session->set_flashdata('errors', 'Unable to add new user');
					redirect('/main/register');
				}

				$blog = $this->Blogger->create_blog();
				 
				if ($blog != 0)
				{
					$res = $this->Blogger->connect_blog_to_user($new_user['id'], $blog['id']);
					if (!$res)
					{
						$this->session->set_flashdata('errors', 'Unable to connect blog to user');
						redirect('/main/register');
					}

				}

				$new_user['access_level'] = 'normal';
				$new_user['blogs_id'] = $blog['id'];
				$this->save_user_info_redirect($new_user);
			}
		}
	}

	public function put_post()
	{
		$result= $this->Blogger->insert_post($this->input->post());
		if ($result)
		{
			$data['user']=$this->Blogger->get_all_data_for_a_user();
			$this->load->view('user_information', $data);
		}
		else
		{
			$this->session->set_flashdata('errors','Unable to put your post on user wall');
			redirect('/main/user_information');
		}
	}

	public function register()
	{
		$this->load->view('register');
	}

	private function save_user_info_redirect($user)
	{
		$data['user']=array('id'=>$user['id'], 
							'first_name'=>$user['first_name'],
							'access_level' =>$user['access_level'],
							'blog_id' =>$user['blogs_id']);

		
		$this->session->set_userdata('user', $user['id']);
		$this->session->set_userdata('blog_id', $user['blogs_id']);
		$this->session->set_userdata('access_level', $user['access_level']);

		$data['user']['last_name'] = $user['last_name'];
		$data['user']['email'] = $user['email'];
		$data['user']['description'] = $user['description'];
		$data['user']['registered_at'] = $user['created_at'];
		$data['user']['posts'] = $this->Blogger->get_all_data_for_a_blog($user['blogs_id']);

		//to do: handle comments

		$this->load->view('user_information', $data);

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