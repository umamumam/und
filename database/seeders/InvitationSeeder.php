<?php

namespace Database\Seeders;

use App\Models\Invitation;
use App\Models\Couple;
use App\Models\Event;
use App\Models\LoveStory;
use App\Models\Gallery;
use App\Models\Gift;
use Illuminate\Database\Seeder;
use App\Models\User;

class InvitationSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there is at least one user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $invitation = Invitation::create([
            'user_id' => $user->id,
            'slug' => 'umam-indah',
            'title' => 'The Wedding of Umam & Indah',
            'wedding_date' => '2026-10-11 08:00:00',
            'cover_photo' => '/public/assets/DSC01188.JPG',
            'quote_verse' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
            'quote_source' => 'Ar-Rum: 21',
            'bg_music' => 'https://hi.goodchoice.id/wp-content/uploads/2026/01/Broken-Symphony-mp3cut.net_.mp3',
        ]);

        Couple::create([
            'invitation_id' => $invitation->id,
            'gender' => 'male',
            'full_name' => 'Miftachul Umam, S.Kom.',
            'nickname' => 'Umam',
            'father_name' => 'Bpk. Nama Ayah Umam',
            'mother_name' => 'Ibu Nama Ibu Umam',
            'instagram_username' => 'mfthlmm',
            'photo' => '/public/assets/Umam.png',
            'child_order' => 'Putra Pertama',
        ]);

        Couple::create([
            'invitation_id' => $invitation->id,
            'gender' => 'female',
            'full_name' => 'Indah Lafati Yanul Ulum, S.Akun.',
            'nickname' => 'Indah',
            'father_name' => 'Bpk. Nama Ayah Indah',
            'mother_name' => 'Ibu Nama Ibu Indah',
            'instagram_username' => 'indahlafati_',
            'photo' => '/public/assets/DSC01562.jpg',
            'child_order' => 'Putri Kedua',
        ]);

        Event::create([
            'invitation_id' => $invitation->id,
            'type' => 'Akad Nikah',
            'date' => '2026-10-11',
            'start_time' => '08:00:00',
            'location_name' => 'Kediaman Mempelai Wanita',
            'location_address' => 'Jl. Raya Pekalongan No. 123',
            'google_maps_url' => 'https://maps.google.com',
        ]);

        Event::create([
            'invitation_id' => $invitation->id,
            'type' => 'Resepsi',
            'date' => '2026-10-11',
            'start_time' => '13:00:00',
            'location_name' => 'Gedung Serbaguna',
            'location_address' => 'Jl. Pemuda No. 45, Pekalongan',
            'google_maps_url' => 'https://maps.google.com',
        ]);

        LoveStory::create([
            'invitation_id' => $invitation->id,
            'year' => '2024',
            'title' => 'Awal Bertemu',
            'story' => 'Kisah ini berawal dari pertemuan kita di tahun 2024, mengenal satu sama lain dan belum ada benih cinta kala itu, hanya sebatas teman kerja.',
            'image' => '/public/assets/dieng2.jpeg',
        ]);

        $galleries = [
            '/public/assets/dieng.jpeg',
            '/public/assets/DSC01538.jpg',
            '/public/assets/dieng2.jpeg',
            '/public/assets/DSC01562.jpg',
            '/public/assets/DSC01546.jpg',
            '/public/assets/DSC01544.jpg',
            '/public/assets/bioskop.jpeg',
            '/public/assets/jalan1.jpeg',
            '/public/assets/bioskop2.jpeg',
            '/public/assets/DSC01193.JPG',
            '/public/assets/jalan2.jpeg',
        ];

        foreach ($galleries as $url) {
            Gallery::create([
                'invitation_id' => $invitation->id,
                'type' => 'image',
                'url' => $url,
            ]);
        }

        Gift::create([
            'invitation_id' => $invitation->id,
            'bank_name' => 'BCA',
            'account_number' => '1234567890',
            'account_name' => 'Miftachul Umam',
        ]);
    }
}
