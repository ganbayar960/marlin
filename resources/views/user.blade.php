@extends('master')

@section('content')
<div class="container" id="app">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <users-index></users-index>
            </div>
        </div>
    </div>
</div>
@endsection