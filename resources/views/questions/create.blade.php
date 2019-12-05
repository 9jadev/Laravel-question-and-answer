@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2> Ask Question </h2>
                        <div class="ml-auto">
                        <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Question </a>
                        </div>
                    </div>     
                </div>

                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question-title"> Question Title </label>
                        <input type="text" name="title" id="question-title" value="{{ old('title') }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : ' ' }}">
                        </div>
                        @if ($errors->has('title'))
                            <div class="invalid-feedback" role="alert">
                                <strong> {{ $errors->first('title') }} </strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="question-body"> Question Body </label>
                            <textarea name="body" id="question-body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ' ' }}" rows="10">{{ old('title') }}</textarea>
                        </div>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback" role="alert">
                                <strong class="color: $red;"> {{ $errors->first('body') }} </strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg">  Ask Question </button>
                        </div>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
