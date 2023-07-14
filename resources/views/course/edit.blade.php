@extends('layout.master')
@section('content')
    <div class="col-md-12" style="min-height: 70vh">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="card-content">
                <form action="{{ route('courses.update', $course) }}" method="post">
                    @csrf
                    @method('PUT')
                    Name
                    <input type="text" name="name" value="{{ $course->name }}">
                    @if ($errors->has('name'))
                        <span class="error">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                    <br>
                    <button>Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
