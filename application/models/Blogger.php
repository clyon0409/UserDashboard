<?php

class Blogger extends CI_Model {
	function get_all_users()
	{
	return $this->db->query("SELECT * FROM users")->result_array();
	}

	function get_user_by_email($email)
	{
		$query = 'SELECT users.*, access.* FROM users JOIN access ON access.users_id = users.id WHERE email = ?';
		return $this->db->query($query, array($email))->row_array();
	}

	function get_user_id($email)
	{
		$query = 'SELECT * FROM users WHERE email = ?';
		return $this->db->query($query, array($email))->row_array();
	}

	function get_user_by_id($id)
	{
		$query = 'SELECT users.*, access.* FROM users JOIN access ON access.users_id = users.id WHERE users.id = ?';
		return $this->db->query($query, array($id))->row_array();
	}

	function add_user($user)
	{
		$query = 'INSERT INTO users (first_name, last_name, password, email, created_at) VALUES (?,?,?,?,?)';
		$values = array($user['first_name'], $user['last_name'], $user['password'], $user['email'], date("Y-m-d, H:i:s"));
		return $this->db->query($query, $values);
	}

	function get_all_data_for_a_blog($blog_id)
	{
		$query = 'SELECT posts.id as post_id, users.first_name as poster_first, users.last_name as poster_last, posts.content, posts.created_at as post_date
				  FROM users
				  JOIN posts on posts.users_id=users.id
				  WHERE blogs_id = ?';

		return $this->db->query($query, array($blog_id))->result_array();
	}

	function get_all_data_for_a_post($post_id)
	{
		//var_dump($post_id);
		$query = 'SELECT comments.posts_id, users.first_name as comment_first, comments.content, users.last_name as comment_last, comments.created_at as comment_date
				  FROM users
				  JOIN comments on comments.users_id=users.id
				  WHERE posts_id=?';

				  return $this->db->query($query, array($post_id))->result_array();
	}

	function get_all_data_for_a_user()
	{
		$user = $this->get_user_by_id($this->session->userdata('user'));

		
		$data=array('id'=>$user['id'], 
					'first_name'=>$user['first_name'],
					'access_level' =>$user['access_level'],
					'blog_id' =>$user['blogs_id'],
					'last_name'=>$user['last_name'],
					'email'=>$user['email'],
					'description' => $user['description'],
					'registered_at' => $user['created_at']);

 		// var_dump($data);die();
		$data['posts'] = $this->get_all_data_for_a_blog($user['blogs_id']);
		return $data;

	}
	function create_blog()
	{
		$query = 'INSERT INTO blogs (created_at) VALUES (?)';
		$values = array(date("Y-m-d, H:i:s"));
		$res = $this->db->query($query, $values);
		if($res)
		{
			$query = 'SELECT * FROM blogs WHERE created_at = ?';
			return $this->db->query($query, $values)->row_array();
		}else{
			return $res;
		}
	}

	function connect_blog_to_user($user_id, $blog_id)
	{
		$query = 'INSERT INTO access (users_id, blogs_id, access_level) VALUES (?,?,?)';
		$values = array($user_id, $blog_id, 'normal');
		return $this->db->query($query, $values);
	}

	function insert_post($data){
		echo 'got into insert post';
		var_dump($data);
		$query = 'INSERT INTO posts (users_id, blogs_id, content, created_at, modified_at) VALUES (?,?,?,?,?)';
		$values = array($this->session->userdata('user'), $this->session->userdata('blog_id'), $data['post'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s")) ;
		return $this->db->query($query, $values);
	}

	function delete_course($id)
	{
		$this->db->delete('courses',array('id'=>$id));
	}
}