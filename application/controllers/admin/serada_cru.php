<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serada_cru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model sesuai nama class
        $this->load->model('Model_menu');
        $this->load->model('Model_order');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'upload']);
        
    }

    // Halaman login
    public function login()
    {
        $this->load->view('halaman_login');
    }

    // Proses login
    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Cek kredensial
        $user = $this->Model_menu->check_login($username, $password);

        if ($user) {
            // Set session
            $this->session->set_userdata([
                'username' => $user->username,
                'is_login' => TRUE,
                'role'      => $user->role
            ]);
            // Redirect ke halaman admin
            redirect('admin/serada_cru/halaman_admin');
        } else {
            // Gagal login
            $this->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('admin/serada_cru/login');
        }
    }

    // Halaman Admin (Dashboard)
    public function halaman_admin()
    {
        if ( ! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        $data['produk'] = $this->Model_menu->get_produk();
        $data['order_data'] = $this->Model_order->get_all();
        $this->load->view('template_admin/head');
        $this->load->view('template_admin/navbar');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/halaman_admin', $data);
        $this->load->view('template_admin/footer');
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('dashboard/index');
    }

    // Lihat daftar produk
    public function lihat_data()
    {
        // Pastikan login
        if ( ! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        $data['produk'] = $this->Model_menu->get_produk();
        $this->load->view('template_admin/head');
        $this->load->view('template_admin/navbar');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/lihat_produk', $data);
        $this->load->view('template_admin/footer');
    }

    // Detail produk
    public function detail($id)
    {
        if ( ! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        $data['produk'] = $this->Model_menu->get_produk_by_id($id);
        if ( ! $data['produk']) {
            show_404();
        }

        $this->load->view('template_admin/head');
        $this->load->view('template_admin/navbar');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/detail_produk', $data);
        $this->load->view('template_admin/footer');
    }

    // Tambah produk
    public function tambah_produk()
    {
        if ( ! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        if ($this->input->post()) {
            $nama_produk = trim($this->input->post('nama_produk'));
            // Cek duplikat
            $this->db->where('LOWER(nama_produk)', strtolower($nama_produk));
            if ($this->db->get('sraddha_menu')->row()) {
                $data['error'] = 'Nama produk sudah digunakan.';
            } else {
                // Upload gambar
                $config = [
                    'upload_path'   => './assets2/img/',
                    'allowed_types' => 'jpg|jpeg|png|gif',
                    'max_size'      => 2048,
                    'encrypt_name'  => FALSE
                ];
                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar_produk')) {
                    $file = $this->upload->data('file_name');
                    $insert = [
                        'nama_produk'      => $nama_produk,
                        'deskripsi_produk' => $this->input->post('deskripsi_produk'),
                        'kategori_produk'  => $this->input->post('kategori_produk'),
                        'harga'            => $this->input->post('harga'),
                        'gambar_produk'    => $file
                    ];
                    $this->Model_menu->insert_produk($insert);
                    redirect('admin/serada_cru/lihat_data');
                } else {
                    $data['error'] = $this->upload->display_errors();
                }
            }
        }

        $this->load->view('template_admin/head');
        $this->load->view('template_admin/navbar');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/tambah_produk', isset($data) ? $data : NULL);
        $this->load->view('template_admin/footer');
    }

    // Edit produk
    public function edit_product($id)
    {
        if ( ! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        $data['produk'] = $this->Model_menu->get_produk_by_id($id);
        if ( ! $data['produk']) {
            show_404();
        }

        if ($this->input->post()) {
            $config = [
                'upload_path'   => './assets/img/',
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 2048
            ];
            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar_produk')) {
                // Hapus gambar lama
                if ($data['produk']->gambar_produk && file_exists('./assets/img/'.$data['produk']->gambar_produk)) {
                    unlink('./assets/img/'.$data['produk']->gambar_produk);
                }
                $upd['gambar_produk'] = $this->upload->data('file_name');
            }
            $upd['nama_produk']      = $this->input->post('nama_produk');
            $upd['deskripsi_produk'] = $this->input->post('deskripsi_produk');
            $upd['harga']            = $this->input->post('harga');
            $this->Model_menu->update_produk($id, $upd);
            redirect('admin/serada_cru/lihat_data');
        }

        $this->load->view('template_admin/head');
        $this->load->view('template_admin/navbar');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/edit_produk', $data);
        $this->load->view('template_admin/footer');
    }

    // Delete produk
    public function delete_product($id)
    {
        if ( ! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }
        $this->Model_menu->delete_produk($id);
        redirect('admin/serada_cru/lihat_data');
    }

    public function ubah_status($id)
    {
        $this->db->where('id_order', $id);
        $this->db->update('sraddha_order', ['status' => 'Sudah dibayar']);
        redirect('admin/serada_cru/lihat_order');
    }

    public function lihat_order()
    {
        // Pastikan login
        if (! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        $data['sraddha_order'] = $this->db->get('sraddha_order')->result(); 

        $this->load->view('template_admin/head');
        $this->load->view('template_admin/navbar');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/lihat_order', $data); 
        $this->load->view('template_admin/footer');
    }

    public function tambah_order()
{
    if (!$this->session->userdata('is_login')) {
        redirect('admin/serada_cru/login');
    }

    // Ambil data produk dari model
    $data['produk'] = $this->Model_menu->get_produk(); // Harus ada di model

    // Tampilkan view
    $this->load->view('template_admin/head');
    $this->load->view('template_admin/navbar');
    $this->load->view('template_admin/sidebar');
    $this->load->view('admin/tambah_order', $data); // Pastikan nama view sesuai
    $this->load->view('template_admin/footer');
}

    public function simpan_order()
{
    $this->load->database();

    $nama_pemesan   = $this->input->post('nama_pemesan', TRUE);
    $produk_dipesan = $this->input->post('produk_dipesan', TRUE); // array nama produk
    $jumlah_list    = $this->input->post('jumlah', TRUE);         // array jumlah
    $harga_list     = $this->input->post('harga', TRUE);          // array harga
    $pembayaran     = $this->input->post('pembayaran', TRUE);
    $status         = $this->input->post('status', TRUE);
    $tanggal        = date('Y-m-d');

    $produk_final = [];
    $harga_rinci  = [];
    $total_semua  = 0;

    if (is_array($produk_dipesan) && is_array($jumlah_list) && is_array($harga_list)) {
        $jumlah_produk = count($produk_dipesan);

        for ($i = 0; $i < $jumlah_produk; $i++) {
            $produk = isset($produk_dipesan[$i]) ? trim($produk_dipesan[$i]) : '';
            $jumlah = isset($jumlah_list[$i]) ? (int)$jumlah_list[$i] : 0;
            $harga  = isset($harga_list[$i]) ? (int)$harga_list[$i] : 0;

            if ($produk !== '' && $jumlah > 0 && $harga > 0) {
                $subtotal = $jumlah * $harga;
                $total_semua += $subtotal;

                // Format produk_dipesan: NAMA + JUMLAH|HARGA
                $produk_final[] = "$produk + $jumlah|$harga";

                // Simpan hanya harga (tanpa nama produk)
                $harga_rinci[] = "$harga";
            }
        }
    }

    // Gabungkan menjadi string baris-baris
    $produk_dipesan_string = implode("\n", $produk_final);
    $harga_string = implode("\n", $harga_rinci);

    // Siapkan data untuk disimpan
    $data = [
        'nama_pemesan'   => $nama_pemesan,
        'produk_dipesan' => $produk_dipesan_string,
        'pembayaran'     => $pembayaran,
        'harga'          => $harga_string,
        'status'         => $status,
        'total_harga'    => $total_semua,
        'tanggal'        => $tanggal
    ];

    // Simpan ke database
    $this->db->insert('sraddha_order', $data);

    // Redirect ke halaman lihat order
    redirect('admin/serada_cru/lihat_order');
}



    public function delete_order($id_order)
    {
        // Pastikan login
        if ( ! $this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        // Cek apakah ID ada di database
        $order = $this->db->get_where('sraddha_order', ['id_order' => $id_order])->row();

        if ($order) {
            $this->db->where('id_order', $id_order);
            $this->db->delete('sraddha_order');

            $this->session->set_flashdata('success', 'Data order berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data order tidak ditemukan.');
        }

        redirect('admin/serada_cru/lihat_order');
    }

    public function laporan()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('admin/serada_cru/login');
        }

        $filter = $this->input->get('filter');
        $data['hasil'] = [];

        if ($filter == 'harian') {
            $tanggal = $this->input->get('tanggal');
            $data['hasil'] = $this->Model_menu->laporan_harian($tanggal);
        } elseif ($filter == 'mingguan') {
            $start = $this->input->get('start');
            $end = $this->input->get('end');
            $data['hasil'] = $this->Model_menu->laporan_mingguan($start, $end);
        } elseif ($filter == 'bulanan') {
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $data['hasil'] = $this->Model_menu->laporan_bulanan($bulan, $tahun);
        } elseif ($filter == 'tahunan') {
            $tahun = $this->input->get('tahun_tahunan'); // ← Bukan $_GET['tahun'] lagi
            $data['hasil'] = $this->Model_menu->laporan_tahunan($tahun);
        }

        $this->load->view('template_admin/head');
        $this->load->view('template_admin/navbar');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/vlaporan', $data);  // Buat file ini
        $this->load->view('template_admin/footer');
    }

    public function export_pdf()
{
    if (!$this->session->userdata('is_login')) {
        redirect('admin/serada_cru/login');
    }

    $filter = $this->input->get('filter');
    $data['hasil'] = [];

    if ($filter == 'bulanan') {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $data['hasil'] = $this->Model_menu->laporan_bulanan($bulan, $tahun);
    }
    if ($filter == 'tahunan') {
        $tahun = $this->input->get('tahun');
        $data['hasil'] = $this->Model_menu->laporan_tahunan($tahun);
    }
    if ($filter == 'harian') {
        $tanggal = $this->input->get('tanggal');
        $data['hasil'] = $this->Model_menu->laporan_harian($tanggal);
    }
    if ($filter == 'mingguan') {
        $start = $this->input->get('start');
        $end = $this->input->get('end');     
        $data['hasil'] = $this->Model_menu->laporan_mingguan($start, $end);
    }

    $this->load->library('dompdf_gen');

    $html = $this->load->view('admin/laporan_pdf', $data, true);

    $this->dompdf_gen->loadHtml($html);
    $this->dompdf_gen->setPaper('A4', 'portrait');
    $this->dompdf_gen->render();
    $this->dompdf_gen->stream("laporan.pdf", array("Attachment" => false));

}

}
