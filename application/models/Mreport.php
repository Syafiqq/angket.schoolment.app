<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 12:59 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreport extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getAll()
    {
        $query = 'SELECT `id`, `name`, `created_at`, `update_at` FROM `report`';
        $result = $this->db->query($query);

        return $result->result_array();
    }
}