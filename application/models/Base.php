<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Model {


	public function index()
	{
		return true;
	}

	public function sha(){
		return true;
	}

	public function graph(){

		return 'hi2';
	}


}
