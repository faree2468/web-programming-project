<?php

require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/CategoryDao.php';
require_once __DIR__ . '/../dao/BillDao.php';
require_once __DIR__ . '/../dao/PaymentDao.php';
require_once __DIR__ . '/../dao/PaymentMethodDao.php';

$user_dao = new UserDao();
$category_dao = new CategoryDao();
$bills_dao = new BillDao();
$payments_dao = new PaymentDao();
$payment_methods_dao = new PaymentMethodDao();

$users = $user_dao->get_all();
print_r($users);

echo '<br/>';
echo '<br/>';

$categories = $category_dao->get_all();
print_r($categories);

echo '<br/>';
echo '<br/>';

$bills = $bills_dao->get_all();
print_r($bills);

// $bills_dao->delete(1);
echo '<br/>';
echo 'After deleting id=1';
echo '<br/>';
print_r($bills_dao->get_all());
echo '<br/>';
echo '<br/>';
echo 'Adding new bill';
echo '<br/>';
$bills_dao->add([
    'name' => 'new_bill',
    'due_date' => '2025-12-02',
    'status' => 0,
    'user_id' => 1,
    'category_id' => 2
]);
echo '<br/>';
print_r($bills_dao->get_all());
echo '<br/>';
echo '<br/>';

$payments = $payments_dao->get_all();
print_r($payments);

echo '<br/>';
echo '<br/>';

$payment_methods = $payment_methods_dao->get_all();
print_r($payment_methods);