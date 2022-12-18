cd "C:\Program Files\PostgreSQL\13\bin"
pg_dump -U postgres -W -h localhost doclinic > backup_doclinic.sql
exit