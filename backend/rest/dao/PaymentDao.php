<?php

require_once __DIR__ . '/BaseDao.php';

class PaymentDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "payments";
        parent::__construct($this->table_name);
    }

    public function get_paid_bills_for_month_year($month, $year, $user_id)
    {
        return $this->query(
            'SELECT 
                p.*, 
                b.name AS bill_name, 
                b.user_id
            FROM ' . $this->table_name . ' AS p
            JOIN bills b ON p.bill_id = b.id
            WHERE MONTH(p.payment_date) = :month
            AND YEAR(p.payment_date) = :year
            AND b.user_id = :user_id',
            [
                'month' => $month,
                'year' => $year,
                'user_id' => $user_id
            ]
        );
    }


    public function get_paid_bills_for_user($user_id)
    {
        return $this->query(
            'SELECT p.*, b.name AS bill_name, b.category_id
            FROM ' . $this->table_name . ' AS p
            JOIN bills b ON p.bill_id = b.id
            WHERE b.user_id = :user_id',
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