<?php

namespace Core\Database\Traits;

use Core\Database\DBConnection\DBConnection;

trait HasQueryBuilder
{
    private string $sql;

    private array $where;

    private array $orderBy;

    private array $limit;

    private array $values;

    private array $bindingValues;

    protected function getSql(): string
    {
        return $this->sql;
    }

    protected function setSql(string $sql): void
    {
        $this->sql = $sql;
    }

    protected function resetSql(): void
    {
        $this->sql = '';
    }

    protected function setWhere($operator, $condition): void
    {
        $q = ['operator' => $operator, 'condition' => $condition];
        $this->where[] = $q;
    }

    protected function resetWhere(): void
    {
        $this->where = [];
    }

    protected function setOrderBy(string $key, string $expression): void
    {
        $this->orderBy[] = $key . ' ' . $expression;
    }

    protected function resetOrderBy(): void
    {
        $this->orderBy = [];
    }

    protected function setLimit(int $offset, int $number): void
    {
        $this->limit['offset'] = $offset;
        $this->limit['number'] = $number;
    }

    protected function resetLimit(): void
    {
        unset($this->limit['offset'], $this->limit['number']);
    }

    protected function setValue($attr, $value): void
    {
        $this->values[$attr] = $value;
        $this->bindingValues[] = $value;
    }

    protected function resetValue(): void
    {
        $this->values = [];
        $this->bindingValues = [];
    }

    protected function resetQuery(): void
    {
        $this->resetSql();
        $this->resetWhere();
        $this->resetOrderBy();
        $this->resetLimit();
        $this->resetValue();
    }

    protected function executeQuery()
    {
        $query = '';
        $query .= $this->sql;
        if (!empty($this->where)) {
            $whereQuery = '';
            foreach ($this->where as $where) {
                $whereQuery == ''
                    ? $whereQuery .= $where['condition']
                    : $whereQuery .= ' ' . $where['operator'] . ' ' . $where['condition'];
            }
            $query .= ' WHERE ' . $whereQuery;
        }

        if (!empty($this->orderBy)) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
        }

        if (!empty($this->limit)) {
            $query .= ' LIMIT ' . $this->limit['number'] . ' OFFSET ' . $this->limit['offset'];
        }

        $query = " ;";

        $pdo = DBConnection::GetDBConnection();
        $stmt = $pdo->prepare($query);
        if (sizeof($this->bindingValues) > sizeof($this->values)) {
            sizeof($this->bindingValues) > 0
                ? $stmt->execute($this->bindingValues)
                : $stmt->execute();
        } else {
            sizeof($this->values) > 0
                ? $stmt->execute($this->values)
                : $stmt->execute();
        }

        return $stmt;
    }
}