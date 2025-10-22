@extends('admin.default')

@section('content')
<section class="content">
    <div class="error-page">
        <h2 class="headline text-warning">404</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
            <p>{{ $exception->getMessage() }} <a href="{{ route('admin.dashboard') }}">return to index</a>.</p>
        </div>
    </div>
</section>
@endsection
