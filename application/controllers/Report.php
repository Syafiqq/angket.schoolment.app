<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 5:23 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
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
        $this->publish();
    }

    public function publish()
    {
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {
                if (isset($_GET['answer']))
                {
                    $this->load->model('minventory', 'inventory');
                    $this->load->model('mauth', 'auth');
                    $answered = $this->inventory->getAnsweredByAnswerID($_GET['answer']);
                    if (count($answered) > 0)
                    {
                        $answered = $answered[0];
                        $profile = $this->auth->findStudentByID($answered['student']);
                        $profile = $profile[0];
                        $this->load->helper('conclusion_interpretation');
                        $grading = interpretCritical();
                        $_result = $this->inventory->getAnsweredResultByID($answered['id']);
                        $result = ['answer_id' => $answered['id'], 'value' => 0.0];
                        foreach ($_result as $_vr)
                        {
                            $result['value'] += $_vr['value'];
                        }
                        $counselor = $_SESSION['user']['auth'];
                        $this->load->view('report/publish/counselor-publish-report', compact('counselor', 'profile', 'result', 'grading', 'answered'));
                    }
                    else
                    {
                        redirect('student/report');
                    }
                }
                else
                {
                    redirect('student/report');
                }
            }
                break;
            case 'student' :
            {
                redirect('/inventory/result');

                return;
            }
        }
    }

    public function display()
    {
        switch ($_SESSION['user']['auth']['role'])
        {
            case 'counselor' :
            {

                redirect('/student');

                return;
            }
            case 'student' :
            {
                if (isset($_GET['answer']))
                {
                    $this->load->model('minventory', 'inventory');
                    $answered = $this->inventory->getAnsweredUserByAnswerID($_SESSION['user']['auth']['id'], $_GET['answer']);
                    if (count($answered) > 0)
                    {
                        $answered = $answered[0];
                        $this->load->helper('conclusion_interpretation');
                        $grading = interpretCritical();
                        $_result = $this->inventory->getAnsweredResultByID($answered['id']);
                        $result = ['answer_id' => $answered['id'], 'value' => 0.0];
                        foreach ($_result as $_vr)
                        {
                            $result['value'] += $_vr['value'];
                        }
                        $profile = $_SESSION['user']['auth'];

                        $this->load->view('report/display/student-display-report', compact('profile', 'result', 'grading', 'answered'));

                        return;
                    }
                }
                redirect('/inventory/result');

                return;
            }
        }
    }

    public function jump()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            switch ($_SESSION['user']['auth']['role'])
            {
                case 'counselor' :
                {
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