@extends('layouts.app')
@section('content')
<h1 class="text-center text-capitalize text-success py-2">
    {{$category}} Section
</h1>
    <div class="d-flex flex-wrap">
        @foreach ($projects as $project)
        <div class="border border-secondary col-4 p-4 ">

            <a href="/project/{{$project->id}}">
                <img src="/storage/{{$project->image}}" alt=""> <br>
            </a>
            <h3 class="text-center">
                {{$project->title}}
            </h3>
            <p class="align-self-end">
                by: {{$projects->find($project->id)->profile->user->name}}
            </p>
            <p>
                {{$project->caption}}
            </p>
        </div>

        @endforeach
    </div>
    </body>
@endsection
