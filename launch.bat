@echo off
cd /d "%~dp0"
echo Installing dependencies...
"C:\xampp\php\php.exe" composer.phar install
echo Starting PHP server at http://localhost:8000
"C:\xampp\php\php.exe" -S localhost:8000 -t public
pause
