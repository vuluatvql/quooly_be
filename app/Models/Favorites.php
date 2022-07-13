<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $bukken_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Favorites extends Model
{
    use HasFactory, SoftDeletes, Sortable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */

    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'bukken_id', 'created_at', 'updated_at', 'deleted_at'];
}
