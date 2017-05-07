<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 07 May 2017, 10:46 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcoupon extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function insert($id, $coupon)
    {
        $query = 'INSERT INTO `coupon`(`id`, `coupon`, `request`, `created_at`) VALUES (NULL, ?, ?, CURRENT_TIMESTAMP);';
        $this->db->query($query, array((string)$coupon, (int)$id));

        return $this->db->insert_id();
    }

    public function getByCoupon($coupon)
    {
        $query = 'SELECT `id`, `coupon`, `request`, `created_at` FROM `coupon` WHERE `coupon` = ? LIMIT 1';
        $result = $this->db->query($query, array((string)$coupon));

        return $result->result_array();
    }

    public function deleteByCoupon($coupon)
    {
        $query = 'DELETE FROM `coupon` WHERE `coupon`=?';
        $this->db->query($query, array((string)$coupon));
    }
}