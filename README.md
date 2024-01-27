<h1 align="center">MadinApp</h1>

## Tentang MadinApp

MadinApp merupakan aplikasi management untuk madrasah diniyyah (Madin) dengan fitur mengelolah beberapa data dalam administrasi tata usaha madrasah seperti:

-   Identitas Madin
-   Data Asatidz
-   Data Santri
-   Data Pelajaran
-   Data Kelas
-   Data Periode
-   Penilaian
-   Import Penilaian from Excel
-   Raport

## Coming soon

-   Export / Import Data Asatidz dengan Excel
-   Export / Import Data Santri dengan Excel

## Requirements

-   PHP 8.1 or newer
-   MariaDB 10.4.32
-   PHP extension php_gd enabled (php.ini)
-   PHP extension php_zip enabled (php.ini)

## Installation

Clone repository

```
git clone https://github.com/saktiID/madin-app.git
```

Install Package

```
composer Install
```

Copy .env file

```
cp .env.example .env
```

Generate key

```
php artisan key:generate
```

Link storage

```
php artisan storage:link
```

Migrate database

```
php artisan migrate --seed
```

Serve

```
php artisan serve
```

## License

MadinApp adalah perangkat lunak sumber terbuka yang dilisensikan di bawah [lisensi MIT] (https://opensource.org/licenses/MIT).
