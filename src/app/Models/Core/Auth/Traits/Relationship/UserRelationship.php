<?php

namespace App\Models\Core\Auth\Traits\Relationship;

use App\Models\Core\Auth\PasswordHistory;
use App\Models\Core\Auth\Role;
use App\Models\Core\Auth\SocialAccount;
use App\Models\Core\Builder\Form\CustomFieldValue;
use App\Models\Core\File\File;
use App\Models\Core\Setting\Setting;
use App\Models\Core\Traits\CreatedByRelationship;
use App\Models\Core\Traits\StatusRelationship;
use App\Models\Tenant\Attendance\Attendance;
use App\Models\Tenant\Employee\Department;
use App\Models\Tenant\Employee\DepartmentUser;
use App\Models\Tenant\Employee\Designation;
use App\Models\Tenant\Employee\DesignationUser;
use App\Models\Tenant\Employee\EmploymentStatus;
use App\Models\Tenant\Employee\Profile;
use App\Models\Tenant\Employee\UserBankAccount;
use App\Models\Tenant\Employee\UserContact;
use App\Models\Tenant\Employee\UserDocument;
use App\Models\Tenant\Employee\UserDependent;
use App\Models\Tenant\Employee\UserEducation;
use App\Models\Tenant\Employee\UserLicense;
use App\Models\Tenant\Employee\UserWorkExperience;
use App\Models\Tenant\Leave\Leave;
use App\Models\Tenant\Leave\UserLeave;
use App\Models\Tenant\Payroll\BeneficiaryValue;
use App\Models\Tenant\Payroll\PayrunSetting;
use App\Models\Tenant\Payroll\Payslip;
use App\Models\Tenant\Salary\Salary;
use App\Models\Tenant\WorkingShift\UpcomingUserWorkingShift;
use App\Models\Tenant\WorkingShift\WorkingShift;
use App\Models\Tenant\WorkingShift\WorkingShiftUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    use CreatedByRelationship, StatusRelationship;

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function settings()
    {
        return $this->morphMany(
            Setting::class,
            'settingable'
        );
    }

    public function customFields()
    {
        return $this->morphMany(
            CustomFieldValue::class,
            'contextable'
        );
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function profilePicture()
    {
        return $this->morphOne(File::class, 'fileable')
            ->whereType('profile_picture');
    }

    public function department()
    {
        return $this->departments()
            ->toOne()
            ->wherePivotNull('end_date')
            ->withPivot('start_date', 'end_date');
    }

    public function departments()
    {
        return $this->belongsToMany(
            Department::class,
            'department_user',
            'user_id',
            'department_id'
        )->withPivot('start_date', 'end_date')
            ->using(DepartmentUser::class);
    }

    public function hasDepartments(): HasMany
    {
        return $this->hasMany(
            Department::class,'manager_id', 'id'
        );
    }

    public function designation()
    {
        return $this->designations()
            ->toOne()
            ->withPivot('start_date', 'end_date')
            ->wherePivotNull('end_date');
    }

    public function designations()
    {
        return $this->belongsToMany(
            Designation::class,
            'designation_user',
            'user_id',
            'designation_id'
        )->withPivot('start_date', 'end_date')
            ->using(DesignationUser::class);
    }

    public function workingShift()
    {
        return $this->workingShifts()
            ->toOne()
            ->withPivot('start_date', 'end_date')
            ->wherePivotNull('end_date')
            ->using(WorkingShiftUser::class);
    }

    public function workingShifts()
    {
        return $this->belongsToMany(
            WorkingShift::class,
            'working_shift_user',
            'user_id',
            'working_shift_id'
        )->withPivot('start_date', 'end_date')
            ->using(WorkingShiftUser::class);
    }

    public function employmentStatus()
    {
        return $this->employmentStatuses()
            ->toOne()
            ->withPivot('start_date', 'end_date', 'description')
            ->wherePivotNull('end_date');
    }

    public function employmentStatuses()
    {
        return $this->belongsToMany(EmploymentStatus::class, 'user_employment_status')
            ->withPivot('start_date', 'end_date', 'description');
    }

    public function addresses()
    {
        return $this->hasMany(UserContact::class)->whereIn('key', ['present_address', 'permanent_address']);
    }

    public function contacts()
    {
        return $this->hasMany(UserContact::class)->where('key', 'emergency_contacts');
    }

    public function socialLinks()
    {
        return $this->hasMany(UserContact::class)
            ->whereIn('key', config('settings.supported_social_links'));
    }

    public function documents()
    {
        return $this->hasMany(UserDocument::class)->whereIn('key', ['ktp', 'npwp', 'bpjs_kesehatan', 'bpjs_ketenagakerjaan']);
    }

    public function licenses()
    {
        return $this->hasMany(UserLicense::class)->where('key', 'employee_licenses');
    }

    public function workExperiences()
    {
        return $this->hasMany(UserWorkExperience::class)->where('key', 'employee_work_experiences');
    }

    public function bankAccounts()
    {
        return $this->hasMany(UserBankAccount::class)->where('key', 'employee_bank_accounts');
    }

    public function dependents()
    {
        return $this->hasMany(UserDependent::class)
        ->select('user_dependents.id','user_id','key','value','user_dependents.created_at','user_dependents.updated_at','relationships.name as relationship_name')
        ->join('relationships', function($join) {
            $join->on('value->relationship_id', '=', 'relationships.id');
        })
        ->where('key', 'employee_dependents');
    }

    public function educations()
    {
        return $this->hasMany(UserEducation::class)
        ->select('user_educations.id','user_id','key','value','user_educations.created_at','user_educations.updated_at','education_levels.name as education_level_name','educational_institutions.name as institution_name')
        ->join('education_levels', function($join) {
            $join->on('value->education_level', '=', 'education_levels.id');
        })
        ->join('educational_institutions', function($join) {
            $join->on('value->educational_institution', '=', 'educational_institutions.id');
        })
        ->where('key', 'employee_educations');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function assignedLeaves(): HasMany
    {
        return $this->hasMany(UserLeave::class);
    }

    public function assignedPaidLeaves(): HasMany
    {
        return $this->assignedLeaves()
            ->whereHas('leaveType', fn($builder) => $builder->where('type', 'paid'));
    }

    public function assignedUnpaidLeaves(): HasMany
    {
        return $this->assignedLeaves()
            ->whereHas('leaveType', fn($builder) => $builder->where('type', 'unpaid'));
    }

    public function assignedSpecialLeaves(): HasMany
    {
        return $this->assignedLeaves()
            ->whereHas('leaveType', fn($builder) => $builder->where('type', 'special'));
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function salary($date = null)
    {
        $nowDate = $date ?: nowFromApp();

        return $this->hasOne(Salary::class)
            ->where(fn (Builder $b) => $b
                ->where(fn (Builder $builder) => $builder
                    ->whereDate('start_at', '<=', $nowDate)
                    ->whereNull('end_at')
                )->orWhere(fn (Builder $builder) => $builder
                    ->whereDate('start_at', '<=', $nowDate)
                    ->whereDate('end_at', '>', $nowDate)
                )->orWhere(fn (Builder $builder) => $builder
                    ->whereNull('start_at')
                    ->whereNull('end_at')
                )->orWhere(fn (Builder $builder) => $builder
                    ->whereNull('start_at')
                    ->whereDate('end_at', '>', $nowDate)
                )
            );
    }

    public function updatedSalary()
    {
        return $this->hasOne(Salary::class)
            ->whereNull('end_at');
    }

    public function payrunSetting()
    {
        return $this->morphOne(PayrunSetting::class, 'payrun_settingable');
    }

    public function payrunBeneficiaries()
    {
        return $this->morphMany(BeneficiaryValue::class, 'beneficiary_valuable');
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public function upcomingWorkingShift()
    {
        return $this->hasMany(UpcomingUserWorkingShift::class, 'user_id', 'id');
    }
}
