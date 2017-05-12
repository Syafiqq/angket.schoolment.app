<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 04 May 2017, 5:07 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller
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
                $this->load->model('minventory', 'inventory');
                $favourables = $this->inventory->getFavourable();
                $categories = $this->inventory->getCategory();
                $questions = $this->inventory->getQuestion();
                $profile['assets']['record'] = $this->generateCounselorRecord();
                $this->load->view('inventory/view/counselor-view-inventory', compact('favourables', 'categories', 'questions', 'profile'));

                return;
            }
            case 'student' :
            {
                $this->load->helper('identity_checking');
                $b_test = $this->allowedToTakeTest();
                $b_complete = isStudentIdentityIsComplete($_SESSION['user']['auth']);
                $profile['assets'] = $_SESSION['user']['data'];
                $this->load->view('inventory/view/student-view-inventory', compact('b_test', 'b_complete', 'profile'));

                return;
            }
        }
    }

    private function allowedToTakeTest()
    {
        $allowed = false;
        $this->load->model('mauth', 'auth');
        $this->load->model('manswer', 'answer');
        $answered = $this->answer->getLatestAnsweredByStudentID($_SESSION['user']['auth']['id']);

        if (count($answered) > 0)
        {
            $answered = Carbon::createFromFormat('Y-m-d H:i:s', $answered[0]['answer_at']);

            if ((int)$_SESSION['user']['auth']['is_active'] === 1)
            {
                $allowed = true;
            }
            else
            {
                if ($answered->diffInDays(Carbon::now('Asia/Jakarta')) <= 7)
                {
                    $allowed = false;
                }
                else
                {
                    $allowed = true;
                }
            }
        }
        else
        {
            $allowed = true;
        }

        return $allowed;
    }

    public function test()
    {
        $profile = $_SESSION['user']['auth'];
        $profile['assets'] = $_SESSION['user']['data'];

        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                redirect('/inventory');

                return;
            }
            case 'student' :
            {
                $this->load->helper('identity_checking');
                $allowed = $this->allowedToTakeTest();
                $allowed &= isStudentIdentityIsComplete($_SESSION['user']['auth']);
                if ($allowed)
                {
                    $this->load->model('minventory', 'inventory');
                    $questions = $this->inventory->getQuestionByActive(1);
                    $options = $this->inventory->getOptions();
                    $this->load->view('inventory/test/student-test-inventory', compact('questions', 'options', 'profile'));
                }
                else
                {
                    redirect('/inventory');
                }

                return;
            }
        }
    }

    public function result()
    {
        $profile = $_SESSION['user']['auth'];
        $profile['assets'] = $_SESSION['user']['data'];

        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                redirect('/inventory');

                return;
            }
            case 'student' :
            {
                $this->load->model('minventory', 'inventory');
                $_answered = $this->inventory->getAnsweredUser($_SESSION['user']['auth']['id']);
                $answered = [];
                $result = $this->inventory->getAnsweredResultByUser($_SESSION['user']['auth']['id']);
                $categories = $this->inventory->getCategory();
                foreach ($_answered as $av)
                {
                    $answered[".{$av['id']}"] = $av;
                    $answered[".{$av['id']}"]['category'] = [];
                    foreach ($categories as $cv)
                    {
                        $answered[".{$av['id']}"]['category'][".{$cv['id']}"] = 0;
                    }
                }

                foreach ($result as $rv)
                {
                    $answered[".{$rv['answer_id']}"]['category'][".{$rv['category']}"] = $rv['value'];
                }
                unset($_answered, $result);
                $this->load->view('inventory/result/student-result-inventory', compact('answered', 'categories', 'profile'));

                return;
            }
        }
    }

    public function add()
    {
        $profile = $_SESSION['user']['auth'];

        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $profile['assets']['record'] = $this->generateCounselorRecord();
                $this->load->model('minventory', 'inventory');
                $categories = $this->inventory->getCategory();
                $favourables = $this->inventory->getFavourable();
                $this->load->view('inventory/add/counselor-add-inventory', compact('categories', 'favourables', 'profile'));

                return;
            }
            case 'student' :
            {
                redirect('/inventory');

                return;
            }
        }
    }

    public function edit($id)
    {
        $profile = $_SESSION['user']['auth'];

        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $profile['assets']['record'] = $this->generateCounselorRecord();
                $this->load->model('minventory', 'inventory');
                $question = $this->inventory->getQuestionByID($id);
                if (count($question) > 0)
                {
                    $question = $question[0];
                    $categories = $this->inventory->getCategory();
                    $favourables = $this->inventory->getFavourable();
                    $this->load->view('inventory/edit/counselor-edit-inventory', compact('categories', 'favourables', 'question', 'profile'));
                }
                else
                {
                    redirect('/inventory');
                }

                return;
            }
            case 'student' :
            {
                redirect('/inventory');

                return;
            }
        }
    }

    public function do_add()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['question']) &&
                isset($_POST['category']) &&
                isset($_POST['favour']) &&
                isset($_POST['active'])
            )
            {
                if (
                    (strlen($_POST['question']) > 0) &&
                    (strlen($_POST['category']) > 0) &&
                    (strlen($_POST['favour']) > 0) &&
                    (strlen($_POST['active']) > 0)
                )
                {
                    $this->load->model('minventory', 'inventory');
                    $this->inventory->addQuestion($_POST['question'], $_POST['category'], $_POST['favour'], $_POST['active']);
                    echo apiMakeCallback(API_SUCCESS, 'Tambah Soal Berhasil', ['notify' => [['Tambah Soal Berhasil', 'success']]]);
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Data Kurang Lengkap', ['notify' => [['Data Kurang Lengkap', 'info']]]);
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

    public function do_edit()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['id']) &&
                isset($_POST['question']) &&
                isset($_POST['category']) &&
                isset($_POST['favour']) &&
                isset($_POST['active'])
            )
            {
                if (
                    (strlen($_POST['question']) > 0) &&
                    (strlen($_POST['category']) > 0) &&
                    (strlen($_POST['favour']) > 0) &&
                    (strlen($_POST['active']) > 0)
                )
                {
                    $this->load->model('minventory', 'inventory');
                    $this->inventory->updateQuestionByID($_POST['id'], $_POST['question'], $_POST['category'], $_POST['favour'], $_POST['active']);
                    echo apiMakeCallback(API_SUCCESS, 'Update Soal Berhasil', ['notify' => [['Update Soal Berhasil', 'success']]], site_url('/inventory'));
                }
                else
                {
                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Data Kurang Lengkap', ['notify' => [['Data Kurang Lengkap', 'info']]]);
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

    public function do_change_favour()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['id']) &&
                isset($_POST['favour'])
            )
            {

                $this->load->model('minventory', 'inventory');
                $this->inventory->updateQuestionFavour($_POST['id'], $_POST['favour']);
                echo apiMakeCallback(API_SUCCESS, 'Update Favour Berhasil', ['notify' => [['Update Favour Berhasil', 'success']]]);
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

    public function do_change_active()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['id']) &&
                isset($_POST['active'])
            )
            {

                $this->load->model('minventory', 'inventory');
                $this->inventory->updateQuestionActive($_POST['id'], $_POST['active']);
                echo apiMakeCallback(API_SUCCESS, 'Update Aktivasi Berhasil', ['notify' => [['Update Aktivasi Berhasil', 'success']]]);
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

    public function do_calculate()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            $this->load->model('minventory', 'inventory');
            $_questions = $this->inventory->getQuestion();
            $question = [];
            foreach ($_questions as $q)
            {
                $question["q{$q['id']}"] = $q;
            }
            $allowed = true;
            foreach ($question as $k => $q)
            {
                if (!key_exists($k, $_POST['question']))
                {
                    $allowed = false;
                    break;
                }
                elseif ($_POST['question'][$k] <= 0)
                {
                    $allowed = false;
                    break;
                }
            }
            unset($_questions);
            if ($allowed)
            {
                $options = $this->inventory->getOptions();

                //Answered Question
                $aq = $_SESSION['user']['auth']['id'];
                $raq = $this->inventory->addAnsweredUser($aq);

                //Answered Detail
                $ad = [];
                foreach ($_POST['question'] as $k => $q)
                {
                    $_ad = [];
                    $_ad['answer_id'] = $raq;
                    $_ad['question'] = $question[$k]['id'];
                    $_ad['answer'] = $q;
                    $_ad['favour'] = $question[$k]['favour'];
                    $_ad['scale'] = count($options);
                    array_push($ad, $_ad);
                }
                $this->inventory->addAnswerDetail($ad);

                //Answered Result
                foreach ($ad as $k => $v)
                {
                    $ad[$k]['category'] = $question["q{$v['question']}"]['category'];
                }
                $_categories = $this->inventory->getCategory();
                $ar = [];
                foreach ($_categories as $c)
                {
                    $ar[".{$c['id']}"]['answer_id'] = $raq;
                    $ar[".{$c['id']}"]['category'] = $c['id'];
                    $ar[".{$c['id']}"]['value'] = 0;
                }
                unset($_categories);

                foreach ($ad as $k => $v)
                {
                    $ar[".{$v['category']}"]['value'] += ((int)$v['favour'] === 1 ? $v['answer'] : ($v['scale'] - $v['answer'] + 1));
                }
                $total = count($options) * count($ad);
                foreach ($ar as $k => $v)
                {
                    $ar[$k]['value'] /= $total;
                    $ar[$k]['value'] *= 100;
                }
                $this->inventory->addAnswerResult($ar);

                $this->load->model('mauth', 'auth');
                $this->auth->updateStudentActivation($aq, 0);
                $_SESSION['user']['auth']['is_active'] = 0;
                $_detail = [];
                switch ($_SESSION['user']['auth']['role'])
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
                echo apiMakeCallback(API_SUCCESS, 'Pengerjaan Selesai', ['notify' => [['Pengerjaan Selesai', 'success']]], site_url('/inventory/result'));
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
                            case 'inventory' :
                            {
                                echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                            }
                                break;
                            case 'inventory/add' :
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
                            case 'inventory' :
                            {
                                echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                            }
                                break;
                            case 'inventory/test' :
                            {
                                $_role = $_SESSION['user']['auth']['role'];
                                $this->load->model('mauth', 'auth');
                                $_SESSION['user']['auth'] = $this->auth->findStudentByID($_SESSION['user']['auth']['id'])[0];
                                $_SESSION['user']['auth']['role'] = $_role;
                                $this->load->helper('identity_checking');
                                $allowed = $this->allowedToTakeTest();
                                if ($allowed)
                                {
                                    $allowed &= isStudentIdentityIsComplete($_SESSION['user']['auth']);
                                    if ($allowed)
                                    {
                                        echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                                    }
                                    else
                                    {
                                        echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Access Denied', ['notify' => [['Data diri anda belum lengkap', 'info']]]);
                                    }
                                }
                                else
                                {
                                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Access Denied', ['notify' => [['Anda Tidak Diperkenankan Mengerjakan<br> Silahkan Hubungi Konselor Anda', 'info']]]);
                                }
                            }
                                break;
                            case 'inventory/result' :
                            {
                                $this->load->model('minventory', 'inventory');
                                $answered = $this->inventory->getAnsweredUser($_SESSION['user']['auth']['id']);
                                if (count($answered) > 0)
                                {
                                    echo apiMakeCallback(API_SUCCESS, "Jump To [{$path}]", [], site_url("/{$path}"));
                                }
                                else
                                {
                                    echo apiMakeCallback(API_NOT_ACCEPTABLE, 'Access Denied', ['notify' => [['Anda belum memiliki data', 'info']]]);
                                }
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
