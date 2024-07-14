@extends('layouts.main')

@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    <div class="card">
        <div class="card-header">
            Formulario de Métricas
        </div>
        <div class="card-body">
            <form id="reportForm" action="{{ route('listados.generar') }}" method='POST'>
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Ingrese la URL" >
                    </div>

                    <div class="form-group col-md-3">
                        <label for="category_id">Categorias</label>
                        <select class="form-control categories-multiple" id="categories" name="categories[]" multiple >
                            <option value="">Select one ...</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="strategy_id">Estrategias</label>
                        <select class="form-control" id="strategy_id" name="strategy_id" >
                            <option value="">Select one ...</option>
                            @foreach ($strategies as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button id="submitInputs" class="btn btn-primary" type="submit">Obtener Métricas</button>
                    </div>
                </div>
            </form>

            <div class="form-row">
                <div class="form-group col-md-12">

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>URL</th>
                    <th>Accesibilidad</th>
                    <th>PWA</th>
                    <th>SEO</th>
                    <th>Rendimiento</th>
                    <th>Mejores Prácticas</th>
                    <th>Estrategia</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mhr as $item)
                <tr>
                    <td>{{ $item->url }}</td>
                    <td>{{ $item->accessibility_metric }}</td>
                    <td>{{ $item->pwa_metric }}</td>
                    <td>{{ $item->seo_metric }}</td>
                    <td>{{ $item->performance_metric }}</td>
                    <td>{{ $item->best_practices_metric }}</td>
                    <td>{{ $item->strategy->name }}</td>
                    <td>{{ $item->datetime }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
                </div>
            </div>                     
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('.categories-multiple').select2();
        });
    </script>
@endsection
