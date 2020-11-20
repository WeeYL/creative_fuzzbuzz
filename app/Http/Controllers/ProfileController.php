<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\ProfileProject;
use App\Models\Project;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $profile = $user->profile;
        
        $backings = $user->profile->backing ;
        $profile_projects = ProfileProject::where('profile_id','=',$id);
        // dd($profile_projects);
        
        $projects = Project::where('profile_id','=',$id)->orderby('expired_at','desc')->get();
        return view('profiles.show', compact('user','profile','backings','projects','profile_projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $profile = $user->profile;
        $this->authorize('update',$profile);

        return view ('profiles.edit',compact('user','profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, User $user)
    {

        $user = User::find($id);
        $profile = $user->profile;

        // get data from edit route and validate
        $data = request()->validate([
            'description'=>'required',
            'url'=>'url',
            'image' =>'',
        ]);

        // if image is uploaded
        if (request('image')){
            $imagePath = request('image')->store('profile', 'public'); // store in a storage/profile folder (folder is auto created)
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(300, 300); 
            $image->save();

            // open image->fit image->save image
            
            $newImg = ['image' => $imagePath]; // store image            
        }
       
     
        // update profile
        $user->profile()->update(array_merge(
            $data,
            $newImg ?? []
            ));

        return redirect("profile/{$user->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}