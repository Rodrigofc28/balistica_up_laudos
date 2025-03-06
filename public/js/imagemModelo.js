//codigo criado para dar zoom na imagem do modelo de arma

document.querySelectorAll(".container").forEach(container => {
    const imagem = container.querySelector(".imagemZoom");
    const zoomLupa = container.querySelector(".zoom-lupa");

    imagem.addEventListener("mousemove", function (e) {
        const { left, top, width, height } = imagem.getBoundingClientRect();
        const x = e.clientX - left;
        const y = e.clientY - top;

        // Define a imagem de fundo na lupa
        zoomLupa.style.backgroundImage = `url(${imagem.src})`;
        zoomLupa.style.backgroundSize = `${width * 2}px ${height * 2}px`;

        // Posiciona a lupa corretamente dentro do container
        zoomLupa.style.left = `${x - zoomLupa.offsetWidth / 2}px`;
        zoomLupa.style.top = `${y - zoomLupa.offsetHeight / 2}px`;
        zoomLupa.style.display = "block";

        // Ajusta a posição da imagem ampliada dentro da lupa
        const zoomFactor = 2; // Ajuste conforme o zoom desejado
        zoomLupa.style.backgroundPosition = `-${x * zoomFactor - zoomLupa.offsetWidth / 2}px -${y * zoomFactor - zoomLupa.offsetHeight / 2}px`;
    });

    imagem.addEventListener("mouseleave", function () {
        zoomLupa.style.display = "none";
    });
});