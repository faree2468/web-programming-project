<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/BillDao.php";

class BillService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new BillDao()); 
    }

    public function add($entity)
    {
        return $this->dao->add_bill($entity);
    }

    public function edit($entity, $id)
    {
        $existing = $this->get_by_id($id);

        if ($existing) {
            $this->dao->edit_bill($entity, $id);
            return true;
        }

        return null;
    }

    public function delete($id)
    {
        $existing = $this->get_by_id($id);

        if ($existing) {
            $this->dao->delete_bill($id);
            return true;
        }

        return null;
    }

    public function get_bills_for_user($user_id)
    {
        return $this->dao->get_bills_for_user($user_id);
    }

    public function get_bills_for_month_year($month, $year, $user_id)
    {
        return $this->dao->get_bills_for_month_year($month, $year, $user_id);
    }
}
