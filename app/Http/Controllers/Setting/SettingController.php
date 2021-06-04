<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    public function updateSetting(SettingRequest $request){
    	$setting = Setting::where(['id' => 1])->firstOrFail();
    	$setting->update([
    		'judger_process' => $request->judger_process
    	]);

        return view("setting", ['setting' => $setting]);
    }
    public function viewSetting(){
    	$setting = Setting::where(['id' => 1])->firstOrFail();
        return view("setting", ['setting' => $setting]);
    }
}
