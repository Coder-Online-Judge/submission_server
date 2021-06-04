<?php

namespace App\Models;

use App\Services\SubmissionService;
use File;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'token', 'language_id', 'source_code', 'checker_type','default_checker','custom_checker', 'input', 'output', 'expected_output', 'time_limit', 'memory_limit', 'verdict_id', 'time', 'memory', 'checker_log','compiler_log'
    ];

    protected $appends = ['verdict', 'language'];
    protected $hidden  = ['language_id', 'verdict_id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($submission) {
            $submission->verdict_id      = 1;
            $submission->input           = SubmissionService::compressString($submission->input);
            $submission->expected_output = SubmissionService::compressString($submission->expected_output);
        });
        static::created(function ($submission) {
            $submission->token = SubmissionService::createToken($submission->id);
            $submission->update();
            $token = $submission->token;

            //create file
            File::put(SubmissionService::getFileName('input', $token), isset(request()->input) ? request()->input : "");
            File::put(SubmissionService::getFileName('expected_output', $token), isset(request()->expected_output) ? request()->expected_output : "");

        });

        static::updated(function ($submission) {
            if ($submission->verdict_id > 2) {
                File::delete($submission->getFileName('input'));
                File::delete($submission->getFileName('expected_output'));
            }
        });
    }

    public function getVerdictAttribute()
    {
        return $this->verdict()->select(['id', 'description'])->get();
    }

    public function getLanguageAttribute()
    {
        return $this->language()->select(['id', 'name'])->get();
    }

    public function getFileName($operation)
    {
        return public_path() . "/test_case/{$operation}/{$this->token}.txt";
    }

    public function readInputFile()
    {
        $input = File::exists($this->getFileName('input')) ? File::get($this->getFileName('input')) : "";
        //new line compilation problem use preg_replace. laravel new line is \r\n but other compiler new line is \n and it is problem for compiler checker
        return preg_replace("/\r\n/", "\n", $input);
    }

    public function readExpectedOutputFile()
    {
        $expected_output = File::exists($this->getFileName('expected_output')) ? File::get($this->getFileName('expected_output')) : "";
        return preg_replace("/\r\n/", "\n", $expected_output);
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function verdict()
    {
        return $this->belongsTo('App\Models\Verdict');
    }
}
