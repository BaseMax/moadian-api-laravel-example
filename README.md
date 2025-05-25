# Moadian API Laravel Example

This is a simple example Laravel project demonstrating how to use the [`jooyeshgar/moadian`](https://github.com/Jooyeshgar/moadian) PHP package for integrating with Iran's national tax system (سامانه مودیان).

> ⚠️ **Note**: This is a test project and should not be used in production without proper validation, error handling, and security hardening.

## 🔧 Features

- Demonstrates basic usage of the `jooyeshgar/moadian` package
- Retrieves:
  - A server nonce via the Moadian API
  - Server info
- Basic error handling for API responses

## 📁 Project Structure

This example is built on top of a fresh Laravel installation and adds a sample route at `/test-moadian` that interacts with the سامانه مودیان.

## 🧪 How It Works

The `/test-moadian` route initializes the Moadian client using your private key, certificate, and base API URL. It then sends two test requests:

1. `getNonce()`: Gets a unique one-time token from the tax system.
2. `getServerInfo()`: Fetches server information.

The route returns both responses as JSON.

## 🛠️ Setup Instructions

1. **Clone the Repository**

   ```bash
   git clone https://github.com/BaseMax/moadian-api-laravel-example.git
   cd moadian-api-laravel-example
   ```

2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

4. **Configure Environment**

   Copy `.env.example` to `.env` and configure the following:

   ```dotenv
   MOADIAN_USERNAME=xxxxxxxxxxx
   TAXID=xxxxxxxxxxx
   ```

   Also ensure your private key and certificate files are placed in:

   ```
   storage/app/keys/private.pem
   storage/app/keys/certificate.crt
   ```

5. **Serve the Application**

   ```bash
   php artisan serve
   ```

6. **Test the Endpoint**

   Visit:

   ```
   http://localhost:8000/test-moadian
   ```

## 📄 Example Route

This is the key route defined in `routes/web.php`:

```php
Route::get('/test-moadian', function () {
    try {
        $privateKey = file_get_contents(__DIR__.'/../storage/app/keys/private.pem');
        $certificate = file_get_contents(__DIR__.'/../storage/app/keys/certificate.crt');
        $base_url = 'https://tp.tax.gov.ir/requestsmanager/api/v2/';
        $moadian = new Moadian($privateKey, $certificate, $base_url);
        $nonce = $moadian->getNonce();
        $info = $moadian->getServerInfo();
        return response()->json([$nonce, $info]);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
```

## 📦 Dependencies

- PHP 8.1+
- Laravel 10+
- [jooyeshgar/moadian](https://github.com/Jooyeshgar/moadian)

## 🪪 License

MIT License © 2025 [Max Base](https://github.com/BaseMax)
