@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-right">Welcome to TMS</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h5 class="text-info text-center">Your Float Balance is: Ksh. {{ $float ?? '0' }}</h5> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection