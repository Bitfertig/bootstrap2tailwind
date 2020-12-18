@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../awssat/tailwindo/tailwindo
php "%BIN_TARGET%" %*
