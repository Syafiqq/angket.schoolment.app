<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 04 May 2017, 10:35 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Minventory extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getCategory()
    {
        $query = 'SELECT `id`, `name`, `description` FROM `question_category`';
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function getFavourable()
    {
        $query = 'SELECT `id`, `name`, `description` FROM `question_favour`';
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function addQuestion($question, $category, $favour, $active)
    {
        $query = 'INSERT INTO `question`(`id`, `question`, `is_active`, `favour`, `created_at`, `update_at`, `category`) VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, ?);';
        $this->db->query($query, array((string)$question, (int)$active, (int)$favour, (int)$category));

        return $this->db->insert_id();
    }

    public function getQuestion()
    {
        $query = 'SELECT `id`, `question`, `is_active`, `favour`, `created_at`, `update_at`, `category` FROM `question`';
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function updateQuestionFavour($id, $favour)
    {
        $query = 'UPDATE `question` SET `favour`=? WHERE `id` = ?';
        $this->db->query($query, [(int)$favour, (int)$id]);
    }

    public function updateQuestionActive($id, $active)
    {
        $query = 'UPDATE `question` SET `is_active`=? WHERE `id` = ?';
        $this->db->query($query, [(int)$active, (int)$id]);
    }

    public function getQuestionByID($id)
    {
        $query = 'SELECT `id`, `question`, `is_active`, `favour`, `created_at`, `update_at`, `category` FROM `question` WHERE `id` = ? LIMIT 1';
        $result = $this->db->query($query, [(int)$id]);

        return $result->result_array();
    }

    public function updateQuestionByID($id, $question, $category, $favour, $active)
    {
        $query = 'UPDATE `question` SET `question`=?,`is_active`=?,`favour`=?,`category`=? WHERE `id` = ?';
        $this->db->query($query, [(string)$question, (int)$active, (int)$favour, (int)$category, (int)$id]);
    }

    public function getOptions()
    {
        $query = 'SELECT `id`, `name`, `nick` FROM `question_option`';
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function getQuestionByActive($active)
    {
        $query = 'SELECT `id`, `question`, `is_active`, `favour`, `created_at`, `update_at`, `category` FROM `question` WHERE `is_active` = ?';
        $result = $this->db->query($query, [(int)$active]);

        return $result->result_array();
    }

    public function addAnsweredUser($id)
    {
        $query = 'INSERT INTO `answered_question`(`id`, `student`, `answer_at`) VALUES (NULL, ?, CURRENT_TIMESTAMP);';
        $this->db->query($query, array((int)$id));

        return $this->db->insert_id();
    }

    public function addAnswerDetail($details = array())
    {
        $query = 'INSERT INTO `answered_detail`(`answer_id`, `question`, `answer`, `favour`, `scale`) VALUES (?, ?, ?, ?, ?);';

        $this->db->trans_begin();
        foreach ($details as $detail)
        {
            $this->db->query($query, [(int)$detail['answer_id'], (int)$detail['question'], (int)$detail['answer'], (int)$detail['favour'], (int)$detail['scale']]);
        }

        if ($this->db->trans_status() === false)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }

    public function addAnswerResult($results = array())
    {
        $query = 'INSERT INTO `answered_result`(`answer_id`, `category`, `value`) VALUES (?, ?, ?);';

        $this->db->trans_begin();
        foreach ($results as $result)
        {
            $this->db->query($query, [(int)$result['answer_id'], (int)$result['category'], (double)$result['value']]);
        }

        if ($this->db->trans_status() === false)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }

    public function getAnsweredUser($user)
    {
        $query = 'SELECT `id`, `student`, `answer_at` FROM `answered_question` WHERE `student` = ? ORDER BY `answer_at` DESC';
        $result = $this->db->query($query, [(int)$user]);

        return $result->result_array();
    }

    public function getAnsweredResultByUser($user)
    {
        $query = 'SELECT `answered_result`.`answer_id`, `answered_result`.`category`, `answered_result`.`value` FROM `answered_result` LEFT OUTER JOIN `answered_question` ON answered_result.answer_id = answered_question.id WHERE  `answered_question`.`student` = ? ';
        $result = $this->db->query($query, [(int)$user]);

        return $result->result_array();
    }

    public function getAnsweredUserByAnswerID($user, $answer)
    {
        $query = 'SELECT `id`, `student`, `answer_at` FROM `answered_question` WHERE `student` = ? AND `id` = ? ORDER BY `answer_at` DESC';
        $result = $this->db->query($query, [(int)$user, (int)$answer]);

        return $result->result_array();
    }


}