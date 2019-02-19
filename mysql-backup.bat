for /f "tokens=2 delims==" %%a in ('wmic OS Get localdatetime /value') do set "dt=%%a"
set "YY=%dt:~2,2%" & set "YYYY=%dt:~0,4%" & set "MM=%dt:~4,2%" & set "DD=%dt:~6,2%"
set "HH=%dt:~8,2%" & set "Min=%dt:~10,2%" & set "Sec=%dt:~12,2%"

set "datestamp=%YYYY%%MM%%DD%" & set "timestamp=%HH%%Min%%Sec%"
set "fullstamp=%YYYY%-%MM%-%DD%_%HH%-%Min%-%Sec%"


cd C:\wamp\www\pic\
mysqldump.exe -e -uroot -proot -hlocalhost pic > C:\mysql-backup\%fullstamp%-pic.sql --skip-lock-tables
mysqldump.exe -e -uroot -proot -hlocalhost cj_motalba > C:\mysql-backup\%fullstamp%-cj_motalba.sql --skip-lock-tables

"NET USE X: "\\10.31.10.51\sarakibackup" /user:administrator Admin1234
"Robocopy C:\mysql-backup x:\ /E /log:"c:\ databasebackuplog.txt"
"NET USE X: /d