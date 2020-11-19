@extends('layouts.app')
@section('content')

<body>
    

    <div class="container">
    
    {{-- description --}}
    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
            @csrf
            {{-- patch method with post method --}}
            @method('patch') 
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label">Description</label>
                        <input 
                            id="description" 
                            name="description" 
                            type="text" 
                            class="form-control @error('description') is-invalid @enderror" 
                            value="{{ old('description') ?? $profile->description }}" required autocomplete="description" autofocus>
    
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
    
                    </div>
                </div>
            </div>


            {{-- URL --}}
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label">URL</label>
                        <input 
                            id="url" 
                            name="url" 
                            type="text" 
                            class="form-control @error('url') is-invalid @enderror" 
                            value="{{ old('url') ?? $profile->url}}" required autocomplete="url" autofocus>
    
                        @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
    
                    </div>
                </div>
            </div>
    
        {{-- Profile image --}}
            <div class="row">
                <div class="col-8 offset-2">
                    <label for="image">Profile Image</label>
                    <input type="file" class="form-control-file" name="image">
            
                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
    
        {{-- button --}}
            <div class="row pt-5">
                <div class="col-8 offset-2">
                    <div class="col-8 offset-2"></div> 
                        <button class="btn-primary"> Add New Profile</button>
                </div>
            </div>
        </form>
    </div>

    

    
</body>
@endsection
