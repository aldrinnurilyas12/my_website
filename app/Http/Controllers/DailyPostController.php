<?php

namespace App\Http\Controllers;

use App\Models\Daily_posts_images;
use App\Models\DailyPostModel;
use App\Models\ProfilePictureModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'posts_img.*' => 'image|mimes:jpg,png,jpeg|max:5000',
            'post' => 'required'
        ]);

        DailyPostModel::create([
            'post' => $request->post
        ]);

        if ($request->hasFile('posts_img')) {
            foreach ($request->file('posts_img') as $img) {
                $folderPath = 'posts_img';
                $imagePath = $img->storeAs($folderPath, uniqid() . '.' . $img->getClientOriginalExtension(), 'public');

                Daily_posts_images::create([
                    'posts_id' => DailyPostModel::latest()->first()->id,
                    'posts_img' => $imagePath
                ]);
            }
        } else {
            DailyPostModel::create([
                'post' => $request->post
            ]);
        }


        session()->flash('message_success', 'Berhasil menambahkan postingan anda');
        return redirect()->route('dailyposts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    public function showpost(Request $request)
    {
        $posts = DB::table('daily_post')->orderBy('created_at', 'desc')->get();

        $posts_images = DB::table('posts_view')
            ->select('id', 'img_id', 'posts_img')
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();
        $all_images_show = DB::table('posts_view')
            ->select('id', 'img_id', 'posts_img')
            ->orderBy('created_at', 'desc')
            ->get();
        $profile_img = ProfilePictureModel::select('profile_img')->get();
        return view('frontend\dailypost\dailypost_main', compact('posts', 'profile_img', 'posts_images', 'all_images_show'));
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

        if ($request->has('posts_img')) {
            foreach ($request->file('posts_img') as $img) {
                $folderPath = 'posts_img';
                $imagePath = $img->storeAs($folderPath, uniqid() . '.' . $img->getClientOriginalExtension(), 'public');

                $daily_posts_img = Daily_posts_images::where('posts_id', $id)->get();

                DailyPostModel::where('id', $id)->update([
                    'post' => $request->post,
                    'updated_at' => now()
                ]);
            }

            if ($daily_posts_img->posts_img) {
                $oldImages = public_path('storage/' . $daily_posts_img->posts_img);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }

            Daily_posts_images::where('posts_id', $id)->update([
                'posts_img' => $folderPath
            ]);
        } else {
            DailyPostModel::where('id', $id)->update([
                'post' => $request->post,
                'updated_at' => now()
            ]);
        }


        session()->flash('message_success', 'Berhasil update postingan anda');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = DailyPostModel::find($id);

        $daily_posts_img = Daily_posts_images::where('posts_id', $id)->firstOrFail();

        if ($post) {
            $post->delete();
            if ($daily_posts_img->posts_img) {
                $oldImages = public_path('storage/' . $daily_posts_img->posts_img);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }
            session()->flash('message_success', 'Berhasil menghapus postingan anda');
            return redirect()->back();
        } else {
            session()->flash('error', 'Postingan tidak ditemukan');
        }
    }
}
