<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    public function index(Page $page)
    {
        $sections = $page->sections()->paginate(10);
        return view('admin.page_sections.index', compact('page', 'sections'));
    }

    public function create(Page $page)
    {
        return view('admin.page_sections.create', compact('page'));
    }

    public function store(Request $request, Page $page)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'sort_order' => 'integer|min:0',
            'background_type' => 'in:image,video,color,none',
            'background_value' => 'nullable|string',
            'visible' => 'boolean'
        ]);

        $page->sections()->create($data);
        return redirect()->route('admin.pages.sections.index', $page)->with('success', 'Section added successfully!');
    }

    public function edit(PageSection $section)
    {
        return view('admin.page_sections.edit', compact('section'));
    }

    public function update(Request $request, PageSection $section)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'sort_order' => 'integer|min:0',
            'background_type' => 'in:image,video,color,none',
            'background_value' => 'nullable|string',
            'visible' => 'boolean'
        ]);

        $section->update($data);
        return back()->with('success', 'Section updated successfully!');
    }

    public function destroy(PageSection $section)
    {
        $section->delete();
        return back()->with('success', 'Section deleted successfully!');
    }
}
