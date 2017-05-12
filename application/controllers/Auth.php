<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 28 April 2017, 7:50 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

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
        unset($_SESSION['user']);
        if (isset($_SESSION['user']['auth']))
        {
            redirect('/dashboard');
        }
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
                    $this->load->view('auth/login/counselor-login-auth');

                    return;
                }
                case 'student' :
                {
                    $this->load->view('auth/login/student-login-auth');

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
        if (isset($_GET['role']))
        {
            switch ($_GET['role'])
            {
                case 'counselor' :
                {
                    $this->load->view('auth/register/counselor-register-auth');

                    return;
                }
                case 'student' :
                {
                    $this->load->view('auth/register/student-register-auth');

                    return;
                }
                default:
                {
                    redirect('/auth/register?role=student');
                }
            }

            return;
        }
        redirect('/auth/register?role=student');
    }

    public function recover()
    {
        if (isset($_GET['role']))
        {
            if (isset($_GET['token']))
            {

                switch ($_GET['role'])
                {
                    case 'counselor' :
                    {
                        $this->load->view('auth/recover/counselor-recover-confirm-auth', ['token' => urldecode($_GET['token'])]);

                        return;
                    }
                    case 'student' :
                    {
                        $this->load->view('auth/recover/student-recover-confirm-auth', ['token' => urldecode($_GET['token'])]);

                        return;
                    }
                }

                return;
            }
            else
            {
                switch ($_GET['role'])
                {
                    case 'counselor' :
                    {
                        $this->load->view('auth/recover/counselor-recover-auth');

                        return;
                    }
                    case 'student' :
                    {
                        $this->load->view('auth/recover/student-recover-auth');

                        return;
                    }
                    default:
                    {
                        redirect('/auth/recover?role=student');
                    }
                }

                return;
            }
        }
        redirect('/auth/recover?role=student');
    }

    public function do_login()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['credential']) &&
                isset($_POST['password']) &&
                isset($_POST['role'])
            )
            {
                $_POST['credential'] = strtolower($_POST['credential']);
                $_POST['role'] = strtolower($_POST['role']);
                if (($_POST['role'] == 'student') || ($_POST['role'] == 'counselor'))
                {
                    $this->load->model('mauth', 'auth');
                    $result = [];
                    switch ($_POST['role'])
                    {
                        case 'student' :
                        {
                            $result = $this->auth->findStudentByCredential($_POST['credential']);
                        }
                            break;
                        case 'counselor' :
                        {
                            $result = $this->auth->findCounselorByCredential($_POST['credential']);
                        }
                            break;
                    }
                    if (count($result) > 0)
                    {
                        if (password_verify($_POST['password'], $result[0]['password']))
                        {
                            $_SESSION['user']['auth'] = $result[0];
                            $_SESSION['user']['auth']['role'] = $_POST['role'];
                            $this->load->model('minventory', 'inventory');
                            $_detail = [];
                            switch ($_POST['role'])
                            {
                                case 'student' :
                                {
                                    $result = $this->inventory->getAnsweredQuestionByUserID($_SESSION['user']['auth']['id']);
                                    if(count($result) > 0)
                                    {
                                        $_detail['total'] = count($result);
                                        $_detail['latest'] = ['date' => $result[0]['answer_at'], 'value' => $this->inventory->getAnsweredResultSummaryByID($result[0]['id'])[0]['value']];

                                        $_result = $this->inventory->getHighestSummaryByUserID($_SESSION['user']['auth']['id']);
                                        foreach ($result as $vr)
                                        {
                                            if((int)$vr['id'] === (int)$_result[0]['answer_id'])
                                            {
                                                $_detail['highest'] = ['date' => $vr['answer_at'], 'value' => $_result[0]['value']];
                                                break;
                                            }
                                        }

                                        $_result = $this->inventory->getLowestSummaryByUserID($_SESSION['user']['auth']['id']);
                                        foreach ($result as $vr)
                                        {
                                            if((int)$vr['id'] === (int)$_result[0]['answer_id'])
                                            {
                                                $_detail['lowest'] = ['date' => $vr['answer_at'], 'value' => $_result[0]['value']];
                                                break;
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $_detail['total'] = null;
                                        $_detail['latest'] = null;
                                        $_detail['highest'] = null;
                                        $_detail['lowest'] = null;
                                    }
                                    $_SESSION['user']['data']['record'] = $_detail;
                                }
                                    break;
                            }
                            echo apiMakeCallback(API_SUCCESS, 'Accepted', ['notify' => [['Login Sukses', 'success']]], site_url('dashboard'));
                        }
                        else
                        {
                            echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Password Salah', ['notify' => [['Password Salah', 'info']]]);
                        }
                    }
                    else
                    {
                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Akun Belum Terdaftar', ['notify' => [['Akun Belum Terdaftar', 'info']]]);
                    }
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Peran Tidak Diketahui', ['notify' => [['Peran Tidak Diketahui', 'info']]]);
                }
            }
            else
            {
                echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Data Kurang Lengkap', ['notify' => [['Data Kurang Lengkap', 'info']]]);
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
        }
    }

    public function do_register()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['name']) &&
                isset($_POST['credential']) &&
                isset($_POST['role']) &&
                isset($_POST['gender']) &&
                isset($_POST['password']) &&
                isset($_POST['coupon'])
            )
            {
                $this->load->model('mcoupon', 'coupon');
                $coupon = $this->coupon->getByCoupon($_POST['coupon']);
                if (count($coupon) > 0)
                {
                    $this->coupon->deleteByCoupon($_POST['coupon']);
                    $_POST['credential'] = strtolower($_POST['credential']);
                    $_POST['role'] = strtolower($_POST['role']);
                    if (($_POST['role'] == 'student') || ($_POST['role'] == 'counselor'))
                    {
                        $_POST['gender'] = strtolower($_POST['gender']);
                        if (($_POST['gender'] == 'male') || ($_POST['gender'] == 'female'))
                        {
                            $this->load->model('mauth', 'auth');
                            switch ($_POST['role'])
                            {
                                case 'student' :
                                {
                                    $result = $this->auth->findStudentByCredential($_POST['credential']);
                                    if (count($result) == 0)
                                    {
                                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                        $this->auth->registerStudent($_POST['name'], $_POST['credential'], $_POST['gender'], $_POST['password']);
                                        echo apiMakeCallback(API_SUCCESS, 'Register Sukses', ['notify' => [['Register Success', 'success']]], site_url("auth/login?role={$_POST['role']}"));
                                    }
                                    else
                                    {
                                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'NISN Sudah Terdaftar', ['notify' => [['NISN Sudah Terdaftar', 'info']]]);
                                    }
                                }
                                    break;
                                case 'counselor' :
                                {
                                    $result = $this->auth->findCounselorByCredential($_POST['credential']);
                                    if (count($result) == 0)
                                    {
                                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                        $this->auth->registerCounselor($_POST['name'], $_POST['credential'], $_POST['gender'], $_POST['password']);
                                        echo apiMakeCallback(API_SUCCESS, 'Register Sukses', ['notify' => [['Register Sukses', 'success']]], site_url("auth/login?role={$_POST['role']}"));
                                    }
                                    else
                                    {
                                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'NIP/NIK Sudah Terdaftar', ['notify' => [['NIP/NIK Sudah Terdaftar', 'info']]]);
                                    }
                                }
                                    break;
                            }
                        }
                        else
                        {
                            echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Jenis Kelamin Tidak Diketahui', ['notify' => [['Jenis Kelamin Tidak Diketahui', 'info']]]);
                        }
                    }
                    else
                    {
                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Peran Tidak Diketahui', ['notify' => [['Peran Tidak Diketahui', 'info']]]);
                    }
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Kupon Tidak Berlaku', ['notify' => [['Kupon Tidak Berlaku', 'info']]]);
                }
            }
            else
            {
                echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Data Kurang Lengkap', ['notify' => [['Data Kurang Lengkap', 'info']]]);
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
        }
    }

    public function do_recover()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['name']) &&
                isset($_POST['credential']) &&
                isset($_POST['role']) &&
                isset($_POST['gender']) &&
                isset($_POST['created'])
            )
            {
                $_POST['credential'] = strtolower($_POST['credential']);
                $_POST['role'] = strtolower($_POST['role']);
                if (($_POST['role'] == 'student') || ($_POST['role'] == 'counselor'))
                {
                    $_POST['gender'] = strtolower($_POST['gender']);
                    if (($_POST['gender'] == 'male') || ($_POST['gender'] == 'female'))
                    {
                        $this->load->model('mauth', 'auth');
                        switch ($_POST['role'])
                        {
                            case 'student' :
                            {
                                $account = $this->auth->findStudentByCredential($_POST['credential']);
                                if (count($account) <= 0)
                                {
                                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'NISN Belum Terdaftar', ['notify' => [['NISN Belum Terdaftar', 'info']]]);

                                    return;
                                }
                            }
                                break;
                            case 'counselor' :
                            {
                                $account = $this->auth->findCounselorByCredential($_POST['credential']);
                                if (count($account) <= 0)
                                {
                                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'NIP/NIK Belum Terdaftar', ['notify' => [['NIP/NIK Belum Terdaftar', 'info']]]);

                                    return;
                                }
                            }
                        }
                        $account = $account[0];
                        $_created = Carbon::createFromFormat('Y-m-d', $_POST['created']);
                        $_createdDB = Carbon::createFromFormat('Y-m-d H:i:s', $account['create_at']);
                        if (($_POST['name'] === $account['name']) &&
                            ($_POST['gender'] === $account['gender']) &&
                            ($_created->isSameDay($_createdDB))
                        )
                        {
                            $token = base64_encode(bin2hex(random_bytes(32)));
                            $this->load->model('mrecovery', 'recovery');
                            $recovery = $this->recovery->getByUserIdAndRole($account['id'], $_POST['role']);
                            if (count($recovery) > 0)
                            {
                                $this->recovery->updateToken($recovery[0]['id'], $token);
                            }
                            else
                            {
                                $this->recovery->create($account['id'], $_POST['role'], $token);
                            }
                            $token = urlencode($token);
                            echo apiMakeCallback(API_SUCCESS, 'User Terdaftar', ['notify' => [['User Terdaftar', 'success']]], site_url("auth/recover?role={$_POST['role']}&token={$token}"));
                        }
                        else
                        {
                            echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Data Tidak Benar', ['notify' => [['Data Tidak Benar', 'info']]]);
                        }
                    }
                    else
                    {
                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Jenis Kelamin Tidak Diketahui', ['notify' => [['Jenis Kelamin Tidak Diketahui', 'info']]]);
                    }
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Peran Tidak Diketahui', ['notify' => [['Peran Tidak Diketahui', 'info']]]);
                }
            }
            else
            {
                echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Data Kurang Lengkap', ['notify' => [['Data Kurang Lengkap', 'info']]]);
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
        }
    }

    public function do_recover_confirm()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['password']) &&
                isset($_POST['token'])
            )
            {
                $this->load->model('mrecovery', 'recovery');
                $recovery = $this->recovery->getByToken($_POST['token']);
                if (count($recovery) > 0)
                {
                    $this->load->model('mauth', 'auth');
                    $recovery = $recovery[0];
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    switch ($recovery['role'])
                    {
                        case 'student' :
                        {
                            $this->auth->updatePasswordStudentByID($recovery['user'], $_POST['password']);
                        }
                            break;
                        case 'counselor' :
                        {
                            $this->auth->updatePasswordCounselorByID($recovery['user'], $_POST['password']);
                        }
                    }
                    $this->recovery->deleteById($recovery['id']);
                    echo apiMakeCallback(API_SUCCESS, 'Update Berhasil', ['notify' => [['Update Berhasil', 'success']]], site_url("auth/login?role={$recovery['role']}"));
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Token Belum Terdaftar', ['notify' => [['Token Belum Terdaftar', 'info']]]);
                }
            }
            else
            {
                echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Data Kurang Lengkap', ['notify' => [['Data Kurang Lengkap', 'info']]]);
            }
        }
        else
        {
            echo apiMakeCallback(API_BAD_REQUEST, 'Permintaan Tidak Dapat Dikenali', ['notify' => [['Permintaan Tidak Dapat Dikenali', 'danger']]]);
        }
    }

    public function do_logout()
    {
        unset($_SESSION['user']);
        echo apiMakeCallback(API_SUCCESS, 'Logout Sukses', ['notify' => [['Logout Sukses', 'success']]], site_url('/'));
    }
}
