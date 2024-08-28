document.addEventListener('DOMContentLoaded', () => {
    // Obliczenia są uruchamiane po kliknięciu przycisku "Oblicz"
});

function calculate() {
    const length = parseFloat(document.getElementById('length').value);
    const diameter = parseFloat(document.getElementById('diameter').value);
    
    if (isNaN(length) || length <= 0 || isNaN(diameter) || diameter <= 0) {
        alert('Wprowadź prawidłową długość przekątnej i średnicę.');
        return;
    }
    
    const a = length / Math.sqrt(3);
    const resultA = a.toFixed(3);
    const result2A = (2 * a).toFixed(2);
    const adjustedDiameter = (diameter + 20);

    const result = `Długość krawędzi sześcianu: ${resultA}\nDługość dłuższej przekątnej: ${result2A}`;
    
    const programText = `T000 (Zmień narzędzie);
M5;
G54:
M37;
G28 C0;
M303 S1500;
G0 X${adjustedDiameter}. Z-10;
G94;
G112;
G1 -Z10. F1000;
G41 G1;
X${result2A} C0.;
X${resultA} C-${length / 2};
X-${resultA} C-${length / 2};
X-${result2A} C0.
X-${resultA} C${length / 2};
X${resultA} C${length / 2};
X${result2A} C0.;
G40 X${adjustedDiameter}.;
G1 Z10 F1000;
G113;
G0 X230. Z100.;
M36;
G95;
M30;`;

    document.getElementById('result').textContent = result;
    document.getElementById('program-text').textContent = programText;
    document.getElementById('program-text').classList.remove('hidden');
}
