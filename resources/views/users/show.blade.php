@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5 d-flex justify-content-center">
                        <div class="card" style="width:400px">
                            <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png"
                                 alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">{{$user->name}}</h4>
                                <h4 class="card-title">{{$user->birthday->toFormattedDateString()}}</h4>
                                <h4 class="card-title">{{$user->gender == 'M' ? 'Male' : 'Female'}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <my-diagnose-component></my-diagnose-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection