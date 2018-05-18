# Synced Online IP Control
This is the IP Control system programmed by Pravat Bhusal (www.github.com/Shadowsych). This code may be given to anyone to study and use as his or her IP Control service for a Whirled server. However, proper set-up must be completed for the ip control files. For this reason, I have provided step-by-step documentation below to properly set-up the ip control system.

# Documentation:
1. Copy and paste the "ipcontrol.php" file into the "htdocs" of an Apache web-server.  
2. Copy and paste the "iplog.php" file into the "htdocs" folder of an Apache web-server.  
3. Copy and paste the "dbconnection.php" file into the "htdocs" folder of an Apache web-server  
4. Copy and paste the "MsoyAuthenticator.java" file into your msoy/src/java/com/threerings/msoy/server folder  
5. (Discuss creating new columns in MemberRecord here)  
6. (Discuss setting-up the dbconnection system here)  
-----------------------------------------------------------------------------------------------
### NOTE: Here are the different Apache web-servers you can install based on your operating system
- Windows Apache Server: XAMPP
- Mac Apache Server: MAMP
- Linux Apache Server: LAMP

### NOTE: If you're using a Linux server and PostgreSQL, make sure to install the PHP and PostgreSQL driver: sudo apt-get install php5-pgsql