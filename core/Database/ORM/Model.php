<?php

namespace Core\Database\ORM;

use Core\Database\Traits\HasQueryBuilder;

abstract class Model
{
    use HasQueryBuilder;

    protected string $table;
    protected array $fillable;
    protected array $hidden;
    protected array $casts;
    protected string $primaryKey = 'id';
    protected string $createdAtColumn = 'created_at';
    protected string $updatedAtColumn = 'updated_at';
    protected ?string $deletedAtColumn = null;
    protected array $collection;
}