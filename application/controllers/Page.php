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
		$data['ipk'] = $data_ipk['ipk'];
		$this->load->view('page_landing',$data);
				
	}

	public function showDimDesc(){
		$dim =  $this->uri->segment(3);
		$data_desc = $this->M_page->getDescContent($dim);
		$data['dim'] = $dim;
		$data['text'] = $data_desc['text'];
		$data['label'] = $data_desc['nama_dim'];
		$data['asset'] = $data_desc['asset'];
		
		$this->load->view('v_dim',$data);
	}

	public function maps(){
		$dim = $this->uri->segment(3);
		//echo $dim;

		$data['dim'] = substr($dim, 1);

		$this->load->view('maps',$data);
	}

	public function maps_all(){
		$this->load->view('maps_all');
	}

	public function detail(){
		
		$kode_prov = $this->uri->segment(3);
		$data_ipk = $this->M_page->getDimensiProv($kode_prov);
		$data['chart_dim'] = json_encode($data_ipk['chart']);
		$data['ipk'] = $data_ipk['ipk'];		
		$data_ind = $this->M_page->getIndikatorProv($kode_prov);
		//$data['chart_ind'] = json_encode($data_ind['ind']);
		//echo var_dump($data['chart_ind']);
		$data['table_data'] = $data_ind;
		$this->load->view('v_detail_prov', $data);
		
	}
 
}
