<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Helpers\FilesHelper;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class UsersRepository extends RepositoryCrud
{
    use FilesHelper;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    #[Pure]
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param User $user
     * @param string $device_token
     * @return void
     */
    final public static function updateDeviceToken(User $user, string $device_token): void
    {
        $user->update([
            'device_token' => $device_token
        ]);
    }

    /**
     * @return Authenticatable|null
     */
    final public function user(): ?Authenticatable
    {
        return auth()->user();
    }

    /**
     * @param array|int $usersIds
     * @return mixed
     */
    final public function getUsersNotIn(array|int $usersIds): mixed
    {
        return $this->model->whereNotIn('id', $usersIds)->get();
    }

    /**
     * @param array $data
     * @param $id
     * @return void
     */
    final public function update(array $data, $id): mixed
    {
        if ($id instanceof Model) {
            $model = $id;
        } else {
            $model = $this->find($id);
        }

        if (isset($data['image'])) {
            $data['photo'] = $this->fileUpload($data['image'], 'public/user');
        }
        $model->update($data);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        if (!isset($data['password'])) {
            $data['password'] = bcrypt('123456');
        }
        $this->model::create($data);
    }
}
