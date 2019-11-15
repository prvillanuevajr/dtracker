<?php

namespace App\Http\Controllers;

use App\ApiMedicTools\GetDiagnosis;
use App\Diagnosis;
use App\RapidApi\Bmi;
use App\Symptom;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiagnoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('diagnose.index');
    }

    public function get_diagnosis(Request $request)
    {
        $symptoms = $this->convert_request_array_to_int_array($request);
        $user = Auth::user();
        $diagnosis = (new GetDiagnosis())->getDiagnosis($symptoms, Carbon::parse($user->birthday)->year, $user->gender);
        if (!count($diagnosis)) return response(['message' => 'Sorry, there are no diseases related on the given symptoms.'], 400);
        $this->update_user_body_stats($request, $user);
        $age = Carbon::parse($user->birthday)->diffInYears(now());
        $bmi_stats = (new Bmi())->get_bmi($user->gender, $age, $request->weight, $request->height, $request->hip, $request->waist);
        $diagnosis = $this->save_diagnosis($bmi_stats, $diagnosis, $request);
        $diagnosis->symptoms()->attach($symptoms);
        return response(['diagnosis_id' => $diagnosis->id], 200);
    }

    public function show(Diagnosis $diagnosis)
    {
        return view('diagnose.show', compact('diagnosis'));
    }

    public function symptoms()
    {
        return Symptom::all();
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     */
    public function update_user_body_stats(Request $request, ?\Illuminate\Contracts\Auth\Authenticatable $user): void
    {
        DB::table('users')
            ->where('id', $user->id)
            ->update(['hip' => $request->hip, 'weight' => $request->weight, 'height' => $request->height, 'waist' => $request->waist]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function convert_request_array_to_int_array(Request $request): array
    {
        $symptoms = array_map(function ($s) {
            return (int)$s;
        }, $request->symptoms);
        return $symptoms;
    }

    /**
     * @param array $bmi_stats
     * @param $diagnosis
     * @return Diagnosis
     */
    public function save_diagnosis(array $bmi_stats, $diagnosis, Request $request): Diagnosis
    {
        $new_diagnosis_instance = new Diagnosis();
        $new_diagnosis_instance->height_m = $bmi_stats['height']['m'];
        $new_diagnosis_instance->height_cm = $bmi_stats['height']['cm'];
        $new_diagnosis_instance->height_in = $bmi_stats['height']['in'];
        $new_diagnosis_instance->height_ft_in = $bmi_stats['height']['ft-in'];
        $new_diagnosis_instance->weight_kg = $bmi_stats['weight']['kg'];
        $new_diagnosis_instance->weight_lb = $bmi_stats['weight']['lb'];
        $new_diagnosis_instance->bmi_risk = $bmi_stats['bmi']['risk'];
        $new_diagnosis_instance->bmi_status = $bmi_stats['bmi']['status'];
        $new_diagnosis_instance->bmi_value = $bmi_stats['bmi']['value'];
        $new_diagnosis_instance->bmi_prime = $bmi_stats['bmi']['prime'];
        $new_diagnosis_instance->bmr_value = $bmi_stats['bmr']['value'];
        $new_diagnosis_instance->waist = $request->waist;
        $new_diagnosis_instance->hip = $request->hip;
        $new_diagnosis_instance->ideal_weight = $bmi_stats['ideal_weight'];
        $new_diagnosis_instance->ponderal_index = $bmi_stats['ponderal_index'];
        $new_diagnosis_instance->surface_area = $bmi_stats['surface_area'];
        $new_diagnosis_instance->whr_status = $bmi_stats['whr']['status'];
        $new_diagnosis_instance->whr_value = $bmi_stats['whr']['value'];
        $new_diagnosis_instance->whtr_status = $bmi_stats['whtr']['status'];
        $new_diagnosis_instance->whtr_value = $bmi_stats['whtr']['value'];
        $new_diagnosis_instance->disease_id = $diagnosis[0]['Issue']['ID'];
        $new_diagnosis_instance->user_id = Auth::user()->id;
        $new_diagnosis_instance->save();
        return $new_diagnosis_instance;
    }

    public function getAllDiagnosis()
    {
        return Auth::user()->diagnoses()->with('disease')->get();
    }
}
