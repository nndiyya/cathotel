<?php
defined('BASEPATH') or exit('No direct script access allowed');


class ControlCart extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelCart');
	}

	public function index()
	{
		$data['product'] = $this->ModelCart->get_products();
		if (isset($_SESSION['logged_in'])) {
			$data['email'] = $this->session->userdata('email');
			$email = $this->session->userdata('email');
			$user = $this->ModelCart->get_profile($email);
			$data['nama'] = $user->nama;
			$data['id_user'] = $user->id_user;
			$data['keranjang'] = $this->ModelCart->get_all($data['id_user']);
			$data['keranjang_sudah_dibayar'] = $this->ModelCart->get_all_sudah_dibayar($data['id_user']);
		}
		$this->load->view('ViewCart', $data);
	}

	public function logout()
	{
		if (isset($_SESSION['email'])) {
			unset($_SESSION['email']);
		}
		if (isset($_SESSION['logged_in'])) {
			unset($_SESSION['logged_in']);
		}
		redirect('ControlShop');
	}

	public function login()
	{
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);
		$login = $this->ModelCart->login($data);
		if ($login == TRUE) {
			$this->session->set_userdata('email', $data['email']);
			$this->session->set_userdata('logged_in', TRUE);
			redirect('/ControlCart');
		} else {
			$this->session->set_flashdata('error_message', 'email atau password salah');
			redirect('/ControlCart');
		}
	}

	public function deleteItem()
	{
		$id = $this->uri->segment(3);
		$this->ModelCart->deleteItem($id);
		redirect('ControlCart');
	}

	public function refundItem()
	{
		$id = $this->uri->segment(3);
		$this->ModelCart->refundItem($id);
		redirect('ControlCart');
	}

	public function updateItem()
	{
		$id = $this->input->post('Myid');
		$myalamat = $this->input->post('Myalamat');
		$alamat = $this->input->post('alamat');
		if ($alamat == "") {
			$alamat = $myalamat;
		}
		$this->ModelCart->updateItem($id, $alamat);
		redirect('ControlCart');
	}

	public function exportToPdf()
	{
		// Load the Dompdf library
		$this->load->library('pdf');

		// Fetch the data to be included in the PDF
		$id_user = $this->input->post('id_user');
		$selected_items = $this->input->post('checkboxBayar');
		$alamat = $this->input->post('alamat');

		$this->load->model('ModelCart');
		$keranjang = $this->ModelCart->getSelectedItems($id_user, $selected_items);

		// Generate the HTML content
		$data = array(
			'keranjang' => $keranjang,
			'alamat' => $alamat
		);
		$html = $this->load->view('pdf_template', $data, true);

		// Create an instance of Dompdf and render the PDF
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();

		// Output the generated PDF to Browser
		$this->pdf->stream("Invoice_" . $id_user . ".pdf", array("Attachment" => 0));
	}
}
