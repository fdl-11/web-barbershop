<?php
if ( ! defined('BASEPATH')){
	exit('No direct script access allowed');
}

class Authent extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('mAuthent');
		$index = $this->config->item('index_page');
		$host = $this->config->item('base_url');
		$this->url = empty($index) ? $host : $host . $index . '/';
	}

	function in(){
		$msg = '';
		$name = $this->input->post('username');
		$pass = $this->input->post('password');
		$this->session->unset_userdata('user');

		if(!empty($name) && !empty($pass)){
			$user = this->mAuthent->get_user($name);
			if($user['password'] == $pass){
				$userdata = array(
					'id' => $user['user_id'],
					'name' => $user['username'],
					'group' => $user['usergroup_id'],
					'logged_in' => TRUE
				);
				$this->session->set_userdata('user', base64_encode(serialize($userdata)));
			} else {
				$msg = "Username and password didn't match, please try again";
			}
		} else {
			$msg = "Username or password is empty, please try again";
		}

		$this->session->set_flashdata('err_login', $msg);
		header("Location: $this->url");
	}

	function out(){
		$this->session->sess_destroy();
		header("Location: $this->url");
	}
}
?>