const symbols = [
    { name:"Cherry", file:"cherry.png", mult:2 },
    { name:"Bell", file:"bell.png", mult:2.5 },
    { name:"Star", file:"star.png", mult:3 },
    { name:"Diamond", file:"diamond.png", mult:5 },
    { name:"Seven", file:"seven.png", mult:10 }
];

function spinSlot() {
    playSound('spin.mp3');
    const bet = parseFloat(document.getElementById('bet').value) || 1;
    if (!deductBalance(bet)) { playSound('lose.mp3'); return; }

    const grid = [];
    for (let i=0; i<144; i++) { grid.push(symbols[Math.floor(Math.random()*symbols.length)]); }

    const container = document.getElementById('slot-grid');
    container.innerHTML='';
    grid.forEach(s=>{
        const cell = document.createElement('div'); cell.className='cell';
        const img = document.createElement('img'); img.src=`assets/symbols/${s.file}`;
        img.style.width='40px'; img.style.height='40px'; cell.appendChild(img);
        container.appendChild(cell);
    });

    const payout = evaluate(grid, bet);
    if(payout>0){ addBalance(payout); playSound('win.mp3'); }
    document.getElementById('slot-result').textContent=`${payout>0?'WIN: ':'Lose'}${payout.toFixed(2)}`;
}

function evaluate(arr, bet){
    let total=0;
    // Example: simple row/column match 3+ logic
    for(let r=0;r<12;r++){
        for(let c=0;c<10;c++){
            let s=arr[r*12+c];
            if(s===arr[r*12+c+1] && s===arr[r*12+c+2]) total+=s.mult*bet;
        }
    }
    return total;
}

document.getElementById('spin').addEventListener('click', spinSlot);
