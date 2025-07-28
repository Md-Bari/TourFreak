<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    // Show form to create a new skill
    public function create()
    {
        return view('admin.skills.create');
    }

    // Store new skill in database
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency' => 'nullable|integer|min:0|max:100', // percentage 0-100
        ]);

        Skill::create($data);

        return redirect('/admin/skills/create')->with('success', 'Skill added!');
    }
}
