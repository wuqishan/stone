<?php

namespace App\Repositories;

use App\Model\Navigation;

class NavigationRepository extends Repository
{
    /**
     * 根据level等级获取所有节点
     *
     * @param array $level
     * @return array
     */
    public function getSelectNodes($level = [])
    {
        $navgationObj = null;
        if (empty($level)) {
            $navgationObj = Navigation::where([]);
        } else {
            $navgationObj = Navigation::whereIn('level', $level);
        }

        $navgation = $navgationObj->orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        return $this->unlimitedForLevel($navgation);
    }

    /**
     * 根据关系数据数据添加导航
     *
     * @param $data
     * @return mixed
     */
    public function addNavigation($data)
    {
        return Navigation::create($data)->id;
    }

    /**
     * 根据导航id获取导航信息
     *
     * @param $id
     * @return array
     */
    public function getNavigation($id)
    {
        return Navigation::find($id)->toArray();
    }

    public function updateNavigation($navigationId, $data)
    {
        return Navigation::where('id', $navigationId)->update($data);
    }

    public function delete($navigationId)
    {
        $result = 2;
        if (empty(Navigation::where(['parent_id' => $navigationId])->get()->toArray())) {
            Navigation::destroy($navigationId) && ($result = 0);
        }

        return $result;
    }

    /**
     * 生成一维数组，可以直接输出
     *
     * @param $category
     * @param string $html
     * @param int $pid
     * @return array
     */
    public function unlimitedForLevel ($category, $html = '──', $pid = 0)
    {
        $arr = array();
        foreach ($category as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $v['html']  = str_repeat($html, $v['level']);
                $arr[] = $v;
                $arr = array_merge($arr, $this->unlimitedForLevel($category, $html, $v['id']));
            }
        }

        return $arr;
    }

    /**
     * 生成无限极的树，多维数组
     *
     * @param $category
     * @param string $name
     * @param int $pid
     * @return array
     */
    public function array2tree ($category, $name = 'child', $pid = 0)
    {
        $arr = array();
        foreach ($category as $v) {
            if ($v['parent_id'] == $pid) {
                $v[$name] = $this->array2tree($category, $name, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}