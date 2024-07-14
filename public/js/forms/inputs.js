var metricsData = {
    url: "",
    strategy: "",
    accessibility: "",
    pwa: "",
    seo: "",
    performance: "",
    bestpractices: "",
    _token: ""
};

document.addEventListener('DOMContentLoaded', function () 
{
    const form = document.getElementById('metricsForm');
    const submitBtn = document.getElementById('submitInputs');
    const submitMetrics = document.getElementById('submitMetrics');
    const token = document.querySelector('input[name="_token"]').value;

    submitBtn.addEventListener('click', function () {
        //validar ingreso de form
        //bloqueo de form
        $.blockUI({ message: '<h1><img src="http://localhost:8000/img/loading.gif" style="width: 30px;" > Just a moment...</h1>' });
        const url = document.getElementById('url').value;
        const strategy = document.getElementById('strategy').value;
        const categories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
                                .map(checkbox => checkbox.value);

        const data = {
            url: url,
            strategy: strategy,
            categories: categories,
            _token: token
        };

        metricsData.url = url;
        metricsData.strategy = strategy;
        metricsData.token = token;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(response => 
            response.json())

        .then(data => {
            drawRectangles(data);
            $.unblockUI();
            document.getElementById('opcionesMetricas').setAttribute('style', '')
        })
        
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    //guada los valores de metricas
    submitMetrics.addEventListener('click', function () {
        //validar ingreso de form
        //bloqueo de form
        $.blockUI({ message: '<h1><img src="busy.gif" /> Just a moment...</h1>' });
        const url = document.getElementById('url').value;
        const strategy = document.getElementById('strategy').value;;
        const urlPost = "/metrics/save";

        const data = metricsData;

        fetch(urlPost, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(response => 
            response.json())

        .then(data => {
            console.log(data);
            $.unblockUI();
        })
        
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    function drawRectangles(data) {
        // console.log("entra a dibular");
        const resultsContainer = document.getElementById('resultsContainer');
        resultsContainer.innerHTML = ''; 
  
        if(data.hasOwnProperty("accessibility")) {
            item = data.accessibility;
            drawBox(item);
            metricsData.accessibility = item.score;
        };
        if(data.hasOwnProperty("pwa")) {
            item = data.pwa;
            drawBox(item);
            metricsData.pwa = item.score;
        };
        if(data.hasOwnProperty("seo")) {
            item = data.seo;
            drawBox(item);
            metricsData.seo = item.score;
        };
        if(data.hasOwnProperty("performance")) {
            item = data.performance;
            drawBox(item);
            metricsData.performance = item.score;
        };
        if(data.hasOwnProperty("best-practices")) {
            item = data["best-practices"];
            drawBox(item);
            metricsData.bestpractices = item.score;
        };
    } 


    function drawBox(item) {
        // Crear un contenedor para la tarjeta con clase Bootstrap 'col-md-2'
        const col = document.createElement('div');
        col.classList.add('col-md-2', 'mb-3');

        // Crear el contenedor de la tarjeta con clase Bootstrap 'card'
        const card = document.createElement('div');
        card.classList.add('card', 'text-center');
        card.style.width = '100%';

        // Crear el encabezado de la tarjeta con clase Bootstrap 'card-header'
        const cardHeader = document.createElement('div');
        cardHeader.classList.add('card-header');
        cardHeader.textContent = item.title;
        card.appendChild(cardHeader);

        // Crear el cuerpo de la tarjeta con clase Bootstrap 'card-body'
        const cardBody = document.createElement('div');
        cardBody.classList.add('card-body');
        card.appendChild(cardBody);

        // Crear el contenido del cuerpo de la tarjeta con clase Bootstrap 'card-title'
        const cardText = document.createElement('h3');
        cardText.classList.add('font-weight-bold', 'text-center', 'text-primary');
        cardText.style.fontWeight = 'bold';
        cardText.textContent = item.score;
        cardBody.appendChild(cardText);

        // Obtener el contenedor de resultados con clase 'row'
        const resultsRow = document.querySelector('.results-row');
        
        // Verificar si ya existe un contenedor de 'row', si no, crear uno
        if (!resultsRow) {
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'results-row');
            document.getElementById('resultsContainer').appendChild(newRow);
        }

        // Añadir la tarjeta al contenedor de columna dentro de la fila
        const resultsContainer = document.querySelector('.results-row');
        col.appendChild(card);
        resultsContainer.appendChild(col);
    }

    
});
