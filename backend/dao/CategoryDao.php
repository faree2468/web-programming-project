<?php

require_once __DIR__ . "/BaseDao.php";

class CategoryDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "categories";
        parent::__construct($this->table_name);
    }

    
}