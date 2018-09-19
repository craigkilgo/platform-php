<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M extends CI_Controller {

	public function index()
	{
        $this->load->model('Base');
        $this->Base->generateFriends();
    }


}