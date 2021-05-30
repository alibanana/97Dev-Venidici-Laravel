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
                'title' => 'Venidici Ada Sales Event Baru Loh!',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.',
                'link' => 'http://instagram.com/veni.dici/'
            ],
            [
                'isInformation' => 1,
                'title' => 'Venidici Telah Selesai Dibuat',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.',
                'link' => 'http://instagram.com/veni.dici/'
            ],
            [
                'isInformation' => 1,
                'title' => 'Ada Promo Discount Untuk Online Course',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.',
                'link' => 'http://instagram.com/veni.dici/'
            ],
            [
                'isInformation' => 1,
                'title' => 'Venidici 1 Bulan lagi launching!',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.',
                'link' => 'http://instagram.com/veni.dici/'
            ],
        ];

        foreach ($notifications as $key => $value) {
            Notification::create($value);
        }
    }
}
