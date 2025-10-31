<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/PaymentDao.php";

class PaymentService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new PaymentDao());
    }

    public function add($entity)
    {
        return $this->dao->add_paid_bill($entity);
    }

    public function delete($id)
    {
        $existing = $this->get_by_id($id);

        if ($existing) {
            $this->dao->delete_paid_bill($id);
            return true;
        }

        return null;
    }

    public function get_paid_bills_for_user($user_id)
    {
        return $this->dao->get_paid_bills_for_user($user_id);
    }

    public function get_paid_bills_for_month_year($month, $year, $user_id)
    {
        return $this->dao->get_paid_bills_for_month_year($month, $year, $user_id);
    }
}
