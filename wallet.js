let balance = parseFloat(document.getElementById('balance').textContent)||1000;
function updateBalance(){ document.getElementById('balance').textContent=balance.toFixed(2);}
function addBalance(a){ balance+=a; updateBalance();}
function deductBalance(a){ if(a>balance)return false; balance-=a; updateBalance(); return true;}
updateBalance();
