<?php

namespace App\Http\Controllers;

use App\Models\TalentCriteria;
use App\Http\Requests\TalentCriteriaRequest;
use App\DataTables\AllDataTable;
use App\Services\TalentCriteriaService;
use Illuminate\Support\Facades\Auth;

class TalentCriteriaController extends Controller
{
    protected $talentCriteriaService;
    public function __construct(TalentCriteriaService $talentCriteriaService)
    {
        $this->talentCriteriaService = $talentCriteriaService;
    }

    public function index(AllDataTable $dataTable)
    {
        $listOfCriteria = TalentCriteria::getAllTalentCriteria();

        return $dataTable->render('talentCriteria.index', compact(
            'dataTable',
            'listOfCriteria'
        ));
    }

    public function store(TalentCriteriaRequest $request)
    {
        $this->talentCriteriaService->store($request->validated());

        return redirect()
            ->route(Auth::user()->type . '.talentCriteria.index')
            ->with('success','Criteria added successfully');
    }
    
    public function edit(TalentCriteria $talentCriterion)
    {
        return view('talentCriteria.edit', compact(
            'talentCriterion'
        ));
    }
    
    public function update(TalentCriteriaRequest $request, TalentCriteria $talentCriterion)
    {
        $this->talentCriteriaService->update($talentCriterion, $request->validated());

        return redirect()
            ->route(Auth::user()->type . '.talentCriteria.edit', $talentCriterion->id)
            ->with('success','Criteria updated successfully');
    }
    
    public function destroy(TalentCriteria $talentCriterion)
    {
        $this->talentCriteriaService->destroy($talentCriterion);

        return redirect()
            ->route(Auth::user()->type . '.talentCriteria.index')
            ->with('success','Criteria deleted successfully');
    }
}
