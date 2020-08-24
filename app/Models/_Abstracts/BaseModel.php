<?php

namespace App\Models\_Abstracts;

use App\Models\_Trait\UuidTrait;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{

    use UuidTrait;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
}
