<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 13/12/2015
 * Time: 23:36
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    public function model()
    {
        return Client::class;
    }
}