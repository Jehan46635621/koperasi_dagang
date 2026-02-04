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

## Core Capabilities

### 1️⃣ Master Data Management

- **Member Registry**: Complete member lifecycle management from registration to termination
- **Product Catalog**: Configure savings products, loan products, and merchandise inventory
- **Chart of Accounts**: Flexible accounting structure following SAK ETAP standards
- **Branch/Unit Management**: Multi-branch support with consolidated reporting
- **User & Role Management**: Granular permission control for system security
- **Supplier Database**: Vendor management for trading operations
- **System Parameters**: Configurable interest rates, fees, penalties, and fiscal periods

### 2️⃣ Savings & Deposits

- **Simpanan Pokok** (Principal Savings): One-time initial membership contribution
- **Simpanan Wajib** (Mandatory Savings): Monthly required member contributions
- **Simpanan Sukarela** (Voluntary Savings): Flexible savings with interest earnings
- **Time Deposits**: Fixed-term deposits with competitive rates
- **Interest Calculation**: Automated daily/monthly interest computation
- **Passbook Printing**: Generate digital or physical passbooks

### 3️⃣ Loan Management

- **Loan Products**: Multiple loan types (productive, consumptive, emergency)
- **Credit Analysis**: Built-in credit scoring and assessment tools
- **Approval Workflow**: Multi-level approval with committee review
- **Disbursement**: Direct to savings account or cash disbursement
- **Repayment Tracking**: Automated schedule generation and payment allocation
- **Collateral Management**: Document and track loan collaterals
- **Collection Tools**: Aging reports, reminders, and collection tracking

### 4️⃣ Trading & Retail Operations

- **Point of Sale (POS)**: Fast transaction processing for retail sales
- **Inventory Management**: Real-time stock tracking with reorder alerts
- **Purchase Orders**: Streamlined procurement workflow
- **Goods Receipt**: Receiving and quality verification
- **Member Pricing**: Special pricing tiers for cooperative members
- **Credit Sales**: Member purchases on credit (integrated with loan module)
- **Barcode Support**: SKU and barcode scanning for efficiency

### 5️⃣ Accounting & Finance

- **General Ledger**: Double-entry accounting with auto-posting
- **Journal Entries**: Manual entries with approval workflow
- **Bank Reconciliation**: Match bank statements with system records
- **Cash Management**: Daily cash position and petty cash control
- **Fiscal Period Management**: Period opening/closing with validation
- **SHU Calculation**: Automated surplus distribution based on member participation

### 6️⃣ Reporting & Analytics

- **Financial Statements**: Balance Sheet, Income Statement, Cash Flow
- **Member Reports**: Membership statistics, contribution analysis
- **Loan Portfolio Reports**: Outstanding, aging, NPL ratio, collectibility
- **Trading Reports**: Sales analysis, inventory movement, profit margins
- **Regulatory Reports**: Standard formats for cooperative compliance
- **Custom Reports**: Ad-hoc report builder for specific needs

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

## User Roles Supported

| Role                      | Primary Functions                                                 |
| ------------------------- | ----------------------------------------------------------------- |
| **Super Admin**           | Full system access, user management, system configuration, backup |
| **Manager (Pengurus)**    | Approval authority, executive dashboard, policy configuration     |
| **Teller (Kasir)**        | Savings transactions, loan payments, daily cash handling          |
| **Loan Officer**          | Loan applications, credit analysis, disbursement, collection      |
| **Accountant**            | Journal entries, financial reports, reconciliation, closing       |
| **Warehouse Staff**       | Inventory management, goods receipt, stock transfers              |
| **Member Services**       | Member registration, inquiries, document management               |
| **Auditor**               | Read-only access, audit reports, compliance verification          |
| **Member (Self-Service)** | View balances, transaction history, loan applications             |

---

## System Architecture / Modules

```
┌─────────────────────────────────────────────────────────────────────────┐
│                           KOPERASI DAGANG                               │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                      PRESENTATION LAYER                          │   │
│  │  ┌───────────┐ ┌───────────┐ ┌───────────┐ ┌───────────────┐   │   │
│  │  │ Dashboard │ │   Forms   │ │  Reports  │ │ Member Portal │   │   │
│  │  └───────────┘ └───────────┘ └───────────┘ └───────────────┘   │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                    │                                    │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                      APPLICATION LAYER                           │   │
│  │  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐   │   │
│  │  │ Member  │ │ Savings │ │  Loan   │ │ Trading │ │Accounting│  │   │
│  │  │ Module  │ │ Module  │ │ Module  │ │ Module  │ │ Module  │   │   │
│  │  └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘   │   │
│  │  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐   │   │
│  │  │Inventory│ │  Report │ │Settings │ │  Audit  │ │Notifica-│   │   │
│  │  │ Module  │ │ Engine  │ │ Module  │ │  Trail  │ │  tions  │   │   │
│  │  └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘   │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                    │                                    │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                       DATA LAYER                                 │   │
│  │  ┌─────────────────────────────────────────────────────────┐    │   │
│  │  │                    MySQL Database                        │    │   │
│  │  │  Members │ Accounts │ Loans │ Inventory │ Journals │ ... │   │   │
│  │  └─────────────────────────────────────────────────────────┘    │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

**Total Modules: 12 Core Modules**

1. Member Management
2. Savings Management
3. Loan Management
4. Trading/POS
5. Inventory Management
6. Accounting/General Ledger
7. Report Engine
8. Dashboard & Analytics
9. User & Role Management
10. Settings & Parameters
11. Audit Trail
12. Member Self-Service Portal

---

## Infrastructure Highlights

- **Scalable Architecture**: Repository Pattern with Service Layer for maintainability
- **RESTful API**: Prepared for mobile app and third-party integrations
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
Application → Document Upload → Credit Analysis → Committee Review → Approval/Rejection → Disbursement → Schedule Generation → Repayment Tracking → Closure
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

## Dashboard / Analytics

| Widget                     | Purpose                                                          |
| -------------------------- | ---------------------------------------------------------------- |
| **Member Overview**        | Total active members, new registrations, membership trend        |
| **Savings Summary**        | Total deposits by product type, growth percentage                |
| **Loan Portfolio**         | Outstanding principal, disbursements this month, collection rate |
| **NPL Indicator**          | Non-performing loan ratio with aging breakdown                   |
| **Cash Position**          | Today's opening, transactions, projected closing balance         |
| **Trading Performance**    | Daily/monthly sales, top products, gross margin                  |
| **Revenue Breakdown**      | Interest income, trading profit, fees collected                  |
| **SHU Projection**         | Estimated surplus for current period                             |
| **Recent Transactions**    | Live feed of last 20 transactions                                |
| **Pending Approvals**      | Loans, journal entries awaiting manager approval                 |
| **Alerts & Notifications** | Overdue loans, low stock items, system alerts                    |

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

### Current State (Phase 1 - MVP)

- Core member management with registration workflow
- Basic savings transactions (Pokok, Wajib, Sukarela)
- Loan management with approval workflow
- Trading/POS with inventory
- Essential financial reports
- Dashboard with key metrics
- User and role management
- Audit trail logging

### Potential Enhancements

| Priority   | Enhancement                                                    |
| ---------- | -------------------------------------------------------------- |
| **High**   | User Guide Documentation - Step-by-step manual for all modules |
| **High**   | Testing Documentation - Test cases, test data, UAT scripts     |
| **High**   | API Documentation - OpenAPI/Swagger for integrations           |
| **Medium** | Mobile Application - Member self-service mobile app            |
| **Medium** | SMS/WhatsApp Notifications - Payment reminders, balance alerts |
| **Medium** | Biometric Integration - Fingerprint for member verification    |
| **Medium** | Document Management - Digital document storage (KTP, forms)    |
| **Low**    | Multi-Tenant SaaS - Cloud deployment for multiple cooperatives |
| **Low**    | AI Analytics - Predictive credit scoring, demand forecasting   |
| **Low**    | Integration Hub - Bank APIs, payment gateways, e-commerce      |

---

## Technical Foundation

| Component             | Choice                     | Why                                                                        |
| --------------------- | -------------------------- | -------------------------------------------------------------------------- |
| **Backend Framework** | Laravel 11+                | Robust PHP framework with excellent ecosystem, widely adopted in Indonesia |
| **Frontend**          | Livewire 3 + Alpine.js     | Server-rendered reactivity, reduced JavaScript complexity                  |
| **Database**          | MySQL 8.0+                 | Reliable RDBMS, strong ACID compliance, JSON support for flexibility       |
| **Authentication**    | Laravel Sanctum            | Lightweight SPA authentication, API token support                          |
| **Authorization**     | Spatie Laravel Permission  | Industry-standard role/permission management                               |
| **PDF Generation**    | barryvdh/laravel-dompdf    | Receipt printing, report export to PDF                                     |
| **Excel Export**      | Maatwebsite Laravel Excel  | Report export, bulk data import                                            |
| **Audit Logging**     | Spatie Laravel Activitylog | Complete audit trail for all models                                        |
| **File Storage**      | Laravel Storage (Local/S3) | Document uploads, member photos                                            |
| **Queue/Jobs**        | Laravel Queue + Redis      | Background report generation, notifications                                |
| **Caching**           | Redis                      | Session management, query caching                                          |
| **Testing**           | PHPUnit + Pest             | Comprehensive unit and feature testing                                     |

### Database Schema Overview

```
┌─────────────────────────────────────────────────────────────────────────┐
│                         DATABASE ENTITIES                               │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  MEMBERSHIP          FINANCIAL              TRADING                     │
│  ────────────        ─────────────          ─────────────               │
│  members             savings_products       products                    │
│  member_types        savings_accounts       categories                  │
│  member_documents    savings_transactions   suppliers                   │
│  member_families     loan_products          purchase_orders             │
│                      loans                  purchase_items              │
│                      loan_schedules         goods_receipts              │
│                      loan_payments          sales_orders                │
│                      loan_collaterals       sales_items                 │
│                                             stock_movements             │
│                                                                         │
│  ACCOUNTING          SYSTEM                 AUDIT                       │
│  ────────────        ─────────────          ─────────────               │
│  chart_of_accounts   users                  activity_logs               │
│  journal_entries     roles                  audit_trails                │
│  journal_details     permissions            notifications               │
│  fiscal_periods      branches               system_logs                 │
│  account_balances    settings                                           │
│                      parameters                                         │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## Getting Started

### For New Implementations

1. **Environment Setup**
   - Install PHP 8.2+, Composer, Node.js, MySQL 8.0+
   - Clone repository and install dependencies
   - Configure `.env` with database credentials

2. **Database Initialization**
   - Run migrations: `php artisan migrate`
   - Seed initial data: `php artisan db:seed`
   - Configure chart of accounts

3. **System Configuration**
   - Set up cooperative profile (name, address, registration)
   - Configure savings and loan products
   - Define user roles and permissions
   - Set fiscal year and system parameters

4. **Data Migration**
   - Import existing member data (Excel template provided)
   - Set opening balances for accounts
   - Verify data integrity

5. **Training & Go-Live**
   - Train staff using User Guide documentation
   - Conduct UAT with Testing documentation
   - Parallel run before full cutover

### For Existing Users

- Access dashboard at `/dashboard` after login
- Use side navigation to access modules
- Refer to User Guide for detailed instructions
- Contact support for technical issues

---

## Summary

**Koperasi Dagang transforms cooperative management by:**

1. **Unifying Operations** - Single platform for membership, savings, loans, trading, and accounting
2. **Automating Workflows** - Reduce manual tasks with intelligent automation and validation
3. **Enabling Real-Time Visibility** - Live dashboards and instant reports for better decisions
4. **Ensuring Compliance** - Built-in regulatory reports and complete audit trails
5. **Empowering Members** - Self-service portal for transparency and convenience
6. **Reducing Costs** - Lower operational expenses through efficiency gains
7. **Supporting Growth** - Scalable architecture ready for multi-branch expansion

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

## Next Steps

1. Generate **Product Requirements Document (PRD)** for detailed functional specifications
2. Generate **Entity Relationship Diagram (ERD)** for complete database design
3. Generate **Functional Specification Document (FSD)** for implementation details
4. Create **User Guide Documentation** for end-user training
5. Create **Testing Documentation** with test cases and UAT scripts
6. Begin development following the Laravel + MySQL stack

---

_This Product Brief serves as the foundation for the Koperasi Dagang project. All subsequent documentation should reference this document for consistency._
