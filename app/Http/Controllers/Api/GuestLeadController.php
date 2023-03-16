<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\GuestLead;
use App\Mail\GuestContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class GuestLeadController extends Controller
{
    public function store(Request $request)
    {
        $form_data = $request->all();

        $validator = Validator::make($form_data, [
            "name" => "required",
            "surname" => "required",
            "email" => "required",
            "phone" => "required",
            "message" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors(),
            ]);
        }
        $newContact = new GuestLead();
        $newContact->fill($form_data);
        $newContact->save();

        Mail::to("info@boolpress.com")->send(new GuestContact($newContact));

        return response()->json([
            "success" => true
        ]);
    }
}
