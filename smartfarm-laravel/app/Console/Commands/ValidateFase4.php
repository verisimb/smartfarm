<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LandPrediction;
use App\Http\Controllers\LandPredictionController;

class ValidateFase4 extends Command
{
    protected $signature = 'validate:fase4';
    protected $description = 'Validasi lengkap Fase 4 SmartFarm';

    public function handle()
    {
        $this->line('');
        $this->line('================================================');
        $this->info('  VALIDASI FASE 4 - SMARTFARM');
        $this->line('================================================');
        $this->line('');

        $passed = 0;
        $failed = 0;

        // --- BAGIAN 1: DATABASE ---
        $this->info('[1] DATABASE & MODEL');

        // Buat/dapatkan test user
        $user = User::firstOrCreate(
            ['email' => 'rama@smartfarm.test'],
            [
                'name' => 'Rama Tester',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $this->line("    ✅ User test: {$user->name} ({$user->email})");
        $passed++;

        // Cek tabel land_predictions ada kolom yang benar
        $fillable = (new LandPrediction)->getFillable();
        $requiredFields = ['user_id', 'N', 'P', 'K', 'temperature', 'humidity', 'ph', 'rainfall', 'recommended_crop', 'cluster', 'land_type'];
        $missingFields = array_diff($requiredFields, $fillable);
        if (empty($missingFields)) {
            $this->line('    ✅ Model fillable: semua field lengkap (' . implode(', ', $requiredFields) . ')');
            $passed++;
        } else {
            $this->error('    ❌ Model fillable MISSING: ' . implode(', ', $missingFields));
            $failed++;
        }

        // --- BAGIAN 2: CONTROLLER METHODS ---
        $this->line('');
        $this->info('[2] CONTROLLER METHODS');
        $controller = new LandPredictionController();
        $methods = ['dashboard', 'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
        foreach ($methods as $method) {
            if (method_exists($controller, $method)) {
                $this->line("    ✅ {$method}()");
                $passed++;
            } else {
                $this->error("    ❌ {$method}() MISSING");
                $failed++;
            }
        }

        // --- BAGIAN 3: ROUTES ---
        $this->line('');
        $this->info('[3] ROUTES');
        $router = app('router');
        $routes = $router->getRoutes();
        $requiredRoutes = [
            'predictions.index',
            'predictions.show',
            'predictions.create',
            'predictions.store',
            'predictions.edit',
            'predictions.update',
            'predictions.destroy',
        ];
        foreach ($requiredRoutes as $routeName) {
            if ($routes->hasNamedRoute($routeName)) {
                $this->line("    ✅ {$routeName}");
                $passed++;
            } else {
                $this->error("    ❌ {$routeName} NOT FOUND");
                $failed++;
            }
        }

        // --- BAGIAN 4: BLADE VIEWS ---
        $this->line('');
        $this->info('[4] BLADE VIEWS');
        $views = [
            'dashboard' => resource_path('views/dashboard.blade.php'),
            'predictions/index' => resource_path('views/predictions/index.blade.php'),
            'predictions/show' => resource_path('views/predictions/show.blade.php'),
            'predictions/create' => resource_path('views/predictions/create.blade.php'),
            'predictions/edit' => resource_path('views/predictions/edit.blade.php'),
            'layouts/app' => resource_path('views/layouts/app.blade.php'),
        ];
        foreach ($views as $name => $path) {
            if (file_exists($path)) {
                $size = number_format(filesize($path));
                $this->line("    ✅ {$name}.blade.php ({$size} bytes)");
                $passed++;
            } else {
                $this->error("    ❌ {$name}.blade.php MISSING");
                $failed++;
            }
        }

        // --- BAGIAN 5: BUILD ASSETS ---
        $this->line('');
        $this->info('[5] VITE BUILD ASSETS');
        $buildFiles = [
            'public/build/manifest.json',
            'public/build/assets',
        ];
        foreach ($buildFiles as $file) {
            $path = base_path($file);
            if (file_exists($path)) {
                $this->line("    ✅ {$file}");
                $passed++;
            } else {
                $this->error("    ❌ {$file} MISSING - jalankan: npm run build");
                $failed++;
            }
        }

        // --- BAGIAN 6: QUERY LOGIC ---
        $this->line('');
        $this->info('[6] QUERY LOGIC (index, show, destroy)');

        // Bersihkan dan buat prediksi test
        LandPrediction::where('user_id', $user->id)->delete();
        $p1 = LandPrediction::create([
            'user_id' => $user->id, 'N' => 90, 'P' => 42, 'K' => 43,
            'temperature' => 20.87, 'humidity' => 82, 'ph' => 6.5, 'rainfall' => 202.93,
            'recommended_crop' => 'rice', 'cluster' => 1, 'land_type' => 'Lahan Subur',
        ]);
        $p2 = LandPrediction::create([
            'user_id' => $user->id, 'N' => 35, 'P' => 54, 'K' => 25,
            'temperature' => 24.5, 'humidity' => 65, 'ph' => 7.2, 'rainfall' => 85.5,
            'recommended_crop' => 'maize', 'cluster' => 2, 'land_type' => 'Lahan Semi-Kering',
        ]);

        // Test index() query
        $predictions = LandPrediction::where('user_id', $user->id)->latest()->get();
        if ($predictions->count() === 2) {
            $this->line("    ✅ index() query: {$predictions->count()} prediksi ditemukan");
            $passed++;
        } else {
            $this->error("    ❌ index() query: Expected 2, got " . $predictions->count());
            $failed++;
        }

        // Test show() query
        try {
            $found = LandPrediction::where('user_id', $user->id)->findOrFail($p1->id);
            $this->line("    ✅ show() query: Ditemukan ID #{$found->id} ({$found->recommended_crop})");
            $passed++;
        } catch (\Exception $e) {
            $this->error('    ❌ show() query: ' . $e->getMessage());
            $failed++;
        }

        // Test destroy() logic
        $countBefore = LandPrediction::where('user_id', $user->id)->count();
        $p2->delete();
        $countAfter = LandPrediction::where('user_id', $user->id)->count();
        if ($countAfter === $countBefore - 1) {
            $this->line("    ✅ destroy() logic: {$countBefore} → {$countAfter} (1 dihapus)");
            $passed++;
        } else {
            $this->error("    ❌ destroy() logic gagal: {$countBefore} → {$countAfter}");
            $failed++;
        }

        // --- BAGIAN 7: LAYOUT FEATURES ---
        $this->line('');
        $this->info('[7] LAYOUT FEATURES');
        $appLayout = file_get_contents(resource_path('views/layouts/app.blade.php'));
        
        if (str_contains($appLayout, 'hugeicons')) {
            $this->line('    ✅ Hugeicons CDN di layout');
            $passed++;
        } else {
            $this->error('    ❌ Hugeicons CDN MISSING dari layout');
            $failed++;
        }

        if (str_contains($appLayout, "@stack('scripts')")) {
            $this->line('    ✅ @stack(scripts) di layout');
            $passed++;
        } else {
            $this->error("    ❌ @stack('scripts') MISSING");
            $failed++;
        }

        if (str_contains($appLayout, 'Plus+Jakarta+Sans') || str_contains($appLayout, 'Plus Jakarta Sans')) {
            $this->line('    ✅ Google Font Plus Jakarta Sans di layout');
            $passed++;
        } else {
            $this->error('    ❌ Font Plus Jakarta Sans MISSING');
            $failed++;
        }

        // --- SUMMARY ---
        $this->line('');
        $this->line('================================================');
        $total = $passed + $failed;
        if ($failed === 0) {
            $this->info("  HASIL: {$passed}/{$total} LULUS ✅ FASE 4 SEMPURNA!");
        } else {
            $this->warn("  HASIL: {$passed}/{$total} LULUS | {$failed} GAGAL ⚠️");
        }
        $this->line('================================================');
        $this->line('');
        $this->line('CREDENTIALS TEST:');
        $this->line('  URL      : http://127.0.0.1:8000/login');
        $this->line('  Email    : rama@smartfarm.test');
        $this->line('  Password : password');
        $this->line('');
        $this->line('TEST PAGES:');
        $this->line('  Dashboard : http://127.0.0.1:8000/dashboard');
        $this->line('  Riwayat   : http://127.0.0.1:8000/predictions');
        $this->line('  Buat Baru : http://127.0.0.1:8000/predictions/create');
        $this->line("  Detail    : http://127.0.0.1:8000/predictions/{$p1->id}");
        $this->line("  Edit      : http://127.0.0.1:8000/predictions/{$p1->id}/edit");
        $this->line('');

        return $failed === 0 ? 0 : 1;
    }
}
