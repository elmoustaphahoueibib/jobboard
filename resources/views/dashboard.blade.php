@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0"></h3>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="id">#</th>
                            <th scope="col" class="sort" data-sort="budget">Commune</th>
                            <th scope="col" class="sort" data-sort="status">Nombre de personnes</th>
                            <th scope="col" class="sort" data-sort="nombre">Nombre de Pré-Qualifiés</th>
                            <th scope="col" class="sort" data-sort="completion">Nombre des Qualifiés</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        @if(count($data) > 0)
                        <tbody class="list">
                            @foreach($data as $row)
                            <tr>
                               <th scope="col" class="sort" data-sort="name">
                                   {{ $row->commune_id }}
                               </th>
                                <th scope="col" class="sort" data-sort="budget">
                                    {{ $row->  }}
                                </th>tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-5">

        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
