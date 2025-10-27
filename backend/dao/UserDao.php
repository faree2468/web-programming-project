<?php
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "users";
        parent::__construct($this->table_name);
    }

    
}