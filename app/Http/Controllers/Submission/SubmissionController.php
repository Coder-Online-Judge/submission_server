<?php

namespace App\Http\Controllers\Submission;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmissionValidation;
use App\Models\Submission;
use App\Models\Language;
use App\Services\SubmissionService;
use App\Services\JudgeService;

class SubmissionController extends Controller
{
    public function store(SubmissionValidation $request)
    {
        $language = Language::where(['argument' => $request->language_argument])->firstOrFail();
        $data = [
            'language_id' => $language->id,
            'time_limit' => $request->time_limit,
            'memory_limit' => $request->memory_limit,
            'source_code' => $request->source_code,
            'checker_type' => $request->checker_type,
            'default_checker' => isset($request->default_checker) ? $request->default_checker : "",
            'custom_checker' => isset($request->custom_checker) ? $request->custom_checker : "",
            'input' => isset($request->input) ? $request->input : "",
            'expected_output' => isset($request->expected_output) ? $request->expected_output : "",
        ];

        for($i=1; $i<=15; $i++)$submission = Submission::create($data);
        return response()->json([
            'token' => $submission->token,
        ]);
    }

    public function show()
    {
        $show = (int)isset(request()->show)?request()->show:15;
        return Submission::orderBy('id', 'desc')->paginate($show);
    }

    public function single()
    {
        $data = Submission::where(['token' => request()->token])->firstOrFail()->makeHidden(['created_at', 'updated_at', 'id']);

        return SubmissionService::filterSubmissionByFields($data->toArray());
    }

    public function judge()
    {
        (new \App\Services\JudgeService(request()->server_no))->judge();
    }
}
