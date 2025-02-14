@echo WELCOME to DO BACKUP TOOL gest_app
mysqldump -u root -h localhost -plucia gest_app --routines > gest_app.sql 
@PAUSE