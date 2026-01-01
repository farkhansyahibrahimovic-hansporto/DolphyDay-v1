<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MicroAction;
use App\Models\GrowthLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user biasa
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'avatar' => null,
        ]);

        // Membuat beberapa micro actions untuk user
        $microActions = [
            [
                'title' => 'Olahraga pagi',
                'description' => 'Jogging selama 30 menit di taman',
                'is_completed' => true,
                'completed_at' => Carbon::now()->subDays(2),
                'action_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'title' => 'Membaca buku',
                'description' => 'Membaca minimal 20 halaman buku pengembangan diri',
                'is_completed' => true,
                'completed_at' => Carbon::now()->subDays(1),
                'action_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
            ],
            [
                'title' => 'Meditasi',
                'description' => 'Meditasi selama 15 menit',
                'is_completed' => false,
                'completed_at' => null,
                'action_date' => Carbon::now()->format('Y-m-d'),
            ],
            [
                'title' => 'Belajar koding',
                'description' => 'Mengerjakan tutorial Laravel selama 1 jam',
                'is_completed' => false,
                'completed_at' => null,
                'action_date' => Carbon::now()->format('Y-m-d'),
            ],
            [
                'title' => 'Minum air putih 8 gelas',
                'description' => 'Memastikan hidrasi yang cukup sepanjang hari',
                'is_completed' => false,
                'completed_at' => null,
                'action_date' => Carbon::now()->addDay()->format('Y-m-d'),
            ],
        ];

        foreach ($microActions as $action) {
            $user->microActions()->create($action);
        }

        // Membuat beberapa growth logs untuk user
        $growthLogs = [
            [
                'reflection' => 'Hari ini saya merasa sangat produktif. Berhasil menyelesaikan beberapa tugas yang tertunda.',
                'mood' => 'hopeful',
                'log_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
            ],
            [
                'reflection' => 'Mulai membiasakan diri untuk bangun pagi. Terasa lebih segar dan punya waktu lebih banyak.',
                'mood' => 'growing',
                'log_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'reflection' => 'Hari yang tenang. Belajar untuk lebih bersabar dengan diri sendiri.',
                'mood' => 'peaceful',
                'log_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
            ],
            [
                'reflection' => 'Sedikit kesulitan untuk fokus hari ini, tapi tetap berusaha melakukan yang terbaik.',
                'mood' => 'struggling',
                'log_date' => Carbon::now()->format('Y-m-d'),
            ],
        ];

        foreach ($growthLogs as $log) {
            $user->growthLogs()->create($log);
        }

        $this->command->info('Users, Micro Actions, and Growth Logs created successfully!');
    }
}