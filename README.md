# Koperasi Dagang - Indonesian Cooperative Management System

A comprehensive web-based management system for Indonesian cooperatives (Koperasi Dagang) integrating financial services and retail trading operations. Built with Laravel 10 and Filament 3 admin panel.

## Overview

Koperasi Dagang unifies member management, savings accounts, loan processing, retail inventory, and accounting into a single integrated platform designed for Indonesian cooperative organizations.

## Features

### Core Modules

1. **Member Management**
   - Member registration and KYC
   - Member type classification
   - Multi-branch support
   - Document management

2. **Savings Management**
   - Multiple savings product types
   - Interest calculation
   - Transaction processing (deposit/withdrawal)
   - Balance tracking

3. **Loan Management**
   - Flexible loan products
   - Automated amortization schedules
   - Collectibility tracking
   - Collateral management
   - Payment processing

4. **Trading/Retail**
   - Inventory management
   - Multi-tier pricing (retail/member/wholesale)
   - Purchase order workflow
   - Goods receipt verification
   - POS sales with member integration
   - Stock movement tracking

5. **Accounting**
   - Double-entry bookkeeping
   - Chart of accounts
   - Automated journal entries
   - Fiscal period management
   - Financial reporting

6. **HCMS Integration**
   - API endpoints for payroll system integration
   - Employee loan data exposure
   - Savings account data sharing

## Tech Stack

- **Framework**: Laravel 10.50.0
- **Admin Panel**: Filament 3.3.47
- **Database**: MySQL 8.0+
- **PHP**: 8.1.34+
- **Authentication**: Laravel Sanctum
- **Authorization**: Spatie Laravel Permission
- **Audit Trail**: Spatie Laravel Activitylog
- **Export/Import**: Maatwebsite Excel, Barryvdh DomPDF

## System Requirements

- PHP >= 8.1
- MySQL >= 8.0
- Composer >= 2.0
- Node.js >= 18.x (for frontend assets)
- Git

## Installation

### 1. Clone Repository

```bash
cd /Users/rizkyreynaldi/Dev/koperasi_dagang
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=koperasi_dagang
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Setup

Start MySQL service:

```bash
# macOS (via Homebrew)
brew services start mysql

# Or via MySQL.app, MAMP, Valet, etc.
```

Create database:

```bash
mysql -u root -p
CREATE DATABASE koperasi_dagang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

Run migrations:

```bash
php artisan migrate
```

### 5. Seed Initial Data

```bash
php artisan db:seed
```

This will create:

- Default admin user
- User roles and permissions
- Sample branches
- Member types
- Savings products
- Loan products
- Chart of accounts

### 6. Create Admin User

```bash
php artisan make:filament-user
```

Follow prompts to create your admin account.

### 7. Storage Link

```bash
php artisan storage:link
```

### 8. Start Development Server

```bash
php artisan serve
```

Access the application:

- Admin Panel: http://localhost:8000/admin
- API: http://localhost:8000/api

## User Roles & Permissions

The system includes 8 predefined roles:

1. **Super Admin** - Full system access
2. **Manager** - Branch management, reports, approvals
3. **Teller** - Savings/loan transactions, member services
4. **Loan Officer** - Loan applications, evaluations, disbursements
5. **Accountant** - Accounting operations, journal entries, reports
6. **Warehouse Staff** - Inventory management, stock movements
7. **Member Services** - Member registration, document management
8. **Auditor** - Read-only access for auditing purposes

## Database Structure

### Key Tables

- **branches** - Multi-branch organization structure
- **members** - Cooperative member data
- **savings_accounts** - Individual savings accounts
- **savings_transactions** - Savings activity log
- **loans** - Loan applications and disbursements
- **loan_schedules** - Amortization schedules
- **loan_payments** - Payment tracking
- **products** - Inventory/merchandise
- **sales** - POS transactions
- **purchase_orders** - Procurement workflow
- **journal_entries** - Accounting transactions
- **chart_of_accounts** - Account master data

Total: 31 migrations covering all business modules

## Models

25 Eloquent models with comprehensive relationships:

**Foundation**: User, Branch, MemberType, Member

**Savings**: SavingsProduct, SavingsAccount, SavingsTransaction

**Loans**: LoanProduct, Loan, LoanSchedule, LoanPayment, LoanCollateral

**Trading**: ProductCategory, Product, Supplier, Sale, SaleItem, PurchaseOrder, PurchaseOrderItem, GoodsReceipt, GoodsReceiptItem, StockMovement

**Accounting**: ChartOfAccount, FiscalPeriod, JournalEntry, JournalEntryDetail, AccountBalance

All models include:

- Type casting for data integrity
- Relationships (belongsTo, hasMany, morphTo)
- Query scopes for common filters
- Helper methods for business logic
- Activity logging (where applicable)

## API Endpoints (HCMS Integration)

All API endpoints require authentication via Bearer token:

```
Authorization: Bearer {your-token}
```

### Available Endpoints

1. **GET /api/hcms/employees/{employee_id}/loans**
   - Retrieve employee loan data
   - Returns active loans with outstanding balances

2. **GET /api/hcms/employees/{employee_id}/savings**
   - Retrieve employee savings account data
   - Returns account balances and recent transactions

3. **POST /api/hcms/loan-installments**
   - Record loan installment payment from payroll deduction
   - Auto-updates loan schedules and balances

4. **POST /api/hcms/savings-deposits**
   - Record savings deposit from payroll deduction
   - Auto-updates savings account balances

5. **GET /api/hcms/employees/{employee_id}/summary**
   - Get comprehensive financial summary
   - Combines loan and savings data

## Development Workflow

### Code Style

Laravel Pint is configured for code styling:

```bash
./vendor/bin/pint
```

### Testing

PHPUnit is configured for testing:

```bash
php artisan test
```

### Queue Workers

For background jobs (interest calculation, reports):

```bash
php artisan queue:work
```

### Task Scheduler

For automated tasks, add to cron:

```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## Filament Resources (To Be Created)

Planned admin panel resources:

- MemberResource - Member CRUD with document uploads
- SavingsAccountResource - Account management
- SavingsTransactionResource - Transaction processing
- LoanResource - Loan application workflow
- LoanPaymentResource - Payment processing
- ProductResource - Inventory management
- SaleResource - POS interface
- PurchaseOrderResource - Procurement workflow
- JournalEntryResource - Manual journal entries
- ChartOfAccountResource - Account master maintenance

## Business Services (To Be Implemented)

1. **SavingsService**
   - Interest calculation
   - Balance updates
   - Transaction validation

2. **LoanService**
   - Amortization calculation
   - Payment allocation
   - Collectibility classification
   - Auto-scheduling

3. **AccountingService**
   - Auto journal entry generation
   - Period closing
   - Balance calculation

4. **InventoryService**
   - Stock level tracking
   - Reorder point alerts
   - FIFO/weighted average costing

## Project Structure

```
koperasi_dagang/
├── app/
│   ├── Models/              # 25 Eloquent models
│   ├── Http/
│   │   ├── Controllers/     # API & web controllers
│   │   └── Middleware/      # Custom middleware
│   ├── Filament/
│   │   └── Resources/       # Admin panel resources
│   ├── Services/            # Business logic services
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # 31 database migrations
│   ├── seeders/             # Data seeders
│   └── factories/           # Model factories
├── routes/
│   ├── web.php              # Web routes
│   ├── api.php              # API routes (HCMS)
│   └── console.php          # Console commands
├── config/                  # Configuration files
├── public/                  # Public assets
└── storage/                 # Uploaded files, logs
```

## Security Considerations

- Role-based access control (RBAC) via Spatie Permission
- Activity logging for audit trails
- Soft deletes on critical tables
- Input validation on all forms
- SQL injection prevention via Eloquent ORM
- CSRF protection on all forms
- Secure password hashing (bcrypt)
- API authentication via Sanctum tokens

## Performance Optimization

- Database indexing on foreign keys and frequently queried fields
- Eager loading to prevent N+1 queries
- Query result caching for reports
- Queue jobs for heavy operations
- Database connection pooling

## Localization

Default locale: Indonesian (id_ID)
Timezone: Asia/Jakarta (WIB)

Currency: Indonesian Rupiah (IDR)
Date format: DD/MM/YYYY
Number format: 1.234.567,89

## Troubleshooting

### MySQL Connection Refused

```bash
# Check MySQL is running
brew services list

# Start MySQL
brew services start mysql

# Or restart MySQL
brew services restart mysql
```

### Permission Denied Errors

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Composer Memory Limit

```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

## Documentation

Comprehensive documentation available in `prompter/koperasi-dagang/`:

- **product-brief.md** - Product overview and objectives
- **prd.md** - Detailed functional requirements (1,735 lines)
- **fsd.md** - Technical specifications (1,628 lines)
- **erd.md** - Database schema documentation (1,258 lines)
- **testing-documentation.md** - Test cases and scenarios (708 lines)
- **user-guide.md** - End-user manual (547 lines)

## Contributing

1. Follow Laravel coding standards
2. Run `./vendor/bin/pint` before committing
3. Write tests for new features
4. Update documentation as needed
5. Follow conventional commit messages

## License

Proprietary - All rights reserved

## Support

For technical support or questions:

- Review documentation in `prompter/koperasi-dagang/`
- Check Laravel documentation: https://laravel.com/docs/10.x
- Check Filament documentation: https://filamentphp.com/docs/3.x

## Roadmap

### Phase 1 (Current)

- ✅ Database schema implementation
- ✅ Eloquent models with relationships
- ⏳ Filament Resources for CRUD operations
- ⏳ Role and permission seeders

### Phase 2

- Business logic services implementation
- Automated journal entry generation
- Interest calculation engine
- Loan amortization calculator

### Phase 3

- Financial reporting module
- Dashboard with key metrics
- Member portal (self-service)
- Mobile responsive design

### Phase 4

- Integration with payment gateways
- SMS/Email notifications
- Document generation (contracts, receipts)
- Advanced analytics and forecasting

## Credits

Built with:

- Laravel Framework - https://laravel.com
- Filament Admin Panel - https://filamentphp.com
- Spatie Packages - https://spatie.be/open-source
