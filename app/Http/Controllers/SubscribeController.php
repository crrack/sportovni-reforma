<?php

namespace App\Http\Controllers;

use App\Mail\SendBook;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    public function sendBook(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email'
        ])->validate();

        $email = $request->input('email');

        $body = array_merge($request->all(), ['campaign' => 'brožura']);

        $response = Http::post(
            env('ADMIN_URL') . 'api/contact/store',
            $body
        );

        try {

            Mail::to($email)->send(new SendBook());

            return ['status' => 'done'];

        } catch (\Exception $e) {

            return ['status' => 'fail'];
            
        }
    }
}
