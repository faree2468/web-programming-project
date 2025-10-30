<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/UserDao.php";

class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new UserDao()); 
    }

    public function add($entity)
    {
        $existing = $this->dao->get_by_email($entity["email"]);

        if ($existing) {
            return $existing;
        }

        return $this->dao->add_user($entity);
    }

    public function delete($id)
    {
        $existing = $this->get_by_id($id);

        if ($existing) {
            return $this->dao->delete_user($id);
        }

        return null;
    }
}
