<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

    }

    public function index()
    {
        $this->load->view('baked/cardiovaskular');
    }

    public function boilerplate()
    {
        $this->load->helper('cookie');
        echo get_cookie('cookie_name');

        $this->load->view('boilerplate');
    }

    public function bootstrap()
    {
        $this->load->view('bootstrap');
    }

    public function baked_musicplaylist()
    {
        $this->load->view('baked/musicplaylist');
    }

    public function baked_cardiovaskular()
    {
        $this->load->view('baked/cardiovaskular');
    }
}
