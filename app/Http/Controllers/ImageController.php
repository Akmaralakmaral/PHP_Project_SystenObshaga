<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // public function upload(Request $request )
    // {

    //    $path = $request->file('image')->store('uploads', 'public');
    //    $path2 = $request->file('image2')->store('uploads', 'public');
    //    return view('dashboard', compact('path', 'path2'));
    // }


    public function upload(Request $request)
    {
        // $path = $request->file('image')->store('uploads', 'public');
        // $path2 = $request->file('image2')->store('uploads', 'public');

        // // Сохранение информации о файлах в базе данных
        // $image1 = Image::create([
        //     'path' => $path,
        //     'path1' => $path2,
        //     'user_id' => $request->user()->id,
        // ]);

        // return view('dashboard', compact('path', 'path2'));


        $path = $request->file('image')->store('uploads', 'public');
        $path2 = $request->file('image2')->store('uploads', 'public');

        // Сохранение информации о файлах в базе данных
        $image1 = Image::create([
            'path' => $path,
            'path1' => $path2,
            'user_id' => $request->user()->id,
        ]);

        return view('dashboard', compact('path', 'path2'));
    }



    public function getAllImages()
    {
        $images = Image::all();

        return view('gallery', compact('images'));
    }
}
