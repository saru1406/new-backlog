<?php

namespace App\Http\Controllers\Company;

use App\Exceptions\AlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Usecase\Company\StoreCompanyUsecaseInterface;
use DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function __construct(private readonly StoreCompanyUsecaseInterface $storeCompanyUsecase)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Company/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        try {
            DB::transaction(function () use($request) {
                $this->storeCompanyUsecase->execute($request->getCompanyName());
            });
        } catch (AlreadyExistsException $e) {
            Log::info($e->getMessage());
            return Inertia::render('Dashboard', ['message' => $e->getMessage()]);
        }
        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
