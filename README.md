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
-   Raport

## Installation

Clone repository

```
git clone https://github.com/saktiID/madin-app.git
```

Install Package

```
composer Install
```

Generate key

```
php artisan key:generate
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
