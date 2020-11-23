<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Project;
use App\Models\Profile;
use App\Models\User;
use App\Models\ProfileProject;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $project = $user->profile->project;

        return view('projects.create', compact('user', 'profile', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    // Get input of project
    {
        $user = Auth::user();
        $profile = $user->profile;

        $data = request()->validate([
            'title' => 'required',
            'caption' => 'required',
            'goal' => 'required',
            'category' => 'required',
            'image' => ['required', 'image']

        ]);

        if (request('image')) {
            $imagePath = request('image')->store('project', 'public'); // store in a storage/profile folder (folder is auto created)
            $image = Image::make(public_path() .'/storage/' . $imagePath)->fit(547, 308)->save(); // open image->fit image->save image
        }
        // create project
        $date_cur = date_create(date('Y-m-d H:i:s'));

        auth()->user()->profile->projects()->create(
            [
                'title' => $data['title'],
                'caption' => $data['caption'],
                'category' => $data['category'],
                'goal' => $data['goal'],
                'image' => $imagePath,
                'status' => 'live',
                'expired_at' => date_add($date_cur, date_interval_create_from_date_string("30 days")),

            ]
        );



        return redirect("/profile/" . $profile->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function show($id)
    {
        
        $project = Project::find($id);
        $profile = Profile::find($project->profile_id);

        // current datetime
        date_default_timezone_set('Asia/Singapore');
        $date_cur = date_create(date('Y-m-d H:i:s'));

        // backers and total pledged
        $backers = ProfileProject::where('project_id', $id)->count();
        $total_pledged = ProfileProject::where('project_id', $id)->sum('pledged');

        
        // id of live project
        $live_projects = Project::where('status', '=', 'live')->get();
        // loop 
        // set expiry date
        foreach ($live_projects as $live_project) {
            $live_project = Project::find($live_project->id);
            
            $live_project->update(['expired_at' => date_add($live_project->created_at, date_interval_create_from_date_string("30 days"))]);
            $live_project_total_pledged = ProfileProject::where('project_id', $live_project->id)->sum('pledged');


            // set status live/failed/successful
            if ($date_cur > $live_project->expired_at  && $live_project_total_pledged >= $live_project->goal) {
                $live_project->update(['status' => 'successful']);
            } else if ($date_cur > $live_project->expired_at && $live_project_total_pledged < $live_project->goal) {
                
                $live_project->update(['status' => 'failed']);

            } else {
                $live_project->update(['status' => 'live']);
            }
        }




        $list_total_pleged = Project::join('profile_projects', 'projects.id', '=', 'profile_projects.project_id')
            ->groupby('title')
            ->selectRaw('sum(pledged) as sum, title')
            ->get('sum', 'title');

        // pass project
        $project = Project::find($id);

        // countdown to expiry
        $countdown = date_diff($date_cur, date_create($project->expired_at));

        // set pledged total
        $total_pledged = ProfileProject::where('project_id', $id)->sum('pledged');

        // dd($profile);


        return view('projects.show', compact('project', 'profile', 'backers', 'total_pledged', 'countdown'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        $data = request()->validate([
            'title' => 'required',
            'caption' => 'required',
            'goal' => 'required',
            'category' => 'required',
            'image' => ''
        ]);


        // if image is uploaded
        if (request('image')) {
            $imagePath = request('image')->store('project', 'public'); // store in a storage/profile folder (folder is auto created)

            $image = Image::make(public_path() .'/storage/' . $imagePath)->fit(547, 308)->save(); // open image->fit image->save image
            $imageArray = ['image' => $imagePath];         
        }


        // update project
        $project->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("project/{$project->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Project::find($id)->delete();
        return redirect('/profile/' . Auth::user()->id);
    }
}
