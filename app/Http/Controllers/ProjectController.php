<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function create() {
        return view('admin.projects.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);
        return redirect('/admin')->with('success', 'Project added!');
    }
}
