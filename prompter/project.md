# Project Context

## Purpose

Koperasi Dagang is an integrated web-based cooperative management system designed for Indonesian trading cooperatives. The system unifies financial services (savings and loans) with retail/trading operations, providing end-to-end management capabilities from member registration to financial reporting.

### Goals

- Automate cooperative operations (membership, savings, loans, trading)
- Provide real-time visibility through dashboards and reports
- Ensure regulatory compliance with Indonesian cooperative standards
- Reduce operational costs and manual errors
- Enable member self-service capabilities

## Tech Stack

### Backend

- **Framework**: Laravel 11+ (PHP 8.2+)
- **Database**: MySQL 8.0+
- **Cache/Session**: Redis
- **Queue**: Laravel Queue with Redis driver

### Frontend

- **UI Framework**: Livewire 3 + Alpine.js
- **CSS**: Tailwind CSS
- **Icons**: Heroicons / Blade Icons

### Key Laravel Packages

- `spatie/laravel-permission` - Role-based access control
- `spatie/laravel-activitylog` - Audit trail logging
- `maatwebsite/excel` - Excel import/export
- `barryvdh/laravel-dompdf` - PDF generation
- `laravel/sanctum` - API authentication
- `spatie/laravel-backup` - Database backups
- `brick/math` - Precise financial calculations

## Project Conventions

### Code Style

- Follow PSR-12 coding standard for PHP
- Use Laravel Pint for code formatting
- Naming conventions:
  - Models: PascalCase singular (e.g., `Member`, `SavingsAccount`)
  - Controllers: PascalCase with Controller suffix (e.g., `MemberController`)
  - Tables: snake_case plural (e.g., `members`, `savings_accounts`)
  - Methods: camelCase (e.g., `calculateInterest`, `getBalance`)
- Use Form Requests for validation
- Use Resources for API responses

### Architecture Patterns

- **Pattern**: Repository Pattern with Service Layer
- **Structure**:
  ```
  app/
  ├── Http/Controllers/     # Thin controllers
  ├── Services/             # Business logic
  ├── Repositories/         # Data access layer
  ├── Models/               # Eloquent models
  ├── Actions/              # Single-purpose classes
  └── DTOs/                 # Data Transfer Objects
  ```
- Use DTOs for complex data passing between layers
- Keep controllers thin, business logic in Services
- Use Actions for single-purpose operations

### Testing Strategy

- **Unit Tests**: Test Services and Actions in isolation
- **Feature Tests**: Test HTTP endpoints and workflows
- **Browser Tests**: Laravel Dusk for critical user flows
- **Coverage Target**: Minimum 80% for core modules
- **Testing Framework**: Pest PHP
- **Test Data**: Use factories and seeders
- **Naming**: `test_it_can_create_member()`, `test_loan_approval_workflow()`

### Git Workflow

- **Branching**: Git Flow
  - `main` - Production releases
  - `develop` - Development integration
  - `feature/*` - New features
  - `bugfix/*` - Bug fixes
  - `release/*` - Release preparation
- **Commits**: Conventional Commits format
  - `feat:` New feature
  - `fix:` Bug fix
  - `docs:` Documentation
  - `refactor:` Code refactoring
  - `test:` Adding tests
- **Pull Requests**: Required for all changes to `main` and `develop`

## Domain Context

### Indonesian Cooperative (Koperasi) Terminology

- **Anggota**: Member of the cooperative
- **Simpanan Pokok**: Principal savings (one-time initial contribution)
- **Simpanan Wajib**: Mandatory savings (monthly required contribution)
- **Simpanan Sukarela**: Voluntary savings (optional deposits)
- **Pinjaman**: Loan
- **SHU (Sisa Hasil Usaha)**: Annual surplus distribution to members
- **RAT (Rapat Anggota Tahunan)**: Annual General Meeting
- **Pengurus**: Management/Board members
- **Pengawas**: Supervisory board

### Business Rules

- Members must pay Simpanan Pokok before any other transactions
- SHU is calculated based on member's savings contribution and transaction volume
- Loans require collateral documentation for amounts above threshold
- Interest rates are set per product type, not per member
- Trading cooperatives can sell to both members (discounted) and non-members

## Important Constraints

### Regulatory

- Must comply with Indonesian Cooperative Law (UU Perkoperasian)
- Follow SAK ETAP accounting standards
- Maintain audit trail for all financial transactions
- Annual RAT report generation required

### Technical

- Support concurrent users (minimum 50 simultaneous)
- Transaction response time < 2 seconds
- Daily backup with 30-day retention
- Support Indonesian language (Bahasa Indonesia) as primary

### Business

- Offline-first not required (always-connected assumption)
- Multi-branch support required
- Member data privacy compliance

## External Dependencies

### Required Services

- **MySQL Database**: Primary data storage
- **Redis**: Caching and queue management
- **SMTP Server**: Email notifications

### Optional Integrations (Future)

- Bank APIs for payment verification
- SMS Gateway for notifications
- WhatsApp Business API for member communication
- Digital signature service for loan documents

## Documentation Requirements

### Deliverables

1. **User Guide**: End-user documentation for all modules
2. **Testing Documentation**: Test cases, test data, UAT scripts
3. **API Documentation**: OpenAPI/Swagger specification
4. **Database Dictionary**: ERD with table descriptions

### Reference Documents

- Product Brief: `prompter/koperasi-dagang/product-brief.md`
- PRD: To be generated
- ERD: To be generated
- FSD: To be generated
