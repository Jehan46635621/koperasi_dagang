# MySQL Setup Notes

## Issue Encountered

MySQL 9.6.0 is installed but not starting properly on macOS. This is blocking the migration execution.

## Diagnostic Information

**Error**: MySQL process fails to start, no socket file created at `/tmp/mysql.sock`

**Homebrew MySQL Version**: 9.6.0 (upgraded from 8.1.0)

**Issue**: Major version upgrade from MySQL 8 to MySQL 9 requires intermediate step through MySQL 8.4

## Solution Options

### Option 1: Downgrade to MySQL 8.4 (Recommended)

```bash
# Stop current MySQL
brew services stop mysql

# Uninstall MySQL 9
brew uninstall mysql

# Install MySQL 8.4
brew install mysql@8.4

# Link MySQL 8.4
brew link mysql@8.4 --force

# Start MySQL 8.4
brew services start mysql@8.4

# Wait for startup
sleep 5

# Test connection
mysql -u root -e "SELECT VERSION();"
```

### Option 2: Use Docker MySQL (Alternative)

```bash
# Pull MySQL 8 image
docker pull mysql:8.0

# Run MySQL container
docker run --name koperasi-mysql \
  -e MYSQL_ROOT_PASSWORD=secret \
  -e MYSQL_DATABASE=koperasi_dagang \
  -p 3306:3306 \
  -d mysql:8.0

# Wait for initialization
sleep 10

# Update .env
# DB_HOST=127.0.0.1
# DB_PASSWORD=secret
```

### Option 3: Clean MySQL 9 Installation

```bash
# Stop MySQL
brew services stop mysql

# Remove data directory
rm -rf /opt/homebrew/var/mysql

# Initialize new MySQL data directory
mysqld --initialize-insecure --datadir=/opt/homebrew/var/mysql

# Start MySQL
brew services start mysql

# Wait and test
sleep 10
mysql -u root
```

## After MySQL is Running

Once MySQL is operational, run:

```bash
cd /Users/rizkyreynaldi/Dev/koperasi_dagang

# Create database
mysql -u root -e "CREATE DATABASE koperasi_dagang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations (31 tables)
php artisan migrate

# Seed initial data
php artisan db:seed

# Create admin user
php artisan make:filament-user

# Assign super admin role
php artisan tinker
>>> $user = App\Models\User::where('email', 'admin@koperasidagang.com')->first();
>>> $user->assignRole('super_admin');
>>> exit

# Start server
php artisan serve
```

Then access: **http://localhost:8000/admin**

## Current Project Status

✅ **Fully Implemented**:

- 25 Eloquent Models
- 31 Database Migrations
- 9 Filament Admin Resources
- 3 Database Seeders
- Role & Permission System
- Complete business logic structure

⏳ **Pending MySQL Setup**:

- Database creation
- Migration execution
- Seed data loading
- Admin user creation

The Laravel application is **100% code complete** and ready to run once MySQL is operational.
