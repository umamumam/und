@extends('layouts.app')

@section('content')
<style>
    .nav-tabs-custom {
        border-bottom: 2px solid #f1f1f1;
        gap: 20px;
    }

    .nav-tabs-custom .nav-link {
        border: none;
        color: #666;
        padding: 10px 0;
        font-weight: 500;
        position: relative;
        background: transparent;
    }

    .nav-tabs-custom .nav-link.active {
        color: #e63946;
        background: transparent;
    }

    .nav-tabs-custom .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #e63946;
    }

    .card-edit {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .form-section-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        color: #333;
    }

    /* Gallery Styles */
    .gallery-img-wrapper:hover img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-img-wrapper:hover .gallery-overlay {
        opacity: 1;
    }

    .delete-gallery-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('invitations.index') }}">Kelola Undangan</a></li>
                        <li class="breadcrumb-item active">Edit Undangan</li>
                    </ol>
                </nav>
                <h1 class="fs-3 mb-0">Edit Undangan</h1>
                <p class="text-muted">Konfigurasi detail untuk undangan: {{ $invitation->title }}</p>
            </div>
            <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank"
                class="btn btn-outline-dark rounded-pill px-4">
                <i class="ti ti-external-link me-1"></i> Preview Tema
            </a>
        </div>
    </div>
</div>

<div class="card card-edit">
    <div class="card-body p-4">
        <!-- TABS HEADER -->
        <ul class="nav nav-tabs nav-tabs-custom mb-4" id="editInvitationTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="base-tab" data-bs-toggle="tab" data-bs-target="#base" type="button"
                    role="tab">
                    <i class="ti ti-settings me-1"></i> Informasi Dasar
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="couple-tab" data-bs-toggle="tab" data-bs-target="#couple" type="button"
                    role="tab">
                    <i class="ti ti-users me-1"></i> Data Mempelai
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button"
                    role="tab">
                    <i class="ti ti-calendar me-1"></i> Jadwal Acara
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="story-tab" data-bs-toggle="tab" data-bs-target="#story" type="button"
                    role="tab">
                    <i class="ti ti-book me-1"></i> Kisah Cinta
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button"
                    role="tab">
                    <i class="ti ti-photo me-1"></i> Galeri Foto
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="gift-tab" data-bs-toggle="tab" data-bs-target="#gift" type="button"
                    role="tab">
                    <i class="ti ti-gift me-1"></i> Hadiah (Gifts)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="guest-tab" data-bs-toggle="tab" data-bs-target="#guests" type="button"
                    role="tab">
                    <i class="ti ti-mail-opened me-1"></i> Link Undangan & RSVP
                </button>
            </li>
        </ul>

        <!-- TABS CONTENT -->
        <form action="{{ route('invitations.update', $invitation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="tab-content" id="editInvitationTabsContent">
                <!-- TAB 1: INFORMASI DASAR -->
                <div class="tab-pane fade show active" id="base" role="tabpanel">
                    <h4 class="form-section-title">Informasi Dasar</h4>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Acara</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $invitation->title }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Link Undangan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">domain.com/</span>
                                <input type="text" name="slug" id="slug" class="form-control border-start-0"
                                    value="{{ $invitation->slug }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Acara</label>
                            <input type="datetime-local" name="wedding_date" class="form-control"
                                value="{{ $invitation->wedding_date->format('Y-m-d\TH:i') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Musik Latar (Link MP3)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-music"></i></span>
                                <input type="text" name="bg_music" class="form-control"
                                    value="{{ $invitation->bg_music }}" placeholder="https://...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Foto Cover / Sampul</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text bg-light"><i class="ti ti-link"></i></span>
                                        <input type="text" name="cover_photo" class="form-control"
                                            value="{{ $invitation->cover_photo }}"
                                            placeholder="https://... (Gunakan Link)">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="ti ti-upload"></i></span>
                                        <input type="file" name="cover_photo_file" class="form-control">
                                    </div>
                                    <small class="text-muted">Pilih salah satu: Masukkan link atau upload file.</small>
                                </div>
                                <div class="col-md-4">
                                    @if($invitation->cover_photo)
                                    <img src="{{ Str::startsWith($invitation->cover_photo, 'http') ? $invitation->cover_photo : asset('storage/' . $invitation->cover_photo) }}"
                                        class="img-thumbnail" style="max-height: 100px;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Link Live Streaming (Opsional)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-video"></i></span>
                                <input type="text" name="live_streaming_url" class="form-control"
                                    value="{{ $invitation->live_streaming_url }}" placeholder="https://...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dress Code (Opsional)</label>
                            <input type="text" name="dress_code" class="form-control"
                                value="{{ $invitation->dress_code }}"
                                placeholder="Contoh: Batik / Pakaian Bebas & Rapi">
                        </div>
                        <div class="col-12">
                            <h5 class="mt-3 mb-2">Quote / Kata Mutiara</h5>
                            <div class="mb-2">
                                <label class="form-label small">Isi Quote</label>
                                <textarea name="quote_verse" class="form-control"
                                    rows="2">{{ $invitation->quote_verse }}</textarea>
                            </div>
                            <div>
                                <label class="form-label small">Sumber (Contoh: Ar-Rum 21)</label>
                                <input type="text" name="quote_source" class="form-control"
                                    value="{{ $invitation->quote_source }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: DATA MEMPELAI -->
                <div class="tab-pane fade" id="couple" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h4 class="form-section-title">Mempelai Pria</h4>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="groom_full_name" class="form-control"
                                    value="{{ $groom->full_name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Panggilan</label>
                                <input type="text" name="groom_nickname" class="form-control"
                                    value="{{ $groom->nickname ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="groom_father" class="form-control"
                                    value="{{ $groom->father_name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="groom_mother" class="form-control"
                                    value="{{ $groom->mother_name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Anak Ke- (Contoh: Putra Pertama)</label>
                                <input type="text" name="groom_child_order" class="form-control"
                                    value="{{ $groom->child_order ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Instagram Username</label>
                                <input type="text" name="groom_instagram" class="form-control"
                                    value="{{ $groom->instagram_username ?? '' }}" placeholder="@username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat (Opsional)</label>
                                <input type="text" name="groom_address" class="form-control"
                                    value="{{ $groom->address ?? '' }}" placeholder="Contoh: Pati">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Mempelai Pria</label>
                                <input type="file" name="groom_photo" class="form-control mb-2">
                                @if($groom && $groom->photo)
                                <div>
                                    <img src="{{ Str::startsWith($groom->photo, 'http') ? $groom->photo : asset('storage/' . $groom->photo) }}"
                                        class="img-thumbnail" style="max-height: 100px;">
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="delete_groom_photo"
                                            value="1" id="delGroomPhoto">
                                        <label class="form-check-label small text-danger" for="delGroomPhoto">Hapus
                                            Foto</label>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="form-section-title">Mempelai Wanita</h4>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="bride_full_name" class="form-control"
                                    value="{{ $bride->full_name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Panggilan</label>
                                <input type="text" name="bride_nickname" class="form-control"
                                    value="{{ $bride->nickname ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="bride_father" class="form-control"
                                    value="{{ $bride->father_name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="bride_mother" class="form-control"
                                    value="{{ $bride->mother_name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Anak Ke- (Contoh: Putri Kedua)</label>
                                <input type="text" name="bride_child_order" class="form-control"
                                    value="{{ $bride->child_order ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Instagram Username</label>
                                <input type="text" name="bride_instagram" class="form-control"
                                    value="{{ $bride->instagram_username ?? '' }}" placeholder="@username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat (Opsional)</label>
                                <input type="text" name="bride_address" class="form-control"
                                    value="{{ $bride->address ?? '' }}" placeholder="Contoh: Pekalongan">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Mempelai Wanita</label>
                                <input type="file" name="bride_photo" class="form-control mb-2">
                                @if($bride && $bride->photo)
                                <div>
                                    <img src="{{ Str::startsWith($bride->photo, 'http') ? $bride->photo : asset('storage/' . $bride->photo) }}"
                                        class="img-thumbnail" style="max-height: 100px;">
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="delete_bride_photo"
                                            value="1" id="delBridePhoto">
                                        <label class="form-check-label small text-danger" for="delBridePhoto">Hapus
                                            Foto</label>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="event" role="tabpanel">
                    <h4 class="form-section-title">Jadwal Acara</h4>
                    <div id="events-container">
                        @foreach($invitation->events as $index => $event)
                        <div class="border rounded p-3 mb-3 bg-light bg-opacity-25 event-row">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Detail Acara</h5>
                                <div class="delete-action">
                                    <label class="btn btn-sm btn-outline-danger rounded-3 delete-item-btn">
                                        <input type="checkbox" name="delete_events[]" value="{{ $event->id }}"
                                            class="d-none delete-item-checkbox">
                                        <i class="ti ti-trash"></i> Hapus
                                    </label>
                                </div>
                            </div>
                            <div class="row g-3">
                                <input type="hidden" name="events[{{ $index }}][id]" value="{{ $event->id }}">
                                <div class="col-md-4">
                                    <label class="form-label">Tipe Acara</label>
                                    <input type="text" name="events[{{ $index }}][type]" class="form-control"
                                        value="{{ $event->type }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="events[{{ $index }}][date]" class="form-control"
                                        value="{{ $event->date->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Waktu</label>
                                    <input type="text" name="events[{{ $index }}][start_time]" class="form-control"
                                        value="{{ $event->start_time }}" placeholder="08.00 WIB">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nama Lokasi</label>
                                    <input type="text" name="events[{{ $index }}][location_name]" class="form-control"
                                        value="{{ $event->location_name }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="events[{{ $index }}][location_address]"
                                        class="form-control" value="{{ $event->location_address }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Link Google Maps</label>
                                    <input type="text" name="events[{{ $index }}][google_maps_url]" class="form-control"
                                        value="{{ $event->google_maps_url }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-event-btn" class="btn btn-outline-primary btn-sm mt-2"><i
                            class="ti ti-plus"></i> Tambah Acara</button>
                </div>

                <div class="tab-pane fade" id="story" role="tabpanel">
                    <h4 class="form-section-title">Kisah Cinta</h4>
                    <div id="stories-container">
                        @foreach($invitation->loveStories as $index => $story)
                        <div class="border rounded p-3 mb-3 story-row">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Detail Kisah</h5>
                                <div class="delete-action">
                                    <label class="btn btn-sm btn-outline-danger rounded-3 delete-item-btn">
                                        <input type="checkbox" name="delete_stories[]" value="{{ $story->id }}"
                                            class="d-none delete-item-checkbox">
                                        <i class="ti ti-trash"></i> Hapus
                                    </label>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label">Tahun</label>
                                    <input type="text" name="stories[{{ $index }}][year]" class="form-control"
                                        value="{{ $story->year }}">
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Judul Cerita</label>
                                    <input type="text" name="stories[{{ $index }}][title]" class="form-control"
                                        value="{{ $story->title }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Isi Kisah</label>
                                    <textarea name="stories[{{ $index }}][story]" class="form-control"
                                        rows="3">{{ $story->story }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Foto Kisah (Link atau Upload)</label>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <input type="text" name="stories[{{ $index }}][image]"
                                                class="form-control mb-2" value="{{ $story->image }}"
                                                placeholder="Link Foto...">
                                            <input type="file" name="stories[{{ $index }}][image_file]"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 text-center">
                                            @if($story->image)
                                            <img src="{{ Str::startsWith($story->image, 'http') ? $story->image : asset('storage/' . $story->image) }}"
                                                class="img-thumbnail" style="max-height: 80px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="stories[{{ $index }}][id]" value="{{ $story->id }}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-story-btn" class="btn btn-outline-primary btn-sm"><i
                            class="ti ti-plus"></i> Tambah Kisah</button>
                </div>

                <!-- TAB 5: GALERI FOTO -->
                <div class="tab-pane fade" id="gallery" role="tabpanel">
                    <h4 class="form-section-title">Galeri Foto</h4>
                    <div class="mb-4">
                        <label class="form-label">Upload Foto Baru</label>
                        <input type="file" name="gallery_files[]" class="form-control" multiple>
                        <small class="text-muted">Bisa pilih banyak foto sekaligus.</small>
                    </div>
                    <div class="row g-3">
                        @foreach($invitation->galleries as $item)
                        <div class="col-6 col-md-4 mb-4 gallery-item-container">
                            <div
                                class="position-relative overflow-hidden rounded-3 shadow-sm border gallery-img-wrapper">
                                <img src="{{ Str::startsWith($item->url, 'http') ? $item->url : asset('storage/' . $item->url) }}"
                                    class="w-100"
                                    style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">

                                <div class="gallery-overlay">
                                    <button type="button" class="btn btn-danger btn-sm rounded-3 delete-gallery-btn"
                                        data-id="{{ $item->id }}">
                                        <i class="ti ti-trash fs-5"></i>
                                    </button>
                                </div>

                                <!-- Hidden checkbox to mark for deletion -->
                                <input type="checkbox" name="delete_galleries[]" value="{{ $item->id }}"
                                    class="d-none delete-gallery-checkbox" id="del-gal-{{ $item->id }}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="gift" role="tabpanel">
                    <h4 class="form-section-title">Rekening / Kado Digital</h4>
                    <div id="gifts-container">
                        @foreach($invitation->gifts as $index => $gift)
                        <div class="border rounded p-3 mb-3 gift-row">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Detail Rekening</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="delete_gifts[]"
                                        value="{{ $gift->id }}">
                                    <label class="form-check-label text-danger small">Hapus</label>
                                </div>
                            </div>
                            <div class="row g-3">
                                <input type="hidden" name="gifts[{{ $index }}][id]" value="{{ $gift->id }}">
                                <div class="col-md-4">
                                    <label class="form-label">Bank / Provider</label>
                                    <input type="text" name="gifts[{{ $index }}][bank_name]" class="form-control"
                                        value="{{ $gift->bank_name }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" name="gifts[{{ $index }}][account_name]" class="form-control"
                                        value="{{ $gift->account_name }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nomor Rekening</label>
                                    <input type="text" name="gifts[{{ $index }}][account_number]" class="form-control"
                                        value="{{ $gift->account_number }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-gift-btn" class="btn btn-outline-primary btn-sm"><i
                            class="ti ti-plus"></i> Tambah Rekening</button>
                </div>
                <!-- TAB 7: DAFTAR TAMU & RSVP -->
                <div class="tab-pane fade" id="guests" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="form-section-title mb-0">Daftar Tamu & Link Undangan</h4>
                        <button type="button" id="add-guest-btn" class="btn btn-primary btn-sm rounded-pill px-3"><i
                                class="ti ti-plus"></i> Tambah Tamu</button>
                    </div>

                    <div class="alert alert-info border-0 bg-light-primary text-primary small mb-4">
                        <i class="ti ti-info-circle me-1"></i>
                        Tamu yang Anda tambahkan di sini akan memiliki link khusus. Status RSVP akan terupdate otomatis
                        jika mereka mengisi form di undangan.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle border-top">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 250px;">Nama Tamu</th>
                                    <th>Link Khusus (Klik untuk copy)</th>
                                    <th>Status RSVP</th>
                                    <th style="width: 50px;">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="guests-container">
                                @foreach($invitation->guests as $index => $guest)
                                <tr class="guest-row">
                                    <td>
                                        <input type="hidden" name="guests[{{ $index }}][id]" value="{{ $guest->id }}">
                                        <input type="text" name="guests[{{ $index }}][name]"
                                            class="form-control form-control-sm border-0 bg-light"
                                            value="{{ $guest->name }}" placeholder="Nama Tamu">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="text"
                                                class="form-control border-0 bg-light-subtle guest-link-input" readonly
                                                value="{{ route('invitation.show', $invitation->slug) }}?to={{ urlencode($guest->name) }}">
                                            <button class="btn btn-outline-secondary border-0 copy-link" type="button"
                                                title="Copy Link"><i class="ti ti-copy"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        @if($guest->attendance == 'hadir')
                                        <span class="badge bg-success-subtle text-success">Hadir ({{ $guest->guest_count
                                            }})</span>
                                        @elseif($guest->attendance == 'tidak_hadir')
                                        <span class="badge bg-danger-subtle text-danger">Tidak Hadir</span>
                                        @elseif($guest->attendance == 'ragu_ragu')
                                        <span class="badge bg-warning-subtle text-warning">Ragu-ragu</span>
                                        @else
                                        <span class="badge bg-light text-muted">Belum Konfirmasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="delete_guests[]"
                                                value="{{ $guest->id }}">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-5 border-top pt-4 text-end">
                <button type="submit" class="btn btn-primary px-5 rounded-pill">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Event
        const addEventBtn = document.getElementById('add-event-btn');
        const eventsContainer = document.getElementById('events-container');
        let eventIndex = {{ count($invitation->events) }};

        addEventBtn.addEventListener('click', function() {
            const html = `
                <div class="border rounded p-3 mb-3 bg-light bg-opacity-25 event-row">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Acara Baru</h5>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="ti ti-trash"></i></button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tipe Acara</label>
                            <input type="text" name="events[${eventIndex}][type]" class="form-control" placeholder="Contoh: Akad Nikah">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="events[${eventIndex}][date]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Waktu</label>
                            <input type="text" name="events[${eventIndex}][start_time]" class="form-control" placeholder="08.00 WIB">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama Lokasi</label>
                            <input type="text" name="events[${eventIndex}][location_name]" class="form-control">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" name="events[${eventIndex}][location_address]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Link Google Maps</label>
                            <input type="text" name="events[${eventIndex}][google_maps_url]" class="form-control">
                        </div>
                    </div>
                </div>
            `;
            eventsContainer.insertAdjacentHTML('beforeend', html);
            eventIndex++;
        });

        // Add Story
        const addStoryBtn = document.getElementById('add-story-btn');
        const storiesContainer = document.getElementById('stories-container');
        let storyIndex = {{ count($invitation->loveStories) }};

        addStoryBtn.addEventListener('click', function() {
            const html = `
                <div class="border rounded p-3 mb-3 story-row">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Kisah Baru</h5>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="ti ti-trash"></i></button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Tahun</label>
                            <input type="text" name="stories[${storyIndex}][year]" class="form-control">
                        </div>
                        <div class="col-md-10">
                            <label class="form-label">Judul Cerita</label>
                            <input type="text" name="stories[${storyIndex}][title]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Isi Kisah</label>
                            <textarea name="stories[${storyIndex}][story]" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Foto Kisah (URL)</label>
                            <input type="text" name="stories[${storyIndex}][image]" class="form-control mb-2" placeholder="Link Foto...">
                            <input type="file" name="stories[${storyIndex}][image_file]" class="form-control">
                        </div>
                    </div>
                </div>
            `;
            storiesContainer.insertAdjacentHTML('beforeend', html);
            storyIndex++;
        });

        // Add Gift
        const addGiftBtn = document.getElementById('add-gift-btn');
        const giftsContainer = document.getElementById('gifts-container');
        let giftIndex = {{ count($invitation->gifts) }};

        addGiftBtn.addEventListener('click', function() {
            const html = `
                <div class="border rounded p-3 mb-3 gift-row">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Rekening Baru</h5>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="ti ti-trash"></i></button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Bank / Provider</label>
                            <input type="text" name="gifts[${giftIndex}][bank_name]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Atas Nama</label>
                            <input type="text" name="gifts[${giftIndex}][account_name]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor Rekening</label>
                            <input type="text" name="gifts[${giftIndex}][account_number]" class="form-control">
                        </div>
                    </div>
                </div>
            `;
            giftsContainer.insertAdjacentHTML('beforeend', html);
            giftIndex++;
        });

        // Add Guest
        const addGuestBtn = document.getElementById('add-guest-btn');
        const guestsContainer = document.getElementById('guests-container');
        let guestIndex = {{ count($invitation->guests) }};

        addGuestBtn.addEventListener('click', function() {
            const html = `
                <tr class="guest-row">
                    <td>
                        <input type="text" name="guests[${guestIndex}][name]" class="form-control form-control-sm border-0 bg-light" placeholder="Nama Tamu">
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control border-0 bg-light-subtle" readonly value="Simpan untuk melihat link">
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-light text-muted">Baru</span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-link text-danger remove-guest-row p-0"><i class="ti ti-trash"></i></button>
                    </td>
                </tr>
            `;
            guestsContainer.insertAdjacentHTML('beforeend', html);
            guestIndex++;
        });

        // Copy Link
        document.addEventListener('click', function(e) {
            if (e.target.closest('.copy-link')) {
                const btn = e.target.closest('.copy-link');
                const input = btn.previousElementSibling;
                input.select();
                document.execCommand('copy');
                
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="ti ti-check"></i>';
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                }, 2000);
            }

            if (e.target.closest('.remove-guest-row')) {
                e.target.closest('tr').remove();
            }

            // Delete Gallery Implementation
            if (e.target.closest('.delete-gallery-btn')) {
                const btn = e.target.closest('.delete-gallery-btn');
                const container = btn.closest('.gallery-item-container');
                const checkbox = container.querySelector('.delete-gallery-checkbox');
                
                // Mark for deletion
                checkbox.checked = true;
                
                // Animate and hide
                container.style.transition = 'all 0.4s ease';
                container.style.opacity = '0';
                container.style.transform = 'scale(0.8)';
                
                setTimeout(() => {
                    container.classList.add('d-none');
                    showToast('Foto ditandai untuk dihapus. Klik simpan untuk permanen.', 'info');
                }, 400);
            }

            // Generic Delete Item Implementation (for Events/Stories)
            if (e.target.closest('.delete-item-btn')) {
                const btn = e.target.closest('.delete-item-btn');
                const container = btn.closest('.event-row, .story-row, .gift-row');
                const checkbox = btn.querySelector('.delete-item-checkbox');
                
                // Toggle status (karena ini label, klik akan mengubah checkbox)
                setTimeout(() => {
                    if (checkbox.checked) {
                        container.style.opacity = '0.5';
                        container.style.filter = 'grayscale(1)';
                        btn.classList.remove('btn-outline-danger');
                        btn.classList.add('btn-danger');
                        btn.innerHTML = '<i class="ti ti-rotate-clockwise"></i> Batal';
                        showToast('Item ditandai untuk dihapus.', 'warning');
                    } else {
                        container.style.opacity = '1';
                        container.style.filter = 'none';
                        btn.classList.add('btn-outline-danger');
                        btn.classList.remove('btn-danger');
                        btn.innerHTML = '<i class="ti ti-trash"></i> Hapus';
                    }
                }, 10);
            }
        });

        // Event delegation for remove buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('.event-row, .story-row, .gift-row').remove();
            }
        });

        // Auto Slug Generation
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                let slug = this.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '') // Remove non-word chars
                    .replace(/[\s_-]+/g, '-')  // Replace spaces/underscores with hyphens
                    .replace(/^-+|-+$/g, '');  // Remove leading/trailing hyphens
                
                slugInput.value = slug;
            });
        }
    });
</script>
@endpush