<?php

namespace App\Http\Controllers;

use App\Models\color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SizeAndColorController extends Controller
{
    //
    public function CreateSize()
    {
        $datas = Size::orderBy('created_at', 'desc')->paginate(3);
        return view('backend.SizeAndColor.Sizes_view', compact('datas'));
    }
    public function PostSize(Request $request)
    {
        $request->validate([

            'size_name' => 'required|max:3|unique:sizes',
        ], [
            'max' => 'Please! enter Short term of sizes.',
            'unique' => 'This size already added. '
        ]);

        $size = new Size();
        $size->size_name = Str::lower($request->size_name);
        $size->slug = Str::slug($request->size_name . " size ");
        $size->save();
        return back();
    }


    public function CreateColor()
    {
        $datas = color::orderBy('created_at', 'desc')->paginate(3);
        return view('backend.SizeAndColor.color_view', compact('datas'));
    }
    public function PostColor(Request $request)
    {
        $request->validate([

            'color_name' => 'required|unique:colors',
        ], [
            'unique' => 'This color already added.'
        ]);

        $color = new color();
        $color->color_name = Str::ucfirst($request->color_name);
        $color->slug = Str::slug($request->color_name . ' size');
        $color->save();
        return back();
    }

    public function DeleteColor($id)
    {
        color::findorFail($id)->forceDelete();
        return redirect()->action([SizeAndColorController::class, 'CreateColor'])->with('success', 'Color Deleted succesfully');
    }
    public function DeleteSize($id)
    {
        Size::findorFail($id)->forceDelete();
        return redirect()->action([SizeAndColorController::class, "CreateSize"])->with('success', 'Size Deleted Succesfully');
    }
}
