# Swivel-Group Practical Test

## Getting started

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

	git clone https://github.com/cprathiba/Swivel-Group.git

Switch to the repo folder

	cd Swivel-Group

Install all the dependencies using composer

	Install all the dependencies using composer

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

## Testing
	
	./vendor/bin/phpunit
	
## Run the Search Application

	php artisan search:start
