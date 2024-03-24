<?php namespace App\Models\Repository\Executed;

use App\Models\Repository\IRepositoryInterface;
use App\Models\Executed;

interface IExecutedRepository extends IRepositoryInterface
{
	public function getLastExecuted(): ?Executed;
}