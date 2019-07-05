<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function index()
	{	
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/home');
		$this->load->view('template/footer');	
	}
	public function jual()
	{	
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['sport']=$this->db->query('SELECT Query9.id_sparepart, spareparts.nama_sparepart, Query9.MaxOftgl_berlaku, spareparts.stok, harga.nominal FROM spareparts INNER JOIN ((SELECT Query8.id_sparepart, Max(Query8.tgl_berlaku) AS MaxOftgl_berlaku FROM (SELECT harga.id_sparepart, harga.tgl_berlaku FROM harga WHERE (((harga.tgl_berlaku)<=Now())) ORDER BY harga.id_sparepart, harga.tgl_berlaku) AS Query8 GROUP BY Query8.id_sparepart)  AS Query9 INNER JOIN harga ON (Query9.MaxOftgl_berlaku = harga.tgl_berlaku) AND (Query9.id_sparepart =harga.id_sparepart)) ON spareparts.id_sparepart = harga.id_sparepart  ORDER BY Spareparts.nama_sparepart ')->result();

		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/jualbarang',$data);
		$this->load->view('template/footer');
	}

	public function input()
	{	/*date_default_timezone_set("Indonesia/Jakarta");*/
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data=explode("|", $_POST['data']);
		$url=array_shift($data);
		
		$jual = array(
		'tgl_jual' => date("Y-m-d h:m:s"),
		'total_jual' => $_POST['jumlah'],
		'tunai' => $_POST['tunai'],
		'kembali' => $_POST['kembalian'],
		'kasir' => $this->session->userdata('id_user')
		);
		$this->db->insert('jual',$jual);
		$d = $this->db->insert_id();

		
		for ($i=0; $i <count($data) ; $i++) { 
			$e=explode("±", $data[$i]);
			$dd=array_shift($e);
		$detail = array(
			'id_sparepart' =>$e[0] ,
			'harga_satuan' => $e[1],
			'jumlah_jual' => $e[2],
			'harga_total' => $e[3],
			'id_jual' =>$d ,
			 );
		$this->db->insert('detail_jual',$detail);

		$stok = array(
			'stok' => $e[4] - $e[2],
			);
		$this->db->where('id_sparepart',$e[0]);
		$this->db->update('Spareparts',$stok);
		
		}

		$this->db->query('DELETE FROM detail_jual WHERE jumlah_jual = 0');

		$data['jual']=$this->db->query('SELECT * FROM jual WHERE id_jual='.$d)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_jual INNER JOIN spareparts ON spareparts.id_sparepart=detail_jual.id_sparepart WHERE id_jual= '.$d.' ORDER By nama_sparepart')->result();
		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/struk',$data);
		$this->load->view('template/footer');
	}
	public function daftar(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['sport']=$this->db->query('SELECT Query9.id_sparepart, spareparts.nama_sparepart, spareparts.jenis_motor, spareparts.stok, DATE_FORMAT(Query9.MaxOftgl_berlaku, "%d - %M - %Y, %h:%m:%s") AS tgljual, harga.nominal FROM spareparts INNER JOIN ((SELECT Query8.id_sparepart, Max(Query8.tgl_berlaku) AS MaxOftgl_berlaku FROM (SELECT harga.id_sparepart, harga.tgl_berlaku FROM harga WHERE (((harga.tgl_berlaku)<=Now())) ORDER BY harga.id_sparepart, harga.tgl_berlaku) AS Query8 GROUP BY Query8.id_sparepart)  AS Query9 INNER JOIN harga ON (Query9.MaxOftgl_berlaku = harga.tgl_berlaku) AND (Query9.id_sparepart =harga.id_sparepart)) ON spareparts.id_sparepart = harga.id_sparepart  ORDER BY Spareparts.nama_sparepart ')->result();

		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/listbarang',$data);
		$this->load->view('template/footer');	
	}

	function transaksi(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%d - %M - %Y") AS tgl_jual, id_jual, total_jual, id_user FROM jual INNER JOIN user ON user.id_user=jual.kasir WHERE id_user='.$this->session->userdata('id_user'))->result();
		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/transaksi',$data);
		$this->load->view('template/footer');	
	}
	function detail($id){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%d - %M - %Y %h:%m:%s") AS tgl_jual, id_jual, total_jual,tunai,kembali FROM jual WHERE id_jual='.$id)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_jual INNER JOIN spareparts ON spareparts.id_sparepart=detail_jual.id_sparepart WHERE id_jual= '.$id.' ORDER By nama_sparepart')->result();
		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/struk',$data);
		$this->load->view('template/footer');
	}
	public function harian(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT jumlah_jual, DATE_FORMAT(tgl_jual, "%d - %M - %Y, %h:%m:%s") AS tgljual, nama_sparepart, harga_total, harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where month(tgl_jual)='.date('m').' AND jual.kasir='.$this->session->userdata('id_user').' order by tgl_jual ')->result();
  		$data['bulan']=$this->db->query('SELECT Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual  where month(tgl_jual)='.date("m").' AND jual.kasir='.$this->session->userdata('id_user'))->row();

  		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/harian',$data);
		$this->load->view('template/footer');
	}
	public function action_harian(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$e=date_create($_POST['awal']);
		$f=date_create($_POST['akhir']);
		$a= DATE_FORMAT($e, "Y-m-d");
		$b= DATE_FORMAT($f, "Y-m-d");

		$data['jual']=$this->db->query('SELECT jumlah_jual, DATE_FORMAT(tgl_jual, "%d - %M - %Y, %h:%m:%s") AS tgljual, tgl_jual, nama_sparepart,harga_total , harga_satuan FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where tgl_jual between "'. $a .'" and "' . $b. '" AND jual.kasir='.$this->session->userdata('id_user').' order by tgl_jual')->result();
		$data['bulan']=$this->db->query('SELECT Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual  where tgl_jual between "'. $a .'" and "' . $b. '" AND jual.kasir='.$this->session->userdata('id_user'))->row();

		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/harian',$data);
		$this->load->view('template/footer');
	}
	public function bulanan(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah,  nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where month(tgl_jual)='.date("m").' and year(tgl_jual)='.date("Y").' AND jual.kasir='.$this->session->userdata('id_user').' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%M") AS bulan,Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual  where month(tgl_jual)='.date("m").'  AND jual.kasir='.$this->session->userdata('id_user'))->row();

  		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/bulanan',$data);
		$this->load->view('template/footer');	
	}
	public function action_bulan(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah, DATE_FORMAT(tgl_jual, "%M") AS bulan, nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where month(tgl_jual)='.$_POST['bulan'].' and year(tgl_jual)='.$_POST['tahun'].' AND jual.kasir='.$this->session->userdata('id_user').' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%M") AS bulan,Sum(detail_jual.harga_total) AS SumOftotal  FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual where month(tgl_jual)='.$_POST['bulan'].' AND jual.kasir='.$this->session->userdata('id_user'))->row();

  		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/bulanan',$data);
		$this->load->view('template/footer');	
	}
	public function tahunan(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah,  nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where year(tgl_jual)='.date("Y").' AND jual.kasir='.$this->session->userdata('id_user').' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%Y") AS tahun ,Sum(detail_jual.harga_total) AS SumOftotal  FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual where year(tgl_jual)='.date("Y").' AND jual.kasir='.$this->session->userdata('id_user'))->row();

		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/tahunan',$data);
		$this->load->view('template/footer');	
		
	}
	public function action_tahun(){
		if($this->session->userdata('status') != 'Kasir'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah,  nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where year(tgl_jual)='.$_POST['tahun'].' AND jual.kasir='.$this->session->userdata('id_user').' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%Y") AS tahun ,Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual where year(tgl_jual)='.$_POST['tahun'].' AND jual.kasir='.$this->session->userdata('id_user'))->row();

		$this->load->view('template/header_kasir');
		$this->load->view('penjualan/tahunan',$data);
		$this->load->view('template/footer');	
		
	}
}
