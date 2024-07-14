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

document.addEventListener('DOMContentLoaded', function () {
    // const form = document.getElementById('metricsForm')[0];
    const submitBtn = document.getElementById('submitInputs');
    const submitMetrics = document.getElementById('submitMetrics');
    const token = document.querySelector('input[name="_token"]').value;

    submitBtn.addEventListener('click', function () {
        //validar ingreso de form
        var form = $('#metricsForm')[0];
        var urlInput = $('#url');
        var errorSpanUrl = $('#urlErr');
        var categoryCheckboxes = $('input[name="categories[]"]');
        var errorSpanCate = $('#cateErr');
        var strategySelect = $('#strategy');
        var errorSpanStra = $('#straErr');
        var hasCategorySelected = categoryCheckboxes.is(':checked');
        var hasStrategySelected = strategySelect.val() !== '';


        //validaciones
        var urlPattern = /^(https?:\/\/)/;
        if (!urlPattern.test(urlInput.val())) {
            errorSpanUrl.text('Por favor, ingrese una URL válida que comience con http:// o https://.');
            urlInput.addClass('is-invalid');
            return;
        } else {
            errorSpanUrl.text('');
            urlInput.removeClass('is-invalid');
        }

        // Validar las categorías
        if (!hasCategorySelected) {
            errorSpanCate.text('Por favor, seleccione al menos una categoría.');
            isValid = false;
        }

        // Validar la estrategia
        if (!hasStrategySelected) {
            strategySelect.addClass('is-invalid');
            errorSpanStra.text('Por favor, seleccione una estrategia.');
            isValid = false;
        } else {
            strategySelect.removeClass('is-invalid');
        }

        // Validar el formulario usando la API de Validación de Constraint de HTML5
        if (form.checkValidity() === false) {
            $(form).addClass('was-validated');
            return;
        }

        //bloqueo de form
        callBlockUI();
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
        urlPost = "/api/data"

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
                drawRectangles(data);
                $.unblockUI();
                document.getElementById('opcionesMetricas').setAttribute('style', '');
                btnSaveMetri = document.getElementById("submitMetrics");
                btnSaveMetri.setAttribute('style', '');
                msgSave = document.getElementById("saveMsg");
                msgSave.style.display = "none";
            })

            .catch((error) => {
                $.unblockUI();
                console.error('Error:', error);
            });
    });

    //guada los valores de metricas
    submitMetrics.addEventListener('click', function () {
        //validar ingreso de form
        //bloqueo de form
        callBlockUI();
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
                btnSaveMetri = document.getElementById("submitMetrics");
                btnSaveMetri.style.display = "none";
                msgSave = document.getElementById("saveMsg");
                msgSave.setAttribute('style', '');
            })

            .catch((error) => {
                console.error('Error:', error);
            });
    });

    function drawRectangles(data) {
        // console.log("entra a dibular");
        const resultsContainer = document.getElementById('resultsContainer');
        resultsContainer.innerHTML = '';

        if (data.hasOwnProperty("accessibility")) {
            item = data.accessibility;
            drawBox(item);
            metricsData.accessibility = item.score;
        };
        if (data.hasOwnProperty("pwa")) {
            item = data.pwa;
            drawBox(item);
            metricsData.pwa = item.score;
        };
        if (data.hasOwnProperty("seo")) {
            item = data.seo;
            drawBox(item);
            metricsData.seo = item.score;
        };
        if (data.hasOwnProperty("performance")) {
            item = data.performance;
            drawBox(item);
            metricsData.performance = item.score;
        };
        if (data.hasOwnProperty("best-practices")) {
            item = data["best-practices"];
            drawBox(item);
            metricsData.bestpractices = item.score;
        };
    }


    function drawBox(item) {
        var template = document.getElementById("templmetrics").innerHTML;
        // Crear un contenedor'
        const col = document.createElement('div');
        col.classList.add('col-md-2', 'mb-3');
        col.innerHTML = template

        col.getElementsByClassName("t-metric-title")[0].innerHTML = item.title;
        col.getElementsByClassName("t-metric-value-desc")[0].innerHTML = item.score;
        col.getElementsByClassName("t-metric-value")[0].setAttribute("style", "width:" + (item.score * 100) + "%");

        const resultsRow = document.querySelector('.results-row');

        // Verificar si ya existe un contenedor de 'row', si no, crear uno
        if (!resultsRow) {
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'results-row');
            document.getElementById('resultsContainer').appendChild(newRow);
        }

        // Añadir la tarjeta al contenedor de columna dentro de la fila
        const resultsContainer = document.querySelector('.results-row');
        resultsContainer.appendChild(col);
    }

    function callBlockUI() {
        $.blockUI.defaults.css = {};
        var messageHTML = `<div>
                                <h1><div class="lds-dual-ring"></div> Just a moment...</h1>
                            </div>`
        $.blockUI({ message: messageHTML });

    }
});
