@extends('layouts.app')
@section('content')
<div id="slot-container">
    <h2>🎰 Slot Machine</h2>
    <p>Balance: <span id="balance">{{ auth()->user()->wallet->balance }}</span> EUR</p>
    <div id="slot-grid"></div>
    <div>
        Bet: <input type="number" id="bet" value="10" min="1">
        <button id="spin">Spin</button>
    </div>
    <p id="slot-result"></p>
</div>
<script src="{{ asset('js/wallet.js') }}"></script>
<script src="{{ asset('js/sounds.js') }}"></script>
<script src="{{ asset('js/slot.js') }}"></script>
@endsection
