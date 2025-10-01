<?php

namespace App\Http\Controllers;

use App\Models\GownCriteria;
use App\Http\Requests\GownCriteriaRequest;
use App\DataTables\AllDataTable;
use App\Services\GownCriteriaService;
use Illuminate\Support\Facades\Auth;

class GownCriteriaController extends Controller
{
    protected $gownCriteriaService;
    public function __construct(GownCriteriaService $gownCriteriaService)
    {
        $this->gownCriteriaService = $gownCriteriaService;
    }

    public function index(AllDataTable $dataTable)
    {
        $listOfCriteria = gownCriteria::getAllgownCriteria();

        return $dataTable->render('gownCriteria.index', compact(
            'dataTable',
            'listOfCriteria'
        ));
    }

    public function store(GownCriteriaRequest $request)
    {
        $this->gownCriteriaService->store($request->validated());

        return redirect()
            ->route(Auth::user()->type . '.gownCriteria.index')
            ->with('success','Criteria added successfully');
    }
    
    public function edit(GownCriteria $gownCriterion)
    {
        return view('gownCriteria.edit', compact(
            'gownCriterion'
        ));
    }
    
    public function update(GownCriteriaRequest $request, GownCriteria $gownCriterion)
    {
        $this->gownCriteriaService->update($gownCriterion, $request->validated());

        return redirect()
            ->route(Auth::user()->type . '.gownCriteria.edit', $gownCriterion->id)
            ->with('success','Criteria updated successfully');
    }
    
    public function destroy(GownCriteria $gownCriterion)
    {
        $this->gownCriteriaService->destroy($gownCriterion);

        return redirect()
            ->route(Auth::user()->type . '.gownCriteria.index')
            ->with('success','Criteria deleted successfully');
    }
}
