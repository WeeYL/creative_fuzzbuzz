@extends('layouts.app')
@section('content')

<body>
        
        <div class="d-flex offset-1">
            
            {{-- left column --}}
            <div class="d-flex flex-column col-md-6  mt-4 px-4 ">
                <h1> {{$project->title}}</h1>
                <h3 class='text-muted text-capitalize'>
                <a href="/profile/{{$profile->id}}">
                        by: {{$profile->user->name}}
                    </a>
                </h3>
                
                <h5 class='text-muted align-self-end'>category: {{$project->category}}</h5>
                <h5 class='text-muted align-self-end'>project expiration: {{date_format(date_create($project->expired_at),"d-M-Y")}}</h5>
                <img style="width:100%" src="/storage/{{$project->image}}" alt="">
                <h3 class="mt-4">{{$project->caption}}</h3>
                <br><br><br><br>
            </div>


            {{-- right column --}}
            <div class="d-flex flex-column col-md-4 pl-5" style="margin-top:142px">
                <h2 class="text-success">{{'S$ ' . number_format($total_pledged)}}</h2>
                <p class="text-muted"> {{'goal S$ ' . number_format($project->goal)}} </p>
                

                <h2 class="text-secondary">{{$backers}}</h2>
                <p class="text-muted"> backers </p>
                
                <div class='d-flex align-items-end'>

                    {{-- if project expired --}}

                    @if($project->status !="live")
                        <h3 >
                            Closed. {{$project->status}}
                        </h3 >
                    @else
                        <h2 class="text-secondary" style="margin:0;">{{$countdown->format("%a days")}}</h2>
                        <div class="flex-column">
                            <div class="text-muted pl-2" style="margin:0; font-size:10px">{{$countdown->format("%H hours %")}}</div>
                            <div class="text-muted pl-2" style="margin:0; font-size:10px">{{$countdown->format("%i mins ")}}</div>
                            <div class="text-muted pl-2" style="margin:0; font-size:10px">{{$countdown->format("%s secs")}}</div>
                        </div>
                </div>
                        <p class="text-muted"> before launch </p>
                    @endif
                

                <br><br>

                {{-- if project is live --}}

                @if ($project->status == 'live')
                    
                <form action="/profileproject" method="post">
                    @csrf
                    <input style="transform: scale(2)" type="radio" class="radio"  required value=5 name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$5</h3></label>
                    <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  required value=25 name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$25</h3></label>
                    <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  required value=50 name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$50</h3></label>
                    <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  required value=88 name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$88</h3></label>
                    <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  required value=128 name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$128</h3></label>
                    
                    {{-- pass project id --}}
                    <input type="hidden" name="project_id" value="{{$project->id}}"> 

                    
                    <br>
                    {{-- Only backers fund project --}}
                    {{-- if authorized, then ... else user not logged in no button at all--}}
                    @if (Auth::check()) 
                        @if (Auth::user()->profile->id != $project->profile_id)
                            <input type="submit" class="btn btn-success" value="Fund This Project">
                        @endif
                    @endif
                    {{-- Only owner update project --}}
                    @can('update', $project)
                        <button class="btn btn-info">
                            <a class="text-white" href="/project/{{$project->id}}/edit">edit project</a>
                        </button>
                         <br><br>
                    @endcan
                </form>

                    {{-- only owner delete project --}}
                    @can('update', $project)
                        <form action="/project/{{$project->id}}" method="post">
                        @method('delete')
                        @csrf
                            <input type="submit" class="btn btn-danger" onclick= "return confirm('you want to delete meh?')" value="delete Project">
                        </form>
                    @endcan
                @else
                                        
                @endif

                <br><br><br><br>
            </div>
        </div>

    </body>
@endsection