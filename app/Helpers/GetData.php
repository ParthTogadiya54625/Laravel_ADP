<?php

namespace App\Helpers;

use App\Models\Business;
use App\Models\Heading;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class GetData
{
    public static function getBusinessDetail($id)
    {
        return Business::with('headings','user')->find($id);
    }

    public static function syncPivotData($businessID = null, $headingId = null, $key = [], $value = null)
    {
        $business = Business::with('headings','user')->find($businessID);
        $heading = Heading::with('keywords')->find($headingId);
        $superAdmins = Role::with('users')->where('name','super-admin')->first()->users->pluck('id');
        $offeredKeywords = $heading->keywords->whereIn('super_admin_user_id',$superAdmins);
        $additionalKeywords = $heading->keywords->where('super_admin_user_id', Auth::user()->id);

        foreach($key as $field){
            if ($field === 'offered_keywords') {
                $business->headings()->syncWithoutDetaching([$headingId=>[$field=>$offeredKeywords ]]);
            } elseif ($field === 'additional_keywords') {
                $business->headings()->syncWithoutDetaching([$headingId=>[$field=>$additionalKeywords ]]);
            } elseif ($field === 'image') {
                $business->headings()->syncWithoutDetaching([$headingId=>[$field=>$value ]]);
            } else {
                return ;
            }
        }
        return [
            'heading' => $heading,
            'offeredKeywords' => $offeredKeywords,
            'additionalKeywords' => $additionalKeywords
        ];
    }

    public static function getUserDetail($id)
    {
        return User::with('keywords','businesses')->find($id);
    }
}
