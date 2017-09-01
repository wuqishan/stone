<?php

namespace App\Repositories;

use App\Model\Navigation;

class NavigationRepository extends Repository
{
    public function getSelectParents()
    {
        $navgation = Navigation::whereIn('parent_id', [0, 1])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        return $this->unlimitedForLevel($navgation);
    }

    /**
     * 生成一维数组，可以直接输出
     *
     * @param $cate
     * @param string $html
     * @param int $pid
     * @param int $level
     * @return array
     */
    public function unlimitedForLevel ($category, $html = '---', $pid = 0, $level = 0)
    {
        $arr = array();
        foreach ($category as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $v['level'] = $level + 1;
                $v['html']  = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, $this->unlimitedForLevel($category, $html, $v['id'], $level + 1));
            }
        }

        return $arr;
    }
}