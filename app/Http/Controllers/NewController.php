<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    public function HomeP()
    {
        $slide_link = DB::table('album')->get();
        return view("admin.pages.pager", ['arr' => $slide_link]);
    }
    public function changesLink_pages(Request $request)
    {
        $validatedData = $request->validate([
            'slide-1' => 'nullable|string|max:255',
            'slide-2' => 'nullable|string|max:255',
            'slide-3' => 'nullable|string|max:255',
        ]);

        $slide1 = Album::find(1);
        $slide2 = Album::find(2);
        $slide3 = Album::find(3);

        $slide1->path = $validatedData['slide-1'] ?: '';
        $slide2->path = $validatedData['slide-2'] ?: '';
        $slide3->path = $validatedData['slide-3'] ?: '';

        $slide1->save();
        $slide2->save();
        $slide3->save();

        return redirect()->route('admin.pages.pager')->with('success', 'Product details updated successfully.');
    }
}
