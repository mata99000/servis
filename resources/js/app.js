import './bootstrap';

 document.addEventListener('livewire:load', function () {
    Livewire.on('fileUploading', () => {
        const loadingProgress = document.getElementById('loadingProgress');
        loadingProgress.style.width = "0%";
        loadingProgress.textContent = "Učitavanje...";

        // Ovo je samo ilustracija, potrebno je pravo praćenje napretka
        let progress = 0;
        const interval = setInterval(() => {
            progress += 20; // Povećajte za realističniji napredak
            loadingProgress.style.width = `${progress}%`;
            if(progress >= 100) {
                clearInterval(interval);
                loadingProgress.textContent = "Upload uspešan"; // Poruka kada je završeno
                loadingProgress.style.background = "green"; // Promenite u zeleno
            }
        }, 500);
    });
});
