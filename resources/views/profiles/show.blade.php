@extends('layouts.app')
@section('content')

<body>
    <div class="d-flex" style="margin-top: 20px">
        <div class="col-3 offset-1 border-right" style="padding-right: 50px" >
            <h1>
                {{$user->name}}
            </h1>

            {{-- update profile --}}
            @can('update', $profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
                <br>
            
            
            {{-- profile image --}}
            <img class="mw-100" src="{{$profile->image}}" alt="">
            <br><br><hr><br>
            <h3>About Me</h3>
            <h5>{{$profile->description}}</h5> <br>

            <h3>Visit Me</h3>
            <h5>
                <a href="{{$profile->url}}">{{$profile->url}}</a> 
            </h5>
            <br>


        </div>

        <div class=" d-flex flex-column align-items-start col-3 border-right" style="padding: 0 50px 0 50px">
            <h1>
                Funded Project
            </h1>
            <br><br>

            @if($backings->isEmpty())
                None Yet
                       
            @else
                @foreach($backings as $backing)
                    <h5>
                        <a href="{{'/project/' . $backing->id}}">
                            {{$backing->title}}
                            
                        </a>
                        <div class='text-muted'>
                            {{$backing->status}}
                        </div>

                    </h5>
                    
                    
      
                    <h5 class="align-self-start"> by<a href="{{'/profile/' . $backing->profile_id}}">
                            {{$profile->find($backing->profile_id)->user->name}}
                        </a>
                    </h5>
                    <hr>
                @endforeach

      
            @endif
    


        </div>

        <div class="col-4" style="padding: 0 50px 0 50px" >
            
            <h1>Created Project</h1>
    
            <br><br>

      

            @if($projects->isempty())
                None Yet
                @else
                @foreach($projects as $project )
                    <h5>
                        <a href="{{'/project/' . $project->id}}">
                            {{$project->title}}
                        </a>
                        <div>
                            {{$project->status}}

                        </div>
                    </h5>
                <hr>

                    
                @endforeach
            @endif
        </div>
        <div>
        </div>
        
        
    </div>
    <br><br><br><br>



    
</body>
@endsection