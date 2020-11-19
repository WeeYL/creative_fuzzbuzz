@extends('layouts.app')
@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Creative Fuzz Buzz</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

       
    <body>
        

        {{-- nav bar create--}}
        @if(Auth::check())
            <div class=" d-flex justify-content-end px-4 mt-2">
                <div class="col-3 d-flex justify-content-end">
                    <h5>
                        <a class='ml-4' href="project/create">Create a Project</a>
                    </h5>
                </div>
            </div>
            @else
            <div class=" d-flex justify-content-end px-4 mt-2">
                <div class="col-3 d-flex justify-content-end">
                    <h5>
                        <br>
                    </h5>
                </div>
            </div>

        @endif
        {{-- nav bar --}}

        <div class=" d-flex justify-content-start ">
            <div class="d-flex col-8 justify-content-start">
        <h5>
        <a class='ml-4'  href="/category/art" value="art", name="art">Art ({{$all_projects->where('category','=','art')->count()}})</a>
            <a class='ml-4'  href="/category/comic">Comic ({{$all_projects->where('category','=','comic')->count()}})</a>
            <a class='ml-4'  href="/category/film">Film ({{$all_projects->where('category','=','film')->count()}})</a>
            <a class='ml-4'  href="/category/game">Game ({{$all_projects->where('category','=','game')->count()}})</a>
            <a class='ml-4'  href="/category/music">Music ({{$all_projects->where('category','=','music')->count()}})</a>
        </h5>

            </div>
        </div>
        <div class="d-flex " style='box-sizing: border-box; '>
            {{-- left column --}}
            <div class="flex-column col-6 ml-4 mt-4" style="margin-right: 50px; ">
                <h1>Comic</h1>
                <h5 class='text-muted'>Featured Project</h5><br>
                <a href="">
                    <img style="width:100%" src="storage/image/3.png" alt="">
                </a>
                <h3 class="mt-4">Foundlings: A new comic from John Stanisci and Emma Kubert</h3>
                <h5 class="text-muted">A group of children the world had turned its back on…until they were the only hope it had left.</h5>
                <a class="text-muted align-self-end mt-4" href="">
                    <p >by : PNKHSE Production</p>
                </a>
            </div>



            {{-- right column --}}
            <div class="d-flex flex-column col-4 mt-4 border-left border-secondary" style="padding-left: 50px;">
                <div class='d-flex flex-row justify-content-between align-items-baseline'>
                    <h5 style="margin-top:52px" class='text-muted'>Projects Ending Soon</h5>
                    <div style="transform:scale(1.2)"class="align-self-end mb-3">
                        {{$projects_expiring->links()}}
                    </div>
                </div>
                <br>
                
            
            {{-- image --}}
            @foreach ($projects_expiring as $project_expiring)
                
                <div class= "d-flex" >
                <a href="/project/{{$project_expiring->id}}"><img style="width:300px" class="border border-secondary" src="storage/{{$project_expiring->image}}" alt=""></a>     
    
               
                    {{-- text --}}
                    <div class="pl-2  flex-column">
                    <h5> <a href="/project/{{$project_expiring->id}}">{{$project_expiring->title}}</a></h5>


                    {{-- category --}}
                        
                    <p>Category: {{$project_expiring->category}}</p>

                    {{-- days left --}}
                    
                    <div class='text-success' style="text-shadow: 2px 2px gray; ">
                        <h5>
                            {{date_diff(date_create(date('Y-m-d H:i:s')),date_create($project_expiring->expired_at))->format("%a days %h hrs")}} left
                        </h5>
                    </div>
     



                    {{-- owner --}}
                        <a class="text-muted " style="margin-bottom: 0" href="/profile/{{$all_projects->find(($project_expiring->id))->profile_id}}">
                            
                            <p >by: {{$owners->find($all_projects->find($project_expiring->id)->profile_id)->user->name}}</p>
                        </a>
                    </div>
                </div>
                <hr>

            @endforeach
            <div style="transform:scale(1.2)"class="align-self-end">
                {{$projects_expiring->links()}}
            </div>


            </div>
        </div>
        <br>
            <br>
            <br>
            <br>
            <h5>
 

        <div class="d-flex justify-content-center pl-5">
            

                <a class="px-3" href="">Contact us</a> 
                <a class="px-3" href="">Terms and Conditions</a>
                <a class="px-3" href="">About us</a>
            </h5>
            
        </div>
        <br><br>


    </body>
@endsection
