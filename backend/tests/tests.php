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
echo 'Adding user';
// $user_dao->add([
//     'email' => 'test@test.com',
//     'name' => 'mr.test'
// ]);
echo '<br>';
echo 'Deleting user id=1 and all of its bills and payments, cascade';
// $user_dao->delete(1);
echo '<br/>';
echo 'Updating user';
// $user_dao->update([
//     'name' => 'mr.beast'
// ], 2);
echo '<br/>';
echo '<br/>';
print_r($user_dao->get_all());

echo '<br/>';
echo '<br/>';

$categories = $category_dao->get_all();
print_r($categories);
echo '<br/>';
echo 'Adding category';
// $category_dao->add([
//     'name' => 'test_category'
// ]);
echo '<br/>';
echo 'Deleting category';
// $category_dao->delete(7);
echo '<br/>';
echo 'Updating category';
// $category_dao->update([
//     'name' => 'edited_test_category'
// ], 8);
echo '<br/>';
print_r($category_dao->get_all());
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
// $bills_dao->add([
//     'name' => 'new_bill',
//     'due_date' => '2025-12-02',
//     'status' => 0,
//     'user_id' => 1,
//     'category_id' => 2
// ]);
echo 'Editing bill id=6';
echo '<br/>';
// $bills_dao->update([
//     'name' => 'updated_bill',
//     'status' => 1
// ], 6);
echo '<br/>';
print_r($bills_dao->get_all());
echo '<br/>';
echo '<br/>';

$payments = $payments_dao->get_all();
print_r($payments);
echo 'Adding payment';
echo '<br/>';
// $payments_dao->add([
//     'amount' => 400,
//     'payment_date' => '2025-12-03',
//     'bill_id' => 2,
//     'payment_method_id' => 2
// ]);
echo '<br/>';
echo 'Deleting payment';
echo '<br/>';
// $payments_dao->delete(4);
echo 'Updating payment';
// $payments_dao->update([
//     'amount' => 1500
// ], 2);
echo '<br/>';
echo '<br/>';
print_r($payments_dao->get_all());

echo '<br/>';
echo '<br/>';


$payment_methods = $payment_methods_dao->get_all();
print_r($payment_methods);
echo '<br/>';
echo '<br/>';
echo 'Adding payment method';
echo '<br/>';
// $payment_methods_dao->add([
//     'name' => 'test_method'
// ]);
echo '<br/>';
echo '<br/>';
echo 'Deleting payment method';
// $payment_methods_dao->delete(2);
echo '<br/>';
echo 'Updating payment method';
echo '<br/>';
// $payment_methods_dao->update([
//     'name' => 'edited_test_method'
// ], 4);
print_r($payment_methods_dao->get_all());