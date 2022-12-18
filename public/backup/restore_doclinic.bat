cd "C:\Program Files\PostgreSQL\13\bin"
psql -h localhost -p 5432 -U postgres -f backup_doclinic.sql doclinic
exit