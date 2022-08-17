<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Words\StoreRequest;
use App\Http\Requests\Admin\Words\UpdateRequest;
use App\Repositories\WordsRepository;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;

class WordsController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $updateRequest = UpdateRequest::class;
    protected ?string $route = 'admin.words.';
    protected ?string $view = 'admin.modules.words.';

    /**
     * SubLettersController constructor.
     * @param WordsRepository $repository
     */
    #[Pure]
    public function __construct(WordsRepository $repository)
    {
        parent::__construct($repository);
    }


    /**
     * @param $model
     * @return string
     */
    public function storeRedirect($model): string
    {
        return route($this->route . 'index', ['letter_id' => $model->letter_id]);
    }

    /**
     * @param $model
     * @return string
     */
    public function updateRedirect($model): string
    {
        return route($this->route . 'index', ['letter_id' => $model->letter_id]);
    }

    /**
     * @param $model
     * @return string
     */
    public function deleteRedirect($model): string
    {
        return route($this->route . 'index', ['letter_id' => $model->letter_id]);
    }
}
