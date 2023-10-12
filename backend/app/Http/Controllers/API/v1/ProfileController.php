<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function create(Request $r)
    {
        $user = auth()->user();
        if ($user->profile_id == 1) {
            try {
                $profile = new Profile();
                $profile->name = $r->name;
                $profile->is_active = true;

                if ($profile->save()) {
                    return response()->json(['status' => 'success', 'data' => $profile]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => true, 'message' => 'voce nao tme permissao para executar essa acao'], 500);
    }

    public function getAll()
    {

        try {
            $profile = Profile::get();
            return response()->json(['status' => 'success', 'data' => $profile]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $r, $id)
    {
        $user = auth()->user();
        if ($user->profile_id == 1) {
            try {
                $profile = Profile::find($id);

                $profile->name = $r->name;
                $profile->is_active = $r->is_active;

                if ($profile->save()) {
                    return response()->json(['status' => 'success', 'data' => $profile]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => true, 'message' => 'voce nao tme permissao para executar essa acao'], 500);
    }

    public function getById($id)
    {
        try {
            $profile = Profile::find($id);
            return response()->json(['status' => 'success', 'data' => $profile]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $profile = Profile::find($id);
            $profile->delete();
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
