<?php namespace App\Models\Repository\Executed;

use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Repository as AbstractRepository;


class ExecutedRepository extends AbstractRepository implements IExecutedRepository {

	protected $modelClassName = 'App\Models\Executed';

}