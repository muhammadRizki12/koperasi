@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Tambah Anggota') }}
                    </div>

                    <div class="card-body">
                        {{-- Session --}}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- End Session --}}

                        {{-- form input --}}
                        <form action="{{ route('member.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <div class="mb-3">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" name="address" class="form-control" cols="30" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="date_of_birth">Tanggal Lahir</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="phone">Nomor Telepon</label>
                                <input type="text" id="phone" name="phone" class="form-control">
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                    required>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Membayar Simpanan Pokok sebesar <b>RP 500.000</b>
                                </label>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
