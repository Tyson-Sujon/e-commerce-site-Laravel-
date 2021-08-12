<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function Subcategories()
    {
        // $subcats = SubCategory::with('category')->paginate(10);
        // $cats = Category::all();
        return view('backend.subcategory.subcategory', [
            'subcats' => SubCategory::with(["Category", 'Product'])->paginate(10),
        ]);
    }
    public function AddSubcategories()
    {
        $cats = Category::orderBy('category_name', 'asc')->get();
        return view('backend.subcategory.subcategory_form', compact('cats'));
    }

    public function PostSubcategories(Request $req)
    {
        $req->validate([
            'subcategory_name' => 'required|min:3|unique:sub_categories',
            'slug' => 'required|min:3|unique:sub_categories',
            'category_id' => 'required',
        ]);

        $sub = new SubCategory();
        $sub->subcategory_name = $req->subcategory_name;
        $sub->slug = Str::Slug($req->slug);
        $sub->category_id = $req->category_id;
        $sub->save();
        return back()->with('success', 'subcategory added Succesfully');
    }

    public function PosstDeleteAllSubcategories(Request $req)
    {
        if (!empty($req->delete)) {

            if ($req->button == 'delete') {
                foreach ($req->delete as $value) {

                    SubCategory::onlyTrashed()->findorFail($value)->forceDelete();
                }
                return back()->with('success', 'Deletation successfull.');
            }
            if ($req->button == 'restore') {
                foreach ($req->delete as $restoreId) {

                    SubCategory::onlyTrashed()->findOrFail($restoreId)->restore($restoreId);
                }
                return back()->with('success', 'Restore successfull.');
            }
        } else {
            return back();
        }
    }


    public function TrashSubCategory()
    {
        $deletedsubcategory = SubCategory::onlyTrashed('deleted_at', 'desc')->paginate(10);

        return view('backend.subcategory.trashed_subcategories', compact('deletedsubcategory'));
    }

    public function Deletesubcategories($id)
    {
        $scat = SubCategory::with('Product')->findOrFail($id);

        if ($scat->Product->count() < 1) {
            SubCategory::findOrFail($id)->delete();
            return redirect()->action([SubCategoryController::class, 'Subcategories'])->with('success', 'Deletation Successful.');
        }
        return redirect()->action([SubCategoryController::class, 'Subcategories'])->with("error", "Can't Delete.");
    }


    //Editing SubCategories
    public function editsubcategories($slug)
    {

        // return SubCategory::where('slug', $slug)->count();
        return view('backend.subcategory.subcategory_edit', [
            'scat' => SubCategory::where('slug', $slug)->first(),
        ]);
    }
    public function updatesubcategories(Request $req)
    {
        $updateSub = SubCategory::findorFail($req->id);

        # $count = SubCategory::where('slug', $req->slug)->count();
        // if (SubCategory::where('slug', $req->slug)->count() <= 1) {

        if (SubCategory::where('slug', $req->slug)->where('id', '!=', $req->id)) {
            $updateSub->subcategory_name = $req->subcategory_name;
            $updateSub->slug = Str::slug($req->slug);
            $updateSub->save();
            return redirect()->action([SubCategoryController::class, 'Subcategories'])->with('success', 'edited successfully');
        } else {
            return back();
        }
    }

    public function PermanentdeleteSubCategory($slug)
    {
        SubCategory::onlyTrashed()->where('slug', $slug)->first()->forceDelete();
        return redirect()->action([SubCategoryController::class, 'TrashSubCategory'])->with('success', 'delted sunccesful.');
    }

    public function PermanentrestoreSubCategory($slug)
    {
        # code...
        SubCategory::onlyTrashed()->where('slug', $slug)->restore();
        return redirect()->action([SubCategoryController::class, 'TrashSubCategory'])->with('success', 'Restore sunccesful.');
    }
}
