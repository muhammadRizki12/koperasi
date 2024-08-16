@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Simpanan') }}

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
                        <div class="d-flex">
                            <div class="me-5">
                                <h5>Simpanan Pokok</h5>
                                <h5>Rp {{ number_format($total_principal_savings, 0, ',', '.') }}</h5>
                            </div>

                            <div class="me-5">
                                <h5>Simpanan Wajib</h5>
                                <h5>Rp {{ number_format($total_mandatory_savings, 0, ',', '.') }}</h5>
                            </div>

                            <div class="me-5">
                                <h5>Simpanan Sukarela</h5>
                                <h5>Rp {{ number_format($total_voluntary_savings, 0, ',', '.') }}</h5>
                            </div>

                            <div class="me-5">
                                <h5>Total Kas</h5>
                                <h5>Rp {{ number_format($total_amount, 0, ',', '.') }}</h5>
                            </div>
                        </div>

                        <table class="table table-hover text-center mt-3 border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($savings as $saving)
                                    <tr class="{{ $saving->description == 'tarik tunai' ? 'table-danger' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $saving->description }}</td>
                                        <td>{{ $saving->amount }}</td>
                                        <td>{{ $saving->savings_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
