<?php

namespace App\Http\Controllers;

use App\Models\Gifs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GIFController extends Controller
{
    public function __invoke(){
        $mostDownloaded = Gifs::join('users', 'gifs.userid', '=', 'users.id')
        ->select('gifs.*', 'users.name as user_name')
        ->where('download_count','>',0)
        ->orderBy('download_count', 'desc')
        ->take(3)
        ->get();  

        $gifs = Gifs::where('userid', auth()->user()->id)->get();  

        return view('pages.admin.images',[
            'gifs' => $gifs ,
            'mostDownloaded' => $mostDownloaded 
        ]);
    }   

    public function home(Request $request){
        $search = $request->input('search');

        $gifs = Gifs::query()
            ->join('users', 'gifs.userid', '=', 'users.id')
            ->select('gifs.*', 'users.name as user_name')
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->get();
    
        $mostDownloaded = Gifs::where('download_count','>',0)->orderBy('download_count', 'desc')
            ->take(6)
            ->get();
            
        return view('pages.client.images',[
            'gifs' => $gifs ,
            'mostDownloaded' => $mostDownloaded
        ]);
    }   

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:gif|max:2048',
            'title' => 'required|string|max:255'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Store the file in storage/app/public/images
            $path = $image->storeAs('images', $filename, 'public');

            // Create database record with title
            Gifs::create([
                'userid' => auth()->id(),
                'image' => $filename,
                'title' => $request->title
            ]);

            return redirect()->back()->with('success',true)->with('message', 'Image uploaded successfully');
        }

        return redirect()->route('gifs-images')->with('error', 'No image uploaded');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:gif|max:2048',
            'title' => 'required|string|max:255'
        ]);

        $gif = Gifs::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::disk('public')->exists('images/' . $gif->image)) {
                Storage::disk('public')->delete('images/' . $gif->image);
            }

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');

            // Update image in database record
            $gif->image = $imageName;
        }

        // Update title in database record
        $gif->title = $request->title;
        $gif->save();

        return redirect()->back()->with('success', true)->with('message', 'Image updated successfully');
    }

    public function destroy($id)
    {
        $gif = Gifs::findOrFail($id);

        // Delete image file
        if (Storage::disk('public')->exists('images/' . $gif->image)) {
            Storage::disk('public')->delete('images/' . $gif->image);
        }

        // Delete database record
        $gif->delete();

        return redirect()->back()->with('success',true)->with('message', 'Image deleted successfully');
    }

    public function download(Gifs $gif)
    {
        // Increment the download counter
        $gif->increment('download_count');

        // Return the file download
        return response()->download(storage_path('app/public/images/' . $gif->image));
    }

    public function toggleFavorite(Gifs $gif)
    {
        $favorite = auth()->user()->favorites()->where('gif_id', $gif->id)->first();
        
        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            auth()->user()->favorites()->create([
                'gif_id' => $gif->id
            ]);
            return response()->json(['status' => 'added']);
        }
    }
    public function comments(Gifs $gif)
    {
        $comments = $gif->comments()->with('user')->latest()->get();
        return view('pages.client.gif-comments', [
            'comments' => $comments,
            'gif' => $gif
        ]);
    }
}
