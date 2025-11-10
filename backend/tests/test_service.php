<?php
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../services/BillService.php';
require_once __DIR__ . '/../services/CategoryService.php';
require_once __DIR__ . '/../services/PaymentService.php';

echo "=== SERVICE TESTS START ===\n\n";

// $user_service = new UserService();
// echo "Testing UserService...\n";

// $new_user = [
//     "email" => "test@example.com",
//     "name" => "Test User"
// ];

// $added_user = $user_service->add($new_user);
// echo "Added User: ";
// print_r($added_user);

// $fetched_user = $user_service->get_by_id($added_user["id"] ?? null);
// echo "Fetched User by ID:\n";
// print_r($fetched_user);

// echo "Deleting user...\n";
// $user_service->delete($added_user["id"] ?? 0);
// echo "User deleted.\n\n";

// $category_service = new CategoryService();
// echo "Testing CategoryService...\n";

// $new_category = ["name" => "Utilities"];
// $added_ctg = $category_service->add($new_category);
// echo "Added Category:\n";
// print_r($added_ctg);

// $fetched_ctg = $category_service->get_ctg_by_name("Utilities");
// echo "Fetched Category by Name:\n";
// print_r($fetched_ctg);

// $categories_spent = $category_service->get_paid_bills_by_ctg();
// echo "Categories with total spent:\n";
// print_r($categories_spent);
// echo "\n";

// $bill_service = new BillService();
// echo "Testing BillService...\n";

// $new_bill = [
//     "name" => "Electricity Bill",
//     "due_date" => "2025-11-30",
//     "user_id" => 2,
//     "category_id" => 1,
//     "status"=>0
// ];

// $added_bill = $bill_service->add($new_bill);
// echo "Added Bill:\n";
// print_r($added_bill);

// $bills_user = $bill_service->get_bills_for_user(1);
// echo "Bills for User 2:\n";
// print_r($bills_user);

// $bills_month = $bill_service->get_bills_for_month_year(11, 2025, 1);
// echo "Bills for Nov 2025 (User 2):\n";
// print_r($bills_month);
// echo "\n";

// $payment_service = new PaymentService();
// echo "Testing PaymentService...\n";

// $new_payment = [
//     "amount" => 100,
//     "bill_id" => 8,
//     "payment_date" => "2025-11-30",
//     "payment_method_id" => 1,
// ];

// $added_payment = $payment_service->add($new_payment);
// echo "Added Payment:\n";
// print_r($added_payment);

// $payments_user = $payment_service->get_paid_bills_for_user(2);
// echo "Payments for User 2:\n";
// print_r($payments_user);

// $payments_month = $payment_service->get_paid_bills_for_month_year(11, 2025, 1);
// echo "Payments for Nov 2025 (User 2):\n";
// print_r($payments_month);

echo "\n=== SERVICE TESTS COMPLETE ===\n";
