<?php

namespace Core\Database\Traits;

use Core\Database\DBConnection\DBConnection;

trait HasCRUD
{
    protected function setFillables($array): string
    {
        $fillables = [];
        foreach ($this->fillable as $attribute) {
            $fillables[] = $attribute . ' = ?';
            $this->setValue($attribute, $array[$attribute]);
        }
        return implode(', ', $fillables);
    }

    public function insert($array)
    {
        $this->setSql(sprintf("INSERT INTO {$this->table} SET %s,%s=Now();", $this->setFillables($array), $this->createdAtColumn));
        $this->executeQuery();
        $this->resetQuery();
        $obj = $this->find(DBConnection::newInsertedId());
        $defaultVariables = get_class_vars(get_called_class());
        $allVariables = get_object_vars($obj);
        $differentVariables = array_diff(array_keys($allVariables), array_keys($defaultVariables));
        foreach ($differentVariables as $attribute) {
            $this->$attribute = $obj->$attribute;
        }
        $this->resetQuery();
        return $this;
    }

    public function update($array)
    {
        $this->setSql(sprintf("UPDATE %s SET %s, %s=Now()", $this->table, $this->setFillables($array), $this->updatedAtColumn));
        $this->setWhere(" AND ", $this->primaryKey . " = ?");
        $this->setValue($this->primaryKey, $this->{$this->primaryKey});
        $this->executeQuery();
        $this->resetQuery();
        return $this;
    }

    public function find($id)
    {
        $this->setSql(sprintf("SELECT * FROM %s", $this->table));
        $this->setWhere("AND ", $this->primaryKey . " = ?");
        $this->setValue($this->primaryKey, $id);
        $stmt = $this->executeQuery();
        $data = $stmt->fetch();
        if ($data) {
            return $this->setAttributes($data);
        } else {
            return null;
        }
    }

    public function get()
    {
        $this->setSql(sprintf("SELECT * FROM %s", $this->table));
        $stmt = $this->executeQuery();
        $data = $stmt->fetchAll();
        if ($data) {
            $this->setObject($data);
            return $this->collection;
        } else {
            return [];
        }
    }

    public function delete($id)
    {
        $object = $this;
        $this->resetQuery();
        if ($id) {
            $object = $this->find($id);
            $this->resetQuery();
        }
        $object->setSql(sprintf("DELETE FROM %s", $this->table));
        $object->setWhere("AND", $object->primaryKey . " = ? ");
        $object->setValue($this->primaryKey, $id);
        return $object->executeQuery();
    }

    public function where($attribute, $operation, $value)
    {
        $condition = $attribute . ' ' . $operation . ' ?';
        $this->setValue($attribute, $value);
        $operator = " AND ";
        $this->setWhere($operator, $condition);
        return $this;
    }

    public function orWhere($attribute, $value, $operation = "=")
    {
        $condition = $attribute . ' ' . $operation . ' ?';
        $this->setValue($attribute, $value);
        $operator = " OR ";
        $this->setWhere($operator, $condition);
        return $this;
    }

    public function orderBy($key, $expression)
    {
        $this->setOrderBy($key, $expression);
        return $this;
    }

    public function limit($offset, $number)
    {
        $this->setLimit($offset, $number);
        return $this;
    }
}