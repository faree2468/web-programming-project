<?php

require_once __DIR__ . '/BaseDao.php';

class BillDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "bills";
        parent::__construct($this->table_name);
    }

    
}