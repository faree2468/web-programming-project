<?php
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "users";
        parent::__construct($this->table_name);
    }

    public function get_by_email($email) {
        return $this->query_unique('SELECT * FROM ' . $this->table_name . ' WHERE email=:email', ['email' => $email]);
    }

    public function count_users() {
        return $this->query('SELECT COUNT(id) AS total FROM ' . $this->table_name, []);
    }

    public function count_online_users() {
        return $this->query('SELECT COUNT(*) AS online_total FROM ' . $this->table_name . ' WHERE isOnline = 1', []);
    }

    public function get_by_name($name) {
        return $this->query('SELECT * FROM ' . $this->table_name . ' WHERE name=:name', ['name'=>$name]);
    }

    public function add_user($params) {
        $this->add($params);
    }

    public function delete_user($id) {
        $this->delete($id);
    }
}