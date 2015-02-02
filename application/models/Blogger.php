<?php

class Blogger extends CI_Model {
	function get_all_users()
	{
	return $this->db->query("SELECT * FROM users")->result_array();
	}

	function get_course_by_id($course_id)
	{
		return $this->db->query('SELECT * FROM courses WHERE id = ?', array($course_id))->row_array();
	}

	function add_course($course)
	{
		$query = 'INSERT INTO Courses (name, description, created_at) VALUES (?,?,?)';
		$values = array($course['name'], $course['description'], date("Y-m-d, H:i:s"));
		return $this->db->query($query, $values);
	}

	function delete_course($id)
	{
		$this->db->delete('courses',array('id'=>$id));
	}
}