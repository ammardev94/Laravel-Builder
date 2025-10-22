<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\PageSection;
use Illuminate\Http\Request;
use App\Models\PageSectionField;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'field_name' => 'required|string|max:255',
            'field_label' => 'nullable|string|max:255',
            'field_type' => 'required|in:file,video,image,text,textarea,link',
            'field_value' => 'nullable|string',
            'value_file' => 'nullable|file|max:10240',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $field = new PageSectionField();
        $field->page_section_id = $section->id;
        $field->field_name = $request->field_name;
        $field->field_label = $request->field_label;
        $field->field_type = $request->field_type;
        $field->sort_order = $request->sort_order ?? 0;

        if (in_array($request->field_type, ['file', 'image', 'video'])) {
            if ($request->hasFile('value_file')) {
                $file = $request->file('value_file');
                $path = $file->store('page_fields', 'public');
                $field->field_value = $path;
            } else {
                $field->field_value = null;
            }
        } else {
            $field->field_value = $request->field_value;
        }

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
        $section = PageSection::findOrFail($field->page_section_id);

        $request->validate([
            'field_name'  => 'required|string|max:255',
            'field_label' => 'nullable|string|max:255',
            'field_type'  => 'required|in:file,video,image,text,textarea,link',
            'field_value' => 'nullable',
            'sort_order'  => 'nullable|integer',
        ]);

        $field->page_section_id = $section->id;
        $field->field_name = $request->field_name;
        $field->field_label = $request->field_label;
        $field->field_type = $request->field_type;
        $field->sort_order = $request->sort_order ?? 0;

        if (in_array($request->field_type, ['file', 'image', 'video'])) {
            if ($request->hasFile('value_file')) {
                if ($field->field_value && Storage::disk('public')->exists($field->field_value)) {
                    Storage::disk('public')->delete($field->field_value);
                }

                $file = $request->file('value_file');
                $path = $file->store('page_fields', 'public');
                $field->field_value = $path;
            }
        } else {
            $field->field_value = $request->field_value;
        }

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

        if ($field->field_value && Storage::disk('public')->exists($field->field_value)) {
            Storage::disk('public')->delete($field->field_value);
        }

        $field->delete();

        return redirect()
            ->route('admin.sections.fields.index', $section_id)
            ->with('success', 'Field deleted successfully.');
    }
}
