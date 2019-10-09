<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_page extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  public function getDimensinasional(){

    $query =  $this->db->query("SELECT ID_DIM,KODE_DIM,NAMA_DIM,NILAI_DIM,ASSET_DIM FROM nilai_dim_complete where KODE_PROV = 0000 ORDER BY ID_DIM"); 
 
      $record = $query->result();
        $data = [];
 
        foreach($record as $row) {
          if ($row->NAMA_DIM != "IPK") {
            $data['chart']['label'][] = $row->NAMA_DIM." ( ".$row->NILAI_DIM." )";
          }else{
            $data['ipk'] = $row->NILAI_DIM;
          } 
          
            //$data['chart']['label'][] = $row->NAMA_DIM." ( ".$row->NILAI_DIM." )";
            $data['chart']['data'][] = (int) $row->NILAI_DIM;
        }
        $data['table']=$query;
        $data['modal_data'] = $this->getKodeDim();
        return $data;
    
  }

  public function getDescContent($dimensi){
    $data= [];
    $dim = $dimensi;
    $query = $this->db->query("SELECT DESKRIPSI_DIM,NAMA_DIM,ASSET_DIM FROM ref_dimensi where KODE_DIM = '$dim' ");
    foreach ($query->result() as $row) {
      $data['text'] = $row->DESKRIPSI_DIM;
      $data['nama_dim'] = $row->NAMA_DIM;
      $data['asset'] = $row->ASSET_DIM;
    }
    return $data;
  }

  public function getKodeDim(){
    $query = $this->db->query("SELECT * FROM ref_dimensi");
    
    return $query;
  }

  public function getDimensiProv($kode_prov){
    $kode = $kode_prov;
     $query =  $this->db->query("SELECT ID_DIM,KODE_DIM,NAMA_DIM,NILAI_DIM,ASSET_DIM FROM nilai_dim_complete where KODE_PROV = '$kode' ORDER BY ID_DIM"); 
 
      $record = $query->result();
        $data = [];
 
        foreach($record as $row) {
          if ($row->NAMA_DIM != "IPK") {
            $data['chart']['label'][] = $row->NAMA_DIM." ( ".$row->NILAI_DIM." )";
          }else{
            $data['ipk'] = $row->NILAI_DIM;
          } 
          
            //$data['chart']['label'][] = $row->NAMA_DIM." ( ".$row->NILAI_DIM." )";
            $data['chart']['data'][] = (int) $row->NILAI_DIM;
        }
        $data['table']=$query;
        $data['modal_data'] = $this->getKodeDim();
        return $data;
    
  }

  public function getIndikatorProv($kode){
    $kode_prov = $kode;
    $data=[];
    $query =  $this->db->query("SELECT ID_DIM,NAMA_IND,NILAI_IND,SOURCE_IND,TAHUN_IND,KODE_PROV,KODE_IND FROM nilai_ind_complete where KODE_PROV = '$kode_prov' ORDER BY ID_DIM"); 
    /*$record = $query->result();
    foreach ($record as $row) {

      $data['ind']['data'][] = (int)$row->NILAI_IND;
      $data['ind']['label'][] = $row->NAMA_IND." ( ".$row->NILAI_IND." )";
    }*/
    return $query;
  }

}

/* End of file M_page.php */
/* Location: ./application/models/M_page.php */
?>