<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 28 April 2017, 3:12 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->load->helper('api_facade');
        $this->load->library('session');
        if (!isset($_SESSION['user']['auth']))
        {
            redirect('/auth/login');
        }
        // Your own constructor code
    }

    public function index()
    {
        $this->view();
    }

    public function view()
    {
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $this->load->view('dashboard/view/counselor-view-dashboard');

                return;
            }
            case 'student' :
            {
                $this->load->view('dashboard/view/student-view-dashboard');

                return;
            }
        }
    }

    public function do_generate_coupon()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            switch ($_SESSION['user']['auth']['role'])
            {
                case 'counselor' :
                {
                    $coupon = strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
                    $this->load->model('mcoupon', 'coupon');
                    $this->coupon->insert($_SESSION['user']['auth']['id'], $coupon);
                    echo apiMakeCallback(API_SUCCESS, 'Generate Kupon Berhasil', ['notify' => [['Generate Kupon Berhasil', 'success']], 'coupon' => $coupon]);

                    return;
                }
                case 'student' :
                {
                    echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);

                    return;
                }
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
        }
    }
}