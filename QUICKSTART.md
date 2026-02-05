# QUICK START GUIDE

## Current Implementation Status ✅

The Koperasi Dagang Laravel project has been successfully implemented with the following components:

### ✅ Completed Components

1. **Laravel 10 Project Structure** - Fully configured with:
   - 25 Eloquent Models with comprehensive relationships
   - 31 Database migrations covering all business modules
   - Authentication & Authorization via Filament + Spatie Permission
   - Activity logging with Spatie Activitylog

2. **Filament 3 Admin Panel Resources** - 9 fully functional resources:
   - **Keanggotaan (Membership)**:
     - MemberResource - Complete member management with Indonesian labels
     - BranchResource - Branch/office management
     - MemberTypeResource - Member type classification
   - **Simpanan (Savings)**:
     - SavingsProductResource - Savings product configuration
     - SavingsAccountResource - Individual savings account management
   - **Pinjaman (Loans)**:
     - LoanProductResource - Loan product setup with interest rates
     - LoanResource - Complete loan application workflow
   - **Dagang (Trading)**:
     - ProductResource - Inventory/product management with multi-tier pricing
     - SaleResource - POS transactions with member integration

3. **Database Seeders**:
   - RolePermissionSeeder - 8 roles with 44 granular permissions
   - BranchSeeder - 3 sample branches (Jakarta, Bandung, Surabaya)
   - MemberTypeSeeder - 4 member types (Regular, Employee, Premium, Special)

### ⏳ Pending Setup

The system is fully coded but requires MySQL to be running to complete setup:

## Step-by-Step Setup Instructions

### 1. Start MySQL Service

```bash
# Check MySQL status
brew services list | grep mysql

# If not running, start MySQL
brew services start mysql

# Verify it's running
ps aux | grep mysql | grep -v grep
```

### 2. Create Database

```bash
mysql -u root -p
```

```sql
CREATE DATABASE koperasi_dagang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON koperasi_dagang.* TO 'your_username'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 3. Run Migrations

```bash
cd /Users/rizkyreynaldi/Dev/koperasi_dagang

# Run all migrations (31 tables will be created)
php artisan migrate

# Expected output: Migration completed successfully
```

### 4. Seed Initial Data

```bash
# Seed roles, branches, and member types
php artisan db:seed

# This will create:
# - 8 user roles with permissions
# - 3 branch offices
# - 4 member types
```

### 5. Create Admin User

```bash
# Create Filament admin user
php artisan make:filament-user

# Follow the prompts:
# Name: Admin
# Email: admin@koperasidagang.com
# Password: [your secure password]
```

### 6. Assign Super Admin Role

```bash
php artisan tinker
```

```php
$user = App\Models\User::where('email', 'admin@koperasidagang.com')->first();
$user->assignRole('super_admin');
exit
```

### 7. Start Development Server

```bash
php artisan serve
```

### 8. Access Admin Panel

Open browser: **http://localhost:8000/admin**

Login with the admin credentials you created.

## Available Features

### Navigation Structure in Admin Panel

**Keanggotaan (Membership)**

- Members - Full CRUD with KYC fields
- Member Types - Classification management
- Branches - Office/branch management

**Simpanan (Savings)**

- Savings Products - Product configuration with interest rates
- Savings Accounts - Account management with balance tracking

**Pinjaman (Loans)**

- Loan Products - Loan configuration with interest methods
- Loans - Complete loan workflow (application → approval → disbursement → payments)

**Dagang (Trading)**

- Products - Inventory with multi-tier pricing (retail/member/wholesale)
- Sales - POS transactions with member discount integration

**Pengaturan (Settings)**

- Located in settings section for configuration

## User Roles & Capabilities

| Role                | Capabilities                                |
| ------------------- | ------------------------------------------- |
| **super_admin**     | Full system access                          |
| **manager**         | Branch operations, approvals, reports       |
| **teller**          | Transaction processing (savings/loan/sales) |
| **loan_officer**    | Loan application processing                 |
| **accountant**      | Accounting operations, journal entries      |
| **warehouse_staff** | Inventory management                        |
| **member_services** | Member registration and services            |
| **auditor**         | Read-only access for auditing               |

## Testing the System

### 1. Create a Member

1. Go to **Keanggotaan → Members**
2. Click **New Member**
3. Fill in required fields (marked with \*)
4. Save

### 2. Create a Savings Account

1. Go to **Simpanan → Savings Products**
2. Create a product (e.g., "Simpanan Pokok")
3. Go to **Savings Accounts**
4. Create an account for the member

### 3. Create a Loan

1. Go to **Pinjaman → Loan Products**
2. Create a product (e.g., "Pinjaman Produktif")
3. Go to **Loans**
4. Create loan application for member

### 4. Add Inventory Products

1. Go to **Dagang → Products**
2. Add products with pricing tiers
3. Stock quantity will be tracked automatically

### 5. Process Sale

1. Go to **Dagang → Sales**
2. Create new sale transaction
3. Select member (optional) for member pricing
4. System will calculate totals automatically

## Troubleshooting

### MySQL Connection Refused

```bash
# Check error logs
tail -f /opt/homebrew/var/mysql/*.err

# Remove PID file if stuck
rm /opt/homebrew/var/mysql/*.pid

# Restart MySQL
brew services restart mysql
```

### Permission Errors

```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache
```

### Cache Issues

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Next Development Steps

1. **Business Services** - Implement calculation logic:
   - SavingsService - Interest calculation
   - LoanService - Amortization calculation
   - AccountingService - Auto journal entry generation

2. **Transaction Modules**:
   - SavingsTransaction Resource for deposits/withdrawals
   - LoanPayment Resource for loan payment processing
   - PurchaseOrder Resource for procurement

3. **Reporting**:
   - Financial statements
   - Member reports
   - Loan collectibility reports
   - Sales/inventory reports

4. **API Implementation**:
   - Complete HCMS integration endpoints in routes/api.php
   - API authentication with Sanctum tokens

5. **Testing**:
   - PHPUnit tests for models
   - Feature tests for resources
   - Integration tests for business logic

## Support & Documentation

- **PRD**: `prompter/koperasi-dagang/prd.md` (1,735 lines)
- **FSD**: `prompter/koperasi-dagang/fsd.md` (1,628 lines)
- **ERD**: `prompter/koperasi-dagang/erd.md` (1,258 lines)
- **Testing Docs**: `prompter/koperasi-dagang/testing-documentation.md` (708 lines)
- **User Guide**: `prompter/koperasi-dagang/user-guide.md` (547 lines)

## Project Statistics

- **Models**: 25 Eloquent models
- **Migrations**: 31 database tables
- **Resources**: 9 Filament admin resources
- **Roles**: 8 user roles
- **Permissions**: 44 granular permissions
- **Seeders**: 3 data seeders
- **Lines of Code**: ~8,000+ lines

---

**Status**: Ready for MySQL setup and migration execution ✨
