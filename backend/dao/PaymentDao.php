<?php

require_once __DIR__ . '/BaseDao.php';

class PaymentDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "payments";
        parent::__construct($this->table_name);
    }

    
}