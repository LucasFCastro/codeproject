<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Http\Requests;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    /**
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->findWhere(['owner_id'=>$userId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->isNotOwner($id) and $this->isNotMember($id)){
            return ['error'=>'Access forbirdden'];
        }

        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->isNotOwner($id) and $this->isNotMember($id)){
            return ['error'=>'Access forbirdden'];
        }

        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->isNotOwner($id) and $this->isNotMember($id)){
            return ['error'=>'Access forbirdden'];
        }

        $this->repository->find($id)->delete($id);
    }

    public function showMembers($id) {
        $project = $this->repository->skipPresenter()->find($id);
        $members = $project->members()->get();

        return $members;
    }

    private function isNotOwner($id){
        $userId = Authorizer::getResourceOwnerId();
        return !$this->repository->isOwner($id, $userId);
    }

    private function isNotMember($id){
        $userId = Authorizer::getResourceOwnerId();
        return !$this->repository->hasMember($id, $userId);
    }


}
