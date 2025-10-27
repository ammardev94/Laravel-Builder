<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\View\View;
use App\Models\PageSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    /**
     * Display a listing of the sections for a page.
     */
    public function index(int $page_id): View
    {
        $page = Page::findOrFail($page_id);
        $sections = $page->sections()->latest()->paginate(10);
        return view('admin.page_sections.index', compact('page', 'sections'));
    }

    /**
     * Show the form for creating a new section.
     */
    public function create(int $page_id): View
    {
        $page = Page::findOrFail($page_id);
        return view('admin.page_sections.create', compact('page'));
    }

    /**
     * Store a newly created section in storage.
     */
    public function store(Request $request, int $page_id)
    {
        $page = Page::findOrFail($page_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'background_type' => 'required|in:none,image,video,color',
            'background_value' => 'nullable|string',
            'visible' => 'nullable|boolean',
            'background_file' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:51200',
        ]);

        $section = new PageSection();
        $section->page_id = $page->id;
        $section->name = $request->name;
        $section->label = $request->label;
        $section->background_type = $request->background_type;
        $section->sort_order = $request->sort_order ?? 0;
        $section->visible = $request->has('visible') ? 1 : 0;

        if (in_array($request->background_type, ['file', 'image', 'video'])) {
            if ($request->hasFile('background_file')) {
                $file = $request->file('background_file');
                $path = $file->store('page_sections', 'public');
                $section->background_value = $path;
            } else {
                $section->background_value = null;
            }
        } elseif ($request->background_type === 'color') {
            $section->background_value = $request->background_value;
        } else {
            $section->background_value = null;
        }

        $section->save();

        return redirect()
            ->route('admin.pages.sections.index', $page->id)
            ->with('success', 'Section created successfully.');
    }

    /**
     * Show the form for editing the specified section.
     */
    public function edit(int $id): View
    {
        $section = PageSection::findOrFail($id);
        $page = $section->page;
        return view('admin.page_sections.edit', compact('page', 'section'));
    }

    /**
     * Update the specified section in storage.
     */
    public function update(Request $request, int $id)
    {
        $section = PageSection::findOrFail($id);
        $page = $section->page;

        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'background_type' => 'required|in:none,image,video,color',
            'background_value' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'visible' => 'nullable|boolean',
        ]);

        $section->name = $request->name;
        $section->label = $request->label;
        $section->background_type = $request->background_type;
        $section->sort_order = $request->sort_order;
        $section->visible = $request->boolean('visible');

        if (in_array($request->background_type, ['image', 'video'])) {
            if ($request->hasFile('background_file')) {
                if ($section->background_value && Storage::disk('public')->exists($section->background_value)) {
                    Storage::disk('public')->delete($section->background_value);
                }

                $file = $request->file('background_file');
                $path = $file->store('page_sections', 'public');
                $section->background_value = $path;
            } else {
                $section->background_value = $section->background_value;
            }
        } elseif ($request->background_type === 'color') {
            $section->background_value = $request->background_value;
        } else {
            if ($section->background_value && Storage::disk('public')->exists($section->background_value)) {
                Storage::disk('public')->delete($section->background_value);
            }
            $section->background_value = null;
        }

        $section->save();

        return redirect()
            ->route('admin.pages.sections.index', $page->id)
            ->with('success', 'Section updated successfully.');
    }


    /**
     * Remove the specified section from storage.
     */
    public function destroy(int $id)
    {
        $section = PageSection::findOrFail($id);
        $page_id = $section->page_id;
        $section->delete();

        return redirect()
            ->route('admin.pages.sections.index', $page_id)
            ->with('success', 'Section deleted successfully.');
    }
}
