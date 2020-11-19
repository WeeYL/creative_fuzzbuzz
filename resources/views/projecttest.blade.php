@extends('layouts.app')
@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Creative Fuzz Buzz</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

       
    <body>
        

        {{-- nav bar fund/create--}}

        <div class=" d-flex justify-content-end px-4">
            <div class="col-3 d-flex justify-content-end">

                <a  href="">Fund a Project</a>
                <a class='ml-4' href="">Create a Project</a>
            </div>
        </div>

    
        <div class=" d-flex offset-1">
            {{-- left column --}}
            <div class="d-flex flex-column col-6  mt-4 px-4 ">
                <h1> Foundlings: A new comic from John Stanisci and Emma Kubert</h1>
                <h5 class='text-muted align-self-end'>by : PNKHSE Production</h5>
                <img style="width:100%" src="storage/image/3.png" alt="">
                <h3 class="mt-4">A group of children the world had turned its back on…until they were the only hope it had left.</h3>
                <br><br><br><br>
            </div>


            {{-- right column --}}
            <div class="d-flex flex-column col-4" style="margin-top:142px">
                <h2 class="text-success">S$ 25,500</h2>
                <p class="text-muted"> $10,000 goal </p>

                <h2 class="text-secondary">102</h2>
                <p class="text-muted"> backers </p>

                <h2 class="text-secondary">3</h2>
                <p class="text-muted"> days left </p>

                <br><br>
                <form action="">
                    <input style="transform: scale(2)" type="radio" class="radio"  value="1" name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$5</h3></label>
                    <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  value="1" name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$12</h3></label>
                    <input style="margin-left: 50px; transform: scale(2)" type="radio" class="radio ml-4"  value="1" name="pledged" />
                    <label class="ml-2" for="#1"> <h3>$50</h3></label>
                    
                    <br>
                    <input type="submit" class="btn btn-success" value="Fund This Project">
                </form>

        </div>

       
    </body>
@endsection
