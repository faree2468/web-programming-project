<?php

require_once __DIR__ . "/BaseDao.php";

class CategoryDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "categories";
        parent::__construct($this->table_name);
    }

    public function get_ctg_by_name($name) {
        return $this->query_unique(
            'SELECT * FROM ' . $this->table_name . ' WHERE name = :name',
            ['name' => $name]
        );
    }

    public function get_paid_bills_by_ctg() {
        $query = '
            SELECT 
                c.name AS category_name, 
                SUM(p.amount) AS total_spent
            FROM payments p
            INNER JOIN bills b ON p.bill_id = b.id
            INNER JOIN ' . $this->table_name . ' c ON b.category_id = c.id
            GROUP BY c.name
            ORDER BY total_spent DESC
        ';

        return $this->query($query, []);
    }
    
}