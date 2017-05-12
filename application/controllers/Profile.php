<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 02 May 2017, 11:48 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
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
                $profile = $_SESSION['user']['auth'];
                $profile['assets']['record'] = $this->generateCounselorRecord();

                $this->load->view('profile/view/counselor-view-profile', compact('profile'));

                return;
            }
            case 'student' :
            {
                $this->load->model('minventory', 'inventory');
                $have_entry = $this->inventory->getAnsweredUser($_SESSION['user']['auth']['id']);
                $have_entry = count($have_entry) > 0;
                $profile = $_SESSION['user']['auth'];
                $profile['assets'] = $_SESSION['user']['data'];

                $this->load->view('profile/view/student-view-profile', compact('profile', 'have_entry'));

                return;
            }
        }
    }

    public function edit()
    {
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $profile = $_SESSION['user']['auth'];
                $profile['assets']['record'] = $this->generateCounselorRecord();

                $this->load->view('profile/edit/counselor-edit-profile', compact('profile'));

                return;
            }
            case 'student' :
            {
                $this->load->model('minventory', 'inventory');
                $have_entry = $this->inventory->getAnsweredUser($_SESSION['user']['auth']['id']);
                $have_entry = count($have_entry) > 0;
                $profile = $_SESSION['user']['auth'];
                $profile['assets'] = $_SESSION['user']['data'];

                $this->load->view('profile/edit/student-edit-profile', compact('profile', 'have_entry'));

                return;
            }
        }

        return;
    }

    public function do_edit_avatar()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_FILES['image']))
            {
                $dest = "/assets/img/avatar/user/{$_SESSION['user']['auth']['role']}/{$_SESSION['user']['auth']['id']}" . image_type_to_extension(getimagesize($_FILES['image']['tmp_name'])[2]);
                if (move_uploaded_file($_FILES['image']['tmp_name'], FCPATH . $dest))
                {
                    $this->load->helper('image_processing');
                    makeProperImage($dest, $dest);
                    $this->load->model('mauth', 'auth');
                    switch ($_SESSION['user']['auth']['role'])
                    {
                        case 'counselor' :
                        {
                            $this->auth->updateAvatarCounselorByID($_SESSION['user']['auth']['id'], $dest);
                            $_SESSION['user']['auth'] = $this->auth->findCounselorByID($_SESSION['user']['auth']['id']);

                            break;
                        }
                        case 'student' :
                        {
                            $this->auth->updateAvatarStudentByID($_SESSION['user']['auth']['id'], $dest);
                            $_SESSION['user']['auth'] = $this->auth->findStudentByID($_SESSION['user']['auth']['id']);

                            break;
                        }
                    }
                    echo apiMakeCallback(API_SUCCESS, 'Update Berhasil', ['notify' => [['Update Berhasil', 'success']]], site_url('profile/edit'));
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Gagal Update', ['notify' => [['Gagal Update', 'info']]]);
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

    public function do_edit_additional()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['address']) &&
                isset($_POST['birthplace']) &&
                isset($_POST['datebirth']) &&
                isset($_POST['school']) &&
                ($_SESSION['user']['auth']['role'] === 'student' ?
                    (isset($_POST['grade'])) : true) &&
                ($_SESSION['user']['auth']['role'] === 'counselor' ?
                    (isset($_POST['school_address']) &&
                        isset($_POST['head']) &&
                        isset($_POST['head_credential'])) : true)
            )
            {
                $this->load->model('mauth', 'auth');
                $_role = $_SESSION['user']['auth']['role'];
                switch ($_SESSION['user']['auth']['role'])
                {
                    case 'counselor' :
                    {
                        $this->auth->updateAdditionalCounselorByID($_SESSION['user']['auth']['id'], $_POST['school'], $_POST['school_address'], $_POST['head'], $_POST['head_credential'], $_POST['address'], $_POST['birthplace'], $_POST['datebirth']);
                        $_SESSION['user']['auth'] = $this->auth->findCounselorByID($_SESSION['user']['auth']['id'])[0];
                        break;
                    }
                    case 'student' :
                    {
                        $this->auth->updateAdditionalStudentByID($_SESSION['user']['auth']['id'], $_POST['school'], $_POST['grade'], $_POST['address'], $_POST['birthplace'], $_POST['datebirth']);
                        $_SESSION['user']['auth'] = $this->auth->findStudentByID($_SESSION['user']['auth']['id'])[0];
                        break;
                    }
                }
                $_SESSION['user']['auth']['role'] = $_role;
                echo apiMakeCallback(API_SUCCESS, 'Update Berhasil', ['notify' => [['Update Berhasil', 'success']]], site_url('profile'));
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
                            case 'profile' :
                            {
                                echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                            }
                                break;
                            case 'profile/edit' :
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
                            case 'profile' :
                            {
                                echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                            }
                                break;
                            case 'profile/edit' :
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
