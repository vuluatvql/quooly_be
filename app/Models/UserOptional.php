<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $jobs
 * @property integer $company_industry
 * @property integer $rent_income
 * @property integer $annual_income
 * @property integer $user_income
 * @property integer $property_building
 * @property integer $property_division
 * @property integer $property_kodate_chintai
 * @property boolean $mail_magazine_flag
 * @property boolean $request_noti_flag
 * @property boolean $favorite_noti_flag
 * @property boolean $seminar_noti_flag
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class UserOptional extends Model
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
    protected $fillable = ['user_id', 'jobs', 'company_industry', 'rent_income', 'annual_income', 'user_income', 'property_building', 'property_division', 'property_kodate_chintai', 'mail_magazine_flag', 'request_noti_flag', 'favorite_noti_flag', 'seminar_noti_flag', 'created_at', 'updated_at', 'deleted_at'];
}
