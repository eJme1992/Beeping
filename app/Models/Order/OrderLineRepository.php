<?php namespace App\Models\Order;

use App\Models\Order\IOrderLineRepository;
use App\Models\Repository as AbstractRepository;


class OrderLineRepository extends AbstractRepository implements IOrderLineRepository {

	protected $modelClassName = 'App\Models\Order\OrderLine';
}