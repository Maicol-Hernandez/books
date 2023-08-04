@extends('layouts.app')

@section('template_title')
    Create Book
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @includeif('partials.errors')
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear Book') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('books.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('books.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
