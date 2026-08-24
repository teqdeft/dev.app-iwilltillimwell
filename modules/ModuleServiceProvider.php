<?php
namespace Modules;
class ModuleServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public static function getUserMenu(){
        return [];
    }

    public static function getUserSubmenu(){
        return [];
    }

    public static function getAffiliateMenu(){
        return [];
    }

    public static function getAffiliateSubmenu(){
        return [];
    }

    public static function getMedicalCareMenu(){
         return [];
    }



    public function register()
    {

    }
}
