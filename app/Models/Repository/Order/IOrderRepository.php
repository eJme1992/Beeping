<?php namespace App\Models\Repository\Order;

use App\Models\Repository\IRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface IOrderRepository extends IRepositoryInterface
{
	function getOrderforPage(int $offset,int $limit):? Collection;
}