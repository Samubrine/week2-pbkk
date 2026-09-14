# Laravel Vercel Assignment - Design Spec

## Overview
A static-like Laravel 11 application designed specifically for deployment on Vercel. The project fulfills an academic assignment (Tugas Mandiri) with strict requirements around routing, regex validation, PSR code standards, and named routes, wrapped in a premium "Pro Max" UI/UX.

## 1. Routing & Controller Architecture

Strictly adhering to named routes and PSR controller separation.

### Controllers
- **`PageController`**: Handles general pages (Home, Fallback).
- **`AgentController`**: Handles the AI Agent harness page.
- **`DashboardController`**: Handles academic features (Mahasiswa profile, IPK Calculator).

### Routes Map
| Method | URI | Name | Controller@Method | Logic/Constraint |
|---|---|---|---|---|
| GET | `/` | `home` | `PageController@home` | Renders the interactive ITS Hero page. |
| GET | `/agent/{type?}` | `agent.show` | `AgentController@show` | If `$type === 'security-harness'`, shows full harness UI. Else, shows "General Assistant Agent". |
| GET | `/dashboard/mahasiswa/{nrp}` | `dashboard.mahasiswa` | `DashboardController@mahasiswa` | Regex: `[0-9]{10}`. If NRP `5025241046`, shows profile. Else, "Couldn't find profile". |
| GET | `/dashboard/hitung-ipk/{ip1}/{ip2}` | `dashboard.kalkulator` | `DashboardController@kalkulator` | Calculates and displays `sum` and `average` of IP1 and IP2. |
| ANY | `{fallbackPlaceholder}` | `fallback` | `PageController@fallback` | `Route::fallback()`. Renders a custom 404 page. |

## 2. UI/UX Design ("Pro Max" Style)
Built with Laravel Blade and Tailwind CSS.
- **Home (ITS Hero):** Interactive, modern university landing page. Glassmorphism styling, clean typography.
- **Agent Harness:** Cyberpunk / Security-tech aesthetic (dark mode, monospaced fonts, dashboard layout).
- **Dashboard (Mahasiswa & Kalkulator):** Clean, card-based academic dashboard interfaces.
- **Navigation:** All internal links use `route()` helpers. Zero hardcoded URLs.

## 3. Deployment Automation (Vercel Closed-Loop)
To run Laravel natively on Vercel without maintaining a server:
- **`vercel.json`**: Configures the PHP runtime (`vercel-php`) and rewrites all traffic to `api/index.php`.
- **`api/index.php`**: Standard Vercel PHP entrypoint that bootstraps the Laravel application.
- **`.vercelignore`**: Excludes vendor and node_modules from the initial upload (built on Vercel).
- **Build Step**: Vercel will automatically run `composer install` and `npm run build` upon GitHub push.

## 4. Success Criteria (Rubric Alignment)
1. **Spesifikasi Teknis (40%)**: All routes functional, parameters correct.
2. **Kerapian Kode (20%)**: PSR-12 formatting, clean Controllers, no logic in `web.php`.
3. **Named Routes (20%)**: 100% usage of `->name()` and `route()` helper.
4. **Challenge A+ (10%)**: Regex on `{nrp}`, math logic in `{ip1}/{ip2}`, and explicit `Route::fallback()`.
5. **Vercel Automation**: Zero-touch deployment via GitHub integration.
