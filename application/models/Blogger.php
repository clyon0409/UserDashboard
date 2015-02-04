<?php

class Blogger extends CI_Model {
	function get_all_users()
	{
		$query = 'SELECT users.*, access.* FROM users JOIN access ON access.users_id = users.id';
		return $this->db->query($query)->result_array();
	}

	function get_user_by_email($email)
	{
		$query = 'SELECT users.*, users.created_at as registered_at, access.* FROM users JOIN access ON access.users_id = users.id WHERE email = ?';
		return $this->db->query($query, array($email))->row_array();
	}

	function get_user_id($email)
	{
		$query = 'SELECT * , users.created_at as registered_at FROM users WHERE email = ?';
		return $this->db->query($query, array($email))->row_array();
	}

	function get_user_by_id($id)
	{
		$query = 'SELECT users.*, users.created_at as registered_at, access.* FROM users JOIN access ON access.users_id = users.id WHERE users.id = ?';
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
				  WHERE blogs_id = ?
				  ORDER BY post_date DESC';

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

	function get_all_data_for_a_user($user_id)
	{	
		$data= $this->get_user_by_id($user_id);
		//var_dump($data);
		$data['posts'] = $this->get_all_data_for_a_blog($data['blogs_id']);
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
		$info=$this->get_user_by_id($data['id']);
		$query = 'INSERT INTO posts (users_id, blogs_id, content, created_at, modified_at) VALUES (?,?,?,?,?)';
		$values = array($this->session->userdata('user'), $info['blogs_id'], $data['post'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s")) ;
		return $this->db->query($query, $values);
	}

	function update_description($data)
	{
		$update = array('description' => $data['description']);
		$this->db->where('id', $this->session->userdata('user'));
		$this->db->update('users', $update); 
	}

	function update_password($data)
	{
		$update = array('password' => $data['password']);
		$this->db->where('id', $this->session->userdata('user'));
		$this->db->update('users', $update); 
	}

	function update_field($table, $key, $data, $user_id)
	{
		$update = array($key => $data);
		$this->db->where('id', $user_id);
		$this->db->update($table, $update); 
	}

	function update_access_level($user_id, $data)
	{
		$update = array('access_level' => $data);
		$this->db->where('users_id', $user_id);
		$this->db->update('access', $update); 
	}

	function delete_user($id)
	{
		$data = $this->get_user_by_id($id);
		$this->db->delete('access',array('blogs_id'=>$data['blogs_id']));
		$this->db->delete('blogs',array('id'=>$data['blogs_id']));
		$this->db->delete('users',array('id'=>$data['id']));
	}
}