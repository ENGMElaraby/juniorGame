<?php

namespace App\Http\Controllers\Admin;

use App\Http\{Requests\Admin\Questions\StoreRequest, Requests\Admin\Questions\UpdateRequest};
use App\Repositories\QuestionsRepository;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;

class QuestionsController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $updateRequest = UpdateRequest::class;
    protected ?string $route = 'admin.questions.';
    protected ?string $view = 'admin.modules.questions.';

    /**
     * SubLettersController constructor.
     * @param QuestionsRepository $repository
     */
    #[Pure]
    public function __construct(QuestionsRepository $repository)
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
