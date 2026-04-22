<?php 
namespace App\Interfaces ;
interface AuthServiceInterface
{
    public function findOrCreateUser($user) ; 
}