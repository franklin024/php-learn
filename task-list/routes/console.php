<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Đăng ký lịch chạy ở đây
Schedule::command('app:send-task-reminders')
    ->dailyAt('08:00') // Chạy lúc 8h sáng hàng ngày
    ->timezone('Asia/Ho_Chi_Minh'); // Quan trọng: Set đúng múi giờ VN


// Khai báo lại lệnh y hệt
Schedule::command('app:send-task-reminders')
    ->dailyAt('14:00') // Chạy lúc 2 giờ chiều (14:00)
    ->timezone('Asia/Ho_Chi_Minh');
