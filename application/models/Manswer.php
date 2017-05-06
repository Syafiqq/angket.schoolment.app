<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 9:22 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Manswer extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getLatestAnsweredByStudentID()
    {
        $query = 'SELECT `aq1`.`id`, `aq1`.`student`, `aq1`.`answer_at` FROM `answered_question` AS `aq1` WHERE `aq1`.`id` = (SELECT `aq2`.`id` FROM `answered_question` AS `aq2` WHERE `aq1`.`student` = `aq2`.`student` ORDER BY `answer_at` DESC LIMIT 1) ORDER BY `student` ASC';
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function getAll()
    {
        $query = 'SELECT `id`, `student`, `answer_at` FROM `answered_question` WHERE 1';
        $result = $this->db->query($query);

        return $result->result_array();
    }
}