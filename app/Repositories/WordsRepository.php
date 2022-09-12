<?php

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Helpers\FilesHelper;
use MElaraby\Emerald\Repositories\RepositoryCrud;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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
        $data['voice'] = $this->fileUpload($data['voice'], 'voices');
        return $this->model::create($data);
    }

    /**
     * @param array $data
     * @param int|Model $id
     */
    public function update(array $data, $id): mixed
    {
        if (isset($data['image']) && !is_null($data['image'])) {
            $data['image'] = $this->fileUpload($data['image'], 'words');
        }

        if (isset($data['image']) && is_null($data['image'])) {
            unset($data['image']);
        }

        if (isset($data['voice']) && !is_null($data['voice'])) {
            $data['voice'] = $this->fileUpload($data['voice'], 'words');
        }

        if (isset($data['voice']) && is_null($data['voice'])) {
            unset($data['voice']);
        }
        return parent::update($data, $id);
    }

    /**
     * @param int|null $letterId
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getWords(?int $letterId = null): mixed
    {
        if ($letterId) {
            $this->where('letter_id', $letterId);
        }
        return $this->index();
    }

    /**
     * @param bool $pagination
     * @param int $perPage
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
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
}
