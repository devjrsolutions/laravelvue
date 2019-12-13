<?php
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 10/6/2017
 * Time: 6:37 AM
 */

namespace App\Components\Master\Repositories;


use App\Components\Core\BaseRepository;
use App\Components\Master\Models\PasienStatus;
use App\Components\Core\Utilities\Helpers;
use Illuminate\Support\Arr;

class PasienStatusRepository extends BaseRepository
{
    public function __construct(PasienStatus $model)
    {
        parent::__construct($model);
    }

    /**
     * list all users
     *
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|mixed[]
     */
    public function listPasienStatus($params)
    {
        return $this->get($params,[],function($q) use ($params)
        {
            $name = Arr::get($params,'name',null);

            if($name) $q = $q->where('name','like',"%{$name}%");

            return $q;
        });
    }

    /**
     * delete a user by id
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $ids = explode(',',$id);

        foreach ($ids as $id)
        {
            /** @var User $User */
            $PasienStatus = $this->model->find($id);

            if(!$PasienStatus)
            {
                return false;
            };

            $PasienStatus->delete();
        }

        return true;
    }
}