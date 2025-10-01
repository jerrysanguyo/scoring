<?php

namespace App\Http\Controllers;

use App\Models\Dance;
use App\Http\Requests\StoreDanceRequest;
use App\Http\Requests\UpdateDanceRequest;
use App\DataTables\AllDataTable;
use Illuminate\Support\Facades\Log;

class DanceController extends Controller
{
    public function index(AllDataTable $dataTable)
    {
        $listOfDance = Dance::all();

        return $dataTable->render('dance.index', compact('listOfDance'));
    }
    
    public function store(StoreDanceRequest $request)
    {
        $validated = $request->validated();
        $validated['added_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try 
        {
            Dance::create($validated);

            return redirect()->route('admin.dance.index')
                             ->with('success', 'dance added successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to store dance', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.dance.index')
                             ->with('error', 'Failed to add dance. Please try again.');
        }
    }
    
    public function edit(Dance $dance)
    {
        return view('dance.edit', compact('dance'));
    }
    
    public function update(UpdateDanceRequest $request, Dance $dance)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        try 
        {
            $dance->update($validated);

            return redirect()->route('admin.dance.edit', $dance)
                             ->with('success', 'dance updated successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to update dance', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.dance.edit', $dance)
                             ->with('error', 'Failed to update dance. Please try again.');
        }
    }
    
    public function destroy(Dance $dance)
    {
        try
        {
            $dance->delete();
        
            return redirect()->route('admin.dance.index')
                             ->with('success', 'dance deleted successfully!');
        }
        catch (\Exception $e)
        {
            Log::error('Failed to delete dance', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.dance.index')
                             ->with('error', 'Failed to delete dance. Please try again.');
        }
    }
}
