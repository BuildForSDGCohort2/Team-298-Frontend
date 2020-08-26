#### What does this PR do?
#### Description of Task to be completed?
#### How should this be manually tested?

##### * clone the repository
##### * npm install
##### * php artisan key:generate
##### * set up your database user & password in the .env file (copy the structure from the .env.example file)
##### * create the mysql database and set the name to .env file
##### * php artisan migrate
##### * php artisan passport:install
##### * copy the new generated passport-client secret from console or from your database and paste it in your .env key PASSPORT_CLIENT_SECRET
##### * php artisan optimize
##### * php artisan serve --host=0.0.0.0
##### * npm run watch


#### What are the relevant card link?

[#story link](link)

#### Screenshots (if appropriate)