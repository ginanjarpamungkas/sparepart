<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{	
		$this->load->view('login');
	}
	
	public function login_action()
	{	
		$this->db->select('user.*');
		$this->db->where('user.username',$_POST['username']);
		$this->db->where('user.password',($_POST['password']));
		$this->db->where('user.akses','1');
		$data = $this->db->get('user')->row();

		if(count($data) == 1){
			$session = array(
			'id_user' => $data->id_user,
			'nama_user' => $data->nama_user,
			'status' => $data->status,
			'since'=>$data->create_at,
			);
			$this->session->set_userdata($session);

			if($data->status == "Manager")
			{
				$this->session->set_flashdata('berhasil',$this->session->nama_user.', anda berhasil login.');
				redirect('Manager');
			}
			else if($data->status == "Kasir")
			{
				$this->session->set_flashdata('berhasil',$this->session->nama_user.', anda berhasil login.');
				redirect('Penjualan');
			}
			else if($data->status == "Gudang")
			{
				$this->session->set_flashdata('berhasil',$this->session->nama_user.', anda berhasil login.');
				redirect('Gudang');
			}

		}
		else
		{
			$this->session->set_flashdata('gagal','Username atau password yang anda masukan salah, atau akses dinonaktifkan oleh MANAGER');
			redirect('welcome/index');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome/index');
	}

    public function error() 
    {
        $this->load->view('error');
    }
    public function profil(){
    	$id = $this->input->post('id2');
		$data=$this->db->query('SELECT *,DATE_FORMAT(create_at, "%d %M %Y") as tanggal FROM user WHERE id_user='.$id)->row();

		echo json_encode($data);
    }
    public function update(){
    	$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			);
		$id=$_POST['id'];

		$this->db->where('id_user',$id);
		$this->db->update('user',$data);
		if($this->session->userdata('status') == 'Kasir'){
            redirect(site_url('Penjualan'));
        }
        if($this->session->userdata('status') == 'Gudang'){
            redirect(site_url('Gudang'));
        }
        if($this->session->userdata('status') == 'Manager'){
            redirect(site_url('Manager'));
        }
    }
}
