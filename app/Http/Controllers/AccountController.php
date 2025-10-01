<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\DataTables\AllDataTable;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function index(AllDataTable $dataTable)
    {
        $listOfAccount = User::all();

        return $dataTable->render('account.index', compact('listOfAccount'));
    }
    
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        try 
        {
            User::create($validated);

            return redirect()->route('admin.account.index')
                             ->with('success', 'User added successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to store User', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.account.index')
                             ->with('error', 'Failed to add User. Please try again.');
        }
    }
    
    public function edit(User $account)
    {
        return view('account.edit', compact('account'));
    }
    
    public function update(UpdateUserRequest $request, User $account)
    {
        $validated = $request->validated();

        try 
        {
            $account->update($validated);

            return redirect()->route('admin.account.edit', $account)
                             ->with('success', 'user updated successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to update user', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.account.edit', $account)
                             ->with('error', 'Failed to update category. Please try again.');
        }
    }
    
    public function destroy(User $account)
    {
        try
        {
            $account->delete();
        
            return redirect()->route('admin.account.index')
                             ->with('success', 'user deleted successfully!');
        }
        catch (\Exception $e)
        {
            Log::error('Failed to delete user', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.account.index')
                             ->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
