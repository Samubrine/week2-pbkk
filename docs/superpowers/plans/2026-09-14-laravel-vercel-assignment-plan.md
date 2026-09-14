# Laravel Vercel Assignment Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Create a static-like Laravel 11 application for an academic assignment, ready to deploy serverlessly on Vercel, featuring a hero page, academic profile, calculator, and agent harness.

**Architecture:** Standard Laravel 11 MVC with Vite/TailwindCSS. Vercel Serverless PHP bridging via `api/index.php`. All features isolated into `PageController`, `AgentController`, and `DashboardController`.

**Tech Stack:** Laravel 11, PHP 8.2+, Tailwind CSS, Vercel Serverless PHP.

## Global Constraints
- **Strictly PSR-12:** Clean code, standardized formatting, clear controller separation.
- **Named Routes:** ALL internal routes must use `->name()` and `route()` helper. No hardcoded URLs.
- **Vercel Native:** Must include `vercel.json` and `api/index.php` for seamless deployment.
- **Assignment Rules:** Must use `Route::fallback()`, `{ip1}/{ip2}` params, and `[0-9]{10}` regex.

---

### Task 1: Bootstrap Laravel & Vercel Configuration

**Files:**
- Create: `api/index.php`
- Create: `vercel.json`
- Create: `.vercelignore`

**Interfaces:**
- Produces: Base Laravel installation ready for routing and Vercel deployment.

- [ ] **Step 1: Install Laravel 11**
Run: `composer create-project laravel/laravel . --prefer-dist` (Ensure this runs cleanly in the empty directory)

- [ ] **Step 2: Create Vercel Configuration**
Create `vercel.json`:
```json
{
    "version": 2,
    "builds": [
        { "src": "api/index.php", "use": "vercel-php@0.6.1" },
        { "src": "public/**", "use": "@vercel/static" }
    ],
    "routes": [
        { "src": "/build/(.*)", "dest": "/public/build/$1" },
        { "src": "/(.*)", "dest": "/api/index.php" }
    ],
    "env": {
        "APP_ENV": "production",
        "APP_DEBUG": "false",
        "APP_URL": "https://your-app-url.vercel.app",
        "APP_CONFIG_CACHE": "/tmp/config.php",
        "APP_EVENTS_CACHE": "/tmp/events.php",
        "APP_PACKAGES_CACHE": "/tmp/packages.php",
        "APP_ROUTES_CACHE": "/tmp/routes.php",
        "APP_SERVICES_CACHE": "/tmp/services.php",
        "VIEW_COMPILED_PATH": "/tmp",
        "CACHE_STORE": "array",
        "SESSION_DRIVER": "cookie",
        "LOG_CHANNEL": "stderr"
    }
}
```

- [ ] **Step 3: Create Vercel PHP Entrypoint**
Create `api/index.php`:
```php
<?php
require __DIR__ . '/../public/index.php';
```

- [ ] **Step 4: Create Vercel Ignore**
Create `.vercelignore`:
```text
/vendor
/node_modules
/tests
/.env
```

- [ ] **Step 5: Commit Setup**
Run:
```bash
git init
git add .
git commit -m "chore: bootstrap laravel 11 and vercel configs"
```

---

### Task 2: Install Tailwind CSS & Configure UI Assets

**Files:**
- Modify: `package.json`, `tailwind.config.js`, `postcss.config.js`
- Modify: `resources/css/app.css`
- Create: `resources/views/layouts/app.blade.php`

**Interfaces:**
- Produces: Base Blade layout (`layouts.app`) with TailwindCSS compiled via Vite.

- [ ] **Step 1: Install Tailwind CSS**
Run: `npm install -D tailwindcss postcss autoprefixer`
Run: `npx tailwindcss init -p`

- [ ] **Step 2: Configure Tailwind**
Modify `tailwind.config.js`:
```javascript
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

- [ ] **Step 3: Add Tailwind Directives**
Modify `resources/css/app.css`:
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

- [ ] **Step 4: Build Assets**
Run: `npm run build`

- [ ] **Step 5: Create Base App Layout**
Create `resources/views/layouts/app.blade.php`:
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tugas Mandiri')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen flex flex-col">
    <nav class="bg-white shadow-sm py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-bold text-xl text-blue-600">ITS Web</a>
            <div class="space-x-4">
                <a href="{{ route('dashboard.mahasiswa', ['nrp' => '5025241046']) }}" class="text-gray-600 hover:text-blue-600">Mahasiswa</a>
                <a href="{{ route('dashboard.kalkulator', ['ip1' => 3.5, 'ip2' => 4.0]) }}" class="text-gray-600 hover:text-blue-600">Kalkulator</a>
                <a href="{{ route('agent.show', ['type' => 'security-harness']) }}" class="text-gray-600 hover:text-blue-600">Agent</a>
            </div>
        </div>
    </nav>
    <main class="flex-grow max-w-7xl mx-auto px-4 py-8 w-full">
        @yield('content')
    </main>
    <footer class="bg-white border-t py-4 text-center text-sm text-gray-500 mt-auto">
        &copy; {{ date('Y') }} Tugas Mandiri
    </footer>
</body>
</html>
```

- [ ] **Step 6: Commit UI Setup**
Run:
```bash
git add .
git commit -m "feat: install tailwind and base layout"
```

---

### Task 3: Implement Page & Agent Controllers

**Files:**
- Create: `app/Http/Controllers/PageController.php`
- Create: `app/Http/Controllers/AgentController.php`
- Create: `resources/views/home.blade.php`
- Create: `resources/views/agent.blade.php`
- Create: `resources/views/errors/404.blade.php`
- Modify: `routes/web.php`

**Interfaces:**
- Produces: `home`, `agent.show`, and `fallback` named routes.

- [ ] **Step 1: Create Controllers**
Run: `php artisan make:controller PageController`
Run: `php artisan make:controller AgentController`

- [ ] **Step 2: Implement PageController Methods**
Modify `app/Http/Controllers/PageController.php`:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function fallback()
    {
        return response()->view('errors.404', [], 404);
    }
}
```

- [ ] **Step 3: Implement AgentController Methods**
Modify `app/Http/Controllers/AgentController.php`:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function show($type = null)
    {
        $isSecurityHarness = $type === 'security-harness';
        return view('agent', compact('isSecurityHarness', 'type'));
    }
}
```

- [ ] **Step 4: Update Routing**
Modify `routes/web.php` (remove default welcome route):
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AgentController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/agent/{type?}', [AgentController::class, 'show'])->name('agent.show');
Route::fallback([PageController::class, 'fallback'])->name('fallback');
```

- [ ] **Step 5: Create Home View**
Create `resources/views/home.blade.php`:
```html
@extends('layouts.app')

@section('title', 'ITS Hero Page')

@section('content')
<div class="flex flex-col items-center justify-center py-20 text-center">
    <h1 class="text-5xl font-extrabold text-blue-900 mb-6 drop-shadow-sm">Welcome to ITS</h1>
    <p class="text-xl text-gray-600 max-w-2xl">Advancing humanity through technology and innovation. Explore the interactive campus portals below.</p>
</div>
@endsection
```

- [ ] **Step 6: Create Agent View**
Create `resources/views/agent.blade.php`:
```html
@extends('layouts.app')

@section('title', 'Agent Interface')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
    <div class="bg-black px-6 py-4 border-b border-gray-800 flex items-center space-x-2">
        <div class="w-3 h-3 rounded-full bg-red-500"></div>
        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
        <div class="w-3 h-3 rounded-full bg-green-500"></div>
        <span class="ml-4 text-gray-400 text-sm font-mono tracking-widest">AGENT TERMINAL</span>
    </div>
    <div class="p-8 text-green-400 font-mono">
        @if($isSecurityHarness)
            <h2 class="text-3xl font-bold text-white mb-4">Security AI Agent Harness</h2>
            <p class="mb-2">> Initializing general purpose security agent...</p>
            <p class="mb-2">> Integrating multiple MCPs and skills...</p>
            <p class="mb-2">> Connecting to orchestrator / board review...</p>
            <p class="text-blue-400 mt-6">> STATUS: ONLINE AND READY FOR COMPLEX TASKS.</p>
        @else
            <h2 class="text-3xl font-bold text-white mb-4">General Assistant Agent</h2>
            <p class="mb-2">> Mode: Standard Assistant</p>
            <p class="text-yellow-400 mt-6">> STATUS: STANDBY.</p>
        @endif
    </div>
</div>
@endsection
```

- [ ] **Step 7: Create 404 View**
Create `resources/views/errors/404.blade.php`:
```html
@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="flex flex-col items-center justify-center py-20 text-center">
    <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
    <h2 class="text-2xl text-gray-600 mb-8">Halaman Tidak Ditemukan</h2>
    <p class="text-gray-500 mb-8">The academic portal you are looking for does not exist or has been moved.</p>
    <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Return Home</a>
</div>
@endsection
```

- [ ] **Step 8: Commit General Pages**
Run:
```bash
git add .
git commit -m "feat: implement home, agent, and fallback routes with PSR controllers"
```

---

### Task 4: Implement Dashboard Controller & Academic Logic

**Files:**
- Create: `app/Http/Controllers/DashboardController.php`
- Modify: `routes/web.php`
- Create: `resources/views/dashboard/mahasiswa.blade.php`
- Create: `resources/views/dashboard/kalkulator.blade.php`

**Interfaces:**
- Produces: `dashboard.mahasiswa` and `dashboard.kalkulator` named routes with strict constraints.

- [ ] **Step 1: Create Dashboard Controller**
Run: `php artisan make:controller DashboardController`

- [ ] **Step 2: Implement Logic**
Modify `app/Http/Controllers/DashboardController.php`:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mahasiswa($nrp)
    {
        if ($nrp !== '5025241046') {
            return response()->view('errors.404', [], 404); // Reusing 404 cleanly
        }

        return view('dashboard.mahasiswa', compact('nrp'));
    }

    public function kalkulator($ip1, $ip2)
    {
        $sum = (float) $ip1 + (float) $ip2;
        $average = $sum / 2;

        return view('dashboard.kalkulator', compact('ip1', 'ip2', 'sum', 'average'));
    }
}
```

- [ ] **Step 3: Update Routing for Group & Regex**
Append to `routes/web.php` (above the fallback route):
```php
use App\Http\Controllers\DashboardController;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/mahasiswa/{nrp}', [DashboardController::class, 'mahasiswa'])
        ->where('nrp', '[0-9]{10}')
        ->name('mahasiswa');
        
    Route::get('/hitung-ipk/{ip1}/{ip2}', [DashboardController::class, 'kalkulator'])
        ->where(['ip1' => '[0-9\.]+', 'ip2' => '[0-9\.]+'])
        ->name('kalkulator');
});
```

- [ ] **Step 4: Create Mahasiswa View**
Create `resources/views/dashboard/mahasiswa.blade.php`:
```html
@extends('layouts.app')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="bg-blue-600 h-32"></div>
    <div class="px-8 py-6 relative">
        <div class="w-24 h-24 bg-white rounded-full border-4 border-white shadow-md absolute -top-12 flex items-center justify-center text-4xl text-gray-300">
            👤
        </div>
        <div class="mt-14">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Profil Akademis</h2>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 font-semibold">NRP</p>
                    <p class="text-lg text-gray-900">{{ $nrp }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 font-semibold">Status</p>
                    <p class="text-lg text-green-600 font-medium">Active</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

- [ ] **Step 5: Create Kalkulator View**
Create `resources/views/dashboard/kalkulator.blade.php`:
```html
@extends('layouts.app')

@section('title', 'Kalkulator Portofolio Akademis')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
        <span class="mr-2">📊</span> Kalkulator Portofolio Akademis
    </h2>
    
    <div class="grid grid-cols-2 gap-6 mb-8">
        <div class="border rounded-xl p-4 text-center bg-gray-50">
            <p class="text-sm text-gray-500 mb-1">Semester 1 (IP1)</p>
            <p class="text-2xl font-bold text-blue-600">{{ number_format((float)$ip1, 2) }}</p>
        </div>
        <div class="border rounded-xl p-4 text-center bg-gray-50">
            <p class="text-sm text-gray-500 mb-1">Semester 2 (IP2)</p>
            <p class="text-2xl font-bold text-blue-600">{{ number_format((float)$ip2, 2) }}</p>
        </div>
    </div>

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl p-6 text-white text-center">
        <div class="grid grid-cols-2 divide-x divide-white/20">
            <div>
                <p class="text-blue-100 text-sm mb-1 uppercase tracking-wider font-semibold">Total Nilai</p>
                <p class="text-3xl font-bold">{{ number_format($sum, 2) }}</p>
            </div>
            <div>
                <p class="text-blue-100 text-sm mb-1 uppercase tracking-wider font-semibold">Rata-Rata IPK</p>
                <p class="text-3xl font-bold">{{ number_format($average, 2) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
```

- [ ] **Step 6: Final Commit**
Run:
```bash
git add .
git commit -m "feat: implement dashboard controller with regex, group routes, and calculation logic"
```
