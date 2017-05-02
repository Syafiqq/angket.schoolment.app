<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 02 May 2017, 9:26 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrecovery extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getByUserIdAndRole($user, $role)
    {
        $query = 'SELECT `id`, `user`, `role`, `token` FROM `recovery` WHERE `user` = ? AND `role` = ? LIMIT 1';
        $result = $this->db->query($query, [(int)$user, (string)$role]);

        return $result->result_array();
    }

    public function getByToken($token)
    {
        $query = 'SELECT `id`, `user`, `role`, `token` FROM `recovery` WHERE `token` = ? LIMIT 1';
        $result = $this->db->query($query, [(string)$token]);

        return $result->result_array();
    }

    public function deleteById($id)
    {
        $query = 'DELETE FROM `recovery` WHERE `id` = ?';
        $this->db->query($query, [(int)$id]);
    }

    public function updateToken($id, $token)
    {
        $query = 'UPDATE `recovery` SET `token`=? WHERE `id` = ?';
        $this->db->query($query, [(string)$token, (int)$id]);
    }

    public function create($user, $role, $token)
    {
        $query = 'INSERT INTO `recovery`(`id`, `user`, `role`, `token`) VALUES (NULL, ?, ?, ?)';
        $this->db->query($query, [(int)$user, (string)$role, (string)$token]);

        return $this->db->insert_id();
    }
}