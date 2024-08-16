@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Peminjaman') }}
                        <button type="button" class="btn btn-primary btn-sm float-end mx-2" data-bs-toggle="modal"
                            data-bs-target="#transaction">
                            Peminjaman
                        </button>
                    </div>

                    <div class="card-body">
                        {{-- Session --}}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- End Session --}}

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

    <!-- Modal transaksi -->
    <div class="modal fade" id="transaction" tabindex="-1" aria-labelledby="transactionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- Form --}}
                <form action="{{ route('loan.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="transactionLabel">Peminjaman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="description">Member</label>
                            <select class="form-select" name="user_id">
                                <option selected></option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->id . ' - ' . $member->name }}</option>
                                @endforeach
                                {{-- <option value="tarik">Tarik</option> --}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="desc">Deskripsi Peminjaman</label>
                            <input type="text" id="desc" name="desc" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="amount">Jumlah Pinjaman</label>
                            <input type="number" id="amount" name="amount" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="monthly_installment">Angsuran Bulanan</label>
                            <input type="number" id="monthly_installment" name="monthly_installment" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                {{-- End Form --}}
            </div>
        </div>
    </div>
    <!-- End Modal transaksi -->
@endsection
