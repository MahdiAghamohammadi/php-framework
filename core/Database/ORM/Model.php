<?php

namespace Core\Database\ORM;

use Core\Database\Traits\HasAttributes;
use Core\Database\Traits\HasCRUD;
use Core\Database\Traits\HasQueryBuilder;

#[\AllowDynamicProperties]
abstract class Model
{
    use HasQueryBuilder, HasAttributes, HasCRUD;

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