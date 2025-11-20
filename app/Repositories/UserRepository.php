<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;


class UserRepository implements UserRepositoryInterface
{
   
    public function getAll(?string $search, ?int $limit, bool $execute)
    {
        $query = User::where(function ($query) use ($search) {
            if ($search) {
               $query->search($search);
            }
        });

        if($limit){
            $query->take($limit);
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search, ?int $rowsPerPage)
    {
        $query = $this->getAll(
            $search,
            null,
            false
        );

        return $query->paginate($rowsPerPage);
    }

    public function getById(string $id)
    {
        return User::where('id', $id)->first(); 
    }

    public function create(array $data){
        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), (int)$e->getCode());
        } 
    }
    
    public function update(
        string $id,
        array $data
    ){
        DB::beginTransaction();

        try {
            $user = User::find($id);
            $user->name = $data['name'];

            if(isset($data['password'])){
                $user->password = bcrypt($data['password']);
            }
           
            $user->save();
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), (int)$e->getCode());
        } 
    }

    public function delete(string $id){
        DB::beginTransaction();

        try {
            $user = User::find($id);

            $deletedData = $user->replicate();

            $user->delete();

            DB::commit();

            return $deletedData;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), (int)$e->getCode());
        } 
    }

}
