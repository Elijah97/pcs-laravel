<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $categories = DB::table('categories')
            ->select('categories.*')
            ->orderBy('categories.id', 'ASC')
            ->get();
        return view('dashboard.categories.categories', ['categories' => $categories, 'index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required|max:255',
        );

        $validator = $request->validate($rules); {
            if (!$validator) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                $category = new Category;
                $category->name = $request->input('name');
                $category->description = $request->input('description');
                $category->status = 1;
                $category->save();

                return Redirect::back()->with('success', 'Category created successfully.');
            }
        }
    }



    public function viewDetails(Request $request, $id)
    {
        $category = Category::find($id);

        if ($request->ajax()) {
            return response()->json([
                'data' => $category
            ]);
        }

        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    public function updateCategory(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');

        $update = Category::where('id', $id)->update(
            array(
                'name' => $name,
                'description' => $description,
            )
        );

        if ($update) {
            return redirect()->back()->with('success', 'Category successfully update');
        }
    }

    public function suspend($id)
    {
        $pend = DB::update("UPDATE categories SET status = 0 WHERE id = '$id'");
        if ($pend) {
            return redirect()->back()->with('success', 'Category successfully suspended');
        }
    }

    public function activate($id)
    {
        $pend = DB::update("UPDATE categories SET status = 1 WHERE id = '$id'");
        if ($pend) {
            return redirect()->back()->with('success', 'Category successfully activated');
        }
    }

    public function delete($id)
    {
        $delete = DB::delete("DELETE FROM categories WHERE id = '$id'");
        if ($delete) {
            return redirect()->back()->with('success', 'Category successfully deleted');
        }
    }
}
