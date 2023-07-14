<link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/material-dashboard.css?v=1.2.1') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/demo.css" rel="stylesheet') }}" />
<div class="card">
    <form action="{{ route('process_register') }}" method="post">
        @csrf
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">contacts</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Register Form</h4>
            <div class="form-group label-floating is-empty">
                <label class="control-label">Name
                    <star>*</star>
                </label>
                <input class="form-control" name="name" type="text" required="true" aria-required="true">
                <span class="material-input"></span>
            </div>
            <div class="form-group label-floating is-empty">
                <label class="control-label">Email Address
                    <star>*</star>
                </label>
                <input class="form-control" name="email" type="text" email="true" required="true"
                    aria-required="true">
                <span class="material-input"></span>
            </div>
            <div class="form-group label-floating is-empty">
                <label class="control-label">Password
                    <star>*</star>
                </label>
                <input class="form-control" name="password" type="password" required="true" aria-required="true">
                <span class="material-input"></span>
            </div>
            <div class="category form-category">
                <a href="{{ route('register') }}">Register</a>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-rose btn-fill btn-wd">Register</button>
            </div>
        </div>
    </form>
</div>
