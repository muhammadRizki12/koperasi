@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Peminjaman') }}

                        {{-- Session --}}
                        @if (session('status'))
                            <div class="mt-3 alert alert-{{ session('status')['type'] }} alert-dismissible fade show"
                                role="alert">
                                {{ session('status')['message'] }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End Session --}}
                    </div>

                    <div class="card-body">

                        @foreach ($loans as $loan)
                            <div class="d-flex justify-content-between">
                                <strong>Peminjaman kode {{ $loan->id }} atas nama {{ $loan->member->name }} Tanggal
                                    {{ $loan->loan_date }}</strong>
                                <strong class="text-success">Total: {{ $loan->amount }}</strong>
                            </div>
                            <table class="table table-hover text-center mt-3 border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jumlah bayar</th>
                                        {{-- <th>Tanggal deadline</th> --}}
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($loan as $installment) --}}
                                    @for ($i = 1; $i <= $loan->monthly_installment; $i++)
                                        <tr>
                                            <td>Pembayaran {{ $i }}</td>
                                            <td>{{ $loan->amount / $loan->monthly_installment }}</td>
                                            {{-- <td>{{ $loan->installment->installment_date }}</td> --}}
                                            <td>`
                                                {{-- <button type="button" id="btn-status"
                                                    class="badge {{ $loan->installment->status == 'belum lunas' ? 'text-bg-danger' : 'text-bg-success' }}"
                                                    onclick="alert('ya?')">{{ $loan->installment->status }}
                                                </button> --}}
                                                <button type="button" class="btn btn-secondary toggle-button"
                                                    id="toggleButton" data-value="Active" data-bg-color="#6c757d">Belum
                                                    Lunas</button>


                                            </td>
                                        </tr>
                                    @endfor

                                    <tr>
                                        <td>Total</td>
                                        <td colspan="3">{{ $loan->amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
