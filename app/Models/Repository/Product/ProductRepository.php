<?php namespace App\Models\Repository\Product;

use App\Models\Repository\Product\IProductRepository;
use App\Models\Repository\Repository as AbstractRepository;


class ProductRepository extends AbstractRepository implements IProductRepository {

	protected $modelClassName = 'App\Models\Product';
}