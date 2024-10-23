<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified.
 * Any custom code should be added elsewhere to avoid losing changes during updates.
 * However, in case your code is overwritten, you can always restore it from a backup folder.
 */

namespace App\Models\Admin\AdminService\Auditable;

use App\Models\Admin\AdminService\Auth\AuthUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Auditable extends Model
{
    public $table = 'admin_auditable_logs';

    protected $fillable = [
        'action',
        'row_id',
        'model',
        'user_id',
        'info',
        'url',
        'ip',
    ];

    protected $casts = [
        'info' => 'collection',
    ];

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(lang('trans/admin/config/date_time.php_date_time_format')) : null;
    }

    public function user_info()
    {
        return $this->belongsTo(AuthUser::class, 'user_id');
    }
    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->orWhere("action","like","%".$search."%")
                ->orWhere("row_id","like","%".$search."%")
                ->orWhere("model","like","%".$search."%")
                ->orWhereHas("user_info", function($q) use($search) { $q->where("name", "like", "%".$search."%")->orWhere("email", "like", "%".$search."%"); })
                ->orWhere("url","like","%".$search."%")
                ->orWhere("ip","like","%".$search."%");
        }
    }
}
