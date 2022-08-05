<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Users\StoreRequest;
use App\Repositories\UsersRepository;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;

class UsersController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $updateRequest = StoreRequest::class;
    protected ?string $route = 'admin.users.';
    protected ?string $view = 'admin.modules.users.';

    /**
     * UsersController constructor.
     * @param UsersRepository $repository
     */
    #[Pure]
    public function __construct(UsersRepository $repository)
    {
        parent::__construct($repository);
    }


}
