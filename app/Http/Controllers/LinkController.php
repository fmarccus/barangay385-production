<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;



class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAnnouncement');
    }
    public function index()
    {
        $links = Link::all();
        return view('links.index', compact('links'));
    }
    public function create()
    {
        return view('links.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'hyperlink' => 'required|max:255',
            'title' => 'required|max:255',
            'file' => 'required|image|mimes:jpeg,jpg,png,gif|max:4096'
        ]);
        $link = new Link();
        $link->title = $request->title;
        $link->subtitle = $request->subtitle;
        $link->hyperlink = $request->hyperlink;

        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('img'), $imageName);
        $link->image = $imageName;
        $link->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $link = Link::find($id);
        return view('links.edit', compact('link'));
    }
    public function update(Request $request, $id)
    {
        $link = Link::find($id);
        $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'hyperlink' => 'required|max:255',
            'title' => 'required|max:255',
            'file' => 'required|image|mimes:jpeg,jpg,png,gif|max:4096'
        ]);
        $link->title = $request->title;
        $link->subtitle = $request->subtitle;
        $link->hyperlink = $request->hyperlink;
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('img'), $imageName);
        $link->image = $imageName;
        $link->save();
        return back()->with('success', '');
    }
    public function destroy($id)
    {
        $link = Link::find($id);
        $directory = 'img/' . $link->image;
        if (File::exists($directory)) {
            File::delete($directory);
        }
        $link->delete();
        return back()->with('deleted', '');
    }
}
