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

    public function findStudentByCredential($credential)
    {
        $query = 'SELECT `id`, `credential`, `name`, `gender`, `password`, `period`, `grade`, `address`, `birthplace`, `datebirth`, `avatar`, `on_create`, `on_update` FROM `user_student` WHERE `credential` = ?';
        $result = $this->db->query($query, array((string)$credential));

        return $result->result_array();
    }

    public function findCounselorByCredential($credential)
    {
        $query = 'SELECT `id`, `credential`, `name`, `gender`, `password`, `address`, `birthplace`, `datebirth`, `avatar`, `on_create`, `on_update` FROM `user_counselor` WHERE `credential` = ?';
        $result = $this->db->query($query, array((string)$credential));

        return $result->result_array();
    }

    public function registerStudent($name, $credential, $gender, $password)
    {
        $avatar = $this->generateDefaultAvatar($gender);
        $query = 'INSERT INTO `user_student`(`id`, `credential`, `name`, `gender`, `password`, `period`, `grade`, `address`, `birthplace`, `datebirth`, `avatar`, `on_create`, `on_update`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);';
        $this->db->query($query, array((string)$credential, (string)$name, (string)$gender, (string)$password, (string)$avatar));

        return $this->db->insert_id();
    }

    private function generateDefaultAvatar($gender = 'male')
    {
        switch ($gender)
        {
            case 'male' :
            {
                $avatar = mt_rand(0, 22);
                $avatar = "/assets/img/avatar/male/boy-{$avatar}.png";
            }
                break;
            case 'female' :
            {
                $avatar = mt_rand(0, 26);
                $avatar = "/assets/img/avatar/female/girl-{$avatar}.png";
            }
                break;
            default :
            {
                $avatar = '/assets/img/avatar/default/default.png';
            }
        }

        return $avatar;
    }

    public function registerCounselor($name, $credential, $gender, $password)
    {
        $avatar = $this->generateDefaultAvatar($gender);
        $query = 'INSERT INTO `user_counselor`(`id`, `credential`, `name`, `gender`, `password`, `address`, `birthplace`, `datebirth`, `avatar`, `on_create`, `on_update`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL, NULL, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);';
        $this->db->query($query, array((string)$credential, (string)$name, (string)$gender, (string)$password, (string)$avatar));

        return $this->db->insert_id();
    }
}