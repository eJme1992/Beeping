<?php namespace App\Models\Repository\Order;

use App\Models\Order;
use App\Models\Repository\Order\IOrderRepository;
use App\Models\Repository\Repository as AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends AbstractRepository implements IOrderRepository {

	protected $modelClassName = 'App\Models\Order';

	public function getOrderforPage(int $offset,int $limit): ? Collection
	{
    	return $this->model->offset($offset)->limit($limit)->get();
	}
}