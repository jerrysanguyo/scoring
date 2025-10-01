<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use App\DataTables\AllDataTable;
use Illuminate\Support\Facades\Log;

class CriteriaController extends Controller
{
    public function index(AllDataTable $dataTable)
    {
        $listOfCriteria = Criteria::all();

        return $dataTable->render('criteria.index', compact('listOfCriteria'));
    }

    public function store(StoreCriteriaRequest $request)
    {
        $validated = $request->validated();
        $validated['added_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try 
        {
            Criteria::create($validated);

            return redirect()->route('admin.criteria.index')
                             ->with('success', 'criteria added successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to store criteria', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.criteria.index')
                             ->with('error', 'Failed to add criteria. Please try again.');
        }
    }
    
    public function edit(Criteria $criterion)
    {
        return view('criteria.edit', compact('criterion'));
    }
    
    public function update(UpdateCriteriaRequest $request, Criteria $criterion)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        try 
        {
            $criterion->update($validated);

            return redirect()->route('admin.criteria.edit', $criterion)
                             ->with('success', 'criteria updated successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to update criteria', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.criteria.edit', $criterion)
                             ->with('error', 'Failed to update criteria. Please try again.');
        }
    }
    
    public function destroy(Criteria $criterion)
    {
        try
        {
            $criterion->delete();
        
            return redirect()->route('admin.criteria.index')
                             ->with('success', 'criteria deleted successfully!');
        }
        catch (\Exception $e)
        {
            Log::error('Failed to delete criteria', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.criteria.index')
                             ->with('error', 'Failed to delete criteria. Please try again.');
        }
    }
}
