<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/CategoryDao.php";

class CategoryService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new CategoryDao()); 
    }

    public function get_ctg_by_name($name) {
        return $this->dao->get_ctg_by_name($name);
    }

    public function get_paid_bills_by_ctg() {
        return $this->dao->get_paid_bills_by_ctg();
    }


}