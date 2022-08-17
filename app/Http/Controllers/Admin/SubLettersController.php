<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SubLetters\StoreRequest;
use App\Http\Requests\Admin\SubLetters\UpdateRequest;
use App\Repositories\SubLettersRepository;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;

class SubLettersController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $updateRequest = UpdateRequest::class;
    protected ?string $route = 'admin.sub-letters.';
    protected ?string $view = 'admin.modules.subletters.';

    /**
     * SubLettersController constructor.
     * @param SubLettersRepository $repository
     */
    #[Pure]
    public function __construct(SubLettersRepository $repository)
    {
        parent::__construct($repository);
    }


}
