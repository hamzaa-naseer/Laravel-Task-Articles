### Requirements

- PHP 8.2 or better
- Docker (Docker Desktop on Windows)
- Composer 2.2.0 or greater (https://getcomposer.org/)

### Required information

- PHP binary path
- Composer path

### Setup

- clone https://github.com/omgiva/pariksha.git
- cd into the folder
- copy the .env file: `cp .env.example .env`
- run `php8.2 /usr/local/bin/composer install`
- `php8.2 artisan sail:install` (select MySQL as the only service required)
- run `./vendor/bin/sail up -d`
- run `./vendor/bin/sail artisan key:generate`
- run `./vendor/bin/sail artisan migrate:fresh --seed`