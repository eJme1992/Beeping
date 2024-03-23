<?php namespace App\Models\Order;

use App\Models\Order\IOrderRepository;
use App\Models\Repository as AbstractRepository;


class OrderRepository extends AbstractRepository implements IOrderRepository {

	protected $modelClassName = 'App\Models\Order\Order';

}