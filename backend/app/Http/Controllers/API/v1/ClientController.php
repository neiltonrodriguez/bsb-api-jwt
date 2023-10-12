<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Address;
use App\Models\JobInformation;
use App\Models\BankReference;
use App\Models\PersonalReference;
use App\Models\LoanRequest;
use App\Models\Vehicle;


class ClientController extends Controller
{
    public function getAll()
    {
        try {
            $clients = Client::all();
            return response()->json(['status' => 'success', 'count' => $clients->count(), 'data' => $clients]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $r, $id)
    {
        $user = auth()->user();
        if ($user->profile_id == 1) {
            try {
                $cli = Client::find($id);
                // dd($r);
                $cli->first_name = $r->first_name;
                $cli->last_name = $r->last_name;
                $cli->phone_a = $r->phone_a;
                $cli->phone_b = $r->phone_b;
                $cli->date_of_birth = $r->date_of_birth;
                $cli->issuing_organization = $r->issuing_organization;
                $cli->shipping_date = $r->shipping_date;
                $cli->marital_status = $r->marital_status;
                $cli->sex = $r->sex;
                $cli->mother = $r->mother;
                $cli->father = $r->father;
                $cli->RG = $r->RG;

                if ($cli->save()) {
                    return response()->json(['status' => 'success', 'data' => $cli]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => true, 'message' => 'voce nao tme permissao para executar essa acao'], 500);
    }

    public function getById($id)
    {
        $user = auth()->user();
        if ($user->profile_id == 1) {
            try {
                $cli = Client::find($id);
                return response()->json(['status' => 'success', 'data' => $cli]);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => true, 'message' => 'voce nao tme permissao para executar essa acao'], 500);
    }

    public function delete($id)
    {
        try {
            $address = Address::where('client_id', '=', $id);
            $address->delete();

            $bank = BankReference::where('client_id', '=', $id);
            if (isset($bank)) {
                $bank->delete();
            }

            $person = PersonalReference::where('client_id', '=', $id);
            if (isset($person)) {
                $person->delete();
            }

            $loan = LoanRequest::where('client_id', '=', $id);
            if (isset($loan)) {
                $v = $loan->get();
                $loan->delete();
                if (isset($v)) {
                    $ve = Vehicle::find($v[0]["vehicle_id"]);
                    $ve->delete();
                }
            }

            $job = JobInformation::where('client_id', '=', $id);
            if (isset($job)) {
                $job->delete();
            }

            $client = Client::find($id);
            if (isset($client)) {
                $client->delete();
            }
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
