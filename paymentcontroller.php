<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use Auth;

class PaymentController extends Controller
{
    public function deposit(Request $request)
    {
        $amount = $request->input('amount', 10);

        $mollie = new MollieApiClient();
        $mollie->setApiKey('live_PCyjmRbqSBMg8xkSHsuKMUpcaCSdSW');

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($amount, 2, '.', '')
            ],
            "description" => "CasinoWorld24 Deposit",
            "redirectUrl" => route('deposit.success'),
            "webhookUrl" => route('deposit.webhook'),
            "profileId" => "pfl_LthSU87hxD",
        ]);

        return redirect($payment->getCheckoutUrl());
    }

    public function webhook(Request $request)
    {
        $paymentId = $request->input('id');
        $mollie = new MollieApiClient();
        $mollie->setApiKey('live_PCyjmRbqSBMg8xkSHsuKMUpcaCSdSW');
        $payment = $mollie->payments->get($paymentId);

        if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
            $user = Auth::user();
            $user->wallet->balance += $payment->amount->value;
            $user->wallet->save();
        }

        return response('OK', 200);
    }

    public function success()
    {
        return view('payment.success');
    }
}


<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use Auth;

class PaymentController extends Controller
{
    public function deposit(Request $request)
    {
        $amount = $request->input('amount', 10);

        $mollie = new MollieApiClient();
        $mollie->setApiKey('live_PCyjmRbqSBMg8xkSHsuKMUpcaCSdSW');

        $payment = $mollie->payments->create([
            "amount" => ["currency" => "EUR", "value" => number_format($amount, 2, '.', '')],
            "description" => "CasinoWorld24 Deposit",
            "redirectUrl" => route('deposit.success'),
            "webhookUrl" => route('deposit.webhook'),
            "profileId" => "pfl_LthSU87hxD",
        ]);

        return redirect($payment->getCheckoutUrl());
    }

    public function webhook(Request $request)
    {
        $paymentId = $request->input('id');
        $mollie = new MollieApiClient();
        $mollie->setApiKey('live_PCyjmRbqSBMg8xkSHsuKMUpcaCSdSW');

        $payment = $mollie->payments->get($paymentId);
        if ($payment->isPaid()) {
            $user = Auth::user();
            $user->wallet->balance += $payment->amount->value;
            $user->wallet->save();
        }

        return response('OK', 200);
    }

    public function success() { return view('payment.success'); }
}
