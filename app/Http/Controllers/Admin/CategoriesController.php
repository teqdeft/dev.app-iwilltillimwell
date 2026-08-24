<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Validators\CategoriesValidator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $categories = categories::latest('created_at')->get();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $categories->each(function ($item, $key) use ($jsonCollection) {
                    $jsonCollection->push([
                        'sr_no' => $key+1,
                        'id' => $item->id,
                        'name' => $item->name,
                    ]);
                });
                return response()->json(['data' => $jsonCollection]);
            }
            return view('admin.categories.index',compact('categories'));
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $CategoriesValidator = new CategoriesValidator();
        try {
            $input = $request->all();
            if (!$CategoriesValidator->with($input)->passes()) {
                $request->session()->flash('error', $CategoriesValidator->getErrors()[0]);
                return back()
                    ->withErrors($CategoriesValidator->getValidator())
                    ->withInput();
            }
            $slug = strToSlug($input['name'],'-');
            $data = array(
                'name' => $input['name'],
                'slug' => $slug,
            );
            Categories::create($data);
            $request->session()->flash('success', 'Category created successfully.');
            return redirect('/admin/categories');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Categories::where('id', $id)->first();
        return view('admin.categories.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id= $request->id;
        $CategoriesValidator = new CategoriesValidator();
        try {
            $input = $request->all();

            if (!$CategoriesValidator->with($input)->passes()) {
                $request->session()->flash('error', $CategoriesValidator->getErrors()[0]);
                return back()
                    ->withErrors($CategoriesValidator->getValidator())
                    ->withInput();
            }

            $slug = strToSlug($input['name'],'-');
            $data = array(
                'name' => $input['name'],
                'slug' => $slug,
            );
            $categories = new Categories;
            $categories->where('id', $id)->update($data);
            $request->session()->flash('success', 'Category Updated successfully.');
            return redirect('/admin/categories');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            Categories::where('id', $id)->delete();
            $request->session()->flash('success', 'Category deleted successfully.');
            return redirect('/admin/categories');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
}
