<?php

namespace App\Repositories;

use App\Models\Word;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Helpers\FilesHelper;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class WordsRepository extends RepositoryCrud
{
    use FilesHelper;

    /**
     * WordRepository constructor.
     * @param Word $model
     */
    #[Pure]
    public function __construct(Word $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $data['image'] = $this->fileUpload($data['image'], 'words');
        $this->model::create($data);
    }
}
