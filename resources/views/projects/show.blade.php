@extends('layouts.app')
@section('content')
    <section class="section columns">
        <div class="column is-6 p-1">
            <div class="card">
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
                <div class="card-content">
                    <div class="content">
                        <h2>{{$project->title}}</h2>
                        <p>{{$project->description}}</p>
                    </div>
                    <div class="actions columns has-background-link-light py-4">
                        <div class="column">
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
                            <a href="/projects/{{$project->id}}/edit" class="button is-outlined is-success">Edit</a>
                        </div>
                    <div class="column">
                        <div class="select" >
                          <form action="/projects/{{$project->id}}" method="post">
                              @csrf
                              @method('PATCH')
                              <select name="status" onchange="this.form.submit()">
                                  <option vlaue="0" {{($project->status ==0)? 'selected' : ''}}>in progress</option>
                                  <option value="1" {{($project->status == 1) ? 'selected' : ''}}>Completed</option>
                                  <option value="2" {{($project->status == 2) ? 'selected' : ''}}>Cancelled</option>
                              </select>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        {{--tasks--}}
        <div class="column is-6">
            <h3>Tasks</h3>
            @forelse($project->tasks as $task)
               <div class="columns">
                       <label class="checkbox mt-4">
                           <form action="{{route('toggleTaskComplete',['project'=>$project->id,'task'=>$task->id])}}" method="post">
                               @csrf
                               @method('PATCH')
                               <input type="checkbox" name="done" {{$task->done ? 'checked' : ''}}
                               onchange="this.form.submit()"
                               >
                           </form>

                       </label>

                   <div class="column">
                       <h3 class="{{$task->done ? 'checked has-text-danger'  : ''}}">
                           {{$task->body}}
                       </h3>
                   </div>
                   <div class="column">
                       <form action="/projects/{{$project->id}}/tasks/{{$task->id}}" method="post">
                           @method('DELETE')
                           @csrf
                           <button class="button is-danger">Delete</button>
                       </form>
                   </div>

               </div>
            @empty
                <h2>there are no tasks yet</h2>
            @endforelse
            <form action="{{route('addTask',['project'=>$project->id ])}}" method="POST">
                @csrf
                <div class="columns">
                    <div class="column">
                        <input class="input" name="body" type="text" placeholder="add a new task to the project">
                    </div>
                    <div class="column">
                        <button class="button is-primary">add</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
