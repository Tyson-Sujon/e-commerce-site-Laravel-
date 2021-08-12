<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function Category()
    {
        // $datas = Category::paginate(10);
        return view('backend.category.category_view', [
            'datas' => Category::with('getProducts')->orderBY('created_at', 'desc')->paginate(10),
        ]);
    }

    function CategoryForm()
    {
        return view('backend.category.category_form');
    }

    function PostCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required| min:3 | unique:categories',
            'slug' => 'required|unique:categories',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->slug = str::slug($request->category_name);
        $category->save();
        // return back();
        return redirect()->action([CategoryController::class, 'CategoryForm'])->with("success", "Added Successfully.");
    }

    function DeleteCategory($id)
    {
        $cat =  Category::with('getSubcategories')->find($id);
        if ($cat->getSubcategories->count() < 1) {
            Category::findorFail($id)->delete();
            return back()->with("success", "Category deleted succesfully");
        } else {
            return back()->with("error", "Cant delete Category");
        }
    }

    function EditCategory($id)
    {
        $data = Category::findorFail($id);
        return view("backend.category.edit_category_form", compact('data'));
    }
    function UpdateCategory(Request $request)
    {
        $updcat = Category::findorFail($request->cat_id);
        $updcat->category_name = $request->category_name;
        $updcat->slug = Str::slug($request->category_name);
        $updcat->save();
        // return redirect("backend.category.categor")->with();
        return redirect()->action([CategoryController::class, 'Category'])->with("success", "Category Updated Succesfull");;
    }

    function TrashCategory()
    {
        // $datas = Category::onlyTrashed('deleted_at', 'desc')->paginate(10);
        return view("backend.category.trashed_categories", [
            'datas' => Category::onlyTrashed('deleted_at', 'desc')->paginate(10),
        ]);
    }


    function RestoreCategory($id)
    {
        Category::onlyTrashed()->findorFail($id)->restore($id);
        return redirect("trashed-categories")->with("success", "restored completed");
    }

    function PermanentDeleteCategory($id)
    {
        Category::onlyTrashed()->findorFail($id)->forceDelete();
        return redirect("/trashed-categories")->with("success", "Delete completed");
    }
}
