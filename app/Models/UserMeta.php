<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserMeta extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','prefix','meta_key','meta_value','created_at','update_at'];

      public static function getMedicalFields(){
        $result = Self::where(['user_id' => Auth::user()->id,'prefix' => 'iwilltilimwell' ])->get()->toArray();
        $getData = [];
        if($result){
            foreach($result as $key => $value){
                    $getData[$value['meta_key']] = $value['meta_value'];
            }
        }
        return $getData;
    }

    public static function consentUpdate($data){
        if( !empty($data['meta_value']) ){
            return Self::updateOrCreate(['prefix' => 'iwilltilimwell','user_id' => Auth::user()->id,'meta_key' => $data['meta_key']  ],['user_id' => Auth::user()->id,'prefix' => 'iwilltilimwell','meta_value' => $data['meta_value'],'meta_key' => $data['meta_key'] ]);
        }
    }

    public static function checkMedication(){
        return Self::where(['meta_key' => 'medications','user_id' => Auth::user()->id,'prefix' => 'iwilltilimwell' ])->count();
    }

    public static function checkDocument(){
        return Self::where(['meta_key' => 'document-manager','user_id' => Auth::user()->id,'prefix' => 'iwilltilimwell' ])->count();
    }

    public static function MedicationAllergy(){
        return Self::where(['meta_key' => 'medication-allergies','user_id' => Auth::user()->id,'prefix' => 'iwilltilimwell' ])->count();
    }

    public static function MedicalHistory(){
        return Self::where(['meta_key' => 'medical-history','user_id' => Auth::user()->id,'prefix' => 'iwilltilimwell' ])->count();
    }

    public static function deleteMedication(){
        return Self::where(['meta_key' => 'medications','user_id' => Auth::user()->id,'prefix' => 'iwilltilimwell' ])->delete();
    }
    public static function CustomeUpdateInsert($meta_key,$meta_value) {

        $meta_value = isset($meta_value)?$meta_value:'';
        UserMeta::updateOrCreate(
                ['user_id' => Auth::user()->id, 'meta_key' =>$meta_key],
                ['meta_value' => $meta_value,'prefix'=>"iwilltilimwell"]
        );
    }   
}
