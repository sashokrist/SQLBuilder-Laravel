<?php

namespace App\SQLBuilders;

class MysqlBuilder implements SQLBuilder {
    protected $query = '';

    public function select($table, $fields) {
        if (!is_array($fields)) {
            $fields = explode(',', $fields);
        }
        $fieldsList = implode(', ', $fields);
        $this->query .= "SELECT $fieldsList FROM $table ";
        return $this;
    }

    public function where($field, $value, $operator) {
        if (!str_contains($this->query, 'WHERE')) {
            $this->query .= " WHERE ";
        } else {
            $this->query .= " AND ";
        }

        if (is_numeric($value)) {
            $this->query .= "$field $operator $value";
        } else {
            $this->query .= "$field $operator '$value'";
        }
        return $this;
    }


    public function limit($start, $offset) {
        if (isset($start) && isset($offset)) {
            $this->query .= " LIMIT $offset OFFSET $start";
        }
        return $this;
    }

    public function getSQL() {
        return rtrim($this->query) . ";";
    }
}
