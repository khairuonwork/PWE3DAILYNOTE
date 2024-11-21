    <?php

    use App\Http\Controllers\ChartController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\PostCatatan;
    use App\Http\Controllers\PostLibrary;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });
    //Dashboard
    Route::get('notes/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    //Notes
    Route::get('notes/list', [PostCatatan::class, 'index'])->middleware(['auth', 'verified'])->name('notes');


    // Image Library
    Route::get('notes/library', [PostLibrary::class, 'index'])->middleware(['auth', 'verified'])->name('library');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //Charts
    Route::get('notes/charts', [ChartController::class, 'charts'])->middleware(['auth', 'verified'])->name('charts');

    // Controller Resource
    Route::resource('notes', PostCatatan::class);


    Route::resource('library', PostLibrary::class);


    require __DIR__.'/auth.php';
