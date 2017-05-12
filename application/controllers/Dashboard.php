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
        $profile = $_SESSION['user']['auth'];
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {

                $profile['assets']['record'] = $this->generateCounselorRecord();
                $this->load->view('dashboard/view/counselor-view-dashboard', compact('profile'));

                return;
            }
            case 'student' :
            {
                $profile['assets'] = $_SESSION['user']['data'];
                $this->load->view('dashboard/view/student-view-dashboard', compact('profile'));

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

    public function jump()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_GET['tab']))
            {
                $path = urldecode($_GET['tab']);
                switch ($_SESSION['user']['auth']['role'])
                {
                    case 'counselor' :
                    {
                        switch ($path)
                        {
                            case 'dashboard' :
                            {
                                echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                            }
                                break;
                            default:
                            {
                                echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
                            }
                                break;
                        }

                        return;
                    }
                    case 'student' :
                    {
                        switch ($path)
                        {
                            case 'dashboard' :
                            {
                                echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                            }
                                break;
                            default:
                            {
                                echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
                            }
                                break;
                        }

                        return;
                    }
                }
            }
            else
            {
                echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
        }
    }

    private function generateCounselorRecord()
    {
        $this->load->model('mauth', 'auth');
        $this->load->model('minventory', 'inventory');
        $detail = [];
        $_counselor = $this->auth->getAllCounselor();
        $_student = $this->auth->getAllStudent();
        $_question = $this->inventory->getQuestion();
        $_latest = $this->inventory->getLatestAnswer();

        $dispatcher = ['male' => 0, 'female' => 0];
        foreach ($_counselor as $_vc)
        {
            if($_vc['gender'] === 'female')
            {
                ++$dispatcher['female'];
            }
            else
            {
                ++$dispatcher['male'];
            }
        }
        $detail['counselor'] = $dispatcher;
        $dispatcher = ['male' => 0, 'female' => 0];
        foreach ($_student as $_vs)
        {
            if($_vs['gender'] === 'female')
            {
                ++$dispatcher['female'];
            }
            else
            {
                ++$dispatcher['male'];
            }
        }
        $detail['student'] = $dispatcher;
        $dispatcher = ['active' => 0, 'inactive' => 0];
        foreach ($_question as $_vq)
        {
            if((int)$_vq['is_active'] === 1)
            {
                ++$dispatcher['active'];
            }
            else
            {
                ++$dispatcher['inactive'];
            }
        }
        $detail['question'] = $dispatcher;
        $detail['latest'] = $_latest;
        return $detail;
    }
}
