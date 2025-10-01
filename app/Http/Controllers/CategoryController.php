<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\DataTables\AllDataTable;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(AllDataTable $dataTable)
    {
        $listOfCategory = Category::all();

        return $dataTable->render('category.index', compact('listOfCategory'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['added_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try 
        {
            Category::create($validated);

            return redirect()->route('admin.category.index')
                             ->with('success', 'Category added successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to store category', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.category.index')
                             ->with('error', 'Failed to add category. Please try again.');
        }
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        try 
        {
            $category->update($validated);

            return redirect()->route('admin.category.edit', $category)
                             ->with('success', 'Category updated successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to update category', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.category.edit', $category)
                             ->with('error', 'Failed to update category. Please try again.');
        }
    }

    public function destroy(Category $category)
    {
        try
        {
            $category->delete();
        
            return redirect()->route('admin.category.index')
                             ->with('success', 'Category deleted successfully!');
        }
        catch (\Exception $e)
        {
            Log::error('Failed to delete category', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.category.index')
                             ->with('error', 'Failed to delete category. Please try again.');
        }
    }
}