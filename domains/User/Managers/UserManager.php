<?php 

namespace Domains\User\Managers;
use Domains\User\Repositories\UserRepository;
use Freelabois\LaravelQuickstart\Extendables\ManipulationManager;
use Illuminate\Validation\Rule;

class UserManager extends ManipulationManager{

    protected $validation = [
        self::CREATE => [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ],
        self::EDIT => [
            
        ],
        self::CREATE_MESSAGE => [

        ],
        self::EDIT_MESSAGE => [

        ],
    ];

    public function __construct( UserRepository $userRepository){
        parent::__construct($userRepository);
    }

    
    public function storeOrUpdate($values, int $id = null, $relations = []){

        if($id){
            $this->validation[self::EDIT] = [
                    'name' => 'max:55',
                    'email' => [Rule::unique('users')->ignore($id)],
                    'password' => [Rule::unique('users')->ignore($id)]         
                ];
           
                return $this->persist($values, $id, []);
        }
        
        $this->validate($values, $id);

         $values['password'] = bcrypt($values['password']);
   
         return $this->persist($values, $id, []);
    }
    
}
