$payment = $mollie->payments->create([
    'amount' => ['currency'=>'EUR','value'=>number_format($amount,2,'.','')],
    'description'=>'CasinoWorld24 Deposit',
    'redirectUrl'=>route('deposit.success'),
    'webhookUrl'=>route('deposit.webhook'),
    'pfl_LthSU87hxD'=>env('MOLLIE_PROFILE'),
    'metadata'=>['user_id'=>auth()->id()]
]);
