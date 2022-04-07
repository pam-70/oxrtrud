@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        {{ Auth::user()->surname }}

                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">ВЫХОД</a>




                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if (Auth::user()->role == 'student')
                            <student-component></student-component>
                        @endif
                        @if (Auth::user()->role == 'admin')
                            <admin-component></admin-component>
                        @endif
                        @if (Auth::user()->role == 'del')

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
