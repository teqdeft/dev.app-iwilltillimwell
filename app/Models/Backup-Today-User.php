<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Medication;
use App\Models\ActivityLog;
use App\Models\UserDetails;
use App\Models\Organization;
use App\Models\UserPharmacy;

use Laravel\Cashier\Billable;
use App\Models\MedicalCondition;use App\Models\SurgicalHistory;
use App\Models\MedicationAllergy;
use Laravel\Passport\HasApiTokens;
use App\Interfaces\CommonConstants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable  implements CommonConstants
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','password','fname','lname','parentId','planid','planDetailsId','groupCode','stateid','user_password','primaryPhone','dob','gender','address','address2','heightFeet','heightInches','weight','zipCode','city','timezoneId','disableNotifications','sendRegistrationNotification','numAllowedDependents','language','customAttributeId','customAttributeValue','effectiveDate','user_role','step_position','relationship','userid','payment_status','organization_id','access_site','onboard','plan',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'promocode','userRole'
    ];



    /**
     * Get all of the user's dependents.
     */
    public function dependents() {
        return $this->hasMany(User::class, 'parentId');
    }

    /**
     * Get parent of the dependents.
     */
    public function parent() {
        return $this->belongsTo(User::class, 'parentId');
    }

    /**
     * Get user details.
     */
    public function user_details() {
        return $this->hasOne(UserDetails::class, 'user_id');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    /**
     * Get medication details.
     */
    public function user_medications() {
        return $this->hasMany(Medication::class, 'userId', 'id')->orderBy('id','DESC');
    }

    /**
     * Get medication allergy details.
     */
    public function user_allergies() {
        return $this->hasMany(MedicationAllergy::class, 'userId', 'id')->orderBy('id','DESC');
    }

    /**
     * Get medication allergy details.
     */
    public function user_medical_condition() {
        return $this->hasMany(MedicalCondition::class, 'userId', 'id')->where('deleted_at', null)->orderBy('id','DESC');
    }
    public function surgical_history() {
        return $this->hasMany(SurgicalHistory::class, 'user_id', 'id')->where('deleted_at', null)->orderBy('id','DESC');
    }

    // Get total dependent
    public function getTotalDependentsAttribute() {
        return User::where('parentId', $this->attributes['id'])->count();
    }

    // Get total dependent
    public function getParentDependentsAttribute() {
        return User::where('parentId', $this->attributes['parentId'])->where('id', '!=', $this->attributes['id'])->whereNotNull('parentId')->get();
    }

    /**
     * Get user pharmacy.
     */
    public function user_pharmcay() {
        return $this->hasOne(UserPharmacy::class, 'user_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the user company information associated with the user.
     */
    public function isAdmin()
    {
        return $this->attributes['user_role'] == self::ADMIN;
    }

    public function isManagers()
    {
        return $this->attributes['user_role'] == self::OTHERS;
    }



    /**
     * Get the user company information associated with the user.
     */
    public function isUser()
    {
        return $this->attributes['user_role'] == self::USER;
    }

    /**
     * Get the user company information associated with the user.
     */
    public function isAppUser()
    {
        return $this->attributes['user_role'] == self::APPUSER;
    }

    /**
     * Get organization.
     */
    public function organization()
    {
      return $this->belongsTo('App\Models\Organization', 'organization_id');
    }

    /**
     * Get the user company information associated with the user.
     */
    public function isAffiliate()
    {
        return $this->attributes['user_role'] == self::AFFILIATE;
    }

    /**
     * user role counsellor.
     */
    public function isCounsellor()
    {
        return $this->attributes['user_role'] == self::COUNSELLOR;
    }

    public function promocode(){
        return $this->hasOne(Promocode::class,'id','promo_code_id')->withDefault();
    }

    public static function getPromoType($id){
        return Self::leftJoin('organizations','organizations.id','=','users.organization_id')
        ->where('users.id',$id)->pluck('organizations.name');
    }


    public function userRole(){
        return $this->hasOne(Role::class,'id','admin_managers')->withDefault();
    }

    public function activityLogs(){
        return $this->hasMany(ActivityLog::class,'user_id','id')->orderBy('id','desc');
    }

    public static function paymentDetails($id,$plan){
        return Self::leftJoin('braintree_transactions as bt','users.id','=','bt.user_id')
                    ->leftJoin('plans','plans.id','=','bt.plan_id')
                    ->where( ['bt.transaction_type' => 'plan','users.id' => $id,'plans.id' => $plan ] )
                    ->orderBy('bt.id')
                    ->select('plans.name','plans.type','bt.created_at','plans.amount','users.expiry_date')->get()->toArray();
    }

        public static function UserUpdate($data){
        return Self::where('id',Auth::user()->id)->update($data);
    }



}
