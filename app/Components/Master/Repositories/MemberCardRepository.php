<?php
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 10/6/2017
 * Time: 6:37 AM
 */

namespace App\Components\Master\Repositories;


use App\Components\Core\BaseRepository;
use App\Components\Master\Models\MemberCard;
use App\Components\Core\Utilities\Helpers;
use Illuminate\Support\Arr;

class MemberCardRepository extends BaseRepository
{
    public function __construct(MemberCard $model)
    {
        parent::__construct($model);
    }

    /**
     * list all users
     *
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|mixed[]
     */
    public function listMemberCard($params)
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
            $MemberCard = $this->model->find($id);

            if(!$MemberCard)
            {
                return false;
            };

            $MemberCard->delete();
        }

        return true;
    }
}

