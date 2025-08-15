<?php
// ...existing code...
public function index()
{
    $ads = auth()->user()->ads ?? []; // Adjust as per your relation
    return view('my-ads', compact('ads'));
}
// ...existing code...