@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Simpanan') }}
                        <button type="button" class="btn btn-success btn-sm float-end mx-2" data-bs-toggle="modal"
                            data-bs-target="#transaction">
                            Transaksi
                        </button>
                        {{-- Session --}}
                        @if (session('status'))
                            <div class="mt-3 alert alert-{{ session('status')['type'] }} alert-dismissible fade show"
                                role="alert">
                                {{ session('status')['message'] }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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




                        {{-- Table --}}
                        <table class="table table-hover text-center mt-3 border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jumlah bayar</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($savings as $saving)
                                    <tr class="{{ $saving->description == 'tarik tunai' ? 'table-danger' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $saving->member->name }}</td>
                                        <td>{{ $saving->member->email }}</td>
                                        <td>Rp {{ number_format($saving->amount, 0, ',', '.') }}</td>
                                        <td>{{ $saving->description }}</td>
                                        <td>{{ $saving->savings_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- End Table --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah data -->
    <div class="modal fade" id="transaction" tabindex="-1" aria-labelledby="transactionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- Form --}}
                <form action="{{ route('saving.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="transactionLabel">Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="description">Member</label>
                            <select class="form-select" name="user_id">
                                <option selected>-</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->id . ' - ' . $member->name }}</option>
                                @endforeach
                                {{-- <option value="tarik">Tarik</option> --}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description">Deskripsi</label>
                            <select class="form-select" id="transactionType" name="description">
                                <option selected>-</option>
                                <option value="simpanan wajib">Simpanan Wajib</option>
                                <option value="simpanan sukarela">Simpanan Sukarela</option>
                                <option value="tarik tunai">Tarik Tunai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount">Jumlah Bayar</label>
                            <input type="number" id="amount" name="amount" class="form-control">
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
@endsection
