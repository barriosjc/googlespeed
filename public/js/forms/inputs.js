var metricsData = {
    url: "",
    strategy: "",
    accesibility: "",
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
            metricsData.accesibility = item.score;
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
        const rectangle = document.createElement('div');
        rectangle.classList.add('rectangle');
        rectangle.style.width = '100px';
        rectangle.style.height = '100px';
        rectangle.style.border = '1px solid black';
        rectangle.style.display = 'inline-block';
        rectangle.style.margin = '10px';

        const value = document.createElement('div');
        value.textContent = item.title;
        rectangle.appendChild(value);

        const text = document.createElement('div');
        text.textContent = item.score;
        rectangle.appendChild(text);

        resultsContainer.appendChild(rectangle);
    }
});
