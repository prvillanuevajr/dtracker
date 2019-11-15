<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function analytics_1()
    {
        return auth()->user()->diagnoses()->orderBy('created_at')->get();
    }

    public function analytics_2()
    {
        $diagnosis_ids_this_month = Diagnosis::query()->whereMonth('created_at', now()->month)->get('id');
        return DB::table('diagnoses_symptoms')
            ->join('symptoms', 'symptoms.id', 'symptom_id')
            ->selectRaw('name, count(*) freq_count')
            ->groupBy('name')
            ->orderByDesc('freq_count')
            ->whereIn('diagnosis_id', $diagnosis_ids_this_month)->limit(20)->get();
    }

    public function analytics_3()
    {
        return DB::table('diagnoses')
            ->join('diseases', 'diseases.id', 'disease_id')
            ->selectRaw('name, count(*) freq_count')
            ->groupBy('name')
            ->orderByDesc('freq_count')
            ->limit(20)
            ->get();
    }

    public function analytics_4()
    {
        return json_decode(file_get_contents("../data.json"),true);
    }
}
