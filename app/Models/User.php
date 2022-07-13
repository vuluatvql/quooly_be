<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $role_id
 * @property string $first_name
 * @property string $last_name
 * @property string $first_name_furigana
 * @property string $last_name_furigana
 * @property string $email
 * @property string $birthday
 * @property string $password
 * @property string $phone_number
 * @property string $postcode
 * @property integer $prefecture_id
 * @property string $city
 * @property string $address
 * @property string $reset_password_token
 * @property string $reset_password_token_expire
 * @property string $remember_token
 * @property string $last_login_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class User extends Authenticatable implements JWTSubject
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
    protected $fillable = ['role_id', 'first_name', 'last_name', 'first_name_furigana', 'last_name_furigana', 'email', 'birthday', 'password', 'phone_number', 'postcode', 'prefecture_id', 'city', 'address', 'reset_password_token', 'reset_password_token_expire', 'remember_token', 'last_login_at', 'created_at', 'updated_at', 'deleted_at'];
}
