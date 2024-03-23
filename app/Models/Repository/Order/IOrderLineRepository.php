<?php namespace App\Models\Repository\Order;

use App\Models\Repository\IRepositoryInterface;

interface IOrderLineRepository extends IRepositoryInterface
{
    public function getTotalCost():float;
}