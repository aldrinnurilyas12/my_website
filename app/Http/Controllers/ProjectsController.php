<?php

namespace App\Http\Controllers;

use App\Models\ProjectMediaModel;
use Illuminate\Http\Request;
use App\Models\ProjectsModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = DB::table('project_view')->orderBy('created_at', 'desc')->get();
        $project_category = DB::table('project_category')->get();

        if ($projects->isNotEmpty()) {
            $start_date  = Carbon::parse($projects->first()->start_date);
            $end_date  = Carbon::parse($projects->first()->end_date);
        } else {
            $start_date = null;
            $end_date = null;
        }


        $tools = DB::table('software_tools')->get();
        return view('backend.projectspages.projects_main', compact('projects', 'project_category', 'tools', 'start_date', 'end_date'));
    }



    public function showproject()
    {
        $projects = DB::table('project_view')->orderBy('created_at', 'desc')->get();
        return view('frontend.projectspage.projects', compact('projects'));
    }


    public function displayproject(string $id, Request $request): View
    {
        $project_data = DB::table('project_view')->where('project_code', $request->project_code)->get();
        return view('frontend.projectspage.show_project', compact('project_data'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'media_files' => 'image|mimes:jpg,png,jpeg|max:5000',
            'project_name' => 'required',
            'category_id' => 'required',
            'start_date' => 'required',
            'project_status' => 'required',
            'tools.*' => 'required | string'

        ]);

        if ($request->hasFile('media_files')) {
            $image = $request->file('media_files');
            $folderPath = 'project_img';
            $imagePath = $image->storeAs($folderPath, uniqid() . '.' . $image->getClientOriginalExtension(), 'public');

            ProjectsModel::create([
                'project_name' => $request->project_name,
                'project_code' => Uuid::uuid4()->toString(),
                'description' => $request->description,
                'category_id' => $request->category_id,
                'github_link' => $request->github_link,
                'demo_project_link' => $request->demo_project_link,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'project_status' => $request->project_status,
                'tools' => implode(', ', $request->tools),
                'contributors' => $request->contributors
            ]);

            ProjectMediaModel::create([
                'project_id' => ProjectsModel::latest()->first()->id,
                'media_files' => $imagePath
            ]);
            session()->flash('message_success', 'Berhasil menambahkan project');
            return redirect()->back();
        } else {
            ProjectsModel::create([
                'project_name' => $request->project_name,
                'project_code' => Uuid::uuid4()->toString(),
                'description' => $request->description,
                'category_id' => $request->category_id,
                'github_link' => $request->github_link,
                'demo_project_link' => $request->demo_project_link,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'project_status' => $request->project_status,
                'tools' => implode(', ', $request->tools),
                'contributors' => $request->contributors
            ]);

            session()->flash('message_success', 'Berhasil menambahkan project');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'media_files' => 'image|mimes:jpg,png,jpeg|max:5000',
            'project_name' => 'required',
            'category_id' => 'required',
            'start_date' => 'required',
            'project_status' => 'required',
            'tools.*' => 'required |string'

        ]);

        $projectImage = DB::table('project_media_files')->where('id', $request->id)->firstOrFail();

        if ($request->hasFile('media_files')) {
            $image = $request->file('media_files');
            $folderPath = 'project_img';
            $imagePath = $image->storeAs($folderPath, uniqid() . '.' . $image->getClientOriginalExtension(), 'public');

            DB::table('projects')->where('id', $request->id)->update([
                'project_name' => $request->project_name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'github_link' => $request->github_link,
                'demo_project_link' => $request->demo_project_link,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'project_status' => $request->project_status,
                'tools' => implode(', ', $request->tools),
                'contributors' => $request->contributors,
                'updated_at' => now()
            ]);

            if ($projectImage->media_files) {
                $oldImages = public_path('storage/' . $projectImage->media_files);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }

            DB::table('project_media_files')->where('id', $request->id)->update([
                'project_id' => ProjectsModel::latest()->first()->id,
                'media_files' => $imagePath
            ]);

            session()->flash('message_success', 'Berhasil update project');
            return redirect()->back();
        } else {
            DB::table('projects')->where('id', $request->id)->update([
                'project_name' => $request->project_name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'github_link' => $request->github_link,
                'demo_project_link' => $request->demo_project_link,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'project_status' => $request->project_status,
                'tools' => implode(', ', $request->tools),
                'contributors' => $request->contributors,
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $projectImage = DB::table('project_media_files')->where('id', $request->id)->firstOrFail();
        $projectId = ProjectsModel::find($id);
        if ($projectId) {
            $projectId->delete();
            if ($projectImage->media_files) {
                $oldImages = public_path('storage/' . $projectImage->media_files);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }
            session()->flash('message_success', 'Berhasil menghapus postingan anda');
            return redirect()->back();
        } else {
            session()->flash('failed_message', 'Postingan tidak ditemukan');
        }
    }
}
