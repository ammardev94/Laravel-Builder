<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of pages.
     */
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created page in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'title' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'visibility' => 'required|in:no-index,no-follow',
            'type' => 'required|boolean',
        ]);

        $page = new Page();
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->canonical_url = $request->canonical_url;
        $page->visibility = $request->visibility;
        $page->type = $request->type;
        $page->status = $request->has('status') ? 1 : 0;
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified page.
     */
    public function show(int $id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified page.
     */
    public function edit(int $id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page in storage.
     */
    public function update(Request $request, int $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'title' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'visibility' => 'required|in:no-index,no-follow',
            'type' => 'required|boolean',
        ]);

        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->canonical_url = $request->canonical_url;
        $page->visibility = $request->visibility;
        $page->type = $request->type;
        $page->status = $request->has('status') ? 1 : 0;
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified page from storage.
     */
    public function destroy(int $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
