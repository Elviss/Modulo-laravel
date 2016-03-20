<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Entities\Client;
use CodeProject\Http\Requests\ClientRequest;
use CodeProject\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\CountValidator\Exception;

class ClientController extends Controller
{
    /*
     * @var ClientRepository
     */
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     * @internal param ClientRepositoryEloquent|ClientRepository $repository
     */
    public function index()
    {
        return $this->repository->all();
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
        return $this->repository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Client::find($id);
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

            $client = $this->repository->find($id)->update($request->all());

            return array('response'=>'Cliente alterado');

        } catch(Exception $e) {
            return array('error' => $e->getMessage());
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

            Client::find($id)->delete();

            return array('response'=>'Cliente excluído');

        } catch(Exception $e) {
            return array('error'=>$e->getMessage());
        }


    }
}
