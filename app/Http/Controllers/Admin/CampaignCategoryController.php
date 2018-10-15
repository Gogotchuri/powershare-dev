<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reference\CampaignCategory;
use Illuminate\Http\Request;

class CampaignCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  CampaignCategory::all();

        return view('admin.categories.index', compact('categories'));
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
        $this->validate($request, [
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:50',
            'name' => 'required|string'
        ]);

        $category = new CampaignCategory();
        $category->name = $request->name;
        $category->icon = file_get_contents($request->file('icon')->getRealPath());
        $category->save();

        return back()->with('message', 'New category created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =  CampaignCategory::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = CampaignCategory::findOrFail($id);

        $this->validate($request, [
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:50',
            'name' => 'required|string'
        ]);

        $category->name = $request->name;

        if($iconFile = $request->file('icon')) {
            $category->icon = file_get_contents($iconFile->getRealPath());
        }

        $category->save();

        return back()->with('message', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CampaignCategory::findOrFail($id)->delete();

        return back();
    }

    public function show()
    {
        //FIXME: Unused
    }
}
