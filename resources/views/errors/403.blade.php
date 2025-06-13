@extends('errors.errors_layout')

@section('title')
403 - Access Denied
@endsection

@section('error-content')
<style>
    .error-area {
        min-height: 100vh;
        background: #F3F8FB;
        background-image: url('https://www.awardspace.com/wp-content/uploads/2021/01/403-forbidden-1.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% 100%;
    }

    .error-content {
        background: none;
    }

    .error-content p {
        color: #fff;
        background-color: #787bd8;
    }
</style>
{{-- <h2>403</h2> --}}
<p>Access to this resource on the server is denied</p>
<hr>
<p class="mt-2">
    {{ $exception->getMessage() }}
</p>
<a href="{{ URL('admin') }}">Back to Dashboard</a>
<a href="{{ route('admin.login') }}">Login Again !</a>
@endsection