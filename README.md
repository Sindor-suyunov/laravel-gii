# About

powerfull UI web interface for generating code (model, controller .. ) in Laravel (save your time)

## Installation and usage

**1. Install package to your laravel project**

```bash
composer require sindor/laravel-gii:dev-main
```

**2. Migrate your migrations (if you did not have DB tables)**

```bash
php artisan migrate
```

**3. Serve your project**

```bash
php artisan serve
```

**4. Go to link (home_url + /gii)**

```bash
http://127.0.0.1:8000/gii/
```

**5. Go to /gii/generate-model for generating model**

```bash
http://127.0.0.1:8000/gii/generate-model
```

**6. Enjoy :)**
