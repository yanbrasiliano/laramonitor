## Monitor Sites

This is a simple script to monitor sites and send a notification when they are down. It is intended to be run as a cron job. It will send a notification when a site is down and when it is back up. It will also send a notification if a site is down for more than 5 minutes.

### Installation

1. Clone the repository and navigate to the directory in your terminal. 
2. Run docker-compose up -d to start the container.
3. Run docker-compose exec laravel-monitor bash to enter the container.
4. Run composer install to install the dependencies.
5. Run cp .env.example .env to create a .env file.
6. Run php artisan key:generate to generate an application key.
7. Run php artisan migrate to run the migrations.
  
### Usage

After register a user, you can add a site to monitor. You can also add a site to monitor and in your terminal run php artisan endpoint:check {uuid} to monitor the site immediately.
Check the logs to see the notifications and the status of the sites. You can see logs also in website. 

### License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


