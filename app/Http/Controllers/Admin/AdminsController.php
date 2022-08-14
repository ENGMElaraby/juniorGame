<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Admins\StoreRequest;
use App\Http\Requests\Admin\Admins\UpdateRequest;
use App\Repositories\AdminsRepository;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;

class AdminsController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $updateRequest = UpdateRequest::class;
    protected ?string $route = 'admin.admins.';
    protected ?string $view = 'admin.modules.admins.';

    /**
     * UsersController constructor.
     * @param AdminsRepository $repository
     */
    #[Pure]
    public function __construct(AdminsRepository $repository)
    {
        parent::__construct($repository);
    }


}
