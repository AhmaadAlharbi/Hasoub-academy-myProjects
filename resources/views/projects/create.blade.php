@extends('layouts.app')
@section('content')
<section class="section container">
    <form action="/projects" method="POST">
        @csrf
        <div class="field">
            <label class="label">What is Your project name?</label>
            <div class="control">
                <input class="input" name="title" type="text" placeholder="Enter title ....">
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
                <textarea class="textarea" placeholder="enter description" name="description"></textarea>
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
                <a class="button is-link is-light" href="/projects">Cancel</a>
            </div>
        </div>
    </form>
</section>
@endsection