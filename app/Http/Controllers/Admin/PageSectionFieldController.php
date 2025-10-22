<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\PageSectionField;
use Illuminate\Http\Request;

class PageSectionFieldController extends Controller
{
    public function index(PageSection $section)
    {
        $fields = $section->fields()->paginate(10);
        return view('admin.page_section_fields.index', compact('section', 'fields'));
    }

    public function create(PageSection $section)
    {
        return view('admin.page_section_fields.create', compact('section'));
    }

    public function store(Request $request, PageSection $section)
    {
        $data = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_label' => 'nullable|string|max:255',
            'field_type' => 'required|in:text,textarea,file,link,video,image',
            'field_value' => 'nullable|string',
            'sort_order' => 'integer|min:0'
        ]);

        $section->fields()->create($data);
        return redirect()->route('admin.sections.fields.index', $section)->with('success', 'Field created successfully!');
    }

    public function edit(PageSectionField $field)
    {
        return view('admin.page_section_fields.edit', compact('field'));
    }

    public function update(Request $request, PageSectionField $field)
    {
        $data = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_label' => 'nullable|string|max:255',
            'field_type' => 'required|in:text,textarea,file,link,video,image',
            'field_value' => 'nullable|string',
            'sort_order' => 'integer|min:0'
        ]);

        $field->update($data);
        return back()->with('success', 'Field updated successfully!');
    }

    public function destroy(PageSectionField $field)
    {
        $field->delete();
        return back()->with('success', 'Field deleted successfully!');
    }
}
