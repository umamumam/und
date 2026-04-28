@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-12">
        <div class="mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fs-3 mb-1">Manajemen Undangan</h1>
                <p>Daftar seluruh undangan pernikahan yang telah dibuat.</p>
                <div class="alert alert-light border small py-2 mt-2 mb-0" style="max-width: 400px;">
                    <i class="ti ti-info-circle text-primary"></i> 
                    <strong>Tips:</strong> Link tamu: <code>?to=Nama+Tamu</code>
                </div>
            </div>
            <a href="{{ route('invitations.create') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Undangan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">Judul Undangan</th>
                                <th class="px-4 py-3">Mempelai</th>
                                <th class="px-4 py-3">Tanggal Pernikahan</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invitations as $invitation)
                            <tr>
                                <td class="px-4">
                                    <div class="fw-bold">{{ $invitation->title }}</div>
                                    <small class="text-muted">Slug: {{ $invitation->slug }}</small>
                                </td>
                                <td class="px-4">
                                    {{ $invitation->coupleGroom->nickname ?? 'N/A' }} & {{ $invitation->coupleBride->nickname ?? 'N/A' }}
                                </td>
                                <td class="px-4">
                                    {{ $invitation->wedding_date->format('d M Y') }}
                                </td>
                                <td class="px-4">
                                    <span class="badge bg-success-subtle text-success">Aktif</span>
                                </td>
                                <td class="px-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="btn btn-sm btn-icon btn-outline-info rounded-circle" title="Lihat">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('invitations.edit', $invitation->id) }}" class="btn btn-sm btn-icon btn-outline-primary rounded-circle" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('invitations.destroy', $invitation->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger rounded-circle" title="Hapus">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($invitations->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="{{ asset('inapp/dist/assets/images/no-data.svg') }}" alt="" width="120" class="mb-3">
                                    <p class="text-muted">Belum ada data undangan.</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
