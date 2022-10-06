@extends('layouts.app')
@section('content')
<section class="section">
    <form action="/projects/{{$project->id}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="field">
            <label class="label">What is Your project name?</label>
            <div class="control">
                <input class="input" name="title" type="text" value="{{$project->title}}">
                @error('title')
                <div class="has-text-danger">
                    <small>{{$message}}</small>
                </div>
                @enderror
            </div>
        </div>
        <div class="field">
            <label class="label">Describe your project</label>
            <div class="control">
                <textarea class="textarea" placeholder="enter description"
                    name="description">{{$project->description}}</textarea>
                @error('description')
                <div class="has-text-danger">
                    <small>{{$message}}</small>
                </div>
                @enderror
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="/projects" class="button is-link is-light">Cancel</a>
            </div>
        </div>
    </form>
</section>
@endsection