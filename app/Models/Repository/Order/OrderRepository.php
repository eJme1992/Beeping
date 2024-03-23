<?php namespace App\Models\Repository\Order;

use App\Models\Repository\Order\IOrderRepository;
use App\Models\Repository\Repository as AbstractRepository;


class OrderRepository extends AbstractRepository implements IOrderRepository {

	protected $modelClassName = 'App\Models\Order';

}