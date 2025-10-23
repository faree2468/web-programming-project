<?php

require_once __DIR__ . '/../dao/UserDao.php';

$user_dao = new UserDao();

$users = $user_dao->get_all();
print_r($users);