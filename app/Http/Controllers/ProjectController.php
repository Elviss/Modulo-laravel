<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Http\Requests\ProjectRequest;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /*
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     * @internal param ProjectRepositoryEloquent|ProjectRepository $repository
     */
    public function index()
    {
        try {
            return $this->repository->with(['owner', 'client'])->all();
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro'];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            return $this->repository->with(['owner', 'client'])->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Esse projeto não foi encontrado'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest|Request $request
     * @param  int $id
     * @return Response
     */
    public function update(ProjectRequest $request, $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (QueryException $e) {
            return ['error' => true, 'message' => 'O projeto não pode ser atualizado'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Esse projeto não foi encontrado'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            return $this->service->delete($id);
        } catch (QueryException $e) {
            return ['error' => true, 'message' => 'O projeto não pode ser deletado pois existe um ou mais clientes vinculados a ele'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Esse projeto não foi encontrado'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro'];
        }
    }
}
