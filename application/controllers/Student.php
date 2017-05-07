<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 8:08 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
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
                $this->load->model('mauth', 'auth');
                $this->load->model('manswer', 'answer');
                $students = $this->auth->getAllStudent();
                $_answered = $this->answer->getLatestAnsweredAllStudent();
                $answered = [];
                foreach ($_answered as $ans)
                {
                    $answered[".{$ans['student']}"] = $ans;
                }
                $window = 7;
                $now = Carbon::now('Asia/Jakarta');
                foreach ($students as $id => $st)
                {
                    $students[$id]['last_answer'] = isset($answered[".{$st['id']}"]) ? $answered[".{$st['id']}"]['answer_at'] : null;
                }
                unset($answered, $_answered);
                $this->load->view('student/view/view-student-counselor', compact('students', 'window', 'now'));

                return;
            }
            case 'student' :
            {
                $this->load->view('student/view/view-student-student');

                return;
            }
        }
    }

    public function report()
    {
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                $this->load->model('mauth', 'auth');
                $this->load->model('manswer', 'answer');
                $this->load->model('mreport', 'report');
                $_students = $this->auth->getAllAnsweredStudent();
                $students = [];
                $answered = $this->answer->getAll();
                $reports = $this->report->getAll();
                foreach ($_students as $student)
                {
                    $student['answered'] = [];
                    $students[".{$student['id']}"] = $student;
                }
                foreach ($answered as $answer)
                {
                    array_push($students[".{$answer['student']}"]['answered'], $answer);
                }
                unset($_students, $answered, $answer, $student);
                $this->load->view('student/report/report-student-counselor', compact('students', 'reports'));

                return;
            }
            case 'student' :
            {
                $this->load->viwe('student/report/report-student-student');

                return;
            }
        }
    }

    public function do_activate()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['id']))
            {

                $this->load->model('mauth', 'auth');
                $this->auth->updateStudentActivation($_POST['id'], 1);
                echo apiMakeCallback(API_SUCCESS, 'Update Aktivasi Berhasil', ['notify' => [['Update Aktivasi Berhasil', 'success']]], site_url('student'));
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