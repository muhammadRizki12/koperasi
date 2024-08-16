@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Detail Anggota') }}
                    </div>

                    <div class="card-body">
                        {{-- Session --}}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- End Session --}}

                        <form action="{{ route('member.update', $member->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $member->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ $member->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" name="address" class="form-control" cols="30" rows="3">{{ $member->address }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="date_of_birth">Tanggal Lahir</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                                    value="{{ $member->date_of_birth }}">
                            </div>

                            <div class="mb-3">
                                <label for="phone">Nomor Telephone</label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="{{ $member->phone }}">
                            </div>

                            <div class="mb-3">
                                <a href="{{ route('member.index') }}" class="btn btn-primary">Kembali</a>
                                <button type="submit" class="btn btn-success">Update</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
