<?php
namespace App\Services\SocialAuth;

use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str ;

class GoogleAuthService implements AuthServiceInterface
{
    public function findOrCreateUser($google_user)
    {
        $user_db = User::query()
            ->where('email', $google_user->email)
            ->first();
        if ($user_db) {
            if ($user_db->provider_id == $google_user->id) {
                return $user_db ; //redirect()->route('frontend.dashboard.setting.index');
            }else{
                 return null ; 
            }
        } else {
            $username = $this->generateUniqueUserName($google_user) ; 

            $user = User::create([
                'provider_id' => $google_user->id,
                'name' => $google_user->name,
                'username' => $username,
                'email' => $google_user->email,
                'password' => Hash::make($google_user->id),
                'email_verified_at' => now(),
                'image' => $google_user->avatar,
                'status' => 1,
            ]);
            if ($user) {
                return $user ; 
            }
        }
    }

    private function generateUniqueUserName($google_user)
    {
        $google_username_slug = Str::slug($google_user->name);
        $count = 1;
        $username = $google_username_slug;
        while (User::where('username', $username)->exists()) {
            $username =  $username . '-' . $count++;
        }
        return $username ; 
    }
}