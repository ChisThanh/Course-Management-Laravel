@extends('layout.master')
@section('content')
    <div class="col-md-12" style="min-height: 70vh">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">{{ $title }} </h4>
            </div>
            <div class="card-content">
                <form action="{{ route('courses.store') }}" method="post">
                    @csrf
                    Name
                    <input type="text" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="error">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                    <br>
                    <button>Create</button>
                </form>
            </div>
        </div>
    </div>
    {{-- old('name') dữ liệu cũ của input --}}
@endsection
