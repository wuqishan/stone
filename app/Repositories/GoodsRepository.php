<?php

namespace App\Repositories;

use App\Model\Goods;

class GoodsRepository extends Repository
{
    public function page($data)
    {
        $eloquentData = Goods::where([]);
        $result['list'] = $this->getWhere($eloquentData, $data)
            ->orderBy('id', 'desc')
            ->offset(($data['pageIndex'] - 1) * $data['pageSize'])
            ->limit($data['pageSize'])->get()->toArray();

        $eloquentCount = Goods::where([]);
        $result['count'] = $this->getWhere($eloquentCount, $data)->count();

        return $result;
    }

    public function getWhere($eloquent, $data)
    {
        if (! empty($data['goodsName'])) {
            $eloquent->where('name','like','%'.$data['goodsName'].'%');
        }

        if (
            $data['priceMin'] > 0 && $data['priceMax'] > 0 ||
            $data['priceMin'] == 0 && $data['priceMax'] > 0
        ) {
            $eloquent->whereBetween('price', [$data['priceMin'], $data['priceMax']]);
        } else if ($data['priceMin'] > 0 && $data['priceMax'] == 0) {
            $eloquent->where('price', '>=', $data['priceMin']);
        }

        return $eloquent;
    }

    /**
     * 添加商品
     *
     * @param $data
     * @return mixed
     */
    public function addGoods($data)
    {
        return Goods::create($data)->id;
    }

    public function updateGoods($goodsId, $data)
    {
        return Goods::where('id', $goodsId)->update($data);
    }

    /**
     * 删除商品
     *
     * @param $goodsId
     * @return int
     */
    public function destroy($goodsId)
    {
        return Goods::destroy($goodsId);
    }

    public function getByPk($id)
    {
        return Goods::find($id)->toArray();
    }
}