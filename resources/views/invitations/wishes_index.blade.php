@extends('layouts.app')

@section('content')
<style>
    .card-custom {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .invitation-item:hover {
        background-color: #f8f9fa;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h1 class="fs-3 mb-0">Ucapan & RSVP</h1>
            <p class="text-muted">Pilih undangan untuk melihat daftar ucapan dan RSVP tamu.</p>
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">Nama Undangan</th>
                        <th class="py-3">Tanggal Acara</th>
                        <th class="py-3 text-center">RSVP</th>
                        <th class="py-3 text-center">Ucapan</th>
                        <th class="pe-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invitations as $invitation)
                    <tr class="invitation-item">
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $invitation->title }}</div>
                            <div class="small text-muted">{{ $invitation->slug }}</div>
                        </td>
                        <td>
                            <div class="small text-dark">{{ $invitation->wedding_date->format('d M Y') }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">
                                {{ $invitation->guests_count }} Tamu
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">
                                {{ $invitation->wishes_count }} Ucapan
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('wishes.show', $invitation->id) }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                                <i class="ti ti-eye me-1"></i> Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/amber/no-messages.svg" alt="No Data" style="height: 150px;" class="mb-3">
                            <p class="text-muted">Belum ada data undangan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
