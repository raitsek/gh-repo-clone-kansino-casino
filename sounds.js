function playSound(file){
    const audio = new Audio(`assets/sounds/${file}`); audio.volume=0.5; audio.play();
}
