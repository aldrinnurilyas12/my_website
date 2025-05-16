<?php

namespace App\Http\Controllers;

use App\Models\DailyPostModel;
use Illuminate\Http\Request;

class DailyPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = DailyPostModel::orderBy('created_at', 'desc')->get();
        $post_id = DailyPostModel::orderBy('id', 'desc')->first();

        return view('backend.dailyposts.dailypost_main', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dailyposts.dailypost_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required'
        ]);

        DailyPostModel::create([
            'post' => $request->post
        ]);

        session()->flash('message_success', 'Berhasil menambahkan postingan anda');
        return redirect()->route('dailyposts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    public function showpost()
    {
        $posts = DailyPostModel::orderBy('created_at', 'desc')->get();
        return view('frontend\dailypost\dailypost_main', compact('posts'));
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
        DailyPostModel::where('id', $id)->update([
            'post' => $request->post,
            'updated_at' => now()
        ]);
        session()->flash('message_success', 'Berhasil update postingan anda');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = DailyPostModel::find($id);

        if ($post) {
            $post->delete();
            session()->flash('message_success', 'Berhasil menghapus postingan anda');
            return redirect()->back();
        } else {
            session()->flash('error', 'Postingan tidak ditemukan');
        }
    }
}
