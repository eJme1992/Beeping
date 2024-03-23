<?php namespace App\Models\Repository\Order;

use App\Models\Repository\Order\IOrderLineRepository;
use App\Models\Repository\Repository as AbstractRepository;


class OrderLineRepository extends AbstractRepository implements IOrderLineRepository {

	protected $modelClassName = 'App\Models\OrderLine';
}