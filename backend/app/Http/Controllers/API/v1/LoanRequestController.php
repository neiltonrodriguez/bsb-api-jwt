<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Client;
use App\Models\BankReference;
use App\Models\PersonalReference;
use App\Models\LoanRequest;
use App\Models\Vehicle;
use App\Models\JobInformation;

class LoanRequestController extends Controller
{
    public function getAll()
    {
        $return = [];

        try {
            $loan = LoanRequest::all();

            return response()->json(['status' => 'success', 'data' => $loan]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function getById($id)
    {
        $user = auth()->user();
        if ($user->profile_id == 1) {
            try {
                $return = [];
                $l = LoanRequest::find($id);
                $cli = Client::find($l->client_id);
                $add = Address::where('client_id', '=', $l->client_id)->first();
                $job = JobInformation::where('client_id', '=', $l->client_id)->first();
                $bank = BankReference::where('client_id', '=', $l->client_id)->get();
                $person = PersonalReference::where('client_id', '=', $l->client_id)->get();
                $return["loanrequest"] = $l;
                $return["client"] = $cli;
                $return["address"] = $add;
                $return["job_information"] = $job;
                $return["bank_references"] = $bank;
                $return["personal_references"] = $person;

                return response()->json(['status' => 'success', 'data' => $return]);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => true, 'message' => 'voce nao tme permissao para executar essa acao'], 500);
    }

    public function update(Request $r, $id)
    {
        $user = auth()->user();
        if ($user->profile_id == 1) {
            try {
                $loan = LoanRequest::find($id);
                $loan->loan_type = $r->loan_type;
                $loan->value = $r->value;
                $loan->installments = $r->installments;
                $loan->description = $r->description;

                if ($loan->save()) {
                    return response()->json(['status' => 'success', 'data' => $loan]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => true, 'message' => 'voce nao tme permissao para executar essa acao'], 500);
    }
}
