<?php namespace App\Models;

use App\Models\IRepositoryInterface;

/**
 * Interface ICriteria
 * @package Wayni\Domain
 */
interface ICriteria
{
    /**
     * Apply criteria in query repository
     *
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, IRepositoryInterface $repository);
}