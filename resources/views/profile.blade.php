@extends('layouts.app')
@section('content')
    @if (session()->has('edit'))
        <div class="notification my-6 is-link has-text-centered">
            <button class="delete"></button>
            <strong>{{ session()->get('edit') }}</strong>

        </div>
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
    @endif
   <section class="section">
       <div class="container ">
           <div class="card">
               <div class="card-content">
                   <div class="content">
                       <div class="control is-flex is-flex-direction-column is-justify-content-center is-align-items-center has-text-centered">
                           <img src="{{asset('storage/'. auth()->user()->image)}}" width="82px" height="82px" alt="">
                           <h3>{{auth()->user()->name}}</h3>
                       </div>
                       <form action="/profile" method="post" enctype="multipart/form-data">
                           @csrf
                           @method('PATCH')
                           <div class="control">
                               <label class="label">Name</label>
                               <input class="input" type="text" name="name" value="{{auth()->user()->name}}">
                               @error('name')
                               <div class="has-text-danger">
                                   <small>{{$message}}</small>
                               </div>
                               @enderror
                           </div>
                           <div class="control">
                               <label class="label">email</label>

                               <input class="input" type="email" name="email" value="{{auth()->user()->email}}">
                               @error('email')
                               <div class="has-text-danger">
                                   <small>{{$message}}</small>
                               </div>
                               @enderror
                           </div>
                           <div class="control">
                               <label class="label">password</label>

                               <input class="input" type="password" name="password" placeholder="Text input">
                               @error('password')
                               <div class="has-text-danger">
                                   <small>{{$message}}</small>
                               </div>
                               @enderror
                           </div>
                           <div class="control">
                               <label class="label">re-type password</label>

                               <input class="input" type="password" name="password_confirmation" placeholder="Text input">
                               @error('password_confirmation')
                               <div class="has-text-danger">
                                   <small>{{$message}}</small>
                               </div>
                               @enderror
                           </div>
                           <div class="control my-6">
                               <div class="file has-name is-info">
                                   <label class="file-label">
                                       <input class="file-input" type="file" name="image">
                                       <span class="file-cta">
                                  <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                  </span>
                                  <span class="file-label">
                                    Choose a file…
                                  </span>
                                </span>
                                       <span class="file-name">
                                </span>
                                   </label>
                               </div>

                           </div>
                           @error('image')
                           <div class="has-text-danger">
                               <small>{{$message}}</small>
                           </div>
                           @enderror
                           <div class="control my-4">
                               <button type="submit" class="button is-link is-outlined  is-rounded">update</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <script>
       //get file name when upload file
       document.addEventListener('DOMContentLoaded', () => {
           // 1. Display file name when select file
           let fileInputs = document.querySelectorAll('.file.has-name')
           for (let fileInput of fileInputs) {
               let input = fileInput.querySelector('.file-input')
               let name = fileInput.querySelector('.file-name')
               input.addEventListener('change', () => {
                   let files = input.files
                   if (files.length === 0) {
                       name.innerText = 'No file selected'
                   } else {
                       name.innerText = files[0].name
                   }
               })
           }

           // 2. Remove file name when form reset
           let forms = document.getElementsByTagName('form')
           for (let form of forms) {
               form.addEventListener('reset', () => {
                   console.log('a')
                   let names = form.querySelectorAll('.file-name')
                   for (let name of names) {
                       name.innerText = 'No file selected'
                   }
               })
           }
       })
   </script>
@endsection
