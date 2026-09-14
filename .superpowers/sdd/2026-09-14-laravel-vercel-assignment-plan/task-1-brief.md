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
