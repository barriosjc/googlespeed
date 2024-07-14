@extends('layouts.main')

@section('contenido')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Get Metrics</h6>
        </div>
        <div class="card-body">
            <form id="metricsForm" action="{{ route('api.data') }}" novadate>
                @csrf

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Ingrese la URL" required>
                    <span id="urlErr" class="text-danger"></span>
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
                    <span id="cateErr" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="strategy">Strategies</label>
                    <select class="form-control" id="strategy" name="strategy" required>
                        <option value="">Select one ...</option>
                        @foreach ($strategies as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span id="straErr" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <button id="submitInputs" class="btn btn-primary" type="button">Get Metrics</button>
                </div>
            </form>

            <div id="resultsContainer" class="results-container"></div>
            <div id="opcionesMetricas" class="form-group" style="display:none">
                <button id="submitMetrics" class="btn btn-success" type="button">Save Metrics</button>
                <span id="saveMsg" class="text-danger" style="display:none">Se guardaron correctamente los datos en la base de datos.</span>
            </div>
        </div>
    </div>

    <script id="templmetrics" type="x-template">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1 t-metric-title">
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 t-metric-value-desc"></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info t-metric-value" role="progressbar"  ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script src="{{ asset('js/forms/inputs.js?v=01') }}"></script>
@endsection
