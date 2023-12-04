<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateComapnyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class ApiCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;
    public function __construct(Company $repository)
    {
        $this->repository = $repository;
    }
    public function index(Request $request)
    {
        return CompanyResource::collection($this->repository->getCompanies($request->get('filter','')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateComapnyRequest $request)
    {
        return new CompanyResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($identify)
    {
        return new CompanyResource($this->repository->where('uuid', $identify)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateComapnyRequest $request, $identify)
    {
        $company = $this->repository->where('uuid', $identify)->firstOrFail();

        $company->update($request->validated());

        return response()->json([
            'message' => 'Empresa atualizada com sucesso !'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($identify)
    {
        $company = $this->repository->where('uuid', $identify)->firstOrFail();

        $company->delete();
        return response()->json([
            'message' => 'Empresa atualizada com sucesso !'
        ]);
    }
}
