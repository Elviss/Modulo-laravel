<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Http\Requests\ClientRequest;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /*
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientService
     */
    private $service;

    /**
     * @param ClientRepository $repository
     * @param ClientService $service
     */
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     * @internal param ClientRepositoryEloquent|ClientRepository $repository
     */
    public function index()
    {
        try {
            return $this->repository->all();
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Nenhum cliente foi encontrado'];
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
            return ['error' => true, 'message' => 'O cliente não pode ser cadastrado'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Esse cliente não foi encontrado'];
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
    public function show($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Esse cliente não foi encontrado'];
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
     * @param ClientRequest|Request $request
     * @param  int $id
     * @return Response
     */
    public function update(ClientRequest $request, $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (QueryException $e) {
            return ['error' => true, 'message' => 'O cliente não pode ser atualizado'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Esse cliente não foi encontrado'];
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
            return ['error' => true, 'message' => 'O cliente não pode ser deletado'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Esse cliente não foi encontrado'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro'];
        }
    }
}
