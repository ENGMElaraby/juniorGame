<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Helpers\FilesHelper;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class AdminsRepository extends RepositoryCrud
{
    use FilesHelper;

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
     * @param array $data
     * @param $id
     * @return void
     */
    final public function update(array $data, $id): mixed
    {
        if ($id instanceof Model) {
            $model = $id;
        } else {
            $model = $this->find($id);
        }

        if (isset($data['image'])) {
            $data['photo'] = $this->fileUpload($data['image'], 'public/user');
        }
        if (isset($data['password']) && is_null($data['password'])) {
            unset($data['password']);
        }
        $model->update($data);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        if (!isset($data['password'])) {
            $data['password'] = bcrypt('123456');
        }
        $this->model::create($data);
    }
}
