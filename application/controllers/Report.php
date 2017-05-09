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
                        $result = $this->inventory->getAnsweredResultByID($answered['id']);
                        $result['detail'] = ['answer_id' => 3, 'value' => 23.5];
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
                        $_categories = $this->inventory->getCategory();
                        $categories = [];
                        foreach ($_categories as $_cv)
                        {
                            $categories[".{$_cv['id']}"] = $_cv;
                        }
                        $result = $this->inventory->getAnsweredResultByID($answered['id']);
                        $isMale = $_SESSION['user']['auth']['gender'] === 'male';
                        foreach ($result as $kr => $vr)
                        {
                            if ($isMale)
                            {
                                if ((int)$vr['category'] === 1)
                                {
                                    unset($result[$kr]);
                                    continue;
                                }
                            }
                            else
                            {
                                if ((int)$vr['category'] === 2)
                                {
                                    unset($result[$kr]);
                                    continue;
                                }
                            }

                            $this->load->helper('conclusion_interpretation');

                            switch ((int)$vr['category'])
                            {
                                case 1 :
                                {
                                    $result[$kr]['interpretation'] = interpretLesbian($vr['value']);
                                }
                                    break;
                                case 2 :
                                {
                                    $result[$kr]['interpretation'] = interpretGay($vr['value']);
                                }
                                    break;
                                case 3 :
                                {
                                    $result[$kr]['interpretation'] = interpretBisexual($vr['value']);
                                }
                                    break;
                                case 4 :
                                {
                                    $result[$kr]['interpretation'] = interpretTransGender($vr['value']);
                                }
                                    break;
                            }
                        }

                        $profile = $_SESSION['user']['auth'];

                        $this->load->view('report/display/student-display-report', compact('profile', 'categories', 'result', 'answered'));

                        return;
                    }
                }
                redirect('/inventory/result');

                return;
            }
        }
    }
}