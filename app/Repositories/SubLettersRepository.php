<?php

namespace App\Repositories;

use App\Models\SubLetter;
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
     * @param bool $pagination
     * @param int $perPage
     * @return mixed
     */
    public function index(bool $pagination = false, int $perPage = 6): mixed
    {
        $this->newQuery()->eagerLoad()->setClauses();

        $model = $this->query;

        if ($pagination) {
            return $model->paginate($perPage);
        }
        if (request()->has('letter_id')) {
            $model->where('letter_id', request()->get('letter_id'));
        }
        return $model->get(['*']);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $data['status'] = (int)$data['status'];
        $data['image'] = $this->fileUpload($data['image'], 'words');
        $data['voice'] = $this->fileUpload($data['voice'], 'voices');
        $this->model::create($data);
    }
}
