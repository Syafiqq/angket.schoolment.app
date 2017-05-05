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
}