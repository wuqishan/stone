<?php

namespace App\Repositories;


class AuthGroupRepository extends Repository
{
    public function page($data)
    {
        $eloquentData = Admin::where([]);
        $result['list'] = $this->getWhere($eloquentData, $data)
            ->orderBy('id', 'desc')
            ->offset(($data['pageIndex'] - 1) * $data['pageSize'])
            ->limit($data['pageSize'])->get()->toArray();

        $eloquentCount = Admin::where([]);
        $result['count'] = $this->getWhere($eloquentCount, $data)->count();

        return $result;
    }

    public function getWhere($eloquent, $data)
    {
        if (! empty($data['title'])) {
            $eloquent->where('title','like','%'.$data['title'].'%');
        }

        if (! empty($data['auth'])) {
            $eloquent->where('auth','like','%'.$data['auth'].'%');
        }

        if (! empty($data['navigation_id'])) {
            $eloquent->where(['navigation_id' => $data['navigation_id']]);
        }

        return $eloquent;
    }

}