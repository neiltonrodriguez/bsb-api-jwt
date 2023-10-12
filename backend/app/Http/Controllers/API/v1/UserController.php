<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $r) {
        
        try {
            $user = new User();
            $user->first_name = $r->first_name;
            $user->last_name = $r->last_name;
            $user->login = $r->login;
            $user->email = $r->email;
            $user->phone_a = $r->phone_a;
            $user->phone_b = $r->phone_b;
            $user->commission = $r->commission;
            $user->password = bcrypt($r->password);
            // $user->email_verified_at = now();
            $profile_id = 1;
            if (isset($r->profile_id)) {
                $profile_id = $r->profile_id;
            }
            $user->profile_id = $profile_id;
            $is_active = false;
            if ($r->is_active) {
                $is_active = true;
            }
            $user->is_active = $is_active;
           
            if ($user->save()) {
                return response()->json(['status' => 'success', $user]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
        
    }
}
