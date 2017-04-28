<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 28 April 2017, 2:01 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mauth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function findByEmailAndRole($email, $role)
    {
        $query = 'SELECT `id`, `name`, `email`, `role`, `gender`, `password` FROM `users` WHERE `email` = ? AND `role` = ? LIMIT 1';
        $result = $this->db->query($query, array((string)$email, (string)$role));

        return $result->result_array();
    }

    public function register($name, $email, $role, $gender, $password)
    {
        $query = 'INSERT INTO `users`(`id`, `name`, `email`, `role`, `gender`, `password`) VALUES (NULL, ?, ?, ?, ?, ?)';
        $this->db->query($query, array((string)$name, (string)$email, (string)$role, (string)$gender, (string)$password));

        return $this->db->insert_id();
    }
}