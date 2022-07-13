<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $first_name_furigana
 * @property string $last_name_furigana
 * @property string $email
 * @property string $content
 * @property integer $user_id
 * @property integer $business_user_id
 * @property boolean $contact_type
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Contact extends Model
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
    protected $fillable = ['first_name', 'last_name', 'first_name_furigana', 'last_name_furigana', 'email', 'content', 'user_id', 'business_user_id', 'contact_type', 'status', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['contact_status_text'];
    public function getContactStatusTextAttribute()
    {
        return ContactStatus::getDescription($this->status);
    }
}
