function Grafica(){
    src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"

    var barColors = ["red", "green","blue","yellow", "orange", "purple", "pink", "maroon", "aqua", "lime"];


    (async () => {
        const respuestaRaw = await fetch("./backend/exitencias.php");
        const respuesta = await respuestaRaw.json();
        const $mychart = document.querySelector("#mychart");
        const categoria = respuesta.categoria; 
        const datos = respuesta.datos;
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: categoria,
                datasets: [{
                backgroundColor: barColors,
                data: datos
                }]
            },
            options: {
                legend: {display: false},
                title: {
                display: true,
                text: "Productos existentes por categoria"
                }
            }
            });
    })();
}
