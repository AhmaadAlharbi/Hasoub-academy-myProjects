@extends('layouts.app')
@section('content')
@if (session()->has('add'))
<div class="notification my-6 is-info has-text-centered">
    <button class="delete"></button>
    <strong>{{ session()->get('add') }}</strong>

</div>

@endif
@if (session()->has('edit'))
<div class="notification my-6 is-success has-text-centered">
    <button class="delete"></button>
    <strong>{{ session()->get('edit') }}</strong>

</div>

@endif
@if (session()->has('delete'))
<div class="notification my-6 is-danger has-text-centered">
    <button class="delete"></button>
    <strong>{{ session()->get('delete') }}</strong>

</div>

@endif
<script>
    //hide notification when click on x
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;

                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
</script>
<section class="section hero has-text-centered is-white ">
    <div class="columns">
        <div class="column">
            <h1 class="has-text is-size-1">My projects</h1>
        </div>
        <div class="column">
            <a class="is-info button" href="/projects/create">add a new project</a>
        </div>
    </div>
    {{--projects section --}}
    <div class="columns is-multiline container mx-auto is-flex is-justify-content-center is-align-items-center">
        @forelse($projects as $project)
        <div class="column is-4 ">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <div class="status has-text-left">
                            @switch($project->status)
                            @case(1)
                            <span class="has-background-white-ter has-text-success p-2">Completed</span>
                            @break
                            @case(2)
                            <span class="has-background-white-ter has-text-danger	 p-2">Cancelled</span>
                            @break
                            @default
                            <span class="has-background-white-ter has-text-info 	 p-2">in progress</span>
                            @endswitch
                        </div>
                        <h4 class="is-size-3">
                            <a href="/projects/{{$project->id}}">{{$project->title}}</a>
                        </h4>
                        <p>{{$project->description}}</p>
                    </div>
                    <div class="actions columns has-background-link-light py-4">
                        <div class="column is-one-third">
                            <span>since : {{$project->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="column">
                            <form action="/projects/{{$project->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="button is-outlined is-danger">Delete</button>
                            </form>
                        </div>
                        <div class="column">
                            <a class="button is-outlined is-link" href="/projects/{{$project->id}}/edit">Edit</a>
                        </div>
                        <div class="column">
                            <span class="mt-5"> {{count($project->tasks)}} tasks</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @empty
        <div class="is-flex container is-flex-direction-column is-justify-content-center is-align-items-center">
            <h3 class="is-size-4 my-6 is-italic is-underlined">There are no projects yet</h3>
            <a href="/projects/create" class="button is-warning">Add a new project now</a>
        </div>
        @endforelse
    </div>

</section>
@endsection