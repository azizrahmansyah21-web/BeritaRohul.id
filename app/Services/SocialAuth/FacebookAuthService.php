<?php
namespace App\Services\SocialAuth;

use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str ;

class FacebookAuthService implements AuthServiceInterface
{
    public function findOrCreateUser($facebook_user)
    {
        $user_db = User::query()
            ->where('email', $facebook_user->email)
            ->first();
        if ($user_db) {
            if ($user_db->provider_id == $facebook_user->id) {
                return $user_db ; //redirect()->route('frontend.dashboard.setting.index');
            }else{
                return null ; 
            }
        } else {
            $username = $this->generateUniqueUserName($facebook_user) ; 

            $user = User::create([
                'provider_id' => $facebook_user->id,
                'name' => $facebook_user->name,
                'username' => $username,
                'email' => $facebook_user->email,
                'password' => Hash::make($facebook_user->id),
                'email_verified_at' => now(),
                'image' => $facebook_user->avatar,
                'status' => 1,
            ]);
            if ($user) {
                return $user ; 
            }
        }
    }

    private function generateUniqueUserName($facebook_user)
    {
        $facebook_username_slug = Str::slug($facebook_user->name);
        $count = 1;
        $username = $facebook_username_slug;
        while (User::where('username', $username)->exists()) {
            $username =  $username . '-' . $count++;
        }
        return $username ; 
    }
}