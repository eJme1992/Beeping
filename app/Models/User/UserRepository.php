<?php namespace App\Models\Order;

use App\Models\User\IUserRepository;
use App\Models\Repository as AbstractRepository;


class UserRepository extends AbstractRepository implements IUserRepository {

	protected $modelClassName = 'App\Models\User\User';
}