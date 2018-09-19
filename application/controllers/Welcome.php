<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Base');
		$data['fiftyvalues'] = $this->Base->fiftyvalues();
		$data['sorted_names'] = $this->Base->sort();
		$data['primes'] = $this->Base->primes();
		$data['checkForHash'] = $this->Base->checkForHash('acb80281e4e94213c7452a81fa08f61893eff5ffa62d50876da8d1fed4710d95');
		$data['minmax'] = $this->Base->minmax();
		$data['graph'] = $this->Base->graph();
		$this->Base->insert();

		$this->load->view('welcome_message',$data);


	}

}
