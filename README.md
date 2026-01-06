# NOTE
You cannot currently get past the login stage due to the .env.example file which needs updating from the default

This means that the application does not currently work however I have video proof of it working here: https://drive.google.com/file/d/1vxb6cclHb6JA1slAExZXAUznSN19yBJJ/view?usp=drive_link

I cannot update the application for the time being due to location constraints but this will be done eventually

# Journalr

Journalr is a full-stack Laravel web application that allows users to create journal-style posts with optional images, comment on posts, like posts and comments, and browse content by tags. The application includes authentication, user profiles, role-based permissions, AJAX functionality, and integration with an external API. 

--- 

## Features 
- User authentication (Laravel Breeze)
- Create, edit, and delete posts with image uploads
- Comment on posts with **AJAX-based submission** (no page reload)
- Like posts and comments (polymorphic relationships)
- Tag system with filtering (many-to-many relationship) - User profiles displaying posts and comments - Role-based permissions (Admin / User) - Email notifications for post interactions (Mailpit for local testing) - Responsive UI styled with Tailwind CSS
- Pagination for posts

--- 

## Tech Stack 
- Laravel (PHP)
- MySQL
- Blade Templates
- JavaScript (Fetch API / AJAX)
- Tailwind CSS
- Laravel Eloquent ORM
- Git

--- 

## Getting the Project Running Locally 
These steps allow you to run the project locally and view the website. 

### All platforms 
- **Docker Desktop** installed and running

### Windows (recommended) 
- **WSL2** enabled (Ubuntu recommended with version 24.04.1 LTS from Microsoft Store used for testing)
(Refer to https://docs.docker.com/desktop/features/wsl/)
- Docker Desktop → Settings → Resources → **WSL Integration** enabled for your distro

> On Windows, run the commands below inside your WSL terminal. 

## Local Setup (Recommended): Laravel Sail 

### 1) Clone the Repository
```bash
git clone https://github.com/dev-aghad/journalr-app.git
cd journalr-app
```

### 2) Create .env
```bash
cp .env.example .env
```

### 3) Install PHP dependencies (Composer) 
If you don't have Composer installed locally, this will run Composer inside a container:
```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php82-composer:latest \
  composer install --no-interaction
```
If composer does not install, make sure php is installed on WSL.

### 4) Start the containers
```bash
./vendor/bin/sail up -d
```

### 5) Storage Link (Required for Images) 
This is to enable posted images to display correctly.
```bash
./vendor/bin/sail artisan storage:link
```
Other dependencies (mainly for frontend assets)
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

### 6) Generate app key
```bash
./vendor/bin/sail artisan key:generate
```

### 7) Run Migrations and Seeders 
Create the database tables and populate them with sample data (already included).
```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```
### 8) Replace .env. file with .env.example file
Simply copy and paste and contents of the .env.example file into the .env file as this is what is run (READ NOTE ON TOP OF PAGE)


Visit the application in your browser: http://localhost (By default Sail maps the app to port 80) 

MailPit dashboard: http://localhost:8025 (for verifying email) 

--- 

## Strongly Recommended: Demo Credentials 
The database is seeded with sample users for testing however you can add your own: 

**Admin account** 
Email: admin@journalr.test
- Password: password 
**Standard user** 
Email: user@journalr.test
- Password: password 

--- 

## Useful Commands 
Stop containers (for when application is not in use):
```bash
./vendor/bin/sail down
```
Open a shell in Tinker (to run database commands directly):
```bash
./vendor/bin/sail artisan tinker
```
## Troubleshooting 
### Port already in use Sail uses APP_PORT (defaults to 80). 
If port 80 is in use, edit the .env file:
```bash
APP_PORT=8080
```
Then restart:
```bash
./vendor/bin/sail down
./vendor/bin/sail up -d
```
Open http://localhost:8080

