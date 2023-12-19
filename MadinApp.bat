@echo off

setlocal enabledelayedexpansion

start "MadinApp" C:\Windows\System32\wscript.exe "C:\xampp\htdocs\madin-app\madinApp.vbs"

echo +---------------------------+
echo   Memulai aplikasi MadinApp
echo +---------------------------+

echo.

set /A "seconds=3"

for /L %%i in (!seconds!, -1, 1) do (
    set /A "i=%%i"
    echo Sedang memulai server Apache...
    timeout /nobreak /t 1 >nul
)

set /A "seconds=3"

for /L %%i in (!seconds!, -1, 1) do (
    set /A "i=%%i"
    echo Sedang memulai server MySQL...
    timeout /nobreak /t 1 >nul
)

set /A "seconds=4"

for /L %%i in (!seconds!, -1, 1) do (
    set /A "i=%%i"
    echo Sedang memulai server MadinApp...
    timeout /nobreak /t 1 >nul
)

echo Refresh browser jika halaman aplikasi belum terbuka.

echo.

echo Membuka aplikasi MadinApp...

timeout /t 5