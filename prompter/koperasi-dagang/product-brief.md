# KOPERASI DAGANG

## Executive Summary

**Integrated Web-Based Cooperative Management System for Indonesian Trading Cooperatives**

---

## At a Glance

|                   |                                                                     |
| ----------------- | ------------------------------------------------------------------- |
| **Product Type**  | Enterprise Web Application (SaaS-ready)                             |
| **Target Market** | Small to Medium Trading Cooperatives (Koperasi Dagang) in Indonesia |
| **Platform**      | Web Application (Responsive)                                        |
| **Technology**    | Laravel 11+ (PHP 8.2+), MySQL 8.0+, Livewire + Alpine.js            |
| **Status**        | Planning Phase - Ready for Development                              |

---

## Product Overview

### What is Koperasi Dagang?

Koperasi Dagang is a comprehensive, web-based cooperative management system designed specifically for Indonesian trading cooperatives. It seamlessly integrates financial services (savings and loans) with retail/trading operations in a single, unified platform. The system provides end-to-end management capabilities from member registration to financial reporting, enabling cooperatives to operate efficiently while maintaining regulatory compliance.

### The Problem We Solve

| Challenge                      | Impact                                                                    |
| ------------------------------ | ------------------------------------------------------------------------- |
| **Manual Record Keeping**      | High error rates, data inconsistencies, and hours spent on reconciliation |
| **Fragmented Systems**         | Separate tools for membership, accounting, and trading create data silos  |
| **Delayed Reporting**          | Management decisions based on outdated information, missed opportunities  |
| **Poor Member Experience**     | Long queues, limited transparency, members unaware of their balances      |
| **Compliance Risk**            | Difficulty preparing regulatory reports and audit trails                  |
| **SHU Calculation Complexity** | Manual surplus distribution prone to errors and disputes                  |
| **Inventory Mismanagement**    | Stock discrepancies, overstocking, and lost sales                         |

### Our Solution

```
┌─────────────────────────────────────────────────────────────────────────┐
│                         KOPERASI DAGANG PLATFORM                        │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│   ┌─────────────┐    ┌─────────────┐    ┌─────────────┐                │
│   │   Member    │───▶│  Financial  │───▶│   Trading   │                │
│   │ Management  │    │  Services   │    │  Operations │                │
│   └─────────────┘    └─────────────┘    └─────────────┘                │
│          │                  │                  │                        │
│          ▼                  ▼                  ▼                        │
│   ┌───────────────────────────────────────────────────────────┐        │
│   │              UNIFIED ACCOUNTING ENGINE                     │        │
│   │         (Double-Entry, Real-Time, Auto-Posting)           │        │
│   └───────────────────────────────────────────────────────────┘        │
│                              │                                          │
│          ┌───────────────────┼───────────────────┐                     │
│          ▼                   ▼                   ▼                     │
│   ┌─────────────┐    ┌─────────────┐    ┌─────────────┐               │
│   │  Dashboard  │    │   Reports   │    │    Audit    │               │
│   │  Analytics  │    │  Generator  │    │    Trail    │               │
│   └─────────────┘    └─────────────┘    └─────────────┘               │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## MVP (Phase 1) Core Capabilities

### 1️⃣ Member Registration & Portal Access

- **Member Registry**: Basic member registration form (name, email, phone, address, ID number)
- **Member Login**: Secure login to self-service portal
- **Member Profile**: View own profile information
- **User & Role Management**: Admin and member roles with basic permission control

### 2️⃣ Savings Application Submission

- **Savings Product Selection**: Members view available savings product types:
  - Simpanan Pokok (Principal Savings)
  - Simpanan Wajib (Mandatory Savings)
  - Simpanan Sukarela (Voluntary Savings)
- **Application Form**: Members enter:
  - Selected product type
  - Initial amount (if applicable)
  - Submission date
- **Admin Review**: Admins can view, approve, or reject savings applications
- **Application Status**: Members can track their application status (Pending, Approved, Rejected)

### 3️⃣ Loan Application Submission

- **Loan Product Selection**: Members view available loan products with basic info (product name, interest rate)
- **Application Form**: Members enter:
  - Loan amount requested
  - Loan term (months)
  - Loan purpose
  - Preferred disbursement date
- **Admin Review**: Admins can view, approve, or reject loan applications
- **Admin Notes**: Admins can add approval/rejection reasons
- **Application Status**: Members can track their application status (Pending, Approved, Rejected)

### Future Phase Capabilities

**Phase 2+** will include:
- Transaction processing (savings deposits, loan disbursements, payments)
- Balance tracking and interest calculation
- Loan repayment scheduling and tracking
- Trading/retail operations (POS, inventory)
- Financial reporting and accounting
- Dashboard analytics
- And more...

---

## Key Benefits

| Icon | Benefit                 | Description                                                        |
| ---- | ----------------------- | ------------------------------------------------------------------ |
| ⏱️   | **Time Savings**        | Reduce administrative tasks by 60% through automation              |
| ✅   | **Accuracy**            | Eliminate manual errors with real-time validation and double-entry |
| 📊   | **Real-Time Insights**  | Dashboard analytics for informed decision-making                   |
| 🔐   | **Security**            | Role-based access control and complete audit trails                |
| 📁   | **Compliance**          | Built-in regulatory report formats and audit support               |
| 🔄   | **Integration**         | Unified platform eliminates data silos between modules             |
| 💰   | **Cost Reduction**      | Lower operational costs vs. multiple separate systems              |
| 👥   | **Member Satisfaction** | Faster service, self-service portal, transparency                  |

---

## User Roles (MVP)

| Role                      | Primary Functions                                                 |
| ------------------------- | ----------------------------------------------------------------- |
| **Super Admin**           | Full system access, member management, approve/reject applications |
| **Member (Self-Service)** | Register, login, submit loan and savings applications, view status |

**Future Phases will add:**
- Manager (Pengurus) - Executive oversight and approval authority
- Teller (Kasir) - Savings transactions, loan payments, daily cash handling
- Loan Officer - Loan disbursement, collection
- Accountant - Financial reports, accounting
- And more...

---

## System Architecture / Modules (MVP)

```
┌─────────────────────────────────────────────────────────────────────────┐
│                    KOPERASI DAGANG MVP - PHASE 1                        │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │              MEMBER SELF-SERVICE PORTAL                          │   │
│  │  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐             │   │
│  │  │ Registration │ │    Login     │ │   Profile    │             │   │
│  │  └──────────────┘ └──────────────┘ └──────────────┘             │   │
│  │  ┌──────────────┐ ┌──────────────┐                              │   │
│  │  │Submit Savings│ │ Submit Loan  │                              │   │
│  │  │Applications  │ │ Applications │                              │   │
│  │  └──────────────┘ └──────────────┘                              │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                    │                                    │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                 ADMIN DASHBOARD (BASIC)                          │   │
│  │  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐             │   │
│  │  │View Members  │ │View Pending  │ │View Pending  │             │   │
│  │  │              │ │Loan Apps     │ │Savings Apps  │             │   │
│  │  └──────────────┘ └──────────────┘ └──────────────┘             │   │
│  │  ┌──────────────┐ ┌──────────────┐                              │   │
│  │  │Approve/Reject│ │Approve/Reject│                              │   │
│  │  │Loan Apps     │ │Savings Apps  │                              │   │
│  │  └──────────────┘ └──────────────┘                              │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                    │                                    │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                       DATA LAYER                                 │   │
│  │  ┌─────────────────────────────────────────────────────────┐    │   │
│  │  │                 MySQL Database                           │    │   │
│  │  │  members │ loan_applications │ savings_applications │ ... │   │   │
│  │  └─────────────────────────────────────────────────────────┘    │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

**MVP Modules: 3 Core Modules**

1. Member Management (Registration & Login)
2. Loan Application Management
3. Savings Application Management

**Future Phases will add:**
- 4. Teller Operations & Transactions
- 5. Accounting & General Ledger
- 6. Report Engine
- 7. Dashboard & Analytics
- 8. Trading/POS
- 9. Inventory Management
- 10. Settings & Parameters
- 11. Audit Trail
- 12. And more...

---

## Infrastructure Highlights

- **Scalable Architecture**: Repository Pattern with Service Layer for maintainability
- **RESTful API**: Prepared for mobile app and third-party integrations, including HCMS payroll integration
- **HCMS Integration Ready**: APIs designed to expose employee loan and savings data for payroll deductions and reporting
- **Queue System**: Background processing for heavy reports and notifications
- **Caching Layer**: Redis for sessions and frequently accessed data
- **Backup Automation**: Scheduled database backups with retention policies
- **Security First**: CSRF protection, SQL injection prevention, encrypted passwords
- **Multi-Tenant Ready**: Architecture supports future SaaS deployment

---

## Domain-Specific Features

### Financial Services (Simpan Pinjam)

✅ Multiple savings product types with configurable terms  
✅ Automated interest calculation (daily, monthly, annually)  
✅ Loan grading and collectibility classification  
✅ Penalty and fine calculation for late payments  
✅ SHU (Sisa Hasil Usaha) automated calculation and distribution  
✅ Member contribution tracking for SHU ratio

**Savings Workflow:**

```
Member Request → Teller Input → Validation → Process Transaction → Update Balance → Print Receipt → Auto-Post to GL
```

**Loan Workflow:**

```
Member Portal OR Admin Entry → Loan Amount + Term Input → Auto-Calculate Payment Schedule → 
Credit Analysis → Admin/Committee Review → Modify Terms (if needed) → Approval/Rejection → 
Disbursement → Repayment Tracking → Collection → Closure
```

### Trading Operations (Perdagangan)

✅ Multi-category product catalog  
✅ Real-time stock level tracking  
✅ Automatic reorder point notifications  
✅ Member vs non-member pricing tiers  
✅ Credit sales for members (Hutang Anggota)  
✅ Purchase order and goods receipt workflow  
✅ Profit margin analysis per product

**Sales Workflow:**

```
Product Selection → Member ID (optional) → Apply Pricing → Payment → Issue Receipt → Update Inventory → Post Revenue to GL
```

**Procurement Workflow:**

```
Reorder Alert → Create PO → Supplier Confirmation → Goods Receipt → Quality Check → Stock Update → Accounts Payable Entry
```

---

## Dashboard / Admin Panel (MVP)

| Widget                     | Purpose                                                          |
| -------------------------- | ---------------------------------------------------------------- |
| **Pending Applications**   | Count of pending loan and savings applications                   |
| **Loan Applications List** | View all loan applications with status (Pending/Approved/Reject) |
| **Savings Applications**   | View all savings applications with status                        |
| **Members Count**          | Total registered members                                         |

**Future Phases will add:**
- Member Overview - Registration trends
- Savings Summary - Total deposits by product type
- Loan Portfolio - Outstanding loans, disbursements
- Real-time transaction feed
- Financial analytics and reporting
- And more...

---

## Competitive Advantages

| Feature                           | Koperasi Dagang        | Traditional/Manual Methods | Generic Accounting Software |
| --------------------------------- | ---------------------- | -------------------------- | --------------------------- |
| Integrated Member Management      | ✅ Built-in            | ❌ Separate registry       | ❌ Not available            |
| Savings & Loan Modules            | ✅ Full featured       | ❌ Manual ledgers          | ❌ Limited/none             |
| Trading/POS Integration           | ✅ Unified             | ❌ Separate system         | ⚠️ Separate purchase        |
| Auto SHU Calculation              | ✅ Automated           | ❌ Manual spreadsheets     | ❌ Not available            |
| Member Self-Service               | ✅ Web portal          | ❌ Office visit only       | ❌ Not available            |
| Indonesian Cooperative Compliance | ✅ Built-in reports    | ❌ Manual preparation      | ❌ Generic only             |
| Real-Time Dashboard               | ✅ Live analytics      | ❌ End-of-day only         | ⚠️ Basic                    |
| Multi-Branch Support              | ✅ Native              | ❌ Per-branch books        | ⚠️ Additional cost          |
| Complete Audit Trail              | ✅ Every action logged | ❌ Limited tracking        | ⚠️ Varies                   |
| Laravel/MySQL (Local Expertise)   | ✅ Easy to maintain    | N/A                        | ❌ Proprietary              |

---

## Roadmap Considerations

### Phase 1 - MVP (Focused Scope)

**Core Features Only:**
- Member registration and login (self-service portal)
- Loan application submission (members submit, admin reviews)
- Savings application submission (members submit, admin reviews)

**Out of Scope for MVP:**
- All transaction processing (teller operations, payments, receipts)
- Inventory and trading/POS
- Financial reporting and accounting
- Dashboard analytics
- Loan/savings activation or balance tracking
- SHU calculations
- Multi-branch support
- API integrations

**MVP Architecture Simplified:**
```
┌────────────────────────────────────┐
│   Member Self-Service Portal       │
│  ┌──────────────┐ ┌──────────────┐ │
│  │ Registration │ │    Login     │ │
│  └──────────────┘ └──────────────┘ │
│  ┌──────────────┐ ┌──────────────┐ │
│  │    Submit    │ │    Submit    │ │
│  │ Loan App     │ │ Savings App  │ │
│  └──────────────┘ └──────────────┘ │
└────────────────────────────────────┘
         │
         ▼
┌────────────────────────────────────┐
│    Admin Dashboard (Basic)         │
│  ┌──────────────┐ ┌──────────────┐ │
│  │View Pending  │ │View Pending  │ │
│  │Loan Apps     │ │Savings Apps  │ │
│  └──────────────┘ └──────────────┘ │
│  ┌──────────────┐ ┌──────────────┐ │
│  │Approve/      │ │Approve/      │ │
│  │Reject Loans  │ │Reject Savings│ │
│  └──────────────┘ └──────────────┘ │
└────────────────────────────────────┘
         │
         ▼
┌────────────────────────────────────┐
│      MySQL Database                │
│  members | loan_applications       │
│  savings_applications              │
└────────────────────────────────────┘
```

### Phase 2 - Enhanced Features

| Priority   | Feature                                                    |
| ---------- | ---------------------------------------------------------- |
| **High**   | Teller operations - savings transactions, loan disbursement |
| **High**   | Loan repayment tracking and monthly payment recording      |
| **High**   | Savings balance tracking and interest calculation          |
| **High**   | Basic dashboard for admin to monitor applications          |

### Phase 3 - Trading & Advanced Features

| Priority   | Enhancement                                                    |
| ---------- | -------------------------------------------------------------- |
| **High**   | Trading/POS system with inventory management                  |
| **High**   | Financial reporting (Balance Sheet, Income Statement)         |
| **High**   | SHU calculation and distribution                              |
| **Medium** | User Guide Documentation - Step-by-step manual for all modules |
| **Medium** | Testing Documentation - Test cases, test data, UAT scripts     |

### Phase 4 - Integrations & SaaS

| Priority   | Enhancement                                                    |
| ---------- | -------------------------------------------------------------- |
| **Medium** | API Documentation - OpenAPI/Swagger for integrations           |
| **Medium** | HCMS Payroll Integration - API to sync employee loans/savings  |
| **Low**    | Mobile Application - Member self-service mobile app            |
| **Low**    | SMS/WhatsApp Notifications - Payment reminders, balance alerts |
| **Low**    | Multi-Tenant SaaS - Cloud deployment for multiple cooperatives |

### Potential Future Enhancements

| Priority   | Enhancement                                                    |
| ---------- | -------------------------------------------------------------- |
| **High**   | User Guide Documentation - Step-by-step manual for all modules |
| **High**   | Testing Documentation - Test cases, test data, UAT scripts     |
| **High**   | API Documentation - OpenAPI/Swagger for integrations           |
| **High**   | HCMS Payroll Integration - API to sync employee loans/savings data for payroll deductions and reporting |
| **Medium** | Mobile Application - Member self-service mobile app            |
| **Medium** | SMS/WhatsApp Notifications - Payment reminders, balance alerts |
| **Medium** | Biometric Integration - Fingerprint for member verification    |
| **Medium** | Document Management - Digital document storage (KTP, forms)    |
| **Low**    | Multi-Tenant SaaS - Cloud deployment for multiple cooperatives |
| **Low**    | AI Analytics - Predictive credit scoring, demand forecasting   |
| **Low**    | Integration Hub - Bank APIs, payment gateways, e-commerce      |

---

## Technical Foundation

| Component             | Choice                     | MVP Status                                          |
| --------------------- | -------------------------- | --------------------------------------------------- |
| **Backend Framework** | Laravel 11+                | ✅ MVP Ready                                        |
| **Admin Panel**       | Laravel Filament 3         | ✅ MVP Ready - Application management               |
| **Frontend Tech**     | Livewire 3 + Alpine.js + Tailwind CSS | ✅ MVP Ready                   |
| **Database**          | MySQL 8.0+                 | ✅ MVP Ready                                        |
| **Authentication**    | Laravel Sanctum            | ✅ MVP Ready - Member and admin login               |
| **Authorization**     | Spatie Laravel Permission  | ✅ MVP Ready - Basic roles                          |
| **PDF Generation**    | barryvdh/laravel-dompdf    | ⏳ Phase 2+ - Reports                               |
| **Excel Export**      | Maatwebsite Laravel Excel  | ⏳ Phase 2+ - Bulk operations                       |
| **Audit Logging**     | Spatie Laravel Activitylog | ⏳ Phase 2+ - Full audit trail                      |
| **File Storage**      | Laravel Storage (Local/S3) | ⏳ Phase 2+ - Documents                             |
| **Queue/Jobs**        | Laravel Queue + Redis      | ⏳ Phase 2+ - Background tasks                      |
| **Caching**           | Redis                      | ⏳ Phase 2+ - Advanced caching                      |
| **Testing**           | PHPUnit + Pest             | ✅ MVP - Critical path coverage                     |
| **UI Components**     | Filament Admin Resources   | ✅ MVP - Member, Application resources              |
| **API Integration**   | RESTful API                | ⏳ Phase 4+ - HCMS and third-party integrations    |

### MVP Technology Stack

**Included in Phase 1:**
- Backend: Laravel 11 (PHP 8.2+)
- Database: MySQL 8.0+
- Frontend: Livewire 3 + Alpine.js + Tailwind CSS
- Admin Panel: Filament 3
- Authentication: Laravel Sanctum
- Authorization: Spatie Laravel Permission

**Future Phases (2-4) will add:**
- HCMS Payroll Integration with API endpoints
- PDF/Excel export capabilities
- Comprehensive audit logging
- Background job queue processing
- And more...

### Database Schema Overview (MVP)

```
┌─────────────────────────────────────────────────────────────────────────┐
│                      MVP DATABASE ENTITIES                              │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  CORE MEMBERSHIP          APPLICATIONS            SYSTEM               │
│  ────────────             ────────────            ────────────         │
│  members                  loan_applications       users                │
│  member_types             savings_applications    roles                │
│                           loan_products          permissions           │
│                           savings_products                             │
│                                                                         │
│                       (That's it for MVP!)                             │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

**Future Phases will add:**
```
FINANCIAL DATA         TRADING DATA          ACCOUNTING
────────────          ────────────          ────────────
savings_accounts      products              chart_of_accounts
savings_transactions  categories            journal_entries
loan_schedules        suppliers             journal_details
loan_payments         purchase_orders       fiscal_periods
loan_collaterals      sales_orders          account_balances
                      stock_movements       
                      
And much more...
```

---

## Getting Started

### Phase 1 MVP Implementation

1. **Environment Setup**
   - Install PHP 8.2+, Composer, Node.js, MySQL 8.0+
   - Clone repository and install dependencies
   - Configure `.env` with database credentials

2. **Database Initialization**
   - Run migrations: `php artisan migrate`
   - Seed initial loan and savings product data
   - Create super admin user

3. **System Configuration**
   - Set up cooperative profile (name, address)
   - Configure available loan products (name, interest rate)
   - Configure available savings products (product types)

4. **Testing**
   - Test member registration workflow
   - Test member login
   - Test loan application submission
   - Test savings application submission
   - Test admin approval/rejection workflow

5. **Go-Live**
   - First batch of members register and submit applications
   - Admins review and approve/reject applications
   - Monitor for issues and perform adjustments

### What to Expect in Phase 1

✅ **Member Portal**
- Register with email/phone
- Login securely
- Submit loan applications (amount, term, purpose)
- Submit savings applications (product type, amount)
- View application status

✅ **Admin Dashboard**
- View all pending applications
- Approve or reject applications
- Add notes to decisions
- View member list

### What's NOT Included in Phase 1

❌ Transaction processing (deposits, withdrawals, disbursements)
❌ Balance tracking or interest calculations
❌ Loan repayment schedules or tracking
❌ Financial reporting or accounting
❌ Trading/POS system
❌ Inventory management
❌ Multiple user roles (teller, accountant, etc.)
❌ PDF/Excel export
❌ API integrations with external systems
❌ Mobile app
❌ SMS/email notifications

---

## Summary

### Phase 1 (MVP) Scope

**Koperasi Dagang MVP focuses on the foundation:**

1. **Member Self-Service Portal** - Members can register and manage their applications online
2. **Loan Application Management** - Streamlined process for members to apply for loans
3. **Savings Application Management** - Members can apply for different savings products
4. **Admin Application Review** - Admins can review, approve, or reject all applications

### Future Growth Path (Phases 2-4)

- **Phase 2**: Transaction processing, balance tracking, and financial management
- **Phase 3**: Trading operations, reporting, and SHU calculations
- **Phase 4**: Advanced integrations (HCMS payroll), mobile app, and multi-tenant SaaS

### Key Benefits of This Phased Approach

✅ **Faster Time-to-Market** - MVP delivered quickly with core functionality
✅ **Lower Initial Investment** - Focus on essentials, reduce scope creep
✅ **Quality Over Quantity** - Thoroughly test and refine core workflows
✅ **Flexible Roadmap** - Adjust based on user feedback before Phase 2
✅ **Sustainable Growth** - Build additional features incrementally

---

## Document Information

|                           |                                             |
| ------------------------- | ------------------------------------------- |
| **Version**               | 1.0                                         |
| **Date**                  | February 3, 2026                            |
| **Classification**        | Internal / Stakeholder Review               |
| **Full Specification**    | See PRD and FSD documents (to be generated) |
| **User Guide**            | To be created in Phase 1 deliverables       |
| **Testing Documentation** | To be created in Phase 1 deliverables       |

---

## Next Steps (Phase 1 MVP)

1. Create **Entity Relationship Diagram (ERD)** - Show database schema for MVP tables
2. Create **Functional Specification Document (FSD)** - Detail all MVP workflows and features
3. Begin **Development** - Build member portal, registration, and application submission
4. Create **Testing Documentation** - Test cases for all MVP features
5. Conduct **UAT** - Have actual cooperative members test and provide feedback

---

_This focused Product Brief reflects the Phase 1 MVP scope of the Koperasi Dagang project. Once Phase 1 is complete and feedback is gathered, subsequent phases will be planned._
