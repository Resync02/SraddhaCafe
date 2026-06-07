<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_menu');
    }

    public function index()
    {
        $data['kopis'] = $this->Model_menu->get_all_kopi();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }

    public function menu()
    {
        // Ambil data gambar menu dari database
        $data['menu_images'] = $this->Model_menu->get_menu_images();

        // Load view dengan data menu_images
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('menu', $data);
        $this->load->view('template/footer');
    }

    public function about()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('about');
        $this->load->view('template/footer');
    }

    public function book()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('book');
        $this->load->view('template/footer');
    }

    public function booking()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('booking');
        $this->load->view('template/footer');
    }

}
