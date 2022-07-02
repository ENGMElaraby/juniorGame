<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Repositories\Filters\Traits\FilterDatatableRepositoryEloquent;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class AdminRepository extends RepositoryCrud
{
    use FilterDatatableRepositoryEloquent;

    /**
     * AdminRepository constructor.
     * @param Admin $model
     */
    #[Pure]
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    /**
     * store data into model
     *
     * @param array $data
     */
    public function store(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        parent::store($data);
    }

    /**
     * @param array $data
     * @param Model|int $id
     */
    public function update(array $data, $id): void
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        parent::update($data, $id);
    }

}
