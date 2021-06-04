<?php

namespace App\Services;

use App\Models\Judger;
use App\Models\Setting;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class JudgeService
{
    protected $serverNo;
    protected $totalServer;
    protected $submission;
    protected $multiJudgeStart;
    protected $judger;

    public function __construct($serverNo = null)
    {
        $this->setServer($serverNo);
    }

    public function setServer($serverNo)
    {
        $setting           = Setting::where(['id' => 1])->firstOrFail();
        $this->totalServer = $setting->judger_process;
        $judgers           = Judger::where(['is_running' => 1])->get();
        $this->totalServer = min(count($judgers), $this->totalServer);

        $this->serverNo = $serverNo == null ? 1 : $serverNo;
        $this->serverNo = $this->serverNo == 0 ? 1 : $this->serverNo;

        if ($this->totalServer == 0) {
            echo "Juding System is pause";
            exit();
        }
        if ($this->serverNo > $this->totalServer) {
            exit();
        }
        $this->judger = $judgers[$this->serverNo - 1]->judger_url . "/api/api.php";
    }

    public function multiJudge($isStart = true)
    {
        if ($isStart) {
            $this->multiJudgeStart = Carbon::now()->timestamp;
        }

        $now = Carbon::now()->timestamp;
        if (($now - $this->multiJudgeStart) >= 55) {
            return;
        }

        $this->judge();

        if (empty($this->submission)) {
            sleep(1);
        } else {
            usleep(100000);
        }

        $this->multiJudge(false);
    }

    public function judge()
    {
        $submissionData = $this->getPendingSubmissionData();
        if (empty($submissionData)) {
            return;
        }

        $response = $this->sendSandBox($submissionData);
        $this->updateSubmissionStatus($response);
    }

    public function getSubmissionData()
    {
        $serverNo         = $this->serverNo - 1;
        $submissionData   = Submission::where('verdict_id', '<=', 2)->whereRaw("id MOD {$this->totalServer} = {$serverNo}")->orderBy('id', 'ASC')->first();
        $this->submission = $submissionData;
        return $submissionData;
    }

    public function getPendingSubmissionData()
    {
        $submission = $this->getSubmissionData();
        if (empty($submission)) {
            //echo "No Pending Submission Found";
            return [];
        }

        // dd($submission);

        $this->submission->update([
            'verdict_id' => 2,
        ]);

        $data = array(
            'source_code'     => base64_encode($submission->source_code),
            'language'        => $submission->language()->first()->argument,
            'time_limit'      => sprintf('%0.3f', ($submission->time_limit / 1000)),
            'memory_limit'    => $submission->memory_limit,
            'input'           => base64_encode($submission->readInputFile()),
            'expected_output' => base64_encode($submission->readExpectedOutputFile()),
            'checker_type'    => $submission->checker_type,
            'custom_checker'  => $submission->custom_checker,
            'default_checker' => $submission->default_checker,
            'api_type'        => 'submission',
        );
        return $data;
    }

    public function sendSandBox($data)
    {
        $url      = $this->judger;
        $response = Http::asForm()->post($url, $data);

        return json_decode($response);
    }

    public function updateSubmissionStatus($response)
    {
        if (!isset($response->status->id)) {
            $this->submission->update([
                'verdict_id' => 1,
            ]);
            return;
        }

        $submission = Submission::where(['id' => $this->submission->id])->firstOrFail();
        if ($submission->verdict_id > 2) {
            return;
        }

        if ($response->status->id > 2) {
            $data = [
                'time'         => ($response->time * 1000),
                'memory'       => $response->memory,
                'checker_log'  => $response->checker_log,
                'compiler_log' => $response->compiler_log,
                'output'       => base64_decode($response->output),
                'verdict_id'   => $response->status->id,
            ];
            $this->submission->update($data);
        } else {
            $this->submission->update([
                'verdict_id' => 1,
            ]);
        }
    }

}
