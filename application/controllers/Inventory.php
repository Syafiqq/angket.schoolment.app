<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 04 May 2017, 5:07 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
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
                $this->load->view('inventory/view/view-inventory-student');

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
}