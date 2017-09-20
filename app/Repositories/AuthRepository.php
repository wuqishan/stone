<?php

namespace App\Repositories;

use App\Model\Auth;

class AuthRepository extends Repository
{
    public function page($data)
    {
        $eloquentData = Auth::where([]);
        $result['list'] = $this->getWhere($eloquentData, $data)
            ->orderBy('id', 'desc')
            ->offset(($data['pageIndex'] - 1) * $data['pageSize'])
            ->limit($data['pageSize'])->get()->toArray();

        $eloquentCount = Auth::where([]);
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

    public function addAuth($data)
    {
        return Auth::create($data)->id;
    }

    public function delete($authId)
    {
        return Auth::destroy($authId);
    }

    public function getAuth($authId)
    {
        return Auth::find($authId)->toArray();
    }

    public function updateAuth($authId, $data)
    {
        return Auth::where(['id' => $authId])->update($data);
    }

    public function getAllAuth()
    {

        $auth = Auth::where([])
            ->from('auth')
            ->leftJoin('navigation', 'auth.navigation_id', '=', 'navigation.id')
            ->orderBy('auth.navigation_id', 'desc')
            ->get(['auth.id as aid', 'auth.title as atitle', 'navigation.parent_id as nparent_id', 'navigation.title as ntitle'])
            ->toArray();
echo "<pre>";
        print_r($auth);exit;
    }
}