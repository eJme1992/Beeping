<?php namespace App\Models\Executed;

use App\Models\Executed\IExecutedRepository;
use App\Models\Repository as AbstractRepository;


class ExecutedRepository extends AbstractRepository implements IExecutedRepository {

	protected $modelClassName = 'App\Models\Executed\Executed';

}