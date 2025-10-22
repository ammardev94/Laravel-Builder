<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\PageSection;
use Illuminate\Http\Request;
use App\Models\PageSectionField;
use App\Http\Controllers\Controller;

class PageSectionFieldController extends Controller
{
    /**
     * Display a listing of the fields for a section.
     */
    public function index(int $section_id): View
    {
        $section = PageSection::findOrFail($section_id);
        $fields = $section->fields()->latest()->paginate(10);

        return view('admin.page_section_fields.index', compact('section', 'fields'));
    }

    /**
     * Show the form for creating a new field.
     */
    public function create(int $section_id): View
    {
        $section = PageSection::findOrFail($section_id);
        return view('admin.page_section_fields.create', compact('section'));
    }

    /**
     * Store a newly created field in storage.
     */
    public function store(Request $request, int $section_id)
    {
        $section = PageSection::findOrFail($section_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'type' => 'required|in:file,video,image,text,textarea,link',
            'value' => 'nullable|string',
        ]);

        $field = new PageSectionField();
        $field->page_section_id = $section->id;
        $field->name = $request->name;
        $field->label = $request->label;
        $field->type = $request->type;
        $field->value = $request->value;
        $field->save();

        return redirect()
            ->route('admin.sections.fields.index', $section->id)
            ->with('success', 'Field created successfully.');
    }

    /**
     * Show the form for editing the specified field.
     */
    public function edit(int $id): View
    {
        $field = PageSectionField::findOrFail($id);
        $section = $field->section;

        return view('admin.page_section_fields.edit', compact('section', 'field'));
    }

    /**
     * Update the specified field in storage.
     */
    public function update(Request $request, int $id)
    {
        $field = PageSectionField::findOrFail($id);
        $section = $field->section;

        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'type' => 'required|in:file,video,image,text,textarea,link',
            'value' => 'nullable|string',
        ]);

        $field->name = $request->name;
        $field->label = $request->label;
        $field->type = $request->type;
        $field->value = $request->value;
        $field->save();

        return redirect()
            ->route('admin.sections.fields.index', $section->id)
            ->with('success', 'Field updated successfully.');
    }

    /**
     * Remove the specified field from storage.
     */
    public function destroy(int $id)
    {
        $field = PageSectionField::findOrFail($id);
        $section_id = $field->page_section_id;
        $field->delete();

        return redirect()
            ->route('admin.sections.fields.index', $section_id)
            ->with('success', 'Field deleted successfully.');
    }
}
