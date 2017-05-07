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
        $query = 'SELECT `id`, `credential`, `name`, `gender`, `password`, `period`, `grade`, `address`, `birthplace`, `datebirth`, `avatar`, `is_active`, `create_at`, `update_at` FROM `user_student` WHERE `credential` = ?';
        $result = $this->db->query($query, array((string)$credential));

        return $result->result_array();
    }

    public function findCounselorByCredential($credential)
    {
        $query = 'SELECT `id`, `credential`, `name`, `gender`, `password`, `address`, `birthplace`, `datebirth`, `avatar`, `create_at`, `update_at` FROM `user_counselor` WHERE `credential` = ?';
        $result = $this->db->query($query, array((string)$credential));

        return $result->result_array();
    }

    public function registerStudent($name, $credential, $gender, $password)
    {
        $avatar = $this->generateDefaultAvatar($gender);
        $query = 'INSERT INTO `user_student`(`id`, `credential`, `name`, `gender`, `password`, `period`, `grade`, `address`, `birthplace`, `datebirth`, `avatar`, `create_at`, `update_at`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);';
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
        $query = 'INSERT INTO `user_counselor`(`id`, `credential`, `name`, `gender`, `password`, `address`, `birthplace`, `datebirth`, `avatar`, `create_at`, `update_at`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL, NULL, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);';
        $this->db->query($query, array((string)$credential, (string)$name, (string)$gender, (string)$password, (string)$avatar));

        return $this->db->insert_id();
    }

    public function updatePasswordStudentByID($id, $password)
    {
        $query = 'UPDATE `user_student` SET `password`= ? WHERE `id` = ?';
        $this->db->query($query, array((string)$password, (int)$id));
    }

    public function updatePasswordCounselorByID($id, $password)
    {
        $query = 'UPDATE `user_counselor` SET `password`= ? WHERE `id` = ?';
        $this->db->query($query, array((string)$password, (int)$id));
    }

    public function updateAvatarCounselorByID($id, $path)
    {
        $query = 'UPDATE `user_counselor` SET `avatar`= ? WHERE `id` = ?';
        $this->db->query($query, array((string)$path, (int)$id));
    }

    public function updateAdditionalCounselorByID($id, $address, $birthplace, $datebirth)
    {
        $query = 'UPDATE `user_counselor` SET `address`= ?, `birthplace`= ?, `datebirth`= ? WHERE `id` = ?';
        $this->db->query($query, array((string)$address, (string)$birthplace, (string)$datebirth, (int)$id));
    }

    public function updateAvatarStudentByID($id, $path)
    {
        $query = 'UPDATE `user_student` SET `avatar`= ? WHERE `id` = ?';
        $this->db->query($query, array((string)$path, (int)$id));
    }

    public function updateAdditionalStudentByID($id, $period, $grade, $address, $birthplace, $datebirth)
    {
        $query = 'UPDATE `user_student` SET `period` = ?, `grade` = ?, `address`= ?, `birthplace`= ?, `datebirth`= ? WHERE `id` = ?';
        $this->db->query($query, array((int)$period, (int)$grade, (string)$address, (string)$birthplace, (string)$datebirth, (int)$id));
    }

    public function updateStudentActivation($id, $active)
    {
        $query = 'UPDATE `user_student` SET `is_active` = ? WHERE `id` = ?';
        $this->db->query($query, array((int)$active, (int)$id));
    }

    public function getAllStudent()
    {
        $query = 'SELECT `id`, `credential`, `name`, `gender`, `password`, `period`, `grade`, `address`, `birthplace`, `datebirth`, `avatar`, `is_active`, `create_at`, `update_at` FROM `user_student` ORDER BY `id` ASC';
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function getAllAnsweredStudent()
    {
        $query = 'SELECT `user_student`.`id`, `user_student`.`credential`, `user_student`.`name`, `user_student`.`gender`, `user_student`.`password`, `user_student`.`period`, `user_student`.`grade`, `user_student`.`address`, `user_student`.`birthplace`, `user_student`.`datebirth`, `user_student`.`avatar`, `user_student`.`is_active`, `user_student`.`create_at`, `user_student`.`update_at` FROM `user_student` RIGHT OUTER JOIN `answered_question` ON `user_student`.`id` = `answered_question`.`student` GROUP BY `user_student`.`id` ORDER BY `user_student`.`id` ASC';
        $result = $this->db->query($query);

        return $result->result_array();
    }
}