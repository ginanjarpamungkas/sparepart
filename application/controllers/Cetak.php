<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	public function index($id)
	{
		$pdfFilePath = FCPATH."/downloads/pembelian.pdf";

		$data['beli']=$this->db->query('SELECT DATE_FORMAT(tgl_beli, "%d - %M - %Y %h:%m:%s") AS tgl_beli, id_beli, total_beli, tunai, kembali FROM beli WHERE id_beli='.$id)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_beli INNER JOIN spareparts ON spareparts.id_sparepart=detail_beli.id_sparepart WHERE id_beli= '.$id.' ORDER By nama_sparepart')->result();

		if (file_exists($pdfFilePath) == FALSE)
		{
			ini_set('memory_limit','32M');

			$html = $this->load->view('gudang/printpdf', $data, true);

			$this->load->library('pdf');

			$pdf = $this->pdf->load();
			

			$pdf->WriteHTML($html);

			$pdf->Output($pdfFilePath, 'I');

		}


		redirect("/downloads/pembelian.pdf");

	}

	public function jual($id)
	{
		$pdfFilePath = FCPATH."/downloads/penjualan.pdf";

		$data['jual']=$this->db->query('SELECT DATE_FORMAT(tgl_jual, "%d - %M - %Y %h:%m:%s") AS tgl_jual, id_jual, total_jual,tunai,kembali FROM jual WHERE id_jual='.$id)->row();
		$data['bayar']=$this->db->query('SELECT * FROM detail_jual INNER JOIN spareparts ON spareparts.id_sparepart=detail_jual.id_sparepart WHERE id_jual= '.$id.' ORDER By nama_sparepart')->result();

		if (file_exists($pdfFilePath) == FALSE)
		{
			ini_set('memory_limit','32M');

			$html = $this->load->view('penjualan/printpdf', $data, true);

			$this->load->library('pdf');

			$pdf = $this->pdf->load();

			$pdf->WriteHTML($html);

			$pdf->Output($pdfFilePath, 'I');

		}

		redirect("/downloads/penjualan.pdf");

	}
}
