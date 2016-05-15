<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectNoteController extends Controller
{
    /*
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteService $service
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     * @internal param ProjectRepositoryEloquent|ProjectRepository $repository
     */
    public function index($id)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id]);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Nenhuma nota foi encontrada'];
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
        try {
            return $this->service->create($request->all());
        } catch (QueryException $e) {
            return ['error' => true, 'message' => 'A nota não pode ser cadastrada'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Essa nota não foi encontrada'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, $noteId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Essa nota não foi encontrada'];
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
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id, $noteId)
    {
        try {
            return $this->service->update($request->all(), $noteId);
        } catch (QueryException $e) {
            return ['error' => true, 'message' => 'A nota não pode ser atualizada'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Essa nota não foi encontrada'];
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
    public function destroy($id, $noteId)
    {
        try {
            return $this->service->delete($noteId);
        } catch (QueryException $e) {
            return ['error' => true, 'message' => 'A nota não pode ser deletada'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Essa nota não foi encontrada'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro'];
        }
    }
}
