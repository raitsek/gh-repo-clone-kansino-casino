use Mollie\Api\MollieApiClient;

Route::get('/deposit', function () {
    $mollie = new MollieApiClient();
    $mollie->setApiKey("live_PCyjmRbqSBMg8xkSHsuKMUpcaCSdSW");

    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "10.00"
        ],
        "description" => "CasinoWorld24 Deposit",
        "redirectUrl" => url('/deposit/success'),
        "webhookUrl" => url('/deposit/webhook'),
        "method" => "ideal",
    ]);

    return redirect($payment->getCheckoutUrl());
});

Route::get('/deposit/success', function () {
    return "Deposit successful ✅ (update balance here)";
});

Route::post('/deposit/webhook', function (Illuminate\Http\Request $request) {
    // Verify payment status with Mollie API
    return response('OK');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/deposit', [PaymentController::class,'deposit'])->name('deposit');
    Route::post('/deposit/webhook', [PaymentController::class,'webhook'])->name('deposit.webhook');
    Route::get('/deposit/success', [PaymentController::class,'success'])->name('deposit.success');
});


<a href="/deposit">💳 Deposit €10</a>
    'profileid'=>env('MOLLIE_PROFILE'),

    

    <a href="https://payment-links.mollie.com/payment/VazBeMUjSXPWgWbHDLtYK/">Deposit</a>