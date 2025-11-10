<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/PaymentMethodDao.php";

class PaymentMethodService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new PaymentMethodDao());
    }

    public function add($entity)
    {
        
        $existing = $this->dao->get_payment_method_by_name($entity["name"]);

        if ($existing) {
            return $existing;
        }

        return $this->dao->add($entity);
    }

    public function get_payment_method_by_name($name)
    {
        return $this->dao->get_payment_method_by_name($name);
    }
}
