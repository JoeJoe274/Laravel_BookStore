<?php

namespace BookStore\Foundations\Domain\Base\Repositories\Eloquent;

use BookStore\Foundations\Domain\Base\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function connection($useModel = false)
    {
        if ($useModel) {
            return $this->model;
        }

        return $this->model;
    }

    private function insert(array $params, $useModel = false)
    {
        $query = $this->connection($useModel)->create($params);

        if (!$query) {
            throw new QueryException("Inserting a row was failed.");
        }

        return $query;
    }

    public function insertGetId(array $params, $useModel = false)
    {
        $query = $this->insert($params, $useModel);

        return $query['id'];
    }

    public function update($id, array $params)
    {
        $query = $this->connection(true)
            ->where('id', $id)
            ->update($params);

        return $query;
    }

    public function delete($id)
    {
        $query = $this->connection(true)->destroy($id);

        if (!$query) {
            throw new QueryException("Deleting a row was failed.");
        }

        return $query;
    }
}
