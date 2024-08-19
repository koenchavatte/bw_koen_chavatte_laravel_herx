<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function create()
    {
        $categories = FAQCategory::all();
        return view('faq.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        FAQ::create($request->all());
        return redirect()->route('faq.index')->with('success', 'FAQ created successfully');
    }

    public function edit(FAQ $faq)
    {
        $categories = FAQCategory::all();
        return view('faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());
        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ deleted successfully');
    }
}

