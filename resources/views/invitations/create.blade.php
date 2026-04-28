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
</style>

<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('invitations.index') }}">Kelola Undangan</a></li>
                    <li class="breadcrumb-item active">Buat Undangan</li>
                </ol>
            </nav>
            <h1 class="fs-3 mb-0">Buat Undangan Baru</h1>
            <p class="text-muted">Lengkapi detail untuk membuat undangan pernikahan baru.</p>
        </div>
    </div>
</div>

<div class="card card-edit">
    <div class="card-body p-4">
        <form action="{{ route('invitations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- TABS HEADER -->
            <ul class="nav nav-tabs nav-tabs-custom mb-4" id="createInvitationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="base-tab" data-bs-toggle="tab" data-bs-target="#base"
                        type="button" role="tab">
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
                    <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                        type="button" role="tab">
                        <i class="ti ti-photo me-1"></i> Galeri Foto
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="gift-tab" data-bs-toggle="tab" data-bs-target="#gift" type="button"
                        role="tab">
                        <i class="ti ti-gift me-1"></i> Hadiah (Gifts)
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="createInvitationTabsContent">
                <!-- TAB 1: INFORMASI DASAR -->
                <div class="tab-pane fade show active" id="base" role="tabpanel">
                    <h4 class="form-section-title">Informasi Dasar</h4>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Acara</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                                placeholder="Contoh: Pernikahan Umam & Indah" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Link Undangan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">domain.com/</span>
                                <input type="text" name="slug" id="slug" class="form-control border-start-0"
                                    value="{{ old('slug') }}" placeholder="umam-indah" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Acara</label>
                            <input type="datetime-local" name="wedding_date" class="form-control"
                                value="{{ old('wedding_date') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Musik Latar (Link MP3)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-music"></i></span>
                                <input type="text" name="bg_music" class="form-control" value="{{ old('bg_music') }}"
                                    placeholder="https://...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Foto Cover / Sampul</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-light"><i class="ti ti-link"></i></span>
                                <input type="text" name="cover_photo" class="form-control"
                                    value="{{ old('cover_photo') }}" placeholder="Link Foto (Opsional)">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-upload"></i></span>
                                <input type="file" name="cover_photo_file" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Link Live Streaming (Opsional)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-video"></i></span>
                                <input type="text" name="live_streaming_url" class="form-control"
                                    value="{{ old('live_streaming_url') }}" placeholder="https://...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dress Code (Opsional)</label>
                            <input type="text" name="dress_code" class="form-control" value="{{ old('dress_code') }}"
                                placeholder="Contoh: Batik / Pakaian Bebas & Rapi">
                        </div>
                        <div class="col-12">
                            <h5 class="mt-3 mb-2">Quote / Kata Mutiara</h5>
                            <div class="mb-2">
                                <label class="form-label small">Isi Quote</label>
                                <textarea name="quote_verse" class="form-control" rows="2"
                                    placeholder="Isi Kata-kata mutiara atau ayat">{{ old('quote_verse') }}</textarea>
                            </div>
                            <div>
                                <label class="form-label small">Sumber</label>
                                <input type="text" name="quote_source" class="form-control"
                                    value="{{ old('quote_source') }}" placeholder="Ar-Rum 21">
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
                                    value="{{ old('groom_full_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Panggilan</label>
                                <input type="text" name="groom_nickname" class="form-control"
                                    value="{{ old('groom_nickname') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="groom_father" class="form-control"
                                    value="{{ old('groom_father') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="groom_mother" class="form-control"
                                    value="{{ old('groom_mother') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Anak Ke-</label>
                                <input type="text" name="groom_child_order" class="form-control"
                                    value="{{ old('groom_child_order', 'Putra Pertama') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Instagram Username</label>
                                <input type="text" name="groom_instagram" class="form-control"
                                    value="{{ old('groom_instagram') }}" placeholder="@username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat (Opsional)</label>
                                <input type="text" name="groom_address" class="form-control"
                                    value="{{ old('groom_address') }}" placeholder="Contoh: Pati">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Mempelai Pria</label>
                                <input type="file" name="groom_photo" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="form-section-title">Mempelai Wanita</h4>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="bride_full_name" class="form-control"
                                    value="{{ old('bride_full_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Panggilan</label>
                                <input type="text" name="bride_nickname" class="form-control"
                                    value="{{ old('bride_nickname') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="bride_father" class="form-control"
                                    value="{{ old('bride_father') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="bride_mother" class="form-control"
                                    value="{{ old('bride_mother') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Anak Ke-</label>
                                <input type="text" name="bride_child_order" class="form-control"
                                    value="{{ old('bride_child_order', 'Putri Pertama') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Instagram Username</label>
                                <input type="text" name="bride_instagram" class="form-control"
                                    value="{{ old('bride_instagram') }}" placeholder="@username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat (Opsional)</label>
                                <input type="text" name="bride_address" class="form-control"
                                    value="{{ old('bride_address') }}" placeholder="Contoh: Pekalongan">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Mempelai Wanita</label>
                                <input type="file" name="bride_photo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: JADWAL ACARA -->
                <div class="tab-pane fade" id="event" role="tabpanel">
                    <h4 class="form-section-title">Jadwal Acara</h4>
                    <div id="events-container">
                        <div class="border rounded p-3 mb-3 bg-light bg-opacity-25 event-row">
                            <h5 class="mb-3">Acara 1</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Tipe Acara</label>
                                    <input type="text" name="events[0][type]" class="form-control"
                                        placeholder="Contoh: Akad Nikah">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="events[0][date]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Waktu</label>
                                    <input type="text" name="events[0][start_time]" class="form-control"
                                        placeholder="08.00 WIB">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nama Lokasi</label>
                                    <input type="text" name="events[0][location_name]" class="form-control">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="events[0][location_address]" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Link Google Maps</label>
                                    <input type="text" name="events[0][google_maps_url]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-event-btn" class="btn btn-outline-primary btn-sm mt-2"><i
                            class="ti ti-plus"></i> Tambah Acara</button>
                </div>

                <!-- TAB 4: KISAH CINTA -->
                <div class="tab-pane fade" id="story" role="tabpanel">
                    <h4 class="form-section-title">Kisah Cinta</h4>
                    <div id="stories-container">
                        <div class="border rounded p-3 mb-3 story-row">
                            <h5 class="mb-3 text-primary">Kisah Pertama</h5>
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label">Tahun</label>
                                    <input type="text" name="stories[0][year]" class="form-control">
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Judul Cerita</label>
                                    <input type="text" name="stories[0][title]" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Isi Kisah</label>
                                    <textarea name="stories[0][story]" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Foto Kisah</label>
                                    <input type="file" name="stories[0][image_file]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-story-btn" class="btn btn-outline-primary btn-sm"><i
                            class="ti ti-plus"></i> Tambah Kisah</button>
                </div>

                <!-- TAB 5: GALERI FOTO -->
                <div class="tab-pane fade" id="gallery" role="tabpanel">
                    <h4 class="form-section-title">Galeri Foto</h4>
                    <div class="p-5 border border-2 border-dashed rounded text-center mb-4">
                        <i class="ti ti-photo fs-1 text-muted mb-3 d-block"></i>
                        <label class="form-label fw-bold">Upload Galeri Foto</label>
                        <input type="file" name="gallery_files[]" class="form-control mx-auto" style="max-width: 400px;"
                            multiple>
                        <small class="text-muted d-block mt-2">Bisa pilih banyak foto sekaligus.</small>
                    </div>
                </div>

                <!-- TAB 6: HADIAH -->
                <div class="tab-pane fade" id="gift" role="tabpanel">
                    <h4 class="form-section-title">Rekening / Kado Digital</h4>
                    <div id="gifts-container">
                        <div class="border rounded p-3 mb-3 gift-row">
                            <h5 class="mb-3 text-primary">Rekening 1</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Bank / Provider</label>
                                    <input type="text" name="gifts[0][bank_name]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" name="gifts[0][account_name]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nomor Rekening</label>
                                    <input type="text" name="gifts[0][account_number]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-gift-btn" class="btn btn-outline-primary btn-sm"><i
                            class="ti ti-plus"></i> Tambah Rekening</button>
                </div>
            </div>

            <div class="mt-5 border-top pt-4 d-flex justify-content-between align-items-center">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                    <label class="form-check-label fw-bold" for="isActive">Publikasikan Langsung</label>
                </div>
                <div>
                    <a href="{{ route('invitations.index') }}" class="btn btn-light rounded-pill px-4 me-2">Batal</a>
                    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Buat Undangan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let eventIndex = 1;
        let storyIndex = 1;
        let giftIndex = 1;

        // Add Event
        const addEventBtn = document.getElementById('add-event-btn');
        const eventsContainer = document.getElementById('events-container');

        addEventBtn.addEventListener('click', function() {
            const html = `
                <div class="border rounded p-3 mb-3 bg-light bg-opacity-25 event-row">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Acara ${eventIndex + 1}</h5>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="ti ti-trash"></i></button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tipe Acara</label>
                            <input type="text" name="events[${eventIndex}][type]" class="form-control">
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

        addStoryBtn.addEventListener('click', function() {
            const html = `
                <div class="border rounded p-3 mb-3 story-row">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-primary">Kisah Lanjutan</h5>
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
                            <label class="form-label">Foto Kisah</label>
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

        addGiftBtn.addEventListener('click', function() {
            const html = `
                <div class="border rounded p-3 mb-3 gift-row">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-primary">Rekening Lanjutan</h5>
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