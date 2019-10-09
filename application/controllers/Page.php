<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

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
		$data_ipk = $this->M_page->getDimensinasional();
		$data['chart_data'] = json_encode($data_ipk['chart']);
		$data['table_data'] = $data_ipk['table'];
		$data['desc'] = $data_ipk['modal_data'];
		
		//echo var_dump($data_ipk);
		$this->load->view('page_landing',$data);
		
		
	}

	public function showDimDesc(){
		$dim =  $this->uri->segment(3);
		$data['text'] = $this->M_page->getDescContent($dim);
		
		$this->load->view('v_dim',$data);
	}

	public function maps(){
		
		$this->load->view('maps');
	}

	public function maps_all(){
		$this->load->view('maps_all');
	}

	public function detail(){
		
		$kode_prov = $this->uri->segment(3);
	//	echo $kode_prov;
		$data_ipk = $this->M_page->getDimensiProv($kode_prov);
		//echo var_dump($data_ipk['bar']);
		$data['chart_data'] = json_encode($data_ipk['chart']);
		
		$data_ind = $this->M_page->getIndikatorProv($kode_prov);

		$this->load->view('v_detail_prov', $data);
		
	}
 
}
