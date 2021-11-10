@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Страница сдачи экзаменов по охране труда') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    @if(Auth::user()->role=="student")
                    <student-component></student-component>
                    @endif
                    @if(Auth::user()->role=="admin")
                    <admin-component></admin-component>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
