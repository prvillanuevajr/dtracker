@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
                <a href="/diagnose" class="btn btn-success float-right mr-4">Get Diagnose</a>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <analytics-4-component></analytics-4-component>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <analytics-1-component></analytics-1-component>
                    </div>
                    <div class="col-md-4">
                        <analytics-2-component></analytics-2-component>
                    </div>
                    <div class="col-md-4">
                        <analytics-3-component></analytics-3-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
