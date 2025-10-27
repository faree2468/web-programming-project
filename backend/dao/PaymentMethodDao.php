<?php

require_once __DIR__ . "/BaseDao.php";

class PaymentMethodDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "payment_methods";
        parent::__construct($this->table_name);
    }

    
}