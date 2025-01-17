@extends('layouts.main')

@section('contenido')
    {{-- <link rel="stylesheet" href="{{ asset('css/forms.css') }}"> --}}

    <div class="card shadow">
        <div class="card-header">
            List of Métrics
        </div>
        <div class="card-body">
            <form id="reportForm" action="{{ route('listados.generar') }}" method='GET'>
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url"
                            placeholder="Ingrese la URL">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="category_id">Categories</label>
                        <select class="form-control categories-multiple" id="categories" name="categories[]" multiple>
                            {{-- <option value="">Select ...</option> --}}
                            @foreach ($categories as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="strategy_id">Strategy</label>
                        <select class="form-control" id="strategy_id" name="strategy_id">
                            <option value="">Select one ...</option>
                            @foreach ($strategies as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button id="submitInputs" class="btn btn-primary" type="submit">Get Metrics</button>
                    </div>
                </div>
            </form>

            <div class="form-row">
                <div class="form-group col-md-12">

                    <!-- Tabla -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Accessibility</th>
                                    <th>PWA</th>
                                    <th>SEO</th>
                                    <th>Performance</th>
                                    <th>Best practices</th>
                                    <th>strategy</th>
                                    <th>Date</th>
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
                                @if(empty($mhr))
                                    <td colspan="8">Sin datos a mostrar</td>
                                @endif
                            </tbody>
                        </table>
                        @if(!empty($mhr))
                            <div class="d-flex justify-content-center">
                                {!! $mhr->links('pagination::bootstrap-4') !!}
                            </div>
                        @endif
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
