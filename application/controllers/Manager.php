<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	public function index()
	{	if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$this->load->view('template/header_manager');
		$this->load->view('manager/home');
		$this->load->view('template/footer');	
	}
	public function daftar(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['sport']=$this->db->query('SELECT spareparts.id_sparepart, spareparts.stok, spareparts.nama_sparepart, detail_beli.harga_supplier, DATE_FORMAT(Query14.MaxOftgl_berlaku, "%d - %M - %Y") AS tglsekarang, harga.nominal AS sekarang, DATE_FORMAT(Query5.tgl_berlaku, "%d - %M - %Y") AS tglrencana, Query5.nominal AS rencana FROM (((spareparts INNER JOIN harga ON spareparts.id_sparepart = harga.id_sparepart) INNER JOIN (beli INNER JOIN detail_beli ON beli.id_beli = detail_beli.id_beli) ON spareparts.id_sparepart = detail_beli.id_sparepart) INNER JOIN (SELECT Query6_1.id_sparepart, Max(Query6_1.tgl_berlaku) AS MaxOftgl_berlaku, Max(Query6_1.tgl_beli) AS MaxOftgl_beli FROM ( (SELECT harga.id_sparepart, harga.tgl_berlaku, beli.tgl_beli FROM beli INNER JOIN (harga INNER JOIN detail_beli ON harga.id_sparepart = detail_beli.id_sparepart) ON beli.id_beli = detail_beli.id_beli WHERE (((harga.tgl_berlaku)<=Now())) ORDER BY harga.id_sparepart, harga.tgl_berlaku, beli.tgl_beli) AS Query6_1 INNER JOIN harga ON Query6_1.tgl_berlaku = harga.tgl_berlaku) INNER JOIN beli ON Query6_1.tgl_beli = beli.tgl_beli GROUP BY Query6_1.id_sparepart ) AS Query14 ON (Query14.MaxOftgl_beli = beli.tgl_beli) AND (Query14.MaxOftgl_berlaku = harga.tgl_berlaku) AND (spareparts.id_sparepart = Query14.id_sparepart)) INNER JOIN (SELECT harga.id_sparepart, harga.tgl_berlaku, harga.nominal FROM harga WHERE (((harga.tgl_berlaku)>=Now()))) AS Query5 ON spareparts.id_sparepart = Query5.id_sparepart')->result();
		$data['list']=$this->db->query('SELECT * FROM referensi WHERE kelompok = "jenis_motor"')->result();
		$this->load->view('template/header_manager');
		$this->load->view('manager/listbarang',$data);
		$this->load->view('template/footer');	
	}
	public function update(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
        $id = $this->input->post('id2');
        $data = $this->db->query('SELECT spareparts.id_sparepart, spareparts.nama_sparepart, detail_beli.harga_supplier, DATE_FORMAT(Query14.MaxOftgl_berlaku, "%d - %M - %Y") AS tglsekarang, harga.nominal AS sekarang, DATE_FORMAT(Query5.tgl_berlaku, "%d - %M - %Y") AS tglrencana, Query5.nominal AS rencana FROM (((spareparts INNER JOIN harga ON spareparts.id_sparepart = harga.id_sparepart) INNER JOIN (beli INNER JOIN detail_beli ON beli.id_beli = detail_beli.id_beli) ON spareparts.id_sparepart = detail_beli.id_sparepart) INNER JOIN (SELECT Query6_1.id_sparepart, Max(Query6_1.tgl_berlaku) AS MaxOftgl_berlaku, Max(Query6_1.tgl_beli) AS MaxOftgl_beli FROM ( (SELECT harga.id_sparepart, harga.tgl_berlaku, beli.tgl_beli FROM beli INNER JOIN (harga INNER JOIN detail_beli ON harga.id_sparepart = detail_beli.id_sparepart) ON beli.id_beli = detail_beli.id_beli WHERE (((harga.tgl_berlaku)<Now())) ORDER BY harga.id_sparepart, harga.tgl_berlaku, beli.tgl_beli) AS Query6_1 INNER JOIN harga ON Query6_1.tgl_berlaku = harga.tgl_berlaku) INNER JOIN beli ON Query6_1.tgl_beli = beli.tgl_beli GROUP BY Query6_1.id_sparepart ) AS Query14 ON (Query14.MaxOftgl_beli = beli.tgl_beli) AND (Query14.MaxOftgl_berlaku = harga.tgl_berlaku) AND (spareparts.id_sparepart = Query14.id_sparepart)) INNER JOIN (SELECT harga.id_sparepart, harga.tgl_berlaku, harga.nominal FROM harga WHERE (((harga.tgl_berlaku)>Now()))) AS Query5 ON spareparts.id_sparepart = Query5.id_sparepart where spareparts.id_sparepart='.$id)->row();
        
        
        echo json_encode($data);
    
    }
    public function update_action($id){
    	if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
    	$e=date_create($_POST['awal']);
		$a= DATE_FORMAT($e, "Y-m-d");
    	$this->db->query('UPDATE harga SET nominal='.$_POST["harga_rencana"].', tgl_berlaku="'.$a.'" WHERE id_sparepart='.$_POST["id_sparepart"].' AND tgl_berlaku > Now()');
    	redirect('manager/daftar');
    }

    public function input(){
    	if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
    	$data =  array(
    		'nama_sparepart' => $_POST['nama_sparepart'], 
    		'jenis_motor' => $_POST['jenis']
    		);
		$this->db->insert('spareparts',$data);
		$d = $this->db->insert_id();

		$beli = array(
			'tgl_beli' =>date("Y-m-d")
			);
		$this->db->insert('beli',$beli);
		$bl = $this->db->insert_id();

		$sup =  array(
			'id_beli'=>$bl,
    		'id_sparepart' => $d, 
    		'harga_supplier' => $_POST['harga_supplier']
    		);

		echo '<pre>';
		echo var_dump($sup);

		$this->db->insert('detail_beli',$sup);

		$e=date_create($_POST['tgl1']);
		$f=date_create($_POST['tgl2']);
		$a= DATE_FORMAT($e, "Y-m-d");
		$b= DATE_FORMAT($f, "Y-m-d");

		$sp =  array(
    		'id_sparepart' => $d, 
    		'nominal' => $_POST['harga1'],
    		'tgl_berlaku' => $a
    		);
		$this->db->insert('harga',$sp);

		$sp =  array(
    		'id_sparepart' => $d, 
    		'nominal' => $_POST['harga2'],
    		'tgl_berlaku' => $b
    		);
		$this->db->insert('harga',$sp);			

		redirect('manager/daftar');	
    }

/*Laporan Penjualan*/
    function transaksi(){
    	if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%d - %M - %Y") AS tgl_jual, id_jual, total_jual,nama_user FROM jual INNER JOIN user ON user.id_user=jual.kasir')->result();
		$this->load->view('template/header_manager');
		$this->load->view('manager/transaksi',$data);
		$this->load->view('template/footer');	
	}
	function detail($id){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%d - %M - %Y %h:%m:%s") AS tgl_jual, id_jual, total_jual,tunai,kembali FROM jual WHERE id_jual='.$id)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_jual INNER JOIN spareparts ON spareparts.id_sparepart=detail_jual.id_sparepart WHERE id_jual= '.$id.' ORDER By nama_sparepart')->result();
		$this->load->view('template/header_manager');
		$this->load->view('manager/struk',$data);
		$this->load->view('template/footer');
	}
	public function harian(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT jumlah_jual, DATE_FORMAT(tgl_jual, "%d - %M - %Y, %h:%m:%s") AS tgljual, nama_sparepart, harga_total, harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where month(tgl_jual)='.date('m').' order by tgl_jual ')->result();
  		$data['bulan']=$this->db->query('SELECT Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual  where month(tgl_jual)='.date("m").'')->row();

  		$this->load->view('template/header_manager');
		$this->load->view('manager/harian',$data);
		$this->load->view('template/footer');
	}
	public function action_harian(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$e=date_create($_POST['awal']);
		$f=date_create($_POST['akhir']);
		$a= DATE_FORMAT($e, "Y-m-d");
		$b= DATE_FORMAT($f, "Y-m-d");

		$data['jual']=$this->db->query('SELECT jumlah_jual, DATE_FORMAT(tgl_jual, "%d - %M - %Y, %h:%m:%s") AS tgljual, tgl_jual, nama_sparepart,harga_total , harga_satuan FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where tgl_jual between "'. $a .'" and "' . $b. '" order by tgl_jual')->result();
		$data['bulan']=$this->db->query('SELECT Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual  where tgl_jual between "'. $a .'" and "' . $b. '" ')->row();

		$this->load->view('template/header_manager');
		$this->load->view('manager/harian',$data);
		$this->load->view('template/footer');
	}
	public function bulanan(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah,  nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where month(tgl_jual)='.date("m").' and year(tgl_jual)='.date("Y").' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%M") AS bulan,Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual  where month(tgl_jual)='.date("m").'')->row();

  		$this->load->view('template/header_manager');
		$this->load->view('manager/bulanan',$data);
		$this->load->view('template/footer');	
	}
	public function action_bulan(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah, DATE_FORMAT(tgl_jual, "%M") AS bulan, nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where month(tgl_jual)='.$_POST['bulan'].' and year(tgl_jual)='.$_POST['tahun'].' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%M") AS bulan,Sum(detail_jual.harga_total) AS SumOftotal  FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual where month(tgl_jual)='.$_POST['bulan'].'')->row();

  		$this->load->view('template/header_manager');
		$this->load->view('manager/bulanan',$data);
		$this->load->view('template/footer');	
	}
	public function tahunan(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah,  nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where year(tgl_jual)='.date("Y").' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%Y") AS tahun ,Sum(detail_jual.harga_total) AS SumOftotal  FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual where year(tgl_jual)='.date("Y").'')->row();

		$this->load->view('template/header_manager');
		$this->load->view('manager/tahunan',$data);
		$this->load->view('template/footer');	
		
	}
	public function action_tahun(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['jual']=$this->db->query('SELECT Sum(detail_jual.jumlah_jual) AS SumOfjumlah,  nama_sparepart, Sum(detail_jual.harga_total) AS SumOftotal , harga_satuan  FROM jual inner join detail_jual on jual.id_jual=detail_jual.id_jual inner join spareparts on spareparts.id_sparepart=detail_jual.id_sparepart where year(tgl_jual)='.$_POST['tahun'].' group by detail_jual.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%Y") AS tahun ,Sum(detail_jual.harga_total) AS SumOftotal FROM Jual inner join detail_jual on jual.id_jual=detail_jual.id_jual where year(tgl_jual)='.$_POST['tahun'].'')->row();

		$this->load->view('template/header_manager');
		$this->load->view('manager/tahunan',$data);
		$this->load->view('template/footer');	
		
	}
/*Laporan Pembelian*/
	function btransaksi(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT nama_user,DATE_FORMAT(tgl_beli, "%d - %M - %Y") AS tanggal, id_beli, total_beli FROM beli INNER JOIN user ON user.id_user=beli.gudang WHERE total_beli > 0')->result();
		$this->load->view('template/header_manager');
		$this->load->view('manager/btransaksi',$data);
		$this->load->view('template/footer');	
	}
	function bdetail($id){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%d - %M - %Y %h:%m:%s") AS tgl_beli, id_beli, total_beli, tunai, kembali FROM beli WHERE id_beli='.$id)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_beli INNER JOIN spareparts ON spareparts.id_sparepart=detail_beli.id_sparepart WHERE id_beli= '.$id.' ORDER By nama_sparepart')->result();
		$this->load->view('template/header_manager');
		$this->load->view('manager/bstruk',$data);
		$this->load->view('template/footer');
	}
	public function bharian(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT jumlah_beli, DATE_FORMAT(tgl_beli, "%d - %M - %Y, %h:%m:%s") AS tglbeli, nama_sparepart, total_harga, harga_supplier  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where month(tgl_beli)='.date('m').' and detail_beli.jumlah_beli > 0 ORDER BY nama_sparepart ')->result();
  		$data['bulan']=$this->db->query('SELECT Sum(detail_beli.total_harga) AS SumOftotal FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli  where month(tgl_beli)='.date("m").'')->row();

  		$this->load->view('template/header_manager');
		$this->load->view('manager/bharian',$data);
		$this->load->view('template/footer');
	}
	public function baction_harian(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$e=date_create($_POST['awal']);
		$f=date_create($_POST['akhir']);
		$a= DATE_FORMAT($e, "Y-m-d");
		$b= DATE_FORMAT($f, "Y-m-d");

		$data['beli']=$this->db->query('SELECT jumlah_beli, DATE_FORMAT(tgl_beli, "%d - %M - %Y, %h:%m:%s") AS tglbeli, tgl_beli, nama_sparepart,total_harga , harga_supplier FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where tgl_beli between "'. $a .'" and "' . $b. '" and detail_beli.jumlah_beli > 0 ORDER BY nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT Sum(detail_beli.total_harga) AS SumOftotal FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli  where tgl_beli between "'. $a .'" and "' . $b. '" ')->row();

		$this->load->view('template/header_manager');
		$this->load->view('manager/bharian',$data);
		$this->load->view('template/footer');
	}
	public function bbulanan(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah,  nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where month(tgl_beli)='.date("m").' and year(tgl_beli)='.date("Y").' and detail_beli.jumlah_beli > 0 group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%M") AS bulan,Sum(detail_beli.total_harga) AS SumOftotal FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli  where month(tgl_beli)='.date("m").'')->row();

  		$this->load->view('template/header_manager');
		$this->load->view('manager/bbulanan',$data);
		$this->load->view('template/footer');	
	}
	public function baction_bulan(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah, DATE_FORMAT(tgl_beli, "%M") AS bulan, nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where month(tgl_beli)='.$_POST['bulan'].' and year(tgl_beli)='.$_POST['tahun'].' and detail_beli.jumlah_beli > 0 group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%M") AS bulan,Sum(detail_beli.total_harga) AS SumOftotal  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli where month(tgl_beli)='.$_POST['bulan'].'')->row();

  		$this->load->view('template/header_manager');
		$this->load->view('manager/bbulanan',$data);
		$this->load->view('template/footer');	
	}
	public function btahunan(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah,  nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where year(tgl_beli)='.date("Y").' and detail_beli.jumlah_beli > 0 group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%Y") AS tahun ,Sum(detail_beli.total_harga) AS SumOftotal  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli where year(tgl_beli)='.date("Y").'')->row();

		$this->load->view('template/header_manager');
		$this->load->view('manager/btahunan',$data);
		$this->load->view('template/footer');	
		
	}
	public function baction_tahun(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['beli']=$this->db->query('SELECT Sum(detail_beli.jumlah_beli) AS SumOfjumlah,  nama_sparepart, Sum(detail_beli.total_harga) AS SumOftotal , harga_supplier  FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli inner join spareparts on spareparts.id_sparepart=detail_beli.id_sparepart where year(tgl_beli)='.$_POST['tahun'].' and detail_beli.jumlah_beli > 0 group by detail_beli.id_sparepart order by nama_sparepart')->result();
		$data['bulan']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%Y") as tahun,Sum(detail_beli.total_harga) AS SumOftotal FROM beli inner join detail_beli on beli.id_beli=detail_beli.id_beli where year(tgl_beli)='.$_POST['tahun'].'')->row();

		$this->load->view('template/header_manager');
		$this->load->view('manager/btahunan',$data);
		$this->load->view('template/footer');	
		
	}

	public function karyawan(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data['karyawan']=$this->db->query('SELECT *,DATE_FORMAT(create_at, "%d %M %Y") as tanggal FROM user')->result();
		$data['jabatan']=$this->db->query('SELECT * FROM referensi WHERE kelompok= "jabatan"')->result();

		$this->load->view('template/header_manager');
		$this->load->view('manager/karyawan',$data);
		$this->load->view('template/footer');	
	}

	public function addkar(){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$data = array(
			'nama_user' => $_POST['nama_karyawan'],
			'status' => $_POST['status'],
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			);
		$this->db->insert('user',$data);

		redirect('manager/karyawan');
	}

	public function update_user(){
		$id = $this->input->post('id2');
		$data=$this->db->query('SELECT * FROM user WHERE id_user='.$id)->row();

		echo json_encode($data);
	}

	public function editkar(){
		$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'status' => $this->input->post('jabatan'),
			);
		$id=$_POST['id'];

		$this->db->where('id_user',$id);
		$this->db->update('user',$data);

		redirect(site_url('manager/karyawan'));
	}

	public function change($id,$user){
		if($this->session->userdata('status') != 'Manager'){
            redirect(site_url('welcome/error'));
        }
		$this->db->query('UPDATE user SET akses='.$id.' WHERE id_user='.$user);
		redirect('manager/karyawan');
	}
}