<?php

namespace App\Http\Controllers;

use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQCategoryController extends Controller
{
    public function index()
    {
        $categories = FAQCategory::with('faqs')->get();
        return view('faq.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('faq.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        FAQCategory::create($request->all());
        return redirect()->route('faq.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(FAQCategory $category)
    {
        return view('faq.categories.edit', compact('category'));
    }

    public function update(Request $request, FAQCategory $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->all());
        return redirect()->route('faq.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(FAQCategory $category)
    {
        $category->delete();
        return redirect()->route('faq.categories.index')->with('success', 'Category deleted successfully');
    }
}

