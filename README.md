Easytrax Clients Portal
=

### Setup


1. Clone the repo

	      git clone git@github.com:easytraxbd/client_portal.git
   (if you get any errors like access denied public key, you may need to add a ssh key to your github account.)



2. Go Inside project root directory


3. Create the `.env` file

	     cp .env.example .env
	
4. Add database credentials to `.env` file

	```
	DB_DATABASE=homestead
	DB_USERNAME=homestead
	DB_PASSWORD=secret
	
5. Composer install:
	`composer install`
	
6. Generate secret key for laravel
	`php artisan key:generate`	
	
7. download metronic and go to metronic>theme>default and copy "demo4" to projects resource Folder.

    (Not compulsory unless you have to work with mix)

8. For compile the assets:

	```
	npm install
	npm run dev

9. Open the application in browser and login:

	*Number:* `01822232221`
	*Password:* `123456`
	
	
### Deployment tasks

After a pull/fetch to a local or live server, run these tasks from within the application root.

1. `composer install`

1. `npm install`

1. `npm run dev`

