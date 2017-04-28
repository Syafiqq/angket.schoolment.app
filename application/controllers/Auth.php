<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 28 April 2017, 7:50 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
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
        unset($_SESSION['user']['auth']);
        if (isset($_SESSION['user']['auth']))
        {
            redirect('/dashboard');
        }
        // Your own constructor code
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if (isset($_GET['role']))
        {
            switch ($_GET['role'])
            {
                case 'counselor' :
                {
                    $this->load->view('auth/login/counselor');

                    return;
                }
                case 'student' :
                {
                    $this->load->view('auth/login/student');

                    return;
                }
                default:
                {
                    redirect('/auth/login?role=student');
                }
            }

            return;
        }
        redirect('/auth/login?role=student');
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function do_login()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['email']) &&
                isset($_POST['password']) &&
                isset($_POST['role'])
            )
            {
                $_POST['email'] = strtolower($_POST['email']);
                $_POST['role'] = strtolower($_POST['role']);
                if (($_POST['role'] == 'student') || ($_POST['role'] == 'counselor'))
                {
                    $this->load->model('mauth', 'auth');
                    $result = $this->auth->findByEmailAndRole($_POST['email'], $_POST['role']);
                    if (count($result) > 0)
                    {
                        if (password_verify($_POST['password'], $result[0]['password']))
                        {
                            $_SESSION['user']['auth'] = $result[0];
                            echo apiMakeCallback(API_SUCCESS, 'Accepted', ['notify' => [['Login Success', 'success']]], site_url('dashboard'));
                        }
                        else
                        {
                            echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Wrong Password', ['notify' => [['Wrong Password', 'info']]]);
                        }
                    }
                    else
                    {
                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'User Not Registered', ['notify' => [['User Not Registered', 'info']]]);
                    }
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Invalid Role', ['notify' => [['Invalid Role', 'info']]]);
                }
            }
            else
            {
                echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Insufficient Data', ['notify' => [['Insufficient Data', 'info']]]);
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Bad Request', ['notify' => [['Bad Request', 'danger']]]);
        }
    }

    public function do_register()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['name']) &&
                isset($_POST['email']) &&
                isset($_POST['role']) &&
                isset($_POST['gender']) &&
                isset($_POST['password'])
            )
            {
                $_POST['email'] = strtolower($_POST['email']);
                $_POST['role'] = strtolower($_POST['role']);
                if (($_POST['role'] == 'student') || ($_POST['role'] == 'counselor'))
                {
                    $_POST['gender'] = strtolower($_POST['gender']);
                    if (($_POST['gender'] == 'male') || ($_POST['gender'] == 'female'))
                    {
                        $this->load->model('mauth', 'auth');
                        $result = $this->auth->findByEmailAndRole($_POST['email'], $_POST['role']);
                        if (count($result) == 0)
                        {
                            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            $this->auth->register($_POST['name'], $_POST['email'], $_POST['role'], $_POST['gender'], $_POST['password']);
                            echo apiMakeCallback(API_SUCCESS, 'Register Success', ['notify' => [['Register Success', 'success']]], site_url("auth/login?role={$_POST['role']}"));
                        }
                        else
                        {
                            echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Email Already Exists', ['notify' => [['Email Already Exists', 'info']]]);
                        }
                    }
                    else
                    {
                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Invalid Gender', ['notify' => [['Invalid Gender', 'info']]]);
                    }
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Invalid Role', ['notify' => [['Invalid Role', 'info']]]);
                }
            }
            else
            {
                echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Insufficient Data', ['notify' => [['Insufficient Data', 'info']]]);
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Bad Request', ['notify' => [['Bad Request', 'danger']]]);
        }
    }


}