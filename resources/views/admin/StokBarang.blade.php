@extends('admin.componen.app')
@section('content')
    <div class="container my-3">
        <div class="card">

            <div class="card-body">


                {{ $dataTable->table() }}

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
