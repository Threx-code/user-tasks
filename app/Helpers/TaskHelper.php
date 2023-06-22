<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;

class TaskHelper
{
    const PRIORITIES = ['low', 'Low', 'LOW', 'medium', 'Medium', 'MEDIUM', 'high', 'Hgh', 'HIGH', 'urgent', 'Urgent', 'URGENT'];

    /**
     * @return int
     * @throws Exception
     */
    public static function randomNumber(): int
    {
        return random_int(1, 1000);
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function dataCreator($model, $data): mixed
    {
        return $model::create($data);
    }

    /**
     * @param $model
     * @param $whereClause
     * @return mixed
     */
    public function getAData($model, $whereClause): mixed
    {
        return $model::where($whereClause)->first();
    }


    /**
     * @param $model
     * @param $whereClause
     * @param $data
     * @return mixed
     */
    public function update($model, $whereClause, $data): mixed
    {
        return $model::where($whereClause)->update($data);
    }

    /**
     * @param $model
     * @param $where
     * @param $whereRaw
     * @param $with
     * @return mixed
     */
    public function getAllData($model, $where, $whereRaw, $with): mixed
    {
        return $model::with($with)
            ->where($where)
            ->whereRaw($whereRaw)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    /**
     * @param $model
     * @param $where
     * @param $whereRaw
     * @param $with
     * @return mixed
     */
    public function getADataAndChild($model, $where, $whereRaw, $with): mixed
    {
        return $model::with($with)
            ->where($where)
            ->whereRaw($whereRaw)
            ->orderBy('id', 'desc')
            ->first();
    }

}
