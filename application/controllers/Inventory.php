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
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $this->load->model('minventory', 'inventory');
                $favourables = $this->inventory->getFavourable();
                $categories = $this->inventory->getCategory();
                $questions = $this->inventory->getQuestion();
                $this->load->view('inventory/view/view-inventory-counselor', compact('favourables', 'categories', 'questions'));

                return;
            }
            case 'student' :
            {
                $b_test = $this->allowedToTakeTest();
                $b_complete = $this->isStudentIdentityIsComplete();
                $this->load->view('inventory/view/view-inventory-student', compact('b_test', 'b_complete'));

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
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                redirect('/inventory');

                return;
            }
            case 'student' :
            {
                $allowed = $this->allowedToTakeTest();
                $allowed &= $this->isStudentIdentityIsComplete();
                if ($allowed)
                {
                    $this->load->model('minventory', 'inventory');
                    $questions = $this->inventory->getQuestionByActive(1);
                    $isMale = $_SESSION['user']['auth']['gender'] === 'male';
                    foreach ($questions as $qk => $qv)
                    {
                        if ($isMale)
                        {
                            if ((int)$qv['category'] === 1)
                            {
                                unset($questions[$qk]);
                            }
                        }
                        else
                        {
                            if ((int)$qv['category'] === 2)
                            {
                                unset($questions[$qk]);
                            }
                        }
                    }
                    $options = $this->inventory->getOptions();
                    $this->load->view('inventory/test/test-inventory-student', compact('questions', 'options'));
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
                $isMale = $_SESSION['user']['auth']['gender'] === 'male';
                foreach ($categories as $ck => $cv)
                {
                    if ($isMale)
                    {
                        if ((int)$cv['id'] === 1)
                        {
                            unset($categories[$ck]);
                        }
                    }
                    else
                    {
                        if ((int)$cv['id'] === 2)
                        {
                            unset($categories[$ck]);
                        }
                    }
                }
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
                    if ($isMale)
                    {
                        if ((int)$rv['category'] === 1)
                        {
                            continue;
                        }
                    }
                    else
                    {
                        if ((int)$rv['category'] === 2)
                        {
                            continue;
                        }
                    }
                    $answered[".{$rv['answer_id']}"]['category'][".{$rv['category']}"] = $rv['value'];
                }
                unset($_answered, $result);
                $this->load->view('inventory/result/result-inventory-student', compact('answered', 'categories'));

                return;
            }
        }
    }

    public function add()
    {
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $this->load->model('minventory', 'inventory');
                $categories = $this->inventory->getCategory();
                $favourables = $this->inventory->getFavourable();
                $this->load->view('inventory/add/add-inventory-counselor', compact('categories', 'favourables'));

                return;
            }
            case 'student' :
            {
                $this->load->view('inventory/add/add-inventory-student');

                return;
            }
        }
    }

    public function edit_question($id)
    {
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $this->load->model('minventory', 'inventory');
                $question = $this->inventory->getQuestionByID($id);
                if (count($question) > 0)
                {
                    $question = $question[0];
                    $categories = $this->inventory->getCategory();
                    $favourables = $this->inventory->getFavourable();
                    $this->load->view('inventory/edit/edit-inventory-counselor', compact('categories', 'favourables', 'question'));
                }
                else
                {
                    redirect('/inventory');
                }

                return;
            }
            case 'student' :
            {
                $this->load->view('inventory/edit/edit-inventory-student');

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
            $isMale = $_SESSION['user']['auth']['gender'] === 'male';
            foreach ($_questions as $qk => $qv)
            {
                if ($isMale)
                {
                    if ((int)$qv['category'] === 1)
                    {
                        unset($_questions[$qk]);
                    }
                }
                else
                {
                    if ((int)$qv['category'] === 2)
                    {
                        unset($_questions[$qk]);
                    }
                }
            }
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
                echo apiMakeCallback(API_SUCCESS, 'Pengerjaan Selesai', ['notify' => [['Pengerjaan Selesai', 'success']]], site_url('/inventory'));
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

    private function isStudentIdentityIsComplete()
    {
        $complete = false;
        if (
            (strlen($_SESSION['user']['auth']['grade']) > 0) &&
            (strlen($_SESSION['user']['auth']['school']) > 0) &&
            (strlen($_SESSION['user']['auth']['address']) > 0) &&
            (strlen($_SESSION['user']['auth']['birthplace']) > 0) &&
            (strlen($_SESSION['user']['auth']['datebirth']) > 0)
        )
        {
            $complete = true;
        }

        return $complete;
    }
}