document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('metricsForm');
    const submitBtn = document.getElementById('submitInputs');

    submitBtn.addEventListener('click', function () {
        const url = document.getElementById('url').value;
        const strategy = document.getElementById('strategy').value;
        const categories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
                                .map(checkbox => checkbox.value);
        const token = document.querySelector('input[name="_token"]').value;

        const data = {
            url: url,
            strategy: strategy,
            categories: categories,
            _token: token
        };

        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            // Aquí puedes manejar la respuesta de la solicitud
            
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});
