<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function about()
    {
        return view('about.index');
    }

    public function gallery()
    {
        $galleries = Gallery::where('is_active', true)->orderBy('created_at', 'desc')->paginate(6);
        return view('gallery.index', compact('galleries'));
    }

    public function galleryShow(Gallery $gallery)
    {
        if (!$gallery->is_active) {
            abort(404);
        }
        return view('gallery.show', compact('gallery'));
    }
}
