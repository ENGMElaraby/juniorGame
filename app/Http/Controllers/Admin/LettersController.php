<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Letters\StoreRequest;
use App\Repositories\LettersRepository;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;

class LettersController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $updateRequest = StoreRequest::class;
    protected ?string $route = 'admin.letters.';
    protected ?string $view = 'admin.modules.letters.';

    /**
     * UsersController constructor.
     * @param LettersRepository $repository
     */
    #[Pure]
    public function __construct(LettersRepository $repository)
    {
        parent::__construct($repository);
    }


}
