@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <hr>
                    <p alignment="center">{{ __('You are logged in!') }}</p>
                    <hr>

                    <br><br><br><br>


                    <h1>{{ __('Contents will come here soon!') }}</h1>




                    <br><br><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
