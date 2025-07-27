<?php
require_once 'database.php';
require_once 'users.php';

class UsersRepository extends Database
{

    public function getAllUsers()
    {
        $sql = "SELECT * FROM `users`";
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();
        $items = array();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $list = array();
        foreach ($items as $item) {
            $list[] = new Users($item['user_id'],  $item['username'],  $item['password'], $item['email'], $item['role_id'], $item['created_at']);
        }
        return $list;
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ? AND `password` = ?";
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $items = array();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $user = null;
        foreach ($items as $item) {
            $user = new Users($item['user_id'],  $item['username'],  $item['password'], $item['email'], $item['role_id'], $item['created_at']);
        }
        return $user;
    }

    public function kiemTraEmail($email)
    {
        $email = trim($email);
        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function register($username, $email, $password,)
    {
        $created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `users` (`username`, `password`,`email` , `role_id`,`created_at`) VALUES ( ?, ?, ?,'50',?)";
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param('ssss', $username, $password, $email, $created_at);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function getUsersByUserId($user_id)
    {
        $sql = "SELECT * FROM `users` WHERE `user_id` = ?";
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param('i',  $user_id);
        $stmt->execute();
        $items = array();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $user = null;
        foreach ($items as $item) {
            $user = new Users($item['user_id'],  $item['username'],  $item['password'], $item['email'], $item['role_id'], $item['created_at']);
        }
        return $user;
    }

    public function addUsers($users)
    {
        $sql = "INSERT INTO `users` (`username`, `password`, `email`, `role_id`) VALUES(?,?,?,?)";
        $stmt = self::$connection->prepare($sql);
        $username = $users->getUsername();
        $password = $users->getPassword();
        $email = $users->getEmail();
        $role_id = $users->getRoleId();
        $stmt->bind_param('sssi', $username, $password, $email, $role_id);
        return $stmt->execute();
    }

    public function updateUsers($users)
    {
        $sql = "UPDATE `users` SET `username` = ?, `password` = ?, `email` = ?, `role_id`= ? , `created_at`= ? WHERE `user_id` = ?";
        $stmt = self::$connection->prepare($sql);
        $username = $users->getUsername();
        $password = $users->getPassword();
        $email = $users->getEmail();
        $role_id = $users->getRoleId();
        $created_at = $users->getCreatedAt();
        $user_id = $users->getUserId();
        $stmt->bind_param('sssisi', $username, $password, $email, $role_id, $created_at, $user_id);
        return $stmt->execute();
    }

    public function deleteUsers($user_id)
    {
        $sql = "DELETE FROM `users` WHERE `user_id` = ? ";
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param('i', $user_id);
        return $stmt->execute();
    }

    public function getAllUsersPage($page, $perPage)
    {
        $start = ($page - 1) * $perPage;
        $sql = "SELECT * FROM `users` LIMIT $start, $perPage";
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();
        $items = array();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $list = array();
        foreach ($items as $item) {
            $list[] = new Users($item['user_id'],  $item['username'],  $item['password'], $item['email'], $item['role_id'], $item['created_at']);
        }
        return $list;
    }

    public function createPageLinkUsers($total, $perPage, $currentPage)
    {
        $totalLink = ceil($total / $perPage);
        $link = "";
        for ($i = 1; $i <= $totalLink; $i++) {
            $active = ($i == $currentPage) ? "active" : "";
            $link .= '<li class="page-item ' . $active . '"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
        }
        return $link;
    }
}
