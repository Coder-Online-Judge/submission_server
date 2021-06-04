<?php

namespace App\Http\Controllers\Judger;

use App\Http\Controllers\Controller;
use App\Http\Requests\JudgerUpdateRequest;
use App\Models\Judger;
use Illuminate\Support\Facades\Http;

class JudgerController extends Controller
{
    public function updateJudger(JudgerUpdateRequest $request)
    {
    	$judgerServer = $request->judger_server;
        $judgers = Http::get($request->judger_server . "/assist/db/db.json");
        $judgers = json_decode($judgers);
        if(isset($request->is_reset))Judger::truncate();
        foreach ($judgers as $key => $value) {
        	if(isset($value->name)){
        		Judger::create([
        			'judger_url' => $judgerServer."/judger/".$value->name
        		]);
        	}
        }

        $judgers = Judger::where(['is_running' => 1])->get();
        return view("judger", ['judgers' => $judgers]);
        
    }
    public function getJudgerList()
    {
        $judgers = Judger::where(['is_running' => 1])->get();
        return view("judger", ['judgers' => $judgers]);
    }
}
