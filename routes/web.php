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
    //Charts
    Route::get('notes/charts', function () {
        return view('charts');
    })->middleware(['auth', 'verified'])->name('charts');
    //Notes
    Route::get('notes/list', [PostCatatan::class, 'index'])->middleware(['auth', 'verified'])->name('notes');
    //Library
    Route::get('notes/library', [PostLibrary::class, 'index'])->middleware(['auth', 'verified'])->name('libraries');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //CRUD
    // Route::get('notes/list', [PostCatatan::class, 'index'])->middleware(['auth', 'verified'])->name('Catatan.index');
    // Route::post('notes/list', [PostCatatan::class, 'store'])->middleware(['auth', 'verified'])->name('Catatan.store');
    // Route::post('notes/list/create', [PostCatatan::class, 'create'])->middleware(['auth', 'verified'])->name('Catatan.create');
    // Route::post('notes/list/{id}', [PostCatatan::class, 'update'])->middleware(['auth', 'verified'])->name('Catatan.update');
    // Route::get('notes/list/{id}/edit', [PostCatatan::class, 'edit'])->middleware(['auth', 'verified'])->name('Catatan.edit');
    // Route::delete('notes/list/{id}', [PostCatatan::class, 'destroy'])->middleware(['auth', 'verified'])->name('Catatan.destroy');


    //Charts
    Route::get('notes/charts', [ChartController::class, 'charts'])->middleware(['auth', 'verified'])->name('charts');

    // Controller PostCatatan (CRUD)
    Route::resource('notes', PostCatatan::class);
    Route::resource('library', PostLibrary::class);


    require __DIR__.'/auth.php';
