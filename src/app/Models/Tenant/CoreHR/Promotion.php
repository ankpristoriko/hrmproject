<?php

namespace App\Models\Tenant\CoreHR;

use App\Models\Tenant\TenantModel;
use Wildside\Userstamps\Userstamps;
use App\Models\Tenant\Traits\CoreHR\PromotionValidationRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repositories\Core\Setting\SettingRepository;
use App\Models\Core\Setting\Setting;
use Carbon\Carbon;

class Promotion extends TenantModel
{
    use Userstamps;
    use SoftDeletes;
    use HasFactory;
    use PromotionValidationRules;

    protected $table = 'promotions';
    protected $fillable = ['promotion_title', 'description', 'company_id', 'employee_id', 'promotion_date'];
    protected $dates = ['deleted_at', 'promotion_date'];

    public function company()
    {
        return $this->hasOne('App\Models\App\Organization\Company','id','company_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\App\Employee','id','employee_id');
    }

    // public function getPromotionDateAttribute($value)
    // {
    //     $data =  resolve(SettingRepository::class)
    //             ->formatSettings(
    //                 Setting::query()->where('context','app')
    //                     ->get()
    //             );
        
    //     $date = Carbon::parse($value)->setTimezone($data['time_zone']);
    //     return $date->format('Y-m-d');
    // }

    // public function setPromotionDateAttribute($value)
    // {
    //     $data =  resolve(SettingRepository::class)
    //             ->formatSettings(
    //                 Setting::query()->where('context','app')
    //                     ->get()
    //             );
        
    //     $date = Carbon::parse($value)->setTimezone($data['time_zone']);
    //     $this->attributes['promotion_date'] = $date->format('Y-m-d');
    // }
}
