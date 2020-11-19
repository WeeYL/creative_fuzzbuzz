@extends('layouts.app')
@section('content')

<body>
    

    <div class="container">
    
    {{-- title --}}
    
    <form action="/project/{{$project->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')

            <div class="d-flex flex-column">
                <div class="col-8 offset-2">

                    {{-- title --}}
                    <div class="form-group row">
                        <h5>
                            <label for="title" class="col-md-4 col-form-label">Title</label>
                        </h5>
                        <input 
                            id="title" 
                            name="title" 
                            type="text" 
                            class="form-control @error('title') is-invalid @enderror" 
                            value="{{ old('title') ?? $project->title}}" required autocomplete="title" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    {{-- Caption --}}
                    <div class="form-group row">
                        <h5>
                            <label for="caption" class="col-md-4 col-form-label">Caption</label>
                        </h5>
                        <input 
                            id="caption" 
                            name="caption" 
                            type="text" 
                            class="form-control @error('caption') is-invalid @enderror" 
                            value="{{ old('caption') ?? $project->caption}}" required autocomplete="caption" autofocus>
                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <br>

                    {{-- goal --}}
                    <div class="form-group row">
                        <h5>
                            <label for="goal" class="pl-3">Target Goal</label>
                        </h5>
                            <input 
                            id="goal" 
                            name="goal" 
                            type="number" 
                            class="form-control @error('goal') is-invalid @enderror" 
                            value="{{ old('goal') ?? $project->goal }}" required autocomplete="goal" autofocus>
                        @error('goal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <br>

                    {{-- category --}} 
                    <div>
                        <input style="transform: scale(2)" type="radio" class="radio"  value="art" required name="category" />
                        <label class="ml-2" > <h5>Art</h5></label>
                        <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  required value="comic" name="category" />
                        <label class="ml-2" > <h5>Comic</h5></label>
                        <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  required value="film" name="category" />
                        <label class="ml-2" > <h5>Film</h5></label>
                        <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4" required  value="game" name="category" />
                        <label class="ml-2" > <h5>Game</h5></label>
                        <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4" required  value="music" name="category" />
                        <label class="ml-2" > <h5>Music</h5></label>
                    </div>
                    <br>
                


                    {{-- image --}}
             
                    <div class='d-flex align-items-end justify-content-between'>
                        <div>
                            <label for="image">Select Main Display Image</label>
                            <input type="file" class="form-control-file" name="image">
                            @error('image')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div >
                            <button class="btn btn-primary"> Update Project</button>
                        </div>
                        
                    </div>
                    <br><br><br><br>
                </div>
            </div>



        </form>
    </div>

    

    
</body>
@endsection
