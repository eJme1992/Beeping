<?php namespace App\Models\Repository\Order;

use App\Models\Order;
use App\Models\Repository\Order\IOrderLineRepository;
use App\Models\Repository\Repository as AbstractRepository;
use Illuminate\Support\Facades\DB;
use App\Models\OrderLine;


class OrderLineRepository extends AbstractRepository implements IOrderLineRepository {

	protected $modelClassName = OrderLine::class;

	public function getTotalCost():float {
		return $this->model
		->join('products', 'order_lines.product_id', '=', 'products.id')
		->sum(DB::raw('qty * cost'));
	}
}