# Product Requirements Document (PRD)

# Koperasi Dagang - Cooperative Management System

---

## Overview

|                    |                                |
| ------------------ | ------------------------------ |
| **Product Name**   | Koperasi Dagang                |
| **Version**        | 1.0                            |
| **Target Release** | Q2 2026                        |
| **Product Owner**  | [TBD - Cooperative Management] |
| **Tech Lead**      | [TBD]                          |
| **Designer**       | [TBD]                          |
| **QA Lead**        | [TBD]                          |
| **Last Updated**   | February 3, 2026               |
| **Status**         | Draft                          |

---

## Quick Links

| Document                 | Link                                   |
| ------------------------ | -------------------------------------- |
| Product Brief            | [product-brief.md](./product-brief.md) |
| Functional Specification | [fsd.md](./fsd.md)                     |
| ERD                      | [erd.md](./erd.md)                     |
| Design Mockups           | [Figma - TBD]                          |
| Technical Spec           | [TBD]                                  |
| Project Board            | [TBD]                                  |

---

## 1. Background

### 1.1 Context

Indonesian trading cooperatives (Koperasi Dagang) face significant operational challenges in managing their dual business model: financial services (savings and loans) and retail trading operations. Most cooperatives rely on manual processes, spreadsheets, or fragmented software solutions that don't communicate with each other.

The cooperative sector in Indonesia comprises over 127,000 registered cooperatives with approximately 22 million members. Trading cooperatives specifically serve communities by providing essential goods at fair prices while offering financial services to their members.

### 1.2 Current State & Metrics

| Metric                            | Current State                     | Source                   |
| --------------------------------- | --------------------------------- | ------------------------ |
| Manual data entry errors          | 15-20% error rate                 | Industry estimate        |
| Time for monthly closing          | 5-7 business days                 | Cooperative surveys      |
| Member wait time for transactions | 10-15 minutes average             | Field observation        |
| SHU calculation accuracy          | 85% (disputes common)             | Cooperative feedback     |
| Report generation time            | 2-3 days for financial statements | Manual process           |
| Inventory accuracy                | 70-80% stock accuracy             | Trading cooperative data |

### 1.3 Problem Statement

**Primary Problem:**
Indonesian trading cooperatives lack an integrated, affordable system to manage membership, financial transactions, inventory, and regulatory reporting, resulting in operational inefficiency, member dissatisfaction, and compliance risks.

**Impact Analysis:**

| Problem Area              | Business Impact                       | Member Impact                 |
| ------------------------- | ------------------------------------- | ----------------------------- |
| Manual record keeping     | 40+ hours/month on reconciliation     | Incorrect balance information |
| Fragmented systems        | Data inconsistencies, duplicate entry | Slow transaction processing   |
| No real-time reporting    | Delayed decision making               | Lack of transparency          |
| Complex SHU calculation   | Disputes, member distrust             | Unfair dividend distribution  |
| Poor inventory management | Lost sales, overstocking costs        | Product unavailability        |

### 1.4 Current Workarounds

1. **Spreadsheet-based management** - Error-prone, no audit trail, single-user limitations
2. **Multiple disconnected software** - Data silos, manual synchronization needed
3. **Paper-based ledgers** - Time-consuming, storage issues, disaster risk
4. **Generic accounting software** - Lacks cooperative-specific features (SHU, savings types)
5. **Outsourced bookkeeping** - Expensive, delayed information access

---

## 2. Objectives

### 2.1 Business Objectives

| ID    | Objective                             | Success Indicator                   | Priority    |
| ----- | ------------------------------------- | ----------------------------------- | ----------- |
| BO-01 | Reduce operational costs by 40%       | Staff hours on admin tasks          | Must Have   |
| BO-02 | Achieve 99% transaction accuracy      | Error rate < 1%                     | Must Have   |
| BO-03 | Enable real-time financial visibility | Dashboard refresh < 5 seconds       | Must Have   |
| BO-04 | Ensure regulatory compliance          | 100% report accuracy                | Must Have   |
| BO-05 | Support cooperative growth            | Handle 10,000+ members per instance | Should Have |

### 2.2 User Objectives

| User Role        | Objective                                 | Benefit                               |
| ---------------- | ----------------------------------------- | ------------------------------------- |
| **Teller**       | Complete transactions in under 2 minutes  | Faster member service, shorter queues |
| **Manager**      | Access real-time dashboards               | Informed decision making              |
| **Accountant**   | Generate reports in minutes, not days     | Focus on analysis, not data gathering |
| **Loan Officer** | Track loan portfolio with aging analysis  | Proactive collection, reduced NPL     |
| **Member**       | View balances and history anytime         | Transparency and trust                |
| **Auditor**      | Complete audit trail for all transactions | Easy compliance verification          |

---

## 3. Success Metrics

### 3.1 Primary Metrics

| Metric                      | Baseline  | Target    | Measurement Method      | Timeline             |
| --------------------------- | --------- | --------- | ----------------------- | -------------------- |
| Transaction processing time | 10-15 min | < 2 min   | System logs             | 3 months post-launch |
| Monthly closing time        | 5-7 days  | < 1 day   | Process completion date | 6 months post-launch |
| Data entry error rate       | 15-20%    | < 1%      | Error correction logs   | 3 months post-launch |
| Member satisfaction score   | N/A       | > 4.0/5.0 | Survey                  | 6 months post-launch |
| System uptime               | N/A       | 99.5%     | Monitoring tools        | Ongoing              |

### 3.2 Secondary Metrics

| Metric                      | Baseline | Target      | Measurement Method       | Timeline             |
| --------------------------- | -------- | ----------- | ------------------------ | -------------------- |
| Report generation time      | 2-3 days | < 5 minutes | System logs              | 3 months post-launch |
| Inventory accuracy          | 70-80%   | > 98%       | Physical audit vs system | 6 months post-launch |
| SHU calculation disputes    | Common   | Zero        | Dispute records          | Annual               |
| User adoption rate          | N/A      | > 90%       | Active user count        | 3 months post-launch |
| Training time for new users | N/A      | < 4 hours   | Training records         | Ongoing              |

---

## 4. Scope

### 4.1 MVP 1 Goals

**Release Target:** Q2 2026

**Core Deliverables:**

1. Member management with complete lifecycle
2. Savings module (Pokok, Wajib, Sukarela)
3. Loan management with approval workflow
4. Basic trading/POS functionality
5. Essential financial reports
6. User authentication and authorization
7. Dashboard with key metrics

### 4.2 In-Scope Features

#### Module 1: Member Management

✅ Member registration with document upload  
✅ Member profile management (personal data, address, contact)  
✅ Member status lifecycle (Active, Inactive, Resigned, Deceased)  
✅ Member type classification  
✅ Family member registration (for beneficiary)  
✅ Member search and filtering  
✅ Member card generation (digital)

#### Module 2: Savings Management

✅ Simpanan Pokok (Principal Savings) - one-time  
✅ Simpanan Wajib (Mandatory Savings) - monthly  
✅ Simpanan Sukarela (Voluntary Savings) - flexible  
✅ Deposit transactions  
✅ Withdrawal transactions  
✅ Interest calculation (configurable rates)  
✅ Savings balance inquiry  
✅ Transaction history  
✅ Passbook printing (PDF)

#### Module 3: Loan Management

✅ Loan product configuration  
✅ Loan application submission  
✅ Credit analysis worksheet  
✅ Multi-level approval workflow  
✅ Loan disbursement  
✅ Repayment schedule generation  
✅ Payment processing (installment, early settlement)  
✅ Loan aging report  
✅ Collateral documentation

#### Module 4: Trading/POS

✅ Product catalog management  
✅ Category management  
✅ Inventory tracking (stock in/out)  
✅ Purchase order creation  
✅ Goods receipt processing  
✅ Point of sale (sales transaction)  
✅ Member pricing (discount for members)  
✅ Sales receipt printing

#### Module 5: Accounting

✅ Chart of accounts setup  
✅ Journal entry (manual)  
✅ Auto-posting from transactions  
✅ Trial balance  
✅ Balance sheet  
✅ Income statement  
✅ Fiscal period management

#### Module 6: Reports

✅ Member list report  
✅ Savings summary report  
✅ Loan portfolio report  
✅ Sales report (daily/monthly)  
✅ Inventory movement report  
✅ Financial statements  
✅ Export to Excel/PDF

#### Module 7: User & Access Control

✅ User account management  
✅ Role-based access control  
✅ Permission management  
✅ Activity logging (audit trail)  
✅ Session management

#### Module 8: Dashboard

✅ Member statistics widget  
✅ Savings summary widget  
✅ Loan portfolio widget  
✅ Daily sales widget  
✅ Cash position widget  
✅ Recent transactions feed  
✅ Pending approvals widget

#### Module 9: Settings

✅ Cooperative profile configuration  
✅ Interest rate settings  
✅ Fiscal year configuration  
✅ System parameters  
✅ Backup management

### 4.3 Out-of-Scope (MVP 1)

❌ **Mobile application** - Deferred to Phase 2 for native mobile experience  
❌ **SMS/WhatsApp notifications** - Requires third-party integration  
❌ **Bank API integration** - Complex, requires bank partnerships  
❌ **Biometric authentication** - Hardware dependency  
❌ **Multi-tenant SaaS** - Architectural complexity for MVP  
❌ **AI/ML credit scoring** - Requires historical data collection first  
❌ **E-commerce integration** - Focus on in-store operations first  
❌ **Time deposits module** - Deferred to Phase 2  
❌ **Advanced SHU calculation** - Simplified version in MVP

### 4.4 Future Iterations

| Phase       | Target  | Key Features                                                 |
| ----------- | ------- | ------------------------------------------------------------ |
| **Phase 2** | Q4 2026 | Member self-service portal, Time deposits, SMS notifications |
| **Phase 3** | Q2 2027 | Mobile app (Android/iOS), Bank integration                   |
| **Phase 4** | Q4 2027 | Advanced SHU, Multi-branch consolidation, API marketplace    |

---

## 5. User Flows

### 5.1 Member Registration Flow

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│   Applicant │───▶│   Member    │───▶│   Payment   │───▶│   Approval  │
│   Fills     │    │   Services  │    │   Simpanan  │    │   by        │
│   Form      │    │   Verifies  │    │   Pokok     │    │   Manager   │
└─────────────┘    └─────────────┘    └─────────────┘    └─────────────┘
                                                                │
                   ┌─────────────┐    ┌─────────────┐           │
                   │   Member    │◀───│   Account   │◀──────────┘
                   │   Active    │    │   Created   │
                   └─────────────┘    └─────────────┘
```

**Steps:**

1. Applicant visits cooperative office with required documents (KTP, photo)
2. Member Services staff creates new member application
3. System validates data and checks for duplicates
4. Applicant pays Simpanan Pokok (Principal Savings)
5. Manager reviews and approves application
6. System creates member account and savings accounts
7. Member receives member number and digital card

**Alternative Flows:**

- If documents incomplete → Application saved as draft, member notified
- If duplicate found → Alert shown, existing member retrieved
- If manager rejects → Applicant notified with reason, refund processed

### 5.2 Savings Transaction Flow

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│   Member    │───▶│   Teller    │───▶│   System    │───▶│   Print     │
│   Request   │    │   Input     │    │   Process   │    │   Receipt   │
└─────────────┘    └─────────────┘    └─────────────┘    └─────────────┘
                          │
                          ▼
                   ┌─────────────┐
                   │  Auto-Post  │
                   │  to GL      │
                   └─────────────┘
```

**Deposit Steps:**

1. Member provides member ID or member number
2. Teller searches and selects member
3. Teller selects savings type and enters amount
4. System validates minimum deposit requirements
5. Teller confirms and processes transaction
6. System updates balance and posts to General Ledger
7. Receipt printed for member

**Withdrawal Steps:**

1. Member provides member ID and withdrawal request
2. Teller searches and selects member
3. Teller selects savings type and enters withdrawal amount
4. System checks available balance
5. System checks daily/monthly withdrawal limits
6. Teller confirms and processes transaction
7. System updates balance and posts to General Ledger
8. Cash disbursed and receipt printed

**Error Handling:**

- Insufficient balance → Transaction blocked, member informed
- Exceeds withdrawal limit → Requires manager override
- System timeout → Transaction rolled back, retry prompted

### 5.3 Loan Application Flow

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│   Member    │───▶│   Loan      │───▶│   Credit    │───▶│  Committee  │
│   Applies   │    │   Officer   │    │   Analysis  │    │   Review    │
└─────────────┘    └─────────────┘    └─────────────┘    └─────────────┘
                                                                │
       ┌────────────────────────────────────────────────────────┤
       ▼                                                        ▼
┌─────────────┐                                          ┌─────────────┐
│  Rejected   │                                          │  Approved   │
│  (Notify)   │                                          │             │
└─────────────┘                                          └─────────────┘
                                                                │
                   ┌─────────────┐    ┌─────────────┐           │
                   │  Repayment  │◀───│   Disburse  │◀──────────┘
                   │  Tracking   │    │   Loan      │
                   └─────────────┘    └─────────────┘
```

**Steps:**

1. Member submits loan application with purpose and amount
2. Loan Officer reviews application and member history
3. Loan Officer completes credit analysis worksheet
4. System calculates debt-to-income ratio and risk score
5. Application routed to appropriate approval level
6. Committee/Manager reviews and makes decision
7. If approved, loan agreement generated for signing
8. Disbursement processed (to savings account or cash)
9. Repayment schedule generated and shared with member
10. System tracks payments against schedule

### 5.4 POS/Sales Transaction Flow

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│   Customer  │───▶│   Cashier   │───▶│   Payment   │───▶│   Receipt   │
│   Selects   │    │   Scans/    │    │   Process   │    │   & Stock   │
│   Items     │    │   Enters    │    │             │    │   Update    │
└─────────────┘    └─────────────┘    └─────────────┘    └─────────────┘
                          │
                          ▼
                   ┌─────────────┐
                   │  Member     │──── If member, apply discount
                   │  Check      │
                   └─────────────┘
```

**Steps:**

1. Customer (member or non-member) selects products
2. Cashier enters products or scans barcodes
3. If member transaction, member ID entered for discount
4. System calculates total with applicable pricing
5. Customer pays (cash)
6. Transaction completed, receipt printed
7. Inventory automatically decremented
8. Revenue posted to General Ledger

---

## 6. User Stories

### 6.1 Member Management

| ID     | User Story                                                                                                      | Acceptance Criteria                                                                                                                                                               | Priority    | Platform |
| ------ | --------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------- | -------- |
| US-001 | As a Member Services staff, I want to register a new member so that they can start using cooperative services   | **Given** valid applicant data and documents, **When** I submit the registration form, **Then** a new member record is created with pending status and member number is generated | Must Have   | Web      |
| US-002 | As a Member Services staff, I want to search for members by name or ID so that I can quickly find their records | **Given** I am on the member search page, **When** I enter search criteria (name, NIK, member number), **Then** matching results are displayed within 2 seconds                   | Must Have   | Web      |
| US-003 | As a Manager, I want to approve pending member applications so that new members can be activated                | **Given** pending applications exist, **When** I review and approve an application, **Then** member status changes to Active and welcome notification is triggered                | Must Have   | Web      |
| US-004 | As a Member Services staff, I want to update member information so that records stay current                    | **Given** a member record exists, **When** I edit and save changes, **Then** the record is updated with audit trail of changes                                                    | Must Have   | Web      |
| US-005 | As an Admin, I want to deactivate members who resign so that they cannot perform transactions                   | **Given** a resignation request, **When** I process the resignation, **Then** member status changes to Resigned and outstanding balances are calculated for settlement            | Should Have | Web      |

### 6.2 Savings Management

| ID     | User Story                                                                                         | Acceptance Criteria                                                                                                                                                 | Priority    | Platform |
| ------ | -------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------- | -------- |
| US-010 | As a Teller, I want to process deposit transactions so that members can add money to their savings | **Given** a valid member and amount, **When** I submit the deposit, **Then** balance is increased, transaction is recorded, receipt is generated, and GL is updated | Must Have   | Web      |
| US-011 | As a Teller, I want to process withdrawal transactions so that members can access their savings    | **Given** a valid member with sufficient balance, **When** I submit the withdrawal, **Then** balance is decreased, transaction is recorded, receipt is generated    | Must Have   | Web      |
| US-012 | As a Member, I want to view my savings balance so that I know how much I have saved                | **Given** I am a registered member, **When** I request balance inquiry, **Then** current balance for each savings type is displayed                                 | Must Have   | Web      |
| US-013 | As a Teller, I want to print a passbook so that members have a physical record                     | **Given** a member with transaction history, **When** I request passbook print, **Then** PDF passbook is generated with all transactions since last print           | Should Have | Web      |
| US-014 | As an Accountant, I want to run interest calculation so that member savings earn interest          | **Given** end of interest period, **When** I execute interest calculation, **Then** interest is calculated for all eligible accounts and posted                     | Must Have   | Web      |

### 6.3 Loan Management

| ID     | User Story                                                                               | Acceptance Criteria                                                                                                                                       | Priority  | Platform |
| ------ | ---------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------- | --------- | -------- |
| US-020 | As a Loan Officer, I want to create a loan application so that members can request loans | **Given** member eligibility is verified, **When** I submit loan application, **Then** application is created with pending status and routed for analysis | Must Have | Web      |
| US-021 | As a Loan Officer, I want to perform credit analysis so that loan risk is assessed       | **Given** a loan application exists, **When** I complete credit analysis form, **Then** risk score is calculated and recommendation is recorded           | Must Have | Web      |
| US-022 | As a Manager, I want to approve or reject loan applications so that decisions are made   | **Given** analyzed loan application, **When** I submit my decision with comments, **Then** status is updated and next steps are triggered                 | Must Have | Web      |
| US-023 | As a Loan Officer, I want to disburse approved loans so that members receive funds       | **Given** approved loan with signed agreement, **When** I process disbursement, **Then** funds are transferred, schedule is generated, and GL is updated  | Must Have | Web      |
| US-024 | As a Teller, I want to process loan repayments so that members can pay installments      | **Given** active loan with amount due, **When** I process payment, **Then** payment is allocated to principal and interest, schedule is updated           | Must Have | Web      |
| US-025 | As a Loan Officer, I want to view loan aging report so that I can manage collections     | **Given** loans exist in portfolio, **When** I run aging report, **Then** loans are categorized by days overdue (current, 30, 60, 90+)                    | Must Have | Web      |

### 6.4 Trading/POS

| ID     | User Story                                                                              | Acceptance Criteria                                                                                                                           | Priority    | Platform |
| ------ | --------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------- | ----------- | -------- |
| US-030 | As a Cashier, I want to process sales transactions so that customers can purchase goods | **Given** products are in stock, **When** I complete sale, **Then** transaction is recorded, inventory is reduced, receipt is printed         | Must Have   | Web      |
| US-031 | As a Warehouse Staff, I want to receive goods so that inventory is updated              | **Given** a purchase order exists, **When** I record goods receipt with quantities, **Then** inventory is increased and PO status is updated  | Must Have   | Web      |
| US-032 | As an Admin, I want to manage product catalog so that items are available for sale      | **Given** product information, **When** I create/update product, **Then** product is available in POS with correct pricing                    | Must Have   | Web      |
| US-033 | As a Cashier, I want to apply member discount so that members get special pricing       | **Given** customer is a member, **When** I enter member ID during sale, **Then** member pricing is applied automatically                      | Should Have | Web      |
| US-034 | As a Warehouse Staff, I want to view low stock alerts so that I can reorder in time     | **Given** stock below reorder point, **When** I view alerts, **Then** products needing reorder are listed with current and minimum quantities | Should Have | Web      |

### 6.5 Accounting & Reports

| ID     | User Story                                                                                  | Acceptance Criteria                                                                                                                                  | Priority    | Platform |
| ------ | ------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------- | ----------- | -------- |
| US-040 | As an Accountant, I want to view trial balance so that I can verify account balances        | **Given** transactions have occurred, **When** I generate trial balance, **Then** all accounts with balances are listed with debits equaling credits | Must Have   | Web      |
| US-041 | As an Accountant, I want to generate financial statements so that management has visibility | **Given** fiscal period data exists, **When** I generate statements, **Then** Balance Sheet and Income Statement are produced in standard format     | Must Have   | Web      |
| US-042 | As a Manager, I want to view dashboard so that I have real-time business overview           | **Given** I log in, **When** dashboard loads, **Then** key metrics (members, savings, loans, sales) are displayed with current data                  | Must Have   | Web      |
| US-043 | As an Accountant, I want to create journal entries so that I can record adjustments         | **Given** adjustment is needed, **When** I create balanced journal entry, **Then** entry is posted to GL with proper debits and credits              | Must Have   | Web      |
| US-044 | As a Manager, I want to export reports to Excel so that I can perform further analysis      | **Given** report is generated, **When** I click export, **Then** Excel file is downloaded with all report data                                       | Should Have | Web      |

### 6.6 User Management

| ID     | User Story                                                                          | Acceptance Criteria                                                                                                                | Priority  | Platform |
| ------ | ----------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | --------- | -------- |
| US-050 | As an Admin, I want to create user accounts so that staff can access the system     | **Given** staff information, **When** I create user, **Then** user account is created with assigned role and temporary password    | Must Have | Web      |
| US-051 | As an Admin, I want to assign roles to users so that access is controlled           | **Given** user exists, **When** I assign role, **Then** user inherits all permissions of that role                                 | Must Have | Web      |
| US-052 | As a User, I want to change my password so that my account is secure                | **Given** I am logged in, **When** I change password with valid criteria, **Then** password is updated and session continues       | Must Have | Web      |
| US-053 | As an Auditor, I want to view audit logs so that I can review all system activities | **Given** activities have occurred, **When** I access audit log, **Then** all actions are listed with user, timestamp, and details | Must Have | Web      |

---

## 7. Analytics & Tracking

### 7.1 Event Tracking Requirements

| Event Name           | Trigger                    | Parameters                                    | Purpose                |
| -------------------- | -------------------------- | --------------------------------------------- | ---------------------- |
| `member_registered`  | New member created         | member_id, member_type, registration_date     | Track member growth    |
| `savings_deposit`    | Deposit processed          | member_id, savings_type, amount, teller_id    | Monitor savings volume |
| `savings_withdrawal` | Withdrawal processed       | member_id, savings_type, amount, teller_id    | Monitor withdrawals    |
| `loan_applied`       | Loan application submitted | member_id, product_id, amount, purpose        | Track loan demand      |
| `loan_approved`      | Loan approved              | loan_id, amount, term, approver_id            | Monitor approval rates |
| `loan_disbursed`     | Loan disbursed             | loan_id, amount, disbursement_method          | Track disbursements    |
| `loan_payment`       | Repayment processed        | loan_id, amount, payment_type                 | Monitor collections    |
| `sale_completed`     | POS transaction completed  | sale_id, total_amount, items_count, is_member | Track sales            |
| `report_generated`   | Report created             | report_type, user_id, parameters              | Monitor report usage   |
| `user_login`         | User logs in               | user_id, role, ip_address                     | Security monitoring    |

### 7.2 Event Structure Example

```json
{
  "event": "savings_deposit",
  "timestamp": "2026-02-03T10:30:00Z",
  "properties": {
    "member_id": "MBR-2024-001234",
    "member_name": "John Doe",
    "savings_type": "simpanan_sukarela",
    "amount": 500000,
    "balance_after": 2500000,
    "teller_id": "USR-001",
    "teller_name": "Jane Smith",
    "branch_id": "BR-001",
    "transaction_id": "TRX-2026020300001"
  }
}
```

### 7.3 Dashboard Analytics

| Widget               | Data Source            | Refresh Rate | Visualization           |
| -------------------- | ---------------------- | ------------ | ----------------------- |
| Total Members        | members table          | Real-time    | Counter with trend      |
| Today's Transactions | transactions table     | Real-time    | Counter                 |
| Savings Balance      | savings_accounts table | Real-time    | Currency with chart     |
| Loan Portfolio       | loans table            | Real-time    | Currency with pie chart |
| NPL Ratio            | loans table            | Daily        | Percentage gauge        |
| Daily Sales          | sales table            | Real-time    | Currency with bar chart |
| Cash Position        | cash_journals table    | Real-time    | Currency                |
| Pending Approvals    | approvals table        | Real-time    | Counter with list       |

---

## 8. Open Questions

| ID     | Question                                                    | Owner         | Status | Resolution        | Due Date   |
| ------ | ----------------------------------------------------------- | ------------- | ------ | ----------------- | ---------- |
| OQ-001 | What are the specific interest rates for each savings type? | Product Owner | Open   | [TBD]             | 2026-02-15 |
| OQ-002 | What is the maximum loan amount per member?                 | Product Owner | Open   | [TBD]             | 2026-02-15 |
| OQ-003 | How many approval levels for loans of different amounts?    | Product Owner | Open   | [TBD]             | 2026-02-15 |
| OQ-004 | What fields are required for regulatory reporting?          | Compliance    | Open   | [TBD]             | 2026-02-20 |
| OQ-005 | What is the member discount percentage for trading?         | Product Owner | Open   | [TBD]             | 2026-02-10 |
| OQ-006 | Is multi-branch support needed in MVP?                      | Product Owner | Open   | [TBD]             | 2026-02-10 |
| OQ-007 | What payment methods are accepted for POS?                  | Product Owner | Open   | Cash only for MVP | Resolved   |
| OQ-008 | What is the SHU distribution formula?                       | Product Owner | Open   | [TBD]             | 2026-03-01 |

---

## 9. Notes & Considerations

### 9.1 Technical Considerations

- **Performance**: System must support 50+ concurrent users with < 2 second response time
- **Database**: MySQL with proper indexing for high-volume transaction tables
- **Backup**: Daily automated backups with 30-day retention
- **Security**: All financial data encrypted at rest, HTTPS required
- **Audit**: Every data change must be logged with user, timestamp, and before/after values

### 9.2 Business Considerations

- **Training**: Plan for 4-hour training sessions per user role
- **Data Migration**: Existing member and balance data must be imported
- **Parallel Run**: Recommend 1-month parallel operation with old system
- **Support**: Establish help desk for go-live support

### 9.3 Regulatory Considerations

- **SAK ETAP**: Accounting must follow Indonesian cooperative accounting standards
- **Data Privacy**: Member data handling must comply with privacy regulations
- **Audit Trail**: Complete audit trail required for all financial transactions
- **RAT Reports**: System must generate required annual meeting reports

### 9.4 Migration Notes

- Member data import template will be provided (Excel format)
- Opening balances must be verified before go-live
- Historical transactions (optional) can be imported for reference
- User acceptance testing must include balance verification

---

## 10. Appendix

### 10.1 References

| Document         | Description                                  | Location                               |
| ---------------- | -------------------------------------------- | -------------------------------------- |
| Product Brief    | Executive summary of Koperasi Dagang         | [product-brief.md](./product-brief.md) |
| UU Perkoperasian | Indonesian Cooperative Law                   | External                               |
| SAK ETAP         | Accounting Standards for Non-Public Entities | External                               |
| Project.md       | Project context and conventions              | [project.md](../project.md)            |

### 10.2 Glossary

| Term                  | Definition                                                                |
| --------------------- | ------------------------------------------------------------------------- |
| **Anggota**           | Member of the cooperative                                                 |
| **Simpanan Pokok**    | Principal savings - one-time initial contribution required for membership |
| **Simpanan Wajib**    | Mandatory savings - monthly required contribution                         |
| **Simpanan Sukarela** | Voluntary savings - optional deposits earning interest                    |
| **SHU**               | Sisa Hasil Usaha - annual surplus distribution to members                 |
| **RAT**               | Rapat Anggota Tahunan - Annual General Meeting                            |
| **NPL**               | Non-Performing Loan - loans with overdue payments                         |
| **Pengurus**          | Cooperative management/board                                              |
| **Pengawas**          | Supervisory board                                                         |
| **GL**                | General Ledger                                                            |
| **COA**               | Chart of Accounts                                                         |
| **POS**               | Point of Sale                                                             |

### 10.3 Revision History

| Version | Date       | Author   | Changes              |
| ------- | ---------- | -------- | -------------------- |
| 1.0     | 2026-02-03 | [Author] | Initial PRD creation |

---

_End of Product Requirements Document_
