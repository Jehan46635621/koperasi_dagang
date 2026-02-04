# Functional Specification Document (FSD)

# Koperasi Dagang - Cooperative Management System

---

## Document Information

|                    |                                   |
| ------------------ | --------------------------------- |
| **Document Title** | Functional Specification Document |
| **Version**        | 1.0                               |
| **Date**           | February 3, 2026                  |
| **PRD Reference**  | [prd.md](./prd.md)                |
| **ERD Reference**  | [erd.md](./erd.md)                |
| **Author**         | [TBD]                             |
| **Reviewers**      | [TBD]                             |
| **Status**         | Draft                             |

---

## 1. Executive Summary

This Functional Specification Document details the functional requirements for Koperasi Dagang, an integrated web-based cooperative management system. The system provides comprehensive management of member services, savings and loans, trading operations, and accounting for Indonesian trading cooperatives (Koperasi Dagang).

The system shall:

- Manage the complete member lifecycle from registration to resignation
- Process savings transactions (deposits, withdrawals, interest)
- Handle loan applications, approvals, disbursements, and collections
- Support point-of-sale trading operations with inventory management
- Maintain double-entry accounting with auto-posting
- Generate regulatory and management reports
- Provide role-based access control with complete audit trails

---

## 2. Scope

### 2.1 In Scope

| Module                 | Functions                                                                                    |
| ---------------------- | -------------------------------------------------------------------------------------------- |
| **Member Management**  | Registration, profile management, status lifecycle, document storage                         |
| **Savings Management** | Product configuration, account management, transactions, interest calculation                |
| **Loan Management**    | Product configuration, applications, approval workflow, disbursement, repayment, collections |
| **Trading/POS**        | Product catalog, inventory, purchasing, point of sale, member pricing                        |
| **Accounting**         | Chart of accounts, journal entries, auto-posting, financial statements                       |
| **Reports**            | Member, savings, loan, trading, and financial reports with export                            |
| **Dashboard**          | Real-time widgets, KPIs, pending actions                                                     |
| **User Management**    | Users, roles, permissions, audit logging                                                     |
| **Settings**           | Cooperative profile, system parameters, fiscal periods                                       |

### 2.2 Out of Scope

| Feature                    | Reason                           |
| -------------------------- | -------------------------------- |
| Mobile application         | Deferred to Phase 2              |
| SMS/WhatsApp notifications | Requires third-party integration |
| Bank API integration       | Complex partnership requirements |
| Multi-tenant SaaS          | Architectural complexity for MVP |
| Advanced SHU calculation   | Simplified version in MVP        |
| E-commerce                 | Focus on in-store operations     |

### 2.3 Assumptions

1. Users have stable internet connectivity
2. Users have modern web browsers (Chrome, Firefox, Safari, Edge - latest 2 versions)
3. Cooperative has legal registration with Indonesian authorities
4. Initial data migration will be handled via Excel import
5. Cash-only transactions for POS in MVP
6. Single cooperative with optional multi-branch support

### 2.4 Dependencies

| Dependency    | Type           | Description         |
| ------------- | -------------- | ------------------- |
| Laravel 11+   | Technical      | Backend framework   |
| MySQL 8.0+    | Technical      | Database server     |
| Redis         | Technical      | Caching and queues  |
| SMTP Server   | Infrastructure | Email notifications |
| PDF Library   | Technical      | Report generation   |
| Excel Library | Technical      | Data export/import  |

---

## 3. User Roles & Permissions

| Role                   | Description                           | Key Capabilities                                     |
| ---------------------- | ------------------------------------- | ---------------------------------------------------- |
| **Super Admin**        | System administrator with full access | All functions, user management, system configuration |
| **Manager (Pengurus)** | Cooperative management                | Approvals, reports, dashboards, configuration        |
| **Teller (Kasir)**     | Front-line transaction processor      | Savings transactions, loan payments, POS             |
| **Loan Officer**       | Loan specialist                       | Loan applications, credit analysis, collections      |
| **Accountant**         | Financial record keeper               | Journal entries, financial reports, period closing   |
| **Warehouse Staff**    | Inventory manager                     | Stock management, goods receipt, transfers           |
| **Member Services**    | Member support staff                  | Member registration, inquiries, updates              |
| **Auditor**            | Compliance reviewer                   | Read-only access to all data, audit logs             |

### Permission Matrix

| Permission         | Super Admin | Manager | Teller | Loan Officer | Accountant | Warehouse | Member Svc | Auditor |
| ------------------ | :---------: | :-----: | :----: | :----------: | :--------: | :-------: | :--------: | :-----: |
| Manage Users       |     ✅      |   ❌    |   ❌   |      ❌      |     ❌     |    ❌     |     ❌     |   ❌    |
| System Settings    |     ✅      |   ✅    |   ❌   |      ❌      |     ❌     |    ❌     |     ❌     |   ❌    |
| Create Member      |     ✅      |   ✅    |   ❌   |      ❌      |     ❌     |    ❌     |     ✅     |   ❌    |
| Approve Member     |     ✅      |   ✅    |   ❌   |      ❌      |     ❌     |    ❌     |     ❌     |   ❌    |
| Savings Deposit    |     ✅      |   ✅    |   ✅   |      ❌      |     ❌     |    ❌     |     ❌     |   ❌    |
| Savings Withdrawal |     ✅      |   ✅    |   ✅   |      ❌      |     ❌     |    ❌     |     ❌     |   ❌    |
| Create Loan        |     ✅      |   ✅    |   ❌   |      ✅      |     ❌     |    ❌     |     ❌     |   ❌    |
| Approve Loan       |     ✅      |   ✅    |   ❌   |      ❌      |     ❌     |    ❌     |     ❌     |   ❌    |
| Loan Payment       |     ✅      |   ✅    |   ✅   |      ✅      |     ❌     |    ❌     |     ❌     |   ❌    |
| POS Sales          |     ✅      |   ✅    |   ✅   |      ❌      |     ❌     |    ❌     |     ❌     |   ❌    |
| Goods Receipt      |     ✅      |   ✅    |   ❌   |      ❌      |     ❌     |    ✅     |     ❌     |   ❌    |
| Journal Entry      |     ✅      |   ✅    |   ❌   |      ❌      |     ✅     |    ❌     |     ❌     |   ❌    |
| View Reports       |     ✅      |   ✅    |   ⚠️   |      ⚠️      |     ✅     |    ⚠️     |     ⚠️     |   ✅    |
| View Audit Logs    |     ✅      |   ✅    |   ❌   |      ❌      |     ❌     |    ❌     |     ❌     |   ✅    |

⚠️ = Limited to role-specific reports

---

## 4. Functional Requirements

### 4.1 Authentication & Authorization

#### FR-AUTH-001: User Login

- **Description:** System shall authenticate users via email and password
- **Priority:** Must Have
- **PRD Reference:** US-050
- **User Story:** As a user, I want to log in securely so that I can access system functions
- **Business Rules:**
  - BR-AUTH-001: Password must be minimum 8 characters with mixed case and numbers
  - BR-AUTH-002: Account locks after 5 failed attempts for 30 minutes
  - BR-AUTH-003: Session expires after 8 hours of inactivity
- **Acceptance Criteria:**
  - [ ] Given valid credentials, when user submits login form, then user is redirected to dashboard
  - [ ] Given invalid credentials, when user submits login form, then error message is displayed
  - [ ] Given locked account, when user attempts login, then lockout message with remaining time is shown
- **Error Handling:**
  - Invalid credentials → "Email or password is incorrect"
  - Locked account → "Account locked. Try again in X minutes"
  - Inactive account → "Account is inactive. Contact administrator"

#### FR-AUTH-002: Password Reset

- **Description:** System shall allow users to reset forgotten passwords via email
- **Priority:** Must Have
- **PRD Reference:** US-052
- **Acceptance Criteria:**
  - [ ] Given valid email, when user requests reset, then reset link is sent to email
  - [ ] Given reset link, when user sets new password, then password is updated and user can login
  - [ ] Reset link expires after 1 hour

#### FR-AUTH-003: Role-Based Access Control

- **Description:** System shall restrict access to functions based on user roles
- **Priority:** Must Have
- **PRD Reference:** US-051
- **Business Rules:**
  - BR-AUTH-004: User inherits all permissions assigned to their role(s)
  - BR-AUTH-005: Multiple roles can be assigned to a user
  - BR-AUTH-006: Permissions are checked on every request
- **Acceptance Criteria:**
  - [ ] Given user without permission, when accessing restricted function, then 403 error is displayed
  - [ ] Given user with permission, when accessing function, then function is accessible

---

### 4.2 Member Management

#### FR-MEM-001: Member Registration

- **Description:** System shall allow staff to register new cooperative members
- **Priority:** Must Have
- **PRD Reference:** US-001
- **User Story:** As a Member Services staff, I want to register new members so that they can use cooperative services
- **Business Rules:**
  - BR-MEM-001: NIK (National ID) must be 16 digits and unique
  - BR-MEM-002: Member number is auto-generated: MBR-{YYYY}-{5-digit sequence}
  - BR-MEM-003: New members start in "pending" status
  - BR-MEM-004: Required fields: NIK, name, address, phone, member type
- **Input Fields:**

| Field          | Type     | Required | Validation         |
| -------------- | -------- | -------- | ------------------ |
| nik            | Text     | Yes      | 16 digits, unique  |
| name           | Text     | Yes      | Max 255 chars      |
| member_type_id | Select   | Yes      | Valid member type  |
| birth_place    | Text     | No       | Max 100 chars      |
| birth_date     | Date     | No       | Not future date    |
| gender         | Select   | Yes      | M or F             |
| address        | Textarea | Yes      | Max 500 chars      |
| phone          | Text     | No       | Valid phone format |
| mobile         | Text     | No       | Valid phone format |
| email          | Email    | No       | Valid email format |
| photo          | File     | No       | JPG/PNG, max 2MB   |

- **Acceptance Criteria:**
  - [ ] Given valid member data, when form is submitted, then member is created with pending status
  - [ ] Given duplicate NIK, when form is submitted, then error "NIK already registered" is displayed
  - [ ] Given incomplete required fields, when form is submitted, then validation errors are shown
- **Output:** Member record with generated member_number

#### FR-MEM-002: Member Search

- **Description:** System shall allow searching members by various criteria
- **Priority:** Must Have
- **PRD Reference:** US-002
- **Search Criteria:**
  - Member number (exact or partial match)
  - Name (partial match)
  - NIK (exact match)
  - Phone/Mobile (partial match)
  - Status filter
  - Member type filter
- **Acceptance Criteria:**
  - [ ] Given search criteria, when search is executed, then matching results displayed within 2 seconds
  - [ ] Results shall be paginated (20 per page default)
  - [ ] Results shall be sortable by name, member number, join date

#### FR-MEM-003: Member Approval

- **Description:** System shall allow managers to approve pending member applications
- **Priority:** Must Have
- **PRD Reference:** US-003
- **Business Rules:**
  - BR-MEM-005: Only pending members can be approved
  - BR-MEM-006: Approval requires Simpanan Pokok payment first
  - BR-MEM-007: Approved members become "active" and savings accounts are auto-created
- **Acceptance Criteria:**
  - [ ] Given pending member with Simpanan Pokok paid, when approved, then status changes to active
  - [ ] Given pending member without Simpanan Pokok, when approval attempted, then error is displayed
  - [ ] System auto-creates savings accounts based on member type configuration

#### FR-MEM-004: Member Profile Update

- **Description:** System shall allow updating member information
- **Priority:** Must Have
- **PRD Reference:** US-004
- **Business Rules:**
  - BR-MEM-008: NIK cannot be changed after approval
  - BR-MEM-009: All changes are logged in audit trail
- **Acceptance Criteria:**
  - [ ] Given member record, when valid updates are saved, then record is updated with audit log
  - [ ] NIK field is read-only after member is approved

#### FR-MEM-005: Member Resignation

- **Description:** System shall process member resignation with settlement
- **Priority:** Should Have
- **PRD Reference:** US-005
- **Business Rules:**
  - BR-MEM-010: Member cannot resign with outstanding loan balance
  - BR-MEM-011: All savings balances must be settled (withdrawn or transferred)
  - BR-MEM-012: Resignation requires manager approval
- **Process Flow:**
  1. Staff initiates resignation request
  2. System checks for outstanding loans
  3. If clear, calculate total savings for settlement
  4. Manager reviews and approves
  5. Settlement processed (withdrawal or transfer)
  6. Member status changed to "resigned"
- **Acceptance Criteria:**
  - [ ] Given member with outstanding loan, when resignation initiated, then error with loan details shown
  - [ ] Given clear member, when resignation approved, then status changes and settlement is processed

---

### 4.3 Savings Management

#### FR-SAV-001: Savings Product Configuration

- **Description:** System shall allow configuration of savings products
- **Priority:** Must Have
- **PRD Reference:** N/A (Admin function)
- **Configuration Fields:**

| Field                | Type    | Description                   |
| -------------------- | ------- | ----------------------------- |
| code                 | Text    | Unique product code           |
| name                 | Text    | Product name                  |
| type                 | Select  | pokok/wajib/sukarela/deposito |
| interest_rate        | Decimal | Annual rate (%)               |
| interest_calculation | Select  | daily/monthly/annually        |
| min_balance          | Decimal | Minimum balance required      |
| min_deposit          | Decimal | Minimum deposit amount        |
| min_withdrawal       | Decimal | Minimum withdrawal amount     |
| max_withdrawal_daily | Decimal | Daily withdrawal limit        |
| gl_account_id        | Select  | GL account mapping            |

- **Business Rules:**
  - BR-SAV-001: Simpanan Pokok has no interest and is non-withdrawable
  - BR-SAV-002: Simpanan Wajib is mandatory monthly
  - BR-SAV-003: Each product type maps to specific GL accounts

#### FR-SAV-002: Savings Account Opening

- **Description:** System shall auto-create savings accounts upon member approval
- **Priority:** Must Have
- **PRD Reference:** Implied by US-003
- **Business Rules:**
  - BR-SAV-004: One account per product type per member
  - BR-SAV-005: Account number format: {Product Code}-{Member Number}
  - BR-SAV-006: Initial balance is zero
- **Acceptance Criteria:**
  - [ ] Given member approval, when processed, then savings accounts are created per member type configuration

#### FR-SAV-003: Deposit Transaction

- **Description:** System shall process deposit transactions
- **Priority:** Must Have
- **PRD Reference:** US-010
- **User Story:** As a Teller, I want to process deposits so that members can save money
- **Input Fields:**

| Field              | Type          | Required | Validation         |
| ------------------ | ------------- | -------- | ------------------ |
| member_id          | Search/Select | Yes      | Active member      |
| savings_account_id | Select        | Yes      | Active account     |
| amount             | Currency      | Yes      | >= minimum deposit |
| description        | Text          | No       | Max 255 chars      |

- **Business Rules:**
  - BR-SAV-007: Amount must meet minimum deposit requirement
  - BR-SAV-008: Transaction auto-posts to General Ledger
  - BR-SAV-009: Transaction number: SAV-{YYYYMMDD}-{sequence}
- **Process Flow:**
  1. Teller selects member
  2. System displays available savings accounts with balances
  3. Teller selects account and enters amount
  4. System validates amount against minimum
  5. Teller confirms transaction
  6. System updates balance, creates transaction record
  7. System auto-posts: Debit Cash, Credit Savings Liability
  8. Receipt generated
- **Acceptance Criteria:**
  - [ ] Given valid deposit, when confirmed, then balance increases and GL is updated
  - [ ] Given amount below minimum, when submitted, then validation error displayed
  - [ ] Transaction is logged with full audit trail
- **GL Posting:**
  ```
  Debit:  Cash (Asset)              XXX
  Credit: Member Savings (Liability)    XXX
  ```

#### FR-SAV-004: Withdrawal Transaction

- **Description:** System shall process withdrawal transactions
- **Priority:** Must Have
- **PRD Reference:** US-011
- **User Story:** As a Teller, I want to process withdrawals so that members can access their savings
- **Business Rules:**
  - BR-SAV-010: Amount cannot exceed available balance
  - BR-SAV-011: Amount must meet minimum withdrawal requirement
  - BR-SAV-012: Daily withdrawal limit applies (if configured)
  - BR-SAV-013: Simpanan Pokok cannot be withdrawn (except resignation)
  - BR-SAV-014: Minimum balance must be maintained (if configured)
- **Validation Logic:**

  ```
  available_balance = current_balance - min_balance
  daily_withdrawn = sum(today's withdrawals)
  remaining_daily_limit = max_withdrawal_daily - daily_withdrawn

  max_withdrawal = MIN(available_balance, remaining_daily_limit)

  IF requested_amount > max_withdrawal THEN reject
  ```

- **Acceptance Criteria:**
  - [ ] Given sufficient balance, when withdrawal processed, then balance decreases
  - [ ] Given insufficient balance, when withdrawal attempted, then error with available amount shown
  - [ ] Given daily limit exceeded, when withdrawal attempted, then error with remaining limit shown
  - [ ] Given Simpanan Pokok account, when withdrawal attempted, then error displayed
- **GL Posting:**
  ```
  Debit:  Member Savings (Liability) XXX
  Credit: Cash (Asset)                   XXX
  ```

#### FR-SAV-005: Savings Balance Inquiry

- **Description:** System shall display member savings balances
- **Priority:** Must Have
- **PRD Reference:** US-012
- **Display Information:**
  - Account number
  - Product type and name
  - Current balance
  - Last transaction date
  - Interest earned (YTD)
- **Acceptance Criteria:**
  - [ ] Given member ID, when inquiry made, then all savings accounts with balances displayed

#### FR-SAV-006: Interest Calculation

- **Description:** System shall calculate and post interest for eligible savings
- **Priority:** Must Have
- **PRD Reference:** US-014
- **Business Rules:**
  - BR-SAV-015: Interest calculation based on product configuration
  - BR-SAV-016: Daily interest = (balance × annual_rate / 365)
  - BR-SAV-017: Interest posts to savings account as deposit
  - BR-SAV-018: Interest calculation runs at end of period (configurable)
- **Calculation Formula:**
  ```
  For Daily:    interest = balance × (annual_rate/100) / 365
  For Monthly:  interest = average_daily_balance × (annual_rate/100) / 12
  ```
- **Acceptance Criteria:**
  - [ ] Given end of interest period, when calculation runs, then interest is posted to all eligible accounts
  - [ ] Interest transaction has type "interest" for reporting

#### FR-SAV-007: Passbook Printing

- **Description:** System shall generate passbook in PDF format
- **Priority:** Should Have
- **PRD Reference:** US-013
- **Content:**
  - Member information
  - Account details
  - Transaction list (since last print or all)
  - Current balance
- **Acceptance Criteria:**
  - [ ] Given member account, when passbook requested, then PDF is generated with all transactions

---

### 4.4 Loan Management

#### FR-LOAN-001: Loan Product Configuration

- **Description:** System shall allow configuration of loan products
- **Priority:** Must Have
- **PRD Reference:** N/A (Admin function)
- **Configuration Fields:**

| Field               | Type    | Description                      |
| ------------------- | ------- | -------------------------------- |
| code                | Text    | Unique product code              |
| name                | Text    | Product name                     |
| type                | Select  | productive/consumptive/emergency |
| interest_rate       | Decimal | Annual rate (%)                  |
| interest_type       | Select  | flat/declining/effective         |
| min_amount          | Decimal | Minimum loan amount              |
| max_amount          | Decimal | Maximum loan amount              |
| min_term_months     | Integer | Minimum term                     |
| max_term_months     | Integer | Maximum term                     |
| admin_fee_percent   | Decimal | Admin fee (%)                    |
| penalty_rate        | Decimal | Late penalty rate (%)            |
| grace_period_days   | Integer | Days before penalty              |
| requires_collateral | Boolean | Collateral required              |

- **Interest Type Calculations:**
  ```
  Flat:      monthly_interest = principal × (annual_rate/12/100)
  Declining: monthly_interest = outstanding × (annual_rate/12/100)
  Effective: use amortization formula
  ```

#### FR-LOAN-002: Loan Application

- **Description:** System shall process loan applications
- **Priority:** Must Have
- **PRD Reference:** US-020
- **User Story:** As a Loan Officer, I want to create loan applications so that members can request financing
- **Input Fields:**

| Field           | Type     | Required    | Validation            |
| --------------- | -------- | ----------- | --------------------- |
| member_id       | Search   | Yes         | Active member         |
| loan_product_id | Select   | Yes         | Active product        |
| amount          | Currency | Yes         | Within product limits |
| term_months     | Integer  | Yes         | Within product limits |
| purpose         | Textarea | Yes         | Max 500 chars         |
| collateral_info | Textarea | Conditional | If product requires   |

- **Business Rules:**
  - BR-LOAN-001: Member must be active with Simpanan Pokok paid
  - BR-LOAN-002: Amount within product min/max limits
  - BR-LOAN-003: Check existing loan limits per member
  - BR-LOAN-004: Loan number: LN-{YYYY}-{5-digit sequence}
- **Eligibility Checks:**
  ```
  1. Member status = "active"
  2. Simpanan Pokok paid
  3. No NPL (non-performing loan) history
  4. Total outstanding + new loan <= member limit
  5. Debt-to-income ratio <= threshold
  ```
- **Acceptance Criteria:**
  - [ ] Given eligible member, when application submitted, then loan created with "pending" status
  - [ ] Given ineligible member, when application attempted, then rejection reason displayed
  - [ ] System calculates installment, total interest, fees automatically

#### FR-LOAN-003: Credit Analysis

- **Description:** System shall support credit analysis workflow
- **Priority:** Must Have
- **PRD Reference:** US-021
- **Analysis Components:**

| Component  | Description                       |
| ---------- | --------------------------------- |
| Character  | Member history, payment behavior  |
| Capacity   | Income vs. obligations, DTI ratio |
| Capital    | Savings balance, net worth        |
| Collateral | Security value (if applicable)    |
| Condition  | Loan purpose, economic factors    |

- **DTI Calculation:**

  ```
  monthly_obligations = existing_installments + new_installment
  dti_ratio = monthly_obligations / monthly_income × 100

  Risk Rating:
  - Low:    DTI <= 30%
  - Medium: DTI 31-50%
  - High:   DTI > 50%
  ```

- **Acceptance Criteria:**
  - [ ] Given loan application, when analysis submitted, then risk rating is calculated
  - [ ] Analysis record attached to loan for audit purposes

#### FR-LOAN-004: Loan Approval Workflow

- **Description:** System shall route loans through approval hierarchy
- **Priority:** Must Have
- **PRD Reference:** US-022
- **Approval Levels:**

| Amount Range              | Approval Authority             |
| ------------------------- | ------------------------------ |
| Up to Rp 5,000,000        | Loan Officer                   |
| Rp 5,000,001 - 25,000,000 | Manager                        |
| Above Rp 25,000,000       | Committee (multiple approvers) |

- **Business Rules:**
  - BR-LOAN-005: Each level must approve sequentially
  - BR-LOAN-006: Rejection at any level ends the process
  - BR-LOAN-007: Approver cannot be the applicant or loan officer
- **Status Transitions:**
  ```
  pending → analyzing → committee → approved → disbursed
                    ↓           ↓
                 rejected    rejected
  ```
- **Acceptance Criteria:**
  - [ ] Given analyzed loan, when routed, then goes to correct approval level
  - [ ] Given approval, when confirmed, then status updates and moves to next level or disbursement
  - [ ] Given rejection, when confirmed, then status is "rejected" and member notified

#### FR-LOAN-005: Loan Disbursement

- **Description:** System shall disburse approved loans
- **Priority:** Must Have
- **PRD Reference:** US-023
- **Disbursement Methods:**
  1. To Savings Account (debit loan receivable, credit member savings)
  2. Cash (debit loan receivable, credit cash)
- **Disbursement Calculation:**
  ```
  disbursed_amount = principal_amount - admin_fee - insurance_fee
  ```
- **Process:**
  1. Generate loan agreement document
  2. Member signs agreement
  3. Staff selects disbursement method
  4. If to savings: select target savings account
  5. Confirm disbursement
  6. System posts to GL and generates schedule
- **GL Posting (to savings):**
  ```
  Debit:  Loan Receivable (Asset)      principal_amount
  Credit: Member Savings (Liability)   disbursed_amount
  Credit: Admin Fee Income (Revenue)   admin_fee
  Credit: Insurance Reserve            insurance_fee
  ```
- **Acceptance Criteria:**
  - [ ] Given approved loan, when disbursed, then funds are transferred and schedule is generated
  - [ ] Loan status changes to "active"
  - [ ] First due date calculated based on disbursement date

#### FR-LOAN-006: Repayment Schedule Generation

- **Description:** System shall generate repayment schedules for loans
- **Priority:** Must Have
- **PRD Reference:** Implied by US-023
- **Schedule Fields:**
  - Installment number
  - Due date
  - Principal portion
  - Interest portion
  - Total due
  - Running balance
- **Calculation Example (Flat):**
  ```
  monthly_principal = principal / term_months
  monthly_interest = principal × (annual_rate/12/100)
  monthly_installment = monthly_principal + monthly_interest
  ```
- **Acceptance Criteria:**
  - [ ] Given loan disbursement, when schedule generated, then all installments calculated correctly
  - [ ] Sum of principal portions equals loan principal
  - [ ] Due dates are monthly from first due date

#### FR-LOAN-007: Loan Payment Processing

- **Description:** System shall process loan repayments
- **Priority:** Must Have
- **PRD Reference:** US-024
- **User Story:** As a Teller, I want to process loan payments so that members can repay their loans
- **Payment Allocation:**
  ```
  Priority:
  1. Penalties (if any)
  2. Interest due
  3. Principal due
  ```
- **Input Fields:**

| Field              | Type     | Required    | Validation          |
| ------------------ | -------- | ----------- | ------------------- |
| loan_id            | Search   | Yes         | Active loan         |
| amount             | Currency | Yes         | > 0                 |
| payment_method     | Select   | Yes         | cash/savings_deduct |
| savings_account_id | Select   | Conditional | If savings deduct   |

- **Business Rules:**
  - BR-LOAN-008: Partial payments are allowed
  - BR-LOAN-009: Overpayment applies to principal
  - BR-LOAN-010: Payment updates schedule status
- **GL Posting (interest + principal):**
  ```
  Debit:  Cash (Asset)                 payment_amount
  Credit: Loan Receivable (Asset)      principal_portion
  Credit: Interest Income (Revenue)    interest_portion
  Credit: Penalty Income (Revenue)     penalty_portion (if any)
  ```
- **Acceptance Criteria:**
  - [ ] Given payment amount, when processed, then correctly allocated to penalty/interest/principal
  - [ ] Schedule installment status updated (paid/partial)
  - [ ] Outstanding balance recalculated

#### FR-LOAN-008: Loan Aging Report

- **Description:** System shall classify loans by days overdue
- **Priority:** Must Have
- **PRD Reference:** US-025
- **Classification (Collectibility):**

| Category        | Days Overdue | Provision % |
| --------------- | ------------ | ----------- |
| Current         | 0            | 0.5%        |
| Special Mention | 1-30         | 5%          |
| Substandard     | 31-60        | 15%         |
| Doubtful        | 61-90        | 50%         |
| Loss            | 90+          | 100%        |

- **Report Output:**
  - Summary by collectibility category
  - Detail list with member, loan amount, days overdue
  - Total outstanding per category
  - Provision calculation
- **Acceptance Criteria:**
  - [ ] Given loan portfolio, when aging report run, then loans correctly categorized
  - [ ] Days overdue calculated from oldest unpaid installment due date

---

### 4.5 Trading / POS

#### FR-TRADE-001: Product Catalog Management

- **Description:** System shall manage product catalog for trading
- **Priority:** Must Have
- **PRD Reference:** US-032
- **Input Fields:**

| Field         | Type     | Required | Validation         |
| ------------- | -------- | -------- | ------------------ |
| sku           | Text     | Yes      | Unique             |
| barcode       | Text     | No       | Unique             |
| name          | Text     | Yes      | Max 255 chars      |
| category_id   | Select   | Yes      | Valid category     |
| unit          | Text     | Yes      | e.g., pcs, kg, ltr |
| cost_price    | Currency | Yes      | > 0                |
| selling_price | Currency | Yes      | > cost_price       |
| member_price  | Currency | No       | <= selling_price   |
| min_stock     | Number   | Yes      | >= 0               |

- **Acceptance Criteria:**
  - [ ] Given valid product data, when saved, then product available in POS
  - [ ] Given duplicate SKU/barcode, when saved, then error displayed

#### FR-TRADE-002: Purchase Order Creation

- **Description:** System shall manage purchase orders to suppliers
- **Priority:** Must Have
- **PRD Reference:** N/A (Inventory function)
- **Process:**
  1. Select supplier
  2. Add products with quantities and unit prices
  3. System calculates totals
  4. Save as draft or submit
- **Acceptance Criteria:**
  - [ ] Given submitted PO, when saved, then PO number generated and supplier notified (future)

#### FR-TRADE-003: Goods Receipt Processing

- **Description:** System shall process goods receipt from suppliers
- **Priority:** Must Have
- **PRD Reference:** US-031
- **User Story:** As Warehouse Staff, I want to receive goods so that inventory is updated
- **Business Rules:**
  - BR-TRADE-001: Can receive against PO or create direct receipt
  - BR-TRADE-002: Receiving updates inventory quantity
  - BR-TRADE-003: Stock movement record created
- **GL Posting:**
  ```
  Debit:  Inventory (Asset)          receipt_value
  Credit: Accounts Payable (Liability)    receipt_value
  ```
- **Acceptance Criteria:**
  - [ ] Given goods receipt, when posted, then inventory quantities increase
  - [ ] Stock movement log created with reference to receipt

#### FR-TRADE-004: Point of Sale Transaction

- **Description:** System shall process sales transactions
- **Priority:** Must Have
- **PRD Reference:** US-030
- **User Story:** As a Cashier, I want to process sales so that customers can purchase goods
- **Process Flow:**
  1. Add products (by barcode scan or search)
  2. Enter quantities
  3. If member: enter member ID for discount
  4. System applies pricing (member vs. regular)
  5. Calculate total
  6. Enter amount received
  7. Calculate change
  8. Complete sale
  9. Print receipt
- **Business Rules:**
  - BR-TRADE-003: Cannot sell if stock insufficient
  - BR-TRADE-004: Member pricing applied automatically if member ID entered
  - BR-TRADE-005: Inventory decremented upon sale
- **GL Posting:**

  ```
  Debit:  Cash (Asset)               sale_amount
  Credit: Sales Revenue (Revenue)        sale_amount

  Debit:  Cost of Goods Sold (Expense)   cogs
  Credit: Inventory (Asset)                  cogs
  ```

- **Acceptance Criteria:**
  - [ ] Given products in cart, when sale completed, then inventory reduced and GL updated
  - [ ] Given member ID, when entered, then member pricing applied to all items
  - [ ] Receipt generated with transaction details

#### FR-TRADE-005: Low Stock Alert

- **Description:** System shall alert when stock falls below reorder point
- **Priority:** Should Have
- **PRD Reference:** US-034
- **Business Rules:**
  - BR-TRADE-006: Alert when stock_quantity <= min_stock
  - BR-TRADE-007: Show in dashboard widget
- **Acceptance Criteria:**
  - [ ] Given stock below minimum, when dashboard loads, then low stock widget displays affected products

---

### 4.6 Accounting

#### FR-ACC-001: Chart of Accounts Management

- **Description:** System shall maintain chart of accounts structure
- **Priority:** Must Have
- **PRD Reference:** N/A (Admin function)
- **Account Structure:**

| Account Type | Code Range       | Normal Balance |
| ------------ | ---------------- | -------------- |
| Asset        | 1-0000 to 1-9999 | Debit          |
| Liability    | 2-0000 to 2-9999 | Credit         |
| Equity       | 3-0000 to 3-9999 | Credit         |
| Revenue      | 4-0000 to 4-9999 | Credit         |
| Expense      | 5-0000 to 5-9999 | Debit          |

- **Business Rules:**
  - BR-ACC-001: Header accounts cannot receive postings
  - BR-ACC-002: Cannot delete accounts with transactions

#### FR-ACC-002: Manual Journal Entry

- **Description:** System shall allow creation of manual journal entries
- **Priority:** Must Have
- **PRD Reference:** US-043
- **User Story:** As an Accountant, I want to create journal entries for adjustments
- **Input Fields:**

| Field               | Type     | Required    | Validation             |
| ------------------- | -------- | ----------- | ---------------------- |
| entry_date          | Date     | Yes         | Within open period     |
| description         | Text     | Yes         | Max 255 chars          |
| lines[]             | Array    | Yes         | Min 2 lines            |
| lines[].account_id  | Select   | Yes         | Non-header account     |
| lines[].description | Text     | No          | Line description       |
| lines[].debit       | Currency | Conditional | Either debit or credit |
| lines[].credit      | Currency | Conditional | Either debit or credit |

- **Business Rules:**
  - BR-ACC-003: Total debits must equal total credits
  - BR-ACC-004: Entry date must be in open fiscal period
  - BR-ACC-005: Posted entries cannot be modified (must reverse)
- **Acceptance Criteria:**
  - [ ] Given balanced entry, when posted, then account balances updated
  - [ ] Given unbalanced entry, when posted, then error "Debits must equal credits"

#### FR-ACC-003: Trial Balance

- **Description:** System shall generate trial balance report
- **Priority:** Must Have
- **PRD Reference:** US-040
- **Report Output:**
  - Account code
  - Account name
  - Debit balance
  - Credit balance
  - Total debits = Total credits
- **Acceptance Criteria:**
  - [ ] Given posted transactions, when trial balance generated, then debits equal credits

#### FR-ACC-004: Financial Statements

- **Description:** System shall generate Balance Sheet and Income Statement
- **Priority:** Must Have
- **PRD Reference:** US-041
- **Balance Sheet Structure:**

  ```
  ASSETS
    Current Assets
    Fixed Assets
  Total Assets = XXX

  LIABILITIES
    Current Liabilities
    Long-term Liabilities
  Total Liabilities = XXX

  EQUITY
    Member Equity
    Retained Surplus
  Total Equity = XXX

  Total Liabilities + Equity = XXX (must equal Assets)
  ```

- **Income Statement Structure:**

  ```
  REVENUE
    Interest Income
    Trading Sales
    Fees and Charges
  Total Revenue = XXX

  EXPENSES
    Operating Expenses
    Interest Expense
    Cost of Goods Sold
  Total Expenses = XXX

  NET SURPLUS (SHU) = Revenue - Expenses
  ```

- **Acceptance Criteria:**
  - [ ] Given fiscal period, when statements generated, then correctly structured per SAK ETAP
  - [ ] Balance sheet balances (Assets = Liabilities + Equity)

#### FR-ACC-005: Fiscal Period Management

- **Description:** System shall manage fiscal periods for transaction posting
- **Priority:** Must Have
- **PRD Reference:** N/A (Admin function)
- **Business Rules:**
  - BR-ACC-006: Only one period can be "current" at a time
  - BR-ACC-007: Cannot post to closed/locked periods
  - BR-ACC-008: Period closing transfers income/expense to retained surplus
- **Acceptance Criteria:**
  - [ ] Given attempt to post to closed period, then error displayed
  - [ ] Given period close, when executed, then closing entries generated

---

### 4.7 Reports

#### FR-RPT-001: Member Reports

- **Description:** System shall generate member-related reports
- **Priority:** Must Have
- **PRD Reference:** N/A (Report function)
- **Available Reports:**

| Report             | Description               | Parameters                |
| ------------------ | ------------------------- | ------------------------- |
| Member List        | All members with status   | Status filter, date range |
| Member Summary     | Statistics by type/status | As of date                |
| New Members        | Members joined in period  | Date range                |
| Resignation Report | Resigned members          | Date range                |

#### FR-RPT-002: Savings Reports

- **Description:** System shall generate savings-related reports
- **Priority:** Must Have
- **Available Reports:**

| Report           | Description                    | Parameters         |
| ---------------- | ------------------------------ | ------------------ |
| Savings Summary  | Total by product type          | As of date         |
| Member Statement | Individual transaction history | Member, date range |
| Interest Report  | Interest earned/paid           | Period             |
| Top Savers       | Highest balance members        | Top N, as of date  |

#### FR-RPT-003: Loan Reports

- **Description:** System shall generate loan-related reports
- **Priority:** Must Have
- **PRD Reference:** US-025
- **Available Reports:**

| Report              | Description                 | Parameters                 |
| ------------------- | --------------------------- | -------------------------- |
| Loan Portfolio      | All active loans            | As of date, product filter |
| Aging Analysis      | Collectibility breakdown    | As of date                 |
| Disbursement Report | Loans disbursed in period   | Date range                 |
| Collection Report   | Payments received           | Date range                 |
| NPL Report          | Non-performing loans detail | As of date                 |

#### FR-RPT-004: Trading Reports

- **Description:** System shall generate trading-related reports
- **Priority:** Must Have
- **Available Reports:**

| Report           | Description           | Parameters          |
| ---------------- | --------------------- | ------------------- |
| Daily Sales      | Sales by date         | Date                |
| Sales Summary    | Sales by period       | Date range          |
| Inventory Status | Current stock levels  | Category filter     |
| Stock Movement   | Inventory in/out      | Date range, product |
| Profit Margin    | Product profitability | Date range          |

#### FR-RPT-005: Report Export

- **Description:** System shall export reports to Excel and PDF
- **Priority:** Should Have
- **PRD Reference:** US-044
- **Acceptance Criteria:**
  - [ ] Given any report, when export clicked, then file downloaded in selected format

---

### 4.8 Dashboard

#### FR-DASH-001: Dashboard Widgets

- **Description:** System shall display role-appropriate dashboard widgets
- **Priority:** Must Have
- **PRD Reference:** US-042

| Widget              | Data                         | Roles                 |
| ------------------- | ---------------------------- | --------------------- |
| Total Members       | Active count, new this month | All                   |
| Savings Balance     | Total by product             | Manager, Accountant   |
| Loan Portfolio      | Outstanding, NPL ratio       | Manager, Loan Officer |
| Daily Sales         | Today's sales total          | Manager, Teller       |
| Cash Position       | Current cash balance         | Manager, Teller       |
| Pending Approvals   | Count with links             | Manager               |
| Recent Transactions | Last 10 activities           | All                   |
| Low Stock Alerts    | Products below minimum       | Manager, Warehouse    |

- **Acceptance Criteria:**
  - [ ] Given user login, when dashboard loads, then role-appropriate widgets displayed
  - [ ] Data refreshes without full page reload

---

## 5. Business Rules Catalog

| ID           | Rule                                                 | Applies To | Validation                    |
| ------------ | ---------------------------------------------------- | ---------- | ----------------------------- |
| BR-AUTH-001  | Password minimum 8 chars with mixed case and numbers | Login      | Registration, Password Change |
| BR-AUTH-002  | Lock account after 5 failed attempts for 30 minutes  | Login      | Login attempt                 |
| BR-MEM-001   | NIK must be 16 digits and unique                     | Members    | Registration                  |
| BR-MEM-002   | Member number auto-generated MBR-{YYYY}-{NNNNN}      | Members    | Approval                      |
| BR-MEM-010   | Cannot resign with outstanding loan                  | Members    | Resignation                   |
| BR-SAV-007   | Deposit must meet minimum requirement                | Savings    | Deposit                       |
| BR-SAV-010   | Withdrawal cannot exceed available balance           | Savings    | Withdrawal                    |
| BR-SAV-013   | Simpanan Pokok non-withdrawable                      | Savings    | Withdrawal                    |
| BR-LOAN-001  | Member must be active with Simpanan Pokok            | Loans      | Application                   |
| BR-LOAN-005  | Approval levels must be sequential                   | Loans      | Approval                      |
| BR-ACC-003   | Journal entry debits must equal credits              | Accounting | Journal                       |
| BR-ACC-004   | Cannot post to closed fiscal period                  | Accounting | All transactions              |
| BR-TRADE-003 | Cannot sell with insufficient stock                  | Trading    | POS                           |

---

## 6. Data Specifications

### 6.1 Data Validation Rules

| Field Type         | Validation Rules                  |
| ------------------ | --------------------------------- |
| NIK                | 16 digits, numeric only           |
| Phone              | 10-15 chars, starts with 0 or +62 |
| Email              | Valid email format                |
| Currency           | Decimal (15,2), >= 0              |
| Percentage         | Decimal (5,2), 0-100              |
| Date               | Valid date, format YYYY-MM-DD     |
| Member Number      | Pattern: MBR-YYYY-NNNNN           |
| Loan Number        | Pattern: LN-YYYY-NNNNN            |
| Transaction Number | Pattern: {TYPE}-YYYYMMDD-NNNNN    |

### 6.2 Data Relationships

See [ERD Document](./erd.md) for complete entity relationships.

---

## 7. Interface Specifications

### 7.1 User Interface Requirements

#### Navigation Structure

```
├── Dashboard
├── Members
│   ├── List
│   ├── Register
│   ├── Pending Approvals
│   └── Search
├── Savings
│   ├── Deposit
│   ├── Withdrawal
│   ├── Balance Inquiry
│   └── Products (Admin)
├── Loans
│   ├── Applications
│   ├── Active Loans
│   ├── Payments
│   ├── Approvals
│   └── Products (Admin)
├── Trading
│   ├── Point of Sale
│   ├── Products
│   ├── Inventory
│   ├── Purchase Orders
│   └── Goods Receipt
├── Accounting
│   ├── Journal Entry
│   ├── Chart of Accounts
│   └── Fiscal Periods
├── Reports
│   ├── Member Reports
│   ├── Savings Reports
│   ├── Loan Reports
│   ├── Trading Reports
│   └── Financial Statements
├── Settings
│   ├── Cooperative Profile
│   ├── Users
│   ├── Roles
│   └── Parameters
└── Audit Log
```

#### Screen Layouts

**Transaction Forms:**

- Member selector with search
- Amount input with thousand separators
- Real-time balance display
- Confirmation dialog before submit
- Success message with receipt print option

**List Views:**

- Search/filter bar at top
- Sortable column headers
- Pagination at bottom
- Action buttons per row
- Bulk action support where applicable

**Reports:**

- Parameter form at top
- Preview in browser
- Export buttons (Excel, PDF)
- Print-friendly layout

### 7.2 API Specifications (Internal)

| Endpoint                     | Method | Purpose                 | Auth                       |
| ---------------------------- | ------ | ----------------------- | -------------------------- |
| POST /api/auth/login         | POST   | User authentication     | Public                     |
| GET /api/members             | GET    | List members            | Authenticated              |
| POST /api/members            | POST   | Create member           | Authenticated + Permission |
| GET /api/members/{id}        | GET    | Member detail           | Authenticated              |
| PUT /api/members/{id}        | PUT    | Update member           | Authenticated + Permission |
| POST /api/savings/deposit    | POST   | Process deposit         | Authenticated + Permission |
| POST /api/savings/withdrawal | POST   | Process withdrawal      | Authenticated + Permission |
| POST /api/loans              | POST   | Create loan application | Authenticated + Permission |
| POST /api/loans/{id}/approve | POST   | Approve loan            | Authenticated + Permission |
| POST /api/pos/sale           | POST   | Process sale            | Authenticated + Permission |

---

## 8. Non-Functional Considerations

### 8.1 Performance Requirements

| Metric                       | Requirement                |
| ---------------------------- | -------------------------- |
| Page load time               | < 3 seconds                |
| Transaction processing       | < 2 seconds                |
| Report generation (standard) | < 10 seconds               |
| Report generation (complex)  | < 60 seconds               |
| Concurrent users             | 50+ simultaneous           |
| Database response            | < 100ms for simple queries |

### 8.2 Security Requirements

| Requirement      | Implementation                     |
| ---------------- | ---------------------------------- |
| Password hashing | bcrypt with cost factor 12         |
| Session security | HTTP-only, secure cookies          |
| CSRF protection  | Laravel CSRF tokens                |
| SQL injection    | Eloquent ORM parameterized queries |
| XSS prevention   | Blade auto-escaping                |
| Data encryption  | TLS 1.2+ in transit                |
| Audit logging    | All data modifications logged      |

### 8.3 Availability Requirements

| Metric                   | Requirement                   |
| ------------------------ | ----------------------------- |
| Uptime                   | 99.5% (excluding maintenance) |
| Backup frequency         | Daily automated               |
| Backup retention         | 30 days                       |
| Recovery time objective  | < 4 hours                     |
| Recovery point objective | < 24 hours                    |

---

## 9. Traceability Matrix

| PRD Item | FSD Requirement(s)       | Priority    |
| -------- | ------------------------ | ----------- |
| US-001   | FR-MEM-001, FR-MEM-002   | Must Have   |
| US-002   | FR-MEM-002               | Must Have   |
| US-003   | FR-MEM-003               | Must Have   |
| US-004   | FR-MEM-004               | Must Have   |
| US-005   | FR-MEM-005               | Should Have |
| US-010   | FR-SAV-003               | Must Have   |
| US-011   | FR-SAV-004               | Must Have   |
| US-012   | FR-SAV-005               | Must Have   |
| US-013   | FR-SAV-007               | Should Have |
| US-014   | FR-SAV-006               | Must Have   |
| US-020   | FR-LOAN-002              | Must Have   |
| US-021   | FR-LOAN-003              | Must Have   |
| US-022   | FR-LOAN-004              | Must Have   |
| US-023   | FR-LOAN-005, FR-LOAN-006 | Must Have   |
| US-024   | FR-LOAN-007              | Must Have   |
| US-025   | FR-LOAN-008, FR-RPT-003  | Must Have   |
| US-030   | FR-TRADE-004             | Must Have   |
| US-031   | FR-TRADE-003             | Must Have   |
| US-032   | FR-TRADE-001             | Must Have   |
| US-033   | FR-TRADE-004             | Should Have |
| US-034   | FR-TRADE-005             | Should Have |
| US-040   | FR-ACC-003               | Must Have   |
| US-041   | FR-ACC-004               | Must Have   |
| US-042   | FR-DASH-001              | Must Have   |
| US-043   | FR-ACC-002               | Must Have   |
| US-044   | FR-RPT-005               | Should Have |
| US-050   | FR-AUTH-001, FR-AUTH-003 | Must Have   |
| US-051   | FR-AUTH-003              | Must Have   |
| US-052   | FR-AUTH-002              | Must Have   |
| US-053   | Activity logging         | Must Have   |

---

## 10. Appendices

### Appendix A: Glossary

| Term     | Definition                                              |
| -------- | ------------------------------------------------------- |
| DTI      | Debt-to-Income ratio                                    |
| NPL      | Non-Performing Loan                                     |
| GL       | General Ledger                                          |
| COA      | Chart of Accounts                                       |
| POS      | Point of Sale                                           |
| SHU      | Sisa Hasil Usaha (Surplus)                              |
| SAK ETAP | Indonesian accounting standards for non-public entities |
| COGS     | Cost of Goods Sold                                      |

### Appendix B: Revision History

| Version | Date       | Author   | Changes              |
| ------- | ---------- | -------- | -------------------- |
| 1.0     | 2026-02-03 | [Author] | Initial FSD creation |

### Appendix C: Open Questions

| ID      | Question                               | Status |
| ------- | -------------------------------------- | ------ |
| FSD-001 | Confirm interest calculation frequency | Open   |
| FSD-002 | Define loan approval amount thresholds | Open   |
| FSD-003 | Confirm member discount percentage     | Open   |
| FSD-004 | Define SHU distribution formula        | Open   |

---

_End of Functional Specification Document_
