<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notifications = [
            [
                'isInformation' => 1,
                'title' => 'Selamat Datang di Venidici!',
                'description' => 'Silahkan verifikasi email, dan lengkapi profil anda untuk mencoba fitur Venidici!',
                'link' => 'https://venidici.id/dashboard'
            ]
        ];

        foreach ($notifications as $key => $value) {
            Notification::create($value);
        }
    }
}
