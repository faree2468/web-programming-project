<?php

require_once __DIR__ . '/BaseDao.php';

class PaymentDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "payments";
        parent::__construct($this->table_name);
    }

    public function get_paid_bills_for_month_year($month, $year, $user_id) {
        return $this->query(
            'SELECT * FROM ' . $this->table_name . ' 
             WHERE MONTH(due_date) = :month 
             AND YEAR(due_date) = :year 
             AND user_id = :user_id',
            ['month' => $month, 'year' => $year, 'user_id' => $user_id]
        );
    }

    public function get_paid_bills_for_user($user_id) {
        return $this->query(
            'SELECT * FROM ' . $this->table_name . ' WHERE user_id = :user_id',
            ['user_id' => $user_id]
        );
    }

    public function add_paid_bill($params) {
        $this->add($params);
    }

    public function delete_paid_bill($id) {
        $this->delete($id);
    }
}