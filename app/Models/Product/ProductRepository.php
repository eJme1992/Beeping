<?php namespace App\Models\Order;

use App\Models\Product\IProductRepository;
use App\Models\Repository as AbstractRepository;


class ProductRepository extends AbstractRepository implements IProductRepository {

	protected $modelClassName = 'App\Models\Product\Product';
}