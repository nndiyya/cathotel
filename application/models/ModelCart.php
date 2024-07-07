<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelCart extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function get_profile($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all($id_user)
	{
		$this->db->select('id_keranjang, product.nama as nama_barang, quantity, harga, (quantity*harga) as total, bukti, status, resi');
		$this->db->join('product', 'product.id_product = keranjang.id_product');
		$this->db->where('status', 'belum');
		$this->db->where('id_user', $id_user);
		return $this->db->get('keranjang')->result_array();
	}

	public function get_all_sudah_dibayar($id_user)
	{
		$this->db->select('id_keranjang, product.nama as nama_barang, quantity, harga, (quantity*harga) as total, bukti, status, alamat, resi');
		$this->db->join('product', 'product.id_product = keranjang.id_product');
		$this->db->where('status !=', 'belum');
		$this->db->where('id_user', $id_user);
		return $this->db->get('keranjang')->result_array();
	}

	public function login($data)
	{
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_products()
	{
		return $this->db->get('product')->result_array();
	}

	public function refundItem($id)
	{
		$this->db->where('id_keranjang', $id);
		$this->db->set('status', 'refund');
		$this->db->set('resi', '');
		return $this->db->update('keranjang');
	}

	public function deleteItem($id)
	{
		$this->db->where('id_keranjang', $id)->delete('keranjang');
	}

	public function updateItem($id, $alamat)
	{
		$this->db->where_in('id_keranjang', $id);
		$this->db->set('alamat', $alamat);
		return $this->db->update('keranjang');
	}

	// Fungsi untuk mengambil item keranjang yang dipilih
	public function get_selected_cart_items($selected_items)
	{
		$this->db->where_in('id_keranjang', $selected_items);
		$query = $this->db->get('keranjang'); // Asumsikan 'keranjang' adalah tabel keranjang belanja Anda
		return $query->result_array();
	}

	// Fungsi untuk mengambil semua item dalam keranjang untuk user tertentu
	public function get_cart_items_by_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('keranjang'); // Asumsikan 'keranjang' adalah tabel keranjang belanja Anda
		return $query->result_array();
	}

	// Fungsi untuk menambahkan item ke dalam keranjang
	public function add_to_cart($data)
	{
		return $this->db->insert('keranjang', $data); // Asumsikan 'keranjang' adalah tabel keranjang belanja Anda
	}

	// Fungsi untuk menghapus item dari keranjang
	public function remove_from_cart($id_keranjang)
	{
		$this->db->where('id_keranjang', $id_keranjang);
		return $this->db->delete('keranjang'); // Asumsikan 'keranjang' adalah tabel keranjang belanja Anda
	}

	// Fungsi untuk memperbarui jumlah item dalam keranjang
	public function update_cart_item($id_keranjang, $quantity)
	{
		$this->db->where('id_keranjang', $id_keranjang);
		return $this->db->update('keranjang', array('quantity' => $quantity)); // Asumsikan 'keranjang' adalah tabel keranjang belanja Anda
	}

	// Tambahkan metode untuk mengambil item keranjang yang dipilih
	public function getSelectedItems($id_user, $selectedItems)
	{
		if (empty($selectedItems)) {
			return array();
		}

		$this->db->where('id_user', $id_user);
		$this->db->where_in('id_keranjang', $selectedItems);
		$query = $this->db->get('keranjang'); // Ganti 'keranjang' dengan nama tabel yang sesuai

		return $query->result_array();
	}
}

?>