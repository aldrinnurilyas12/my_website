<?php

namespace App\Http\Controllers;

use App\Models\ProfilePictureModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilePictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilepicture = ProfilePictureModel::orderBy('created_at', 'desc')->get();
        $bio = DB::table('profile')->select('bio')->first();
        return view('backend.profilepictures.profilepicture_main', compact('profilepicture', 'bio'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $folderPath = 'profile_img';
            $imagePath = $image->storeAs($folderPath, uniqid() . '.' . $image->getClientOriginalExtension(), 'public');


            ProfilePictureModel::create([
                'profile_img' => $imagePath,
                'bio' => $request->bio
            ]);
        }
        session()->flash('message_success', 'Profile picture uploaded successfully.');
        return redirect()->back();
    }

    public function save_bio(Request $request)
    {
        $request->validate([
            'bio' => 'required'
        ]);

        ProfilePictureModel::create([
            'bio' => $request->bio
        ]);
        return redirect()->back()->with('message_success', 'Profile picture uploaded successfully.');
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'profile_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoId = ProfilePictureModel::find($id);

        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $folderPath = 'profile_img';
            $imagePath = $image->storeAs($folderPath, uniqid() . '.' . $image->getClientOriginalExtension(), 'public');


            ProfilePictureModel::where('id', $id)->update([
                'profile_img' => $imagePath,
                'bio' => $request->bio
            ]);

            if ($fotoId->profile_img) {
                $oldImages = public_path('storage/' . $fotoId->profile_img);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }
        } else {
            ProfilePictureModel::where('id', $id)->update([
                'bio' => $request->bio
            ]);
        }
        session()->flash('message_success', 'Profile picture uploaded successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profilepicture = ProfilePictureModel::find($id);
        if ($profilepicture) {
            $profilepicture->delete();
            if ($profilepicture->media_files) {
                $oldImages = public_path('storage/' . $profilepicture->profile_img);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }
            session()->flash('message_success', 'Berhasil menghapus profil.');
        } else {
            session()->flash('message_error', 'Profile picture not found.');
        }
        return redirect()->back();
    }
}
