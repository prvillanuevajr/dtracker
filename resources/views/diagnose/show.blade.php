@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card diagnosis_card">
                    <div class="card-body">
                        <div class="text-right px-4 mb-4">
                            <h4 class="font-weight-bold">{{$diagnosis->created_at->toFormattedDateString()}}</h4>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="text-secondary">Patient name: <b class="text-dark">{{$diagnosis->owner->name}}</b></h5>
                            <h5 class="text-secondary">Patient year of birth: <b class="text-dark">{{$diagnosis->owner->birthday->year}}</b></h5>
                        </div>
                        <div class="mb-4 d-flex justify-content-between">
                            <h5 class="text-secondary">Patient age: <b class="text-dark">{{now()->diffInYears($diagnosis->owner->birthday)}}</b></h5>
                            <h5 class="text-secondary">Patient age when diagnosed: <b class="text-dark">{{$diagnosis->created_at->diffInYears($diagnosis->owner->birthday)}}</b></h5>
                        </div>
                        <div class="mb-4">
                            <h5 class="text-secondary">Body mass index: <b>{{$diagnosis->bmi_value}}</b></h5>
                            <h5 class="text-secondary">{{$diagnosis->bmi_risk}}</h5>
                        </div>
                        <div class="mb-4">
                            <h5 class="d-inline"><b>Disease Name: </b>{{$diagnosis->disease->name}}</h5>
                            <h5 class="float-right"><b>Professional Name: </b>{{$diagnosis->disease->prof_name}}</h5>
                        </div>
                        <p class="disease_description">{{$diagnosis->disease->description}}</p>
                        <div class="mb-4">
                            <h5 class="font-weight-bold">Possible Symptoms:</h5>
                            <p>{{$diagnosis->disease->possible_symptoms}}</p>
                        </div>
                        <div>
                            <h5 class="font-weight-bold">Treatment Recommendation:</h5>
                            <p>{{$diagnosis->disease->treatment_recommendation}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection