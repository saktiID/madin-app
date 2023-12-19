Set objShell = CreateObject("WScript.Shell")

' Start Apache
objShell.Run "cmd /c start /b C:\xampp\apache_start.bat", 0, True

' Cek apakah MySQL sudah berjalan
strCommand = "tasklist /FI ""IMAGENAME eq mysqld.exe"" /NH"
Set objExec = objShell.Exec(strCommand)
strTasklistOutput = objExec.StdOut.ReadAll

' Jika MySQL belum berjalan, jalankan mysql_start.bat
If InStr(strTasklistOutput, "mysqld.exe") = 0 Then
    objShell.Run "cmd /c start /b C:\xampp\mysql_start.bat", 0, True
    WScript.Sleep 5000 ' Tunggu beberapa detik sebelum melanjutkan
End If

' Tunggu beberapa saat sebelum melanjutkan
WScript.Sleep 5000

' Arahkan ke direktori htdocs
objShell.CurrentDirectory = "C:\xampp\htdocs"

' Arahkan ke folder projek Laravel
objShell.CurrentDirectory = "C:\xampp\htdocs\madin-app"

' Jalankan server Laravel dengan artisan tanpa menahan proses
objShell.Run "cmd /c start /b php artisan serve", 0, True

' Tunggu sebentar sebelum membuka browser
WScript.Sleep 5000

' Buka browser dengan link Laravel
objShell.Run "http://127.0.0.1:8000", 0, False

Set objShell = Nothing
