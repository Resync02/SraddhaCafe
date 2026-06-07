<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_menu extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Ambil semua record dari tabel menu
   * @return array
   */
  public function get_all_kopi()
  {
    return $this->db->get('sraddha_menu')->result();
  }

  public function get_menu_images() {
    $this->db->select('gambar_produk');  // Gantilah dengan nama kolom yang sesuai
    $this->db->select('nama_produk');  // Gantilah dengan nama kolom yang sesuai
    $this->db->select('deskripsi_produk');  // Gantilah dengan nama kolom yang sesuai
    $this->db->from('sraddha_menu');  // Nama tabel
    
    $query = $this->db->get();

    return $query->result(); // Mengembalikan data dalam bentuk array
  }
  public function get_produk()
  {
      return $this->db->get('sraddha_menu')->result();
  }

  public function get_produk_by_id($id)
  {
      return $this->db->get_where('sraddha_menu', ['id' => $id])->row();
  }

  public function insert_produk($data)
  {
      return $this->db->insert('sraddha_menu', $data);
  }

  public function update_produk($id, $data)
  {
      $this->db->where('id', $id);
      return $this->db->update('sraddha_menu', $data);
  }

  public function delete_produk($id)
  {
      $this->db->where('id', $id);
      return $this->db->delete('sraddha_menu');
  }

  public function check_login($username, $password) {
      // Cek username dan password
      $this->db->where('username', $username);
      $this->db->where('password', $password);
      $query = $this->db->get('sraddha_adm_login'); 

      // Debug hasil query
      if ($query->num_rows() == 1) {
          return $query->row();  // Mengembalikan data user
      } else {
          return false;  // Jika login gagal
      }
  }
    public function laporan_harian($tanggal)
  {
      $this->db->where('tanggal', $tanggal);
      return $this->db->get('sraddha_order')->result();
  } 

  public function laporan_mingguan($start, $end)
  {
      $this->db->where('tanggal >=', $start);
      $this->db->where('tanggal <=', $end);
      return $this->db->get('sraddha_order')->result();
  }

  public function laporan_bulanan($bulan, $tahun)
  {
      $this->db->where('MONTH(tanggal)', $bulan);
      $this->db->where('YEAR(tanggal)', $tahun);
      return $this->db->get('sraddha_order')->result();
  }

    public function laporan_tahunan($tahun)
    {
        $this->db->where('YEAR(tanggal)', $tahun);
        return $this->db->get('sraddha_order')->result();
    }


}
