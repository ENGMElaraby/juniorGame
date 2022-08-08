<?php

namespace App\Repositories;

use App\Models\SubLetter;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Helpers\FilesHelper;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class SubLettersRepository extends RepositoryCrud
{
    use FilesHelper;

    /**
     * SubLetterRepository constructor.
     * @param SubLetter $model
     */
    #[Pure]
    public function __construct(SubLetter $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $data['status'] = (int)$data['status'];
        $this->model::create($data);
    }
}
