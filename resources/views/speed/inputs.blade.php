@extends('layouts.main')

@section('contenido')
    <div class="card">
        <div class="card-header">
            Get Métrics
        </div>
        <div class="card-body">
            <form id="metricsForm" action="{{ route('api.data') }}">
                @csrf

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Ingrese la URL" required>
                </div>

                <div class="form-group">
                    <label>Categories</label>
                    <div class="d-flex flex-wrap">
                        @foreach ($categories as $item)
                            <div class="form-check mr-3">
                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $item->name }}" id="category-{{ $item->id }}">
                                <label class="form-check-label" for="category-{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="strategy">Strategies</label>
                    <select class="form-control" id="strategy" name="strategy" required>
                        <option value="">Select one ...</option>
                        @foreach ($strategies as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button id="submitInputs" class="btn btn-primary" type="button">Get Métrics</button>
                </div>
            </form>

            <div id="resultsContainer" class="results-container"></div>
            <div id="opcionesMetricas" class="form-group" style="display:none">
                <button id="submitMetrics" class="btn btn-success" type="button">Save Métrics</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/forms/inputs.js?v=01') }}"></script>
@endsection
