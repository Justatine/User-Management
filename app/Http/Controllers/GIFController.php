<?php

namespace App\Http\Controllers;

use App\Models\Gifs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GIFController extends Controller
{
    public function __invoke(){
        $gifs = Gifs::where('userid', auth()->user()->id)->get();  

        return view('pages.admin.images',[
            'gifs' => $gifs 
        ]);
    }   

    public function home(){
        $gifs = Gifs::join('users', 'gifs.userid', '=', 'users.id')
            ->select('gifs.*', 'users.name as user_name')
            ->get();  

        return view('pages.client.images',[
            'gifs' => $gifs 
        ]);
    }   

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Store the file in storage/app/public/images
            $path = $image->storeAs('images', $filename, 'public');

            // Create database record
            Gifs::create([
                'userid' => auth()->id(),
                'image' => $filename
            ]);

            return redirect()->back()->with('success',true)->with('message', 'Image uploaded successfully');

            // return redirect()->route('gifs-images')->with('success', 'Image uploaded successfully');
        }

        return redirect()->route('gifs-images')->with('error', 'No image uploaded');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:gif|max:2048'
        ]);

        $gif = Gifs::findOrFail($id);

        // Delete old image
        if (Storage::disk('public')->exists('images/' . $gif->image)) {
            Storage::disk('public')->delete('images/' . $gif->image);
        }

        // Store new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('images', $imageName, 'public');

        // Update database record
        $gif->image = $imageName;
        $gif->save();

        return redirect()->back()->with('success',true)->with('message', 'Image updated successfully');
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
}
