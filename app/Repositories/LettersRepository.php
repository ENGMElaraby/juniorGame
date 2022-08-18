<?php

namespace App\Repositories;

use App\Models\Letter;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Helpers\FilesHelper;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class LettersRepository extends RepositoryCrud
{
    use FilesHelper;

    /**
     * LetterRepository constructor.
     * @param Letter $model
     */
    #[Pure]
    public function __construct(Letter $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $data['status'] = (int)$data['status'];
        $this->model::create($data);
    }

    /**
     * @return mixed
     */
    public function getLetters(): mixed
    {
        return $this->where('status', true)
            ->index();
    }
}
