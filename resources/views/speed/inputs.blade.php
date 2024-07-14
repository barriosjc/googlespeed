@extends('layouts.main')

@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <h2>Obtener Métricas</h2>
    {{-- <form action="{{ route('api.data') }}" method="POST"> --}}
        <form id="metricsForm"  action="{{ route('api.data') }}">
        @csrf
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" id="url" name="url" placeholder="Ingrese la URL" required>
        </div>

        <div class="checkbox-group">
            <label>Categorías</label>
            <div class="checkbox-container">
                @foreach ($categories as $item)
                    <div class="checkbox-item">
                        <input type="checkbox" name="categories[]" value="{{ $item->name }}">
                        <label>{{ $item->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="strategy">Estrategia</label>
            <select id="strategy" name="strategy" required>
                <option value="">Select one ...</option>
                @foreach ($strategies as $item)
                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button id="submitInputs" type="button">Obtener Métricas</button>
        </div>
    </form>

    <div id="resultsContainer" class="results-container"></div>
    <div id="opcionesMetricas"class="form-group" style="display:none">
        <button id="submitMetrics" type="button">Guardar métricas</button>
    </div>

    <script src="{{ asset('js/forms/inputs.js?v=01') }}"></script>
    
@endsection
