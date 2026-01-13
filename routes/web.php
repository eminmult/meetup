<?php

use App\Http\Controllers\MeetupController;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Route для Livewire preview файлов
Route::get('/livewire/preview-file/{filename}', function ($filename) {
    $disk = config('livewire.temporary_file_upload.disk', 'livewire-tmp');
    $diskInstance = Storage::disk($disk);

    if ($diskInstance->exists($filename)) {
        $path = $diskInstance->path($filename);
        if (file_exists($path)) {
            return response()->file($path);
        }
    }

    abort(404, 'File not found');
})->where('filename', '.*')->name('livewire.preview-file');

// Redirect root to default locale
Route::get('/', function () {
    $locale = session('locale', LanguageService::getDefaultCode());
    return redirect()->to("/{$locale}");
});

// Localized routes with dynamic prefix pattern
Route::prefix('{locale}')
    ->where(['locale' => LanguageService::getLocalePattern()])
    ->middleware('setLocale')
    ->group(function () {
        Route::get('/', [MeetupController::class, 'index'])->name('home');
        Route::get('/services', [MeetupController::class, 'services'])->name('services');
        Route::get('/services/{slug}', [MeetupController::class, 'showService'])->name('service.show');
        Route::get('/portfolio', [MeetupController::class, 'portfolio'])->name('portfolio');
        Route::get('/portfolio/{slug}', [MeetupController::class, 'showPortfolio'])->name('portfolio.show');
        Route::get('/team', [MeetupController::class, 'team'])->name('team');
        Route::get('/team/{slug}', [MeetupController::class, 'showTeamMember'])->name('team.show');
        Route::get('/about', [MeetupController::class, 'about'])->name('about');
        Route::get('/blog', [MeetupController::class, 'blog'])->name('blog');
        Route::get('/blog/{slug}', [MeetupController::class, 'showPost'])->name('blog.show');
        Route::get('/events', [MeetupController::class, 'events'])->name('events');
        Route::get('/events/{slug}', [MeetupController::class, 'showEvent'])->name('event.show');
        Route::get('/contact', [MeetupController::class, 'contact'])->name('contact');
        Route::post('/contact', [MeetupController::class, 'submitContact'])->name('contact.submit');
    });
