<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

	public function index()
	{		
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$this->load->view('template/header_gudang');
		$this->load->view('gudang/home');
		$this->load->view('template/footer');	
	}

	public function beli()
	{	
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['sport']=$this->db->query('SELECT Query2.id_sparepart, spareparts.stok, spareparts.nama_sparepart, Query2.MaxOftgl_beli, detail_beli.harga_supplier FROM beli INNER JOIN ((spareparts INNER JOIN detail_beli ON spareparts.id_sparepart = detail_beli.id_sparepart) INNER JOIN (SELECT Query1.id_sparepart, Max(Query1.tgl_beli) AS MaxOftgl_beli FROM (SELECT detail_beli.id_sparepart, beli.tgl_beli FROM beli INNER JOIN detail_beli ON beli.id_beli = detail_beli.id_beli WHERE (((beli.tgl_beli)<=Now())) ORDER BY detail_beli.id_sparepart, beli.tgl_beli) AS Query1 GROUP BY Query1.id_sparepart) AS Query2 ON spareparts.id_sparepart = Query2.id_sparepart) ON (Query2.MaxOftgl_beli = beli.tgl_beli) AND (beli.id_beli = detail_beli.id_beli) order by spareparts.nama_sparepart')->result();

		$this->load->view('template/header_gudang');
		$this->load->view('gudang/beli',$data);
		$this->load->view('template/footer');	
	}

	public function input(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }

		$data=explode("|", $_POST['data']);
		$url=array_shift($data);
		$beli = array(
		'tgl_beli' => date("Y-m-d h:m:s"),
		'total_beli' => $_POST['jumlah'],
		'tunai' => $_POST['tunai'],
		'kembali' => $_POST['kembalian'],
		'gudang' => $this->session->userdata('id_user')
		);
		$this->db->insert('beli',$beli);
		$d = $this->db->insert_id();

		
		for ($i=0; $i <count($data) ; $i++) { 
			$e=explode("±", $data[$i]);
			$dd=array_shift($e);
		$detail = array(
			'id_sparepart' =>$e[0] ,
			'harga_supplier' => $e[1],
			'jumlah_beli' => $e[2],
			'total_harga' => $e[3],
			'id_beli' =>$d ,
			 );
		$this->db->insert('detail_beli',$detail);

		$stok = array(
			'stok' => $e[4] + $e[2],
			);
		$this->db->where('id_sparepart',$e[0]);
		$this->db->update('Spareparts',$stok);
		
		}

		$this->db->query('DELETE FROM detail_beli WHERE jumlah_beli = 0');

		$data['beli']=$this->db->query('SELECT * FROM beli WHERE id_beli='.$d)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_beli INNER JOIN spareparts ON spareparts.id_sparepart=detail_beli.id_sparepart WHERE id_beli= '.$d.' ORDER By nama_sparepart')->result();

		$this->load->view('template/header_gudang');
		$this->load->view('gudang/struk',$data);
		$this->load->view('template/footer');
	}

	public function daftar(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['sport']=$this->db->query('SELECT Query2.id_sparepart, spareparts.jenis_motor, spareparts.stok, spareparts.nama_sparepart, Query2.MaxOftgl_beli, detail_beli.harga_supplier FROM (spareparts INNER JOIN detail_beli ON spareparts.id_sparepart = detail_beli.id_sparepart) INNER JOIN (SELECT Query1.id_sparepart, Max(Query1.tgl_beli) AS MaxOftgl_beli FROM (SELECT detail_beli.id_sparepart, beli.tgl_beli FROM beli INNER JOIN detail_beli ON beli.id_beli = detail_beli.id_beli WHERE (((beli.tgl_beli)<=Now())) ORDER BY detail_beli.id_sparepart, beli.tgl_beli) AS Query1 GROUP BY Query1.id_sparepart) AS Query2 ON spareparts.id_sparepart = Query2.id_sparepart GROUP BY Query2.id_sparepart, spareparts.nama_sparepart, Query2.MaxOftgl_beli, detail_beli.harga_supplier')->result();

		$this->load->view('template/header_gudang');
		$this->load->view('gudang/list',$data);
		$this->load->view('template/footer');	
	}
	function transaksi(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }

		$data['beli']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%d - %M - %Y") AS tanggal, id_beli, total_beli, id_user FROM beli INNER JOIN user ON user.id_user=beli.gudang WHERE total_beli > 0 and id_user='.$this->session->userdata('id_user'))->result();
		$this->load->view('template/header_gudang');
		$this->load->view('gudang/transaksi',$data);
		$this->load->view('template/footer');	
	}
	function detail($id){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%d - %M - %Y %h:%m:%s") AS tgl_beli, id_beli, total_beli, tunai, kembali FROM beli WHERE id_beli='.$id)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_beli INNER JOIN spareparts ON spareparts.id_sparepart=detail_beli.id_sparepart WHERE id_beli= '.$id.' ORDER By nama_sparepart')->result();
		$this->load->view('template/header_gudang');
		$this->load->view('gudang/struk',$data);
		$this->load->view('template/footer');
	}
	public function harian(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT jumlah_beli, DATE_FORMAT(tgl_beli, "%d - %M - %Y, %h:%m:%s") AS tglbeli, total_beli, beli.id_beli, detail_beli.id_beli, id_user, nama_sparepart, total_harga, harga_supplier  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart INNER JOIN user ON user.id_user=beli.gudang where month(tgl_beli)='.date('m').' and total_beli > 0 and id_user='.$this->session->userdata('id_user').' ORDER BY nama_sparepart ')->result();
  		$data['bulan']=$this->db->query('SELECT Sum(detail_beli.total_harga) AS SumOftotal,  id_user FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli INNER JOIN user ON user.id_user=beli.gudang where month(tgl_beli)='.date("m").' and total_beli > 0 and id_user='.$this->session->userdata('id_user'))->row();

  		$this->load->view('template/header_gudang');
		$this->load->view('gudang/harian',$data);
		$this->load->view('template/footer');
	}
	public function action_harian(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$e=date_create($_POST['awal']);
		$f=date_create($_POST['akhir']);
		$a= DATE_FORMAT($e, "Y-m-d");
		$b= DATE_FORMAT($f, "Y-m-d");

		$data['beli']=$this->db->query('SELECT jumlah_beli, DATE_FORMAT(tgl_beli, "%d - %M - %Y, %h:%m:%s") AS tglbeli, tgl_beli, nama_sparepart,total_harga , harga_supplier,  id_user FROM beli INNER JOIN user ON user.id_user=beli.gudang inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where tgl_beli between "'. $a .'" and "' . $b. '" and total_beli > 0 and id_user='.$this->session->userdata('id_user').' ORDER BY nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT Sum(detail_beli.total_harga) AS SumOftotal,  id_user, gudang FROM beli INNER JOIN user ON user.id_user = beli.gudang inner join detail_beli on beli.id_beli=detail_beli.id_beli  where tgl_beli between "'. $a .'" and "' . $b. '" and total_beli > 0 and id_user='.$this->session->userdata('id_user'))->row();

		$this->load->view('template/header_gudang');
		$this->load->view('gudang/harian',$data);
		$this->load->view('template/footer');
	}
	public function bulanan(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah, id_user,  nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli INNER JOIN user ON user.id_user=beli.gudang inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where month(tgl_beli)='.date("m").' and year(tgl_beli)='.date("Y").' and total_beli > 0 and id_user='.$this->session->userdata('id_user').' group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%M") AS bulan,  id_user, Sum(detail_beli.total_harga) AS SumOftotal FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli INNER JOIN user ON user.id_user=beli.gudang  where month(tgl_beli)='.date("m").' and total_beli > 0 and id_user='.$this->session->userdata('id_user'))->row();

  		$this->load->view('template/header_gudang');
		$this->load->view('gudang/bulanan',$data);
		$this->load->view('template/footer');	
	}
	public function action_bulan(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah, id_user, DATE_FORMAT(tgl_beli, "%M") AS bulan, nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli INNER JOIN user ON user.id_user=beli.gudang inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where month(tgl_beli)='.$_POST['bulan'].' and year(tgl_beli)='.$_POST['tahun'].' and total_beli > 0 and id_user='.$this->session->userdata('id_user').' group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%M") AS bulan,  id_user, Sum(detail_beli.total_harga) AS SumOftotal  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli INNER JOIN user ON user.id_user=beli.gudang where month(tgl_beli)='.$_POST['bulan'].' and total_beli > 0 and id_user='.$this->session->userdata('id_user'))->row();

  		$this->load->view('template/header_gudang');
		$this->load->view('gudang/bulanan',$data);
		$this->load->view('template/footer');	
	}
	public function tahunan(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah, id_user,  nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli INNER JOIN user ON user.id_user=beli.gudang inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where year(tgl_beli)='.date("Y").' and total_beli > 0 and id_user='.$this->session->userdata('id_user').' group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%Y") AS tahun ,  id_user, Sum(detail_beli.total_harga) AS SumOftotal  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli INNER JOIN user ON user.id_user=beli.gudang where year(tgl_beli)='.date("Y").' and total_beli > 0 and id_user='.$this->session->userdata('id_user'))->row();

		$this->load->view('template/header_gudang');
		$this->load->view('gudang/tahunan',$data);
		$this->load->view('template/footer');	
		
	}
	public function action_tahun(){
		if($this->session->userdata('status') != 'Gudang'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah, id_user,  nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli INNER JOIN user ON user.id_user=beli.gudang inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where year(tgl_beli)='.$_POST['tahun'].' and total_beli > 0 and id_user='.$this->session->userdata('id_user').' group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%Y") AS tahun ,Sum(detail_beli.total_harga) AS SumOftotal FROM beli INNER JOIN user ON user.id_user=beli.gudang inner join detail_beli on beli.id_beli=detail_beli.id_beli where year(tgl_beli)='.$_POST['tahun'].' and total_beli > 0 and id_user='.$this->session->userdata('id_user'))->row();

		$this->load->view('template/header_gudang');
		$this->load->view('gudang/tahunan',$data);
		$this->load->view('template/footer');	
		
	}
}
