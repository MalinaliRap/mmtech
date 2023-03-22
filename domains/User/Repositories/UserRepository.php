<?php 

namespace Domains\User\Repositories;
use Freelabois\LaravelQuickstart\Extendables\Repository;
use Domains\User\Models\User;

class UserRepository extends Repository{

    protected $model = User::class;

}
