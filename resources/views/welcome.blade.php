@extends('layouts.app')
@section('content')
    <section class="section has-text-centered is-flex is-justify-content-center is-align-items-center">
        <div class="card">
            <div class="card-image ">
                    <img src="{{asset('storage/project.jpg')}}" alt="Placeholder image">
            </div>
            <div class="card-content">


                <div class="content is-flex is-flex-direction-column is-justify-content-center is-align-items-center">
                    <p class="title is-4">Time to management your project</p>
                    <div class="field is-grouped">
                        <p class="control">
                            <a class="button is-link" href="/login">
                               Sign in
                            </a>
                        </p>
                        <p class="control">
                            <a class="button" href="/register">
                                Register
                            </a>
                        </p>
                        <p class="control">
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
