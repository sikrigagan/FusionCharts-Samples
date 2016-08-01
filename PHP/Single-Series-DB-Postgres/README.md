Single Series Chart with PHP and Postgres Database
===
A simple example for creating single-series chart using FusionCharts PHP Wrapper with data from Postgres Database

###Steps to run the sample:
* Import `browsershare.sql` to your Postgres database.
+ Update connection string variables for database host, database port, database name, postgres database username and password in `index.php`.

```
$host= "host=";
$port= "port=";
$dbname="dbname=";
$dbuser="user=";
$dbpwd="password=";

// connection string (pg_connect() is native PHP method for Postgres)
$dbconn=pg_connect("$host $port $dbname $dbuser $dbpwd");
```
+ Run `index.php` at your local XAMPP/WAMP Server.