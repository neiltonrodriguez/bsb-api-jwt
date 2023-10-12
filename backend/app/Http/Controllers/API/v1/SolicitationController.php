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

class SolicitationController extends Controller
{
    public function index(Request $r)
    {
        $cli = $r->client;
        $bank = $r->bank_references;
        $person = $r->personal_references;
        $job = $r->job_information;
        $vehicle = $r->vehicle;
        $loan = $r->loan_request;
        $add = $r->address;



        try {
            $verifyCad = Client::where('email', '=', $cli["email"])->orWhere('CPF', '=', $cli["CPF"])->get();
            if(count($verifyCad) > 0){
                return response()->json(['error' => true, 'message' => 'já existe um cadastro com esse email ou cpf'], 500);
            }
            $client = new Client();
            $client->first_name = $cli["first_name"];
            $client->last_name = $cli["last_name"];
            $client->email = $cli["email"];
            $client->phone_a = $cli["phone_a"];
            $client->phone_b = $cli["phone_b"];
            $client->date_of_birth = $cli["date_of_birth"];
            $client->CPF = $cli["CPF"];
            $client->issuing_organization = $cli["issuing_organization"];
            $client->shipping_date = $cli["shipping_date"];
            $client->marital_status = $cli["marital_status"];
            $client->sex = $cli["sex"];
            $client->mother = $cli["mother"];
            $client->father = $cli["father"];
            $client->RG = $cli["RG"];
            $client->save();

            $addr = new Address();
            $addr->name = $r->address["name"];
            $addr->client_id = $client->id;
            $addr->neighborhood = $add["neighborhood"];
            $addr->complement = $add["complement"];
            $addr->city = $add["city"];
            $addr->number = $add["number"];
            $addr->zip_code = $add["zip_code"];
            $addr->UF = $add["UF"];
            $addr->type_of_residence = $add["type_of_residence"];
            $addr->resides_since = $add["resides_since"];
            $addr->save();

            foreach ($bank as $b) {
                $ba = new BankReference();
                $ba->client_id = $client->id;
                $ba->bank = $b["bank"];
                $ba->account = $b["account"];
                $ba->agency = $b["agency"];
                $ba->have_check = $b["have_check"];
                $ba->opening_date = $b["opening_date"];
                $ba->save();
            }
            foreach ($person as $p) {
                $pe = new PersonalReference();
                $pe->client_id = $client->id;
                $pe->name = $p["name"];
                $pe->phone = $p["phone"];
                $pe->kinship = $p["kinship"];
                $pe->save();
            }

            $j = new JobInformation();
            $j->client_id = $client->id;
            $j->job_category_id = $job["job_category_id"];
            $j->job_type_id = $job["job_type_id"];
            $j->job_bond_id = $job["job_bond_id"];
            $j->company = $job["company"];
            $j->admission_date = $job["admission_date"];
            $j->address = $job["address"];
            $j->neighborhood = $job["neighborhood"];
            $j->city = $job["city"];
            $j->zip_code = $job["zip_code"];
            $j->UF = $job["UF"];
            $j->office = $job["office"];
            $j->phone = $job["phone"];
            $j->gross_salary = $job["gross_salary"];
            $j->net_salary = $job["net_salary"];
            $j->registration = $job["registration"];
            $j->benefit_number = $job["benefit_number"];
            $j->ocupation = $job["ocupation"];
            $j->save();

            $vehicle_id = 0;
            if (isset($vehicle)) {
                $v = new Vehicle();
                $v->brand = $vehicle["brand"];
                $v->model = $vehicle["model"];
                $v->year = $vehicle["year"];
                $v->quantity_door = $vehicle["quantity_door"];
                $v->fuel = $vehicle["fuel"];
                $v->save();
                $vehicle_id = $v->id;
            }

            $l = new LoanRequest();
            $l->loan_type = $loan["loan_type"];
            $l->client_id = $client->id;
            $l->vehicle_id = $vehicle_id != 0 ? $vehicle_id : null;
            $l->value = $loan["value"];
            $l->installments = $loan["installments"];
            $l->description = $loan["description"];
            $l->save();

            return response()->json(['status' => true, 'message' => 'solicitação enviada com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
        // dd($add);
    }
}
