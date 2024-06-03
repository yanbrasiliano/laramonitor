
## Monitor Sites

This is a simple script designed to monitor websites and send notifications when they are down. Intended to be run as a cron job, it notifies you when a site goes down, when it comes back up, and if a site remains down for more than 5 minutes.

### Installation

1. Clone the repository and navigate to the directory in your terminal:
   ```bash
   git clone https://github.com/yourusername/monitor-sites.git
   cd monitor-sites
   ```

2. Start the Docker container:
   ```bash
   docker-compose up -d
   ```

3. Enter the container:
   ```bash
   docker-compose exec laravel-monitor bash
   ```

4. Install the dependencies:
   ```bash
   composer install
   ```

5. Create a `.env` file:
   ```bash
   cp .env.example .env
   ```

6. Generate an application key:
   ```bash
   php artisan key:generate
   ```

7. Run the migrations:
   ```bash
   php artisan migrate
   ```

### Usage

1. Register a user and add a site to monitor.
2. To monitor a site immediately, run:
   ```bash
   php artisan endpoint:check {uuid}
   ```
3. Check the logs to see notifications and the status of the sites. Logs can also be viewed on the website.

### License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
