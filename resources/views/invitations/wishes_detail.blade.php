@extends('layouts.app')

@section('content')
<style>
    .card-custom {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .badge-hadir {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-tidak {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-ragu {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-pending {
        background-color: #f3f4f6;
        color: #374151;
    }

    .invitation-header {
        border-bottom: 1px solid #f1f1f1;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .msg-bubble {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 10px 15px;
        font-style: italic;
        position: relative;
    }

    .msg-bubble::before {
        content: '"';
        font-family: serif;
        font-size: 2rem;
        color: #ddd;
        position: absolute;
        top: -5px;
        left: 5px;
    }

    .nav-pills .nav-link.active {
        background-color: #e63946;
        color: #fff;
    }

    .nav-pills .nav-link {
        color: #666;
        border: 1px solid #eee;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('wishes.index') }}">Ucapan & RSVP</a></li>
                        <li class="breadcrumb-item active">{{ $invitation->title }}</li>
                    </ol>
                </nav>
                <h1 class="fs-3 mb-0">Detail Ucapan & RSVP</h1>
            </div>
            <a href="{{ route('wishes.index') }}" class="btn btn-outline-dark rounded-pill px-3">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body p-4">
        <div class="invitation-header d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fs-4 mb-1">{{ $invitation->title }}</h3>
                <div class="d-flex gap-3 small text-muted">
                    <span><i class="ti ti-calendar me-1"></i> {{ $invitation->wedding_date->format('d M Y') }}</span>
                    <span><i class="ti ti-link me-1"></i> {{ $invitation->slug }}</span>
                </div>
            </div>
            <div class="text-end">
                <div class="d-flex gap-2">
                    <div class="bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-3 text-center">
                        <div class="fw-bold fs-5">{{ $invitation->guests->where('attendance', 'hadir')->count() +
                            $invitation->wishes->where('attendance_status', 'hadir')->count() }}</div>
                        <div class="small" style="font-size: 0.7rem;">HADIR</div>
                    </div>
                    <div class="bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-3 text-center">
                        <div class="fw-bold fs-5">{{ $invitation->guests->count() + $invitation->wishes->count() }}
                        </div>
                        <div class="small" style="font-size: 0.7rem;">TOTAL</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABS & ACTIONS -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <ul class="nav nav-pills gap-2" id="wishesTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active rounded-pill px-4" id="rsvp-tab" data-bs-toggle="pill"
                        data-bs-target="#rsvp" type="button" role="tab">Daftar RSVP & Tamu</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link rounded-pill px-4" id="wishes-tab" data-bs-toggle="pill"
                        data-bs-target="#wishes" type="button" role="tab">Ucapan Doa</button>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- TAB RSVP (GUEST LIST MANAGEMENT) -->
            <div class="tab-pane fade show active" id="rsvp" role="tabpanel">
                <form action="{{ route('wishes.update-guests', $invitation->id) }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="form-section-title mb-0">Daftar Tamu & Link Undangan</h4>
                        <div class="d-flex gap-2">
                            <button type="button" id="send-all-wa-btn" class="btn btn-success btn-sm rounded-pill px-3">
                                <i class="ti ti-brand-whatsapp"></i> Kirim Semua (Fonnte)
                            </button>
                            <button type="button" id="add-guest-row-btn" class="btn btn-primary btn-sm rounded-pill px-3">
                                <i class="ti ti-plus"></i> Tambah Tamu
                            </button>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 bg-light-primary text-primary small mb-4">
                        <i class="ti ti-info-circle me-1"></i> 
                        Tamu yang Anda tambahkan di sini akan memiliki link khusus. Status RSVP akan terupdate otomatis jika mereka mengisi form di undangan.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle border-top">
                            <thead class="bg-light text-muted small">
                                <tr>
                                    <th style="width: 200px;">Nama Tamu</th>
                                    <th style="width: 150px;">No. WhatsApp</th>
                                    <th>Kirim Undangan / Link</th>
                                    <th style="width: 130px;">Status RSVP</th>
                                    <th style="width: 50px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="guests-container">
                                @foreach($invitation->guests as $index => $guest)
                                <tr class="guest-row">
                                    <td>
                                        <input type="hidden" name="guests[{{ $index }}][id]" value="{{ $guest->id }}">
                                        <input type="text" name="guests[{{ $index }}][name]" class="form-control form-control-sm border-0 bg-light guest-name-input" value="{{ $guest->name }}" placeholder="Nama Tamu" required>
                                    </td>
                                    <td>
                                        <input type="text" name="guests[{{ $index }}][whatsapp]" class="form-control form-control-sm border-0 bg-light guest-whatsapp-input" value="{{ $guest->whatsapp }}" placeholder="Contoh: 08123xxx">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="input-group input-group-sm" style="max-width: 250px;">
                                                <input type="text" class="form-control border-0 bg-light-subtle guest-link-input" readonly value="{{ route('invitation.show', $invitation->slug) }}?to={{ urlencode($guest->name) }}">
                                                <button class="btn btn-outline-secondary border-0 copy-link" type="button" title="Copy Link"><i class="ti ti-copy"></i></button>
                                            </div>
                                            @if($guest->id)
                                                <button type="button" class="btn btn-sm btn-success rounded-pill px-2 send-wa-btn" data-guest-id="{{ $guest->id }}" title="Kirim otomatis lewat Fonnte WA">
                                                    <i class="ti ti-brand-whatsapp"></i> Fonnte
                                                </button>
                                                @php
                                                    $formattedPhone = $guest->whatsapp;
                                                    if (str_starts_with($formattedPhone, '0')) {
                                                        $formattedPhone = '62' . substr($formattedPhone, 1);
                                                    }
                                                    $formattedPhone = preg_replace('/[^0-9]/', '', $formattedPhone);
                                                    
                                                    $waText = "*_Assalamualaikum Warahmatullahi Wabarakatuh_*\n\nKepada Yth.\nBapak/Ibu/Saudara/i\n*" . $guest->name . "*\n\nDengan memohon Rahmat dan Ridho Allah SWT, dalam membentuk keluarga yang sakinah, mawaddah, warrahmah. Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara kami.\n\n*Berikut link undangan kami*,\nUntuk info lengkap dari acara bisa kunjungi :\n\n" . route('invitation.show', $invitation->slug) . "?to=" . urlencode($guest->name) . "\n\nMerupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir dan memberikan doa restu. Mohon maaf atas keterbatasan kami dalam menyampaikan undangan lewat media ini. Terima kasih banyak atas perhatiannya.\n\n*_Wassalamualaikum Warahmatullahi Wabarakatuh_*";
                                                @endphp
                                                <a href="https://api.whatsapp.com/send?phone={{ $formattedPhone }}&text={{ urlencode($waText) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2 manual-wa-btn" title="Kirim manual lewat Web WhatsApp">
                                                    <i class="ti ti-external-link"></i> WA Manual
                                                </a>
                                            @else
                                                <small class="text-muted italic">Simpan untuk kirim</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($guest->attendance == 'hadir')
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3">Hadir ({{ $guest->guest_count }})</span>
                                        @elseif($guest->attendance == 'tidak_hadir')
                                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Tidak Hadir</span>
                                        @elseif($guest->attendance == 'ragu_ragu')
                                            <span class="badge bg-warning-subtle text-warning rounded-pill px-3">Ragu-ragu</span>
                                        @else
                                            <span class="badge bg-light text-muted rounded-pill px-3">Baru</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-link text-danger delete-guest-btn p-0" data-guest-id="{{ $guest->id }}" data-guest-name="{{ $guest->name }}" title="Hapus Tamu">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary px-5 rounded-pill shadow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <!-- TAB WISHES -->
            <div class="tab-pane fade" id="wishes" role="tabpanel">
                <div class="row g-4">
                    @forelse($invitation->wishes as $wish)
                    <div class="col-md-6 col-xl-4">
                        <div class="border border-light-subtle rounded-4 p-3 h-100 bg-white shadow-sm">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="fw-bold text-dark">{{ $wish->name }}</div>
                                <span
                                    class="badge {{ $wish->attendance_status == 'hadir' ? 'badge-hadir' : ($wish->attendance_status == 'tidak_hadir' ? 'badge-tidak' : 'badge-ragu') }} rounded-pill px-2 py-1"
                                    style="font-size: 0.7rem;">
                                    {{ ucfirst($wish->attendance_status) }}
                                </span>
                            </div>
                            <div class="msg-bubble small mb-3">
                                {{ $wish->message }}
                            </div>
                            <div class="text-end small text-muted" style="font-size: 0.65rem;">
                                <i class="ti ti-clock me-1"></i> {{ $wish->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted small italic">
                        <p>Belum ada ucapan doa yang diterima.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const guestsContainer = document.getElementById('guests-container');
        const addGuestBtn = document.getElementById('add-guest-row-btn');
        const sendAllBtn = document.getElementById('send-all-wa-btn');
        const invitationSlug = "{{ $invitation->slug }}";
        const baseUrl = "{{ url('/v') }}";
        let guestIndex = {{ count($invitation->guests) }};

        addGuestBtn.addEventListener('click', function() {
            const html = `
                <tr class="guest-row">
                    <td>
                        <input type="text" name="guests[${guestIndex}][name]" class="form-control form-control-sm border-0 bg-light guest-name-input" placeholder="Nama Tamu" required>
                    </td>
                    <td>
                        <input type="text" name="guests[${guestIndex}][whatsapp]" class="form-control form-control-sm border-0 bg-light guest-whatsapp-input" placeholder="Contoh: 08123xxx">
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-1">
                            <div class="input-group input-group-sm" style="max-width: 250px;">
                                <input type="text" class="form-control border-0 bg-light-subtle guest-link-input" readonly value="Simpan untuk melihat link">
                                <button class="btn btn-outline-secondary border-0 copy-link disabled" type="button" title="Copy Link"><i class="ti ti-copy"></i></button>
                            </div>
                            <small class="text-muted italic">Simpan untuk aktifkan tombol kirim</small>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-light text-muted rounded-pill px-3">Baru</span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-link text-danger remove-guest-row p-0" title="Hapus Baris"><i class="ti ti-trash"></i></button>
                    </td>
                </tr>
            `;
            guestsContainer.insertAdjacentHTML('beforeend', html);
            guestIndex++;
        });

        // Event delegation for name and whatsapp input to update link preview
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('guest-name-input')) {
                const name = e.target.value;
                const row = e.target.closest('tr');
                const linkInput = row.querySelector('.guest-link-input');
                const copyBtn = row.querySelector('.copy-link');
                
                if (name.trim() !== '') {
                    const encodedName = encodeURIComponent(name);
                    linkInput.value = `${baseUrl}/${invitationSlug}?to=${encodedName}`;
                    copyBtn.classList.remove('disabled');
                } else {
                    linkInput.value = 'Simpan untuk melihat link';
                    copyBtn.classList.add('disabled');
                }
            }
        });

        // Copy Link
        document.addEventListener('click', function(e) {
            if (e.target.closest('.copy-link')) {
                const btn = e.target.closest('.copy-link');
                if (btn.classList.contains('disabled')) return;
                
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
        });

        // Handle Instant Guest Delete via AJAX with SweetAlert2
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-guest-btn')) {
                const btn = e.target.closest('.delete-guest-btn');
                const guestId = btn.getAttribute('data-guest-id');
                const guestName = btn.getAttribute('data-guest-name');
                const row = btn.closest('tr');

                if (!guestId) {
                    // If it's a new unsaved row
                    row.remove();
                    return;
                }

                Swal.fire({
                    title: 'Hapus Tamu?',
                    text: `Apakah Anda yakin ingin menghapus "${guestName}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.disabled = true;
                        btn.innerHTML = '<span class="spinner-border spinner-border-sm text-danger" role="status"></span>';

                        fetch(`/wishes/{{ $invitation->id }}/delete-guest/${guestId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-HTTP-Method-Override': 'DELETE'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                row.remove();
                                Swal.fire('Sukses!', data.message, 'success');
                            } else {
                                Swal.fire('Gagal!', data.message || 'Gagal menghapus tamu.', 'error');
                                btn.disabled = false;
                                btn.innerHTML = '<i class="ti ti-trash"></i>';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error!', 'Terjadi kesalahan koneksi.', 'error');
                            btn.disabled = false;
                            btn.innerHTML = '<i class="ti ti-trash"></i>';
                        });
                    }
                });
            }
        });

        // Handle Fonnte Send WhatsApp (Single) with SweetAlert2
        document.addEventListener('click', function(e) {
            if (e.target.closest('.send-wa-btn')) {
                const btn = e.target.closest('.send-wa-btn');
                if (btn.disabled) return;

                const guestId = btn.getAttribute('data-guest-id');
                const originalHtml = btn.innerHTML;
                
                // Show sending spinner
                btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                btn.disabled = true;
                
                fetch(`/wishes/{{ $invitation->id }}/send-wa/${guestId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Sukses!', data.message, 'success');
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-secondary');
                        btn.innerHTML = '<i class="ti ti-check"></i> Sent';
                    } else {
                        Swal.fire('Gagal!', data.message || 'Gagal mengirim pesan.', 'error');
                        btn.innerHTML = originalHtml;
                        btn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Terjadi kesalahan koneksi.', 'error');
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                });
            }
        });

        // Handle Send All WhatsApp (Fonnte) Sequentially with SweetAlert2
        sendAllBtn.addEventListener('click', function() {
            const buttons = Array.from(document.querySelectorAll('.send-wa-btn')).filter(btn => {
                return !btn.disabled && btn.classList.contains('btn-success');
            });

            if (buttons.length === 0) {
                Swal.fire('Informasi', 'Tidak ada tamu dengan nomor WA yang siap dikirim.', 'info');
                return;
            }

            Swal.fire({
                title: 'Kirim Semua Undangan?',
                text: `Kirim undangan otomatis ke ${buttons.length} tamu sekaligus via Fonnte?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Kirim Semua!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    sendAllBtn.disabled = true;
                    const originalText = sendAllBtn.innerHTML;

                    for (let i = 0; i < buttons.length; i++) {
                        const btn = buttons[i];
                        sendAllBtn.innerHTML = `<i class="ti ti-loader spinner-border spinner-border-sm me-1"></i> Mengirim ${i+1}/${buttons.length}...`;
                        
                        await new Promise((resolve) => {
                            const guestId = btn.getAttribute('data-guest-id');
                            const originalHtml = btn.innerHTML;
                            
                            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                            btn.disabled = true;
                            
                            fetch(`/wishes/{{ $invitation->id }}/send-wa/${guestId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    btn.classList.remove('btn-success');
                                    btn.classList.add('btn-secondary');
                                    btn.innerHTML = '<i class="ti ti-check"></i> Sent';
                                } else {
                                    btn.innerHTML = originalHtml;
                                    btn.disabled = false;
                                }
                                // Wait 1.5 seconds delay between each send
                                setTimeout(resolve, 1500);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                btn.innerHTML = originalHtml;
                                btn.disabled = false;
                                setTimeout(resolve, 1500);
                            });
                        });
                    }

                    sendAllBtn.innerHTML = originalText;
                    sendAllBtn.disabled = false;
                    Swal.fire('Sukses!', 'Proses pengiriman massal selesai.', 'success');
                }
            });
        });
    });
</script>
@endpush