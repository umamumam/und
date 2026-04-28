<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with(['coupleGroom', 'coupleBride'])->get();
        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        return view('invitations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:invitations,slug',
            'wedding_date' => 'required',
        ]);

        \DB::beginTransaction();
        try {
            // 1. Invitation
            $data = $request->only(['title', 'slug', 'wedding_date', 'bg_music', 'live_streaming_url', 'quote_verse', 'quote_source', 'dress_code']);
            $data['user_id'] = auth()->id() ?? 1;
            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('cover_photo_file')) {
                $path = $request->file('cover_photo_file')->store('covers', 'public');
                $data['cover_photo'] = $path;
            } else {
                $data['cover_photo'] = $request->cover_photo;
            }

            $invitation = Invitation::create($data);

            // 2. Mempelai
            $groomData = [
                'gender' => 'male',
                'full_name' => $request->groom_full_name ?? '-',
                'nickname' => $request->groom_nickname ?? '-',
                'father_name' => $request->groom_father ?? '-',
                'mother_name' => $request->groom_mother ?? '-',
                'child_order' => $request->groom_child_order,
                'address' => $request->groom_address,
                'instagram_username' => $request->groom_instagram,
            ];
            if ($request->hasFile('groom_photo')) {
                $groomData['photo'] = $request->file('groom_photo')->store('couples', 'public');
            }
            $invitation->couples()->create($groomData);

            $brideData = [
                'gender' => 'female',
                'full_name' => $request->bride_full_name ?? '-',
                'nickname' => $request->bride_nickname ?? '-',
                'father_name' => $request->bride_father ?? '-',
                'mother_name' => $request->bride_mother ?? '-',
                'child_order' => $request->bride_child_order,
                'address' => $request->bride_address,
                'instagram_username' => $request->bride_instagram,
            ];
            if ($request->hasFile('bride_photo')) {
                $brideData['photo'] = $request->file('bride_photo')->store('couples', 'public');
            }
            $invitation->couples()->create($brideData);

            // 3. Events
            if ($request->events) {
                foreach ($request->events as $eventData) {
                    $invitation->events()->create([
                        'type' => $eventData['type'] ?? '',
                        'date' => $eventData['date'] ?? now(),
                        'start_time' => $eventData['start_time'] ?? '',
                        'location_name' => $eventData['location_name'] ?? '',
                        'location_address' => $eventData['location_address'] ?? '',
                        'google_maps_url' => $eventData['google_maps_url'] ?? '',
                    ]);
                }
            }

            // 4. Love Stories
            if ($request->stories) {
                foreach ($request->stories as $index => $storyData) {
                    $insertData = [
                        'year' => $storyData['year'] ?? '',
                        'title' => $storyData['title'] ?? '',
                        'story' => $storyData['story'] ?? '',
                    ];
                    if ($request->hasFile("stories.$index.image_file")) {
                        $insertData['image'] = $request->file("stories.$index.image_file")->store('stories', 'public');
                    }
                    $invitation->loveStories()->create($insertData);
                }
            }

            // 5. Gallery
            if ($request->hasFile('gallery_files')) {
                foreach ($request->file('gallery_files') as $file) {
                    $path = $file->store('galleries', 'public');
                    $invitation->galleries()->create(['url' => $path]);
                }
            }

            // 6. Gifts
            if ($request->gifts) {
                foreach ($request->gifts as $giftData) {
                    $invitation->gifts()->create([
                        'bank_name' => $giftData['bank_name'] ?? '',
                        'account_name' => $giftData['account_name'] ?? '',
                        'account_number' => $giftData['account_number'] ?? '',
                    ]);
                }
            }

            \DB::commit();
            return redirect()->route('invitations.index')->with('success', 'Undangan berhasil dibuat');
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('error', 'Gagal membuat undangan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Invitation $invitation)
    {
        $invitation->load(['couples', 'events', 'loveStories', 'galleries', 'gifts']);
        $groom = $invitation->coupleGroom;
        $bride = $invitation->coupleBride;
        return view('invitations.edit', compact('invitation', 'groom', 'bride'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        \DB::beginTransaction();
        try {
            // 1. Basic Info
            $data = $request->only(['title', 'slug', 'wedding_date', 'bg_music', 'live_streaming_url', 'quote_verse', 'quote_source', 'dress_code']);

            if ($request->hasFile('cover_photo_file')) {
                $path = $request->file('cover_photo_file')->store('covers', 'public');
                $data['cover_photo'] = $path;
            } else {
                $data['cover_photo'] = $request->cover_photo;
            }

            $invitation->update($data);

            // 2. Mempelai
            $groomData = [
                'full_name' => $request->groom_full_name,
                'nickname' => $request->groom_nickname,
                'father_name' => $request->groom_father,
                'mother_name' => $request->groom_mother,
                'child_order' => $request->groom_child_order,
                'address' => $request->groom_address,
                'instagram_username' => $request->groom_instagram,
            ];
            if ($request->hasFile('groom_photo')) {
                $groomData['photo'] = $request->file('groom_photo')->store('couples', 'public');
            } elseif ($request->delete_groom_photo) {
                $groomData['photo'] = null;
            }
            $invitation->coupleGroom()->update($groomData);

            $brideData = [
                'full_name' => $request->bride_full_name,
                'nickname' => $request->bride_nickname,
                'father_name' => $request->bride_father,
                'mother_name' => $request->bride_mother,
                'child_order' => $request->bride_child_order,
                'address' => $request->bride_address,
                'instagram_username' => $request->bride_instagram,
            ];
            if ($request->hasFile('bride_photo')) {
                $brideData['photo'] = $request->file('bride_photo')->store('couples', 'public');
            } elseif ($request->delete_bride_photo) {
                $brideData['photo'] = null;
            }
            $invitation->coupleBride()->update($brideData);

            // 3. Events
            if ($request->delete_events) {
                $invitation->events()->whereIn('id', $request->delete_events)->delete();
            }

            if ($request->events) {
                foreach ($request->events as $eventData) {
                    $invitation->events()->updateOrCreate(
                        ['id' => $eventData['id'] ?? null],
                        [
                            'type' => $eventData['type'] ?? '',
                            'date' => $eventData['date'] ?? now(),
                            'start_time' => $eventData['start_time'] ?? '',
                            'location_name' => $eventData['location_name'] ?? '',
                            'location_address' => $eventData['location_address'] ?? '',
                            'google_maps_url' => $eventData['google_maps_url'] ?? '',
                        ]
                    );
                }
            }

            // 4. Love Stories
            if ($request->delete_stories) {
                $invitation->loveStories()->whereIn('id', $request->delete_stories)->delete();
            }

            if ($request->stories) {
                foreach ($request->stories as $index => $storyData) {
                    $updateData = [
                        'year' => $storyData['year'] ?? '',
                        'title' => $storyData['title'] ?? '',
                        'story' => $storyData['story'] ?? '',
                    ];

                    if ($request->hasFile("stories.$index.image_file")) {
                        $path = $request->file("stories.$index.image_file")->store('stories', 'public');
                        $updateData['image'] = $path;
                    } elseif (isset($storyData['image'])) {
                        $updateData['image'] = $storyData['image'];
                    }

                    $invitation->loveStories()->updateOrCreate(
                        ['id' => $storyData['id'] ?? null],
                        $updateData
                    );
                }
            }

            // 5. Gallery
            if ($request->delete_galleries) {
                $invitation->galleries()->whereIn('id', $request->delete_galleries)->delete();
            }

            if ($request->hasFile('gallery_files')) {
                foreach ($request->file('gallery_files') as $file) {
                    $path = $file->store('galleries', 'public');
                    $invitation->galleries()->create(['url' => $path]);
                }
            }

            // 6. Gifts
            if ($request->delete_gifts) {
                $invitation->gifts()->whereIn('id', $request->delete_gifts)->delete();
            }

            if ($request->gifts) {
                foreach ($request->gifts as $giftData) {
                    $invitation->gifts()->updateOrCreate(
                        ['id' => $giftData['id'] ?? null],
                        [
                            'bank_name' => $giftData['bank_name'] ?? '',
                            'account_name' => $giftData['account_name'] ?? '',
                            'account_number' => $giftData['account_number'] ?? '',
                        ]
                    );
                }
            }

            // 6. Guests
            if ($request->delete_guests) {
                $invitation->guests()->whereIn('id', $request->delete_guests)->delete();
            }
            if ($request->guests) {
                foreach ($request->guests as $guestData) {
                    if (empty($guestData['name'])) continue;
                    $invitation->guests()->updateOrCreate(
                        ['id' => $guestData['id'] ?? null],
                        ['name' => $guestData['name']]
                    );
                }
            }

            \DB::commit();
            return redirect()->route('invitations.index')->with('success', 'Undangan berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('error', 'Gagal update undangan: ' . $e->getMessage());
        }
    }

    public function storeRSVP(Request $request, $slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'attendance' => 'required|in:hadir,tidak_hadir,ragu_ragu',
            'guest_count' => 'required|integer|min:0',
            'message' => 'nullable|string',
        ]);

        // Find or create guest by name for this invitation
        $guest = $invitation->guests()->updateOrCreate(
            ['name' => $request->name],
            [
                'attendance' => $request->attendance,
                'guest_count' => $request->guest_count,
                'message' => $request->message,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih, RSVP Anda telah kami terima.'
        ]);
    }

    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil dihapus');
    }

    public function show($slug)
    {
        $invitation = Invitation::with([
            'couples',
            'events',
            'loveStories',
            'galleries',
            'gifts',
            'wishes' => function ($query) {
                $query->latest();
            }
        ])->where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Separate groom and bride for convenience
        $groom = $invitation->couples->where('gender', 'male')->first();
        $bride = $invitation->couples->where('gender', 'female')->first();

        return view('hehe', compact('invitation', 'groom', 'bride'));
    }

    public function storeWish(Request $request, $slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'attendance_status' => 'nullable|in:hadir,tidak_hadir,ragu_ragu',
            'guest_count' => 'nullable|integer|min:1|max:10',
        ]);

        $invitation->wishes()->create([
            'name' => $request->name,
            'message' => $request->message,
            'attendance_status' => $request->attendance_status ?? 'hadir',
            'guest_count' => $request->guest_count ?? 1,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih atas doa dan ucapannya!'
            ]);
        }

        return back()->with('success', 'Terima kasih atas doa dan ucapannya!');
    }

    public function wishes()
    {
        $invitations = Invitation::where('user_id', auth()->id())
            ->withCount(['guests', 'wishes'])
            ->latest()
            ->get();

        return view('invitations.wishes_index', compact('invitations'));
    }

    public function wishesDetail(Invitation $invitation)
    {
        // Ensure user owns this invitation
        if ($invitation->user_id !== auth()->id()) {
            abort(403);
        }

        $invitation->load(['guests', 'wishes']);

        return view('invitations.wishes_detail', compact('invitation'));
    }
    public function addGuest(Request $request, Invitation $invitation)
    {
        // Ensure user owns this invitation
        if ($invitation->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'attendance' => 'required|in:hadir,tidak_hadir,ragu_ragu',
            'guest_count' => 'required|integer|min:1',
        ]);

        $invitation->guests()->create([
            'name' => $request->name,
            'attendance' => $request->attendance,
            'guest_count' => $request->guest_count,
        ]);

        return back()->with('success', 'Tamu berhasil ditambahkan.');
    }

    public function updateGuests(Request $request, Invitation $invitation)
    {
        // Ensure user owns this invitation
        if ($invitation->user_id !== auth()->id()) {
            abort(403);
        }

        \DB::beginTransaction();
        try {
            // 1. Delete guests
            if ($request->delete_guests) {
                $invitation->guests()->whereIn('id', $request->delete_guests)->delete();
            }

            // 2. Update/Create guests
            if ($request->guests) {
                foreach ($request->guests as $guestData) {
                    if (empty($guestData['name'])) continue;
                    
                    $invitation->guests()->updateOrCreate(
                        ['id' => $guestData['id'] ?? null],
                        ['name' => $guestData['name']]
                    );
                }
            }

            \DB::commit();
            return back()->with('success', 'Daftar tamu berhasil diperbarui.');
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('error', 'Gagal memperbarui daftar tamu: ' . $e->getMessage());
        }
    }
}
