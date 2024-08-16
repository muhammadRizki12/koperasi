@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Anggota') }}
                        <a href="{{ route('member.create') }}" class="btn btn-success btn-sm float-end">Tambah Data</a>
                    </div>

                    <div class="card-body">
                        {{-- Session --}}
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status')['message'] }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End Session --}}

                        {{-- Table --}}
                        <table class="table table-hover table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('member.show', $member->id) }}"
                                                class="badge text-bg-primary me-2">detail</a>
                                            <form action="{{ route('member.destroy', $member->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge text-bg-danger"
                                                    onclick="confirm('ya?')">Hapus</button>
                                            </form>
                                        </td>
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
@endsection
