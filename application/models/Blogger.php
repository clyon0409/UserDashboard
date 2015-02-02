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

	function add_user($user)
	{
		$query = 'INSERT INTO users (first_name, last_name, password, email, created_at) VALUES (?,?,?,?,?)';
		$values = array($user['first_name'], $user['last_name'], $user['password'], $user['email'], date("Y-m-d, H:i:s"));
		return $this->db->query($query, $values);
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

	function delete_course($id)
	{
		$this->db->delete('courses',array('id'=>$id));
	}
}