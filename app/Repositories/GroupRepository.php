<?php

namespace App\Repositories;

use App\Model\Group;

class GroupRepository extends Repository
{
    public function page($data)
    {
        $eloquentData = Group::where([]);
        $result['list'] = $this->getWhere($eloquentData, $data)
            ->orderBy('id', 'desc')
            ->offset(($data['pageIndex'] - 1) * $data['pageSize'])
            ->limit($data['pageSize'])->get()->toArray();

        $eloquentCount = Group::where([]);
        $result['count'] = $this->getWhere($eloquentCount, $data)->count();

        return $result;
    }

    public function getWhere($eloquent, $data)
    {
        if (! empty($data['title'])) {
            $eloquent->where('title','like','%'.$data['title'].'%');
        }

        if (! empty($data['comments'])) {
            $eloquent->where('comments','like','%'.$data['comments'].'%');
        }

        return $eloquent;
    }

    public function addGroup($data)
    {
        return Group::create($data)->id;
    }
}