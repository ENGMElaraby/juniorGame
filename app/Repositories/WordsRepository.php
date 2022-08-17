<?php

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Database\Eloquent\Model;
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
        $data['image'] = $this->fileUpload($data['image'], 'words');
        $data['voice'] = $this->fileUpload($data['voice'], 'voices');
        return $this->model::create($data);
    }

    /**
     * @param array $data
     * @param int|Model $id
     */
    public function update(array $data, $id): void
    {
        if (isset($data['image']) && is_null($data['image'])) {
            unset($data['image']);
        }
        if (isset($data['voice']) && is_null($data['voice'])) {
            unset($data['voice']);
        }
        parent::update($data, $id);
    }
}
