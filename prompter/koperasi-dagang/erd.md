# Entity Relationship Diagram (ERD)

# Koperasi Dagang - Database Design

---

## Document Information

|                    |                             |
| ------------------ | --------------------------- |
| **Document Title** | Entity Relationship Diagram |
| **Version**        | 1.0                         |
| **Date**           | February 3, 2026            |
| **PRD Reference**  | [prd.md](./prd.md)          |
| **Database**       | MySQL 8.0+                  |
| **Author**         | [TBD]                       |

---

## 1. Entity Catalog

| Entity Name            | Description                    | Type        | Primary Key                      |
| ---------------------- | ------------------------------ | ----------- | -------------------------------- |
| `users`                | System users (staff, admin)    | Strong      | id                               |
| `roles`                | User roles for access control  | Strong      | id                               |
| `permissions`          | Individual permissions         | Strong      | id                               |
| `role_has_permissions` | Role-permission mapping        | Associative | role_id, permission_id           |
| `model_has_roles`      | User-role mapping              | Associative | model_id, role_id                |
| `members`              | Cooperative members            | Strong      | id                               |
| `member_types`         | Classification of members      | Strong      | id                               |
| `member_documents`     | Documents uploaded for members | Weak        | id (depends on members)          |
| `member_families`      | Family/beneficiary data        | Weak        | id (depends on members)          |
| `savings_products`     | Savings product configuration  | Strong      | id                               |
| `savings_accounts`     | Member savings accounts        | Strong      | id                               |
| `savings_transactions` | Deposits and withdrawals       | Weak        | id (depends on savings_accounts) |
| `loan_products`        | Loan product configuration     | Strong      | id                               |
| `loans`                | Loan applications and records  | Strong      | id                               |
| `loan_schedules`       | Repayment schedule per loan    | Weak        | id (depends on loans)            |
| `loan_payments`        | Actual payments received       | Weak        | id (depends on loans)            |
| `loan_collaterals`     | Collateral documentation       | Weak        | id (depends on loans)            |
| `loan_approvals`       | Approval workflow records      | Weak        | id (depends on loans)            |
| `categories`           | Product categories             | Strong      | id                               |
| `products`             | Inventory products             | Strong      | id                               |
| `suppliers`            | Product suppliers              | Strong      | id                               |
| `purchase_orders`      | Purchase orders to suppliers   | Strong      | id                               |
| `purchase_order_items` | Line items in PO               | Weak        | id (depends on purchase_orders)  |
| `goods_receipts`       | Goods received against PO      | Strong      | id                               |
| `goods_receipt_items`  | Line items in receipt          | Weak        | id (depends on goods_receipts)   |
| `sales`                | Sales transactions             | Strong      | id                               |
| `sale_items`           | Line items in sales            | Weak        | id (depends on sales)            |
| `stock_movements`      | Inventory movement log         | Strong      | id                               |
| `chart_of_accounts`    | Account structure              | Strong      | id                               |
| `journal_entries`      | Journal entry headers          | Strong      | id                               |
| `journal_details`      | Journal entry lines            | Weak        | id (depends on journal_entries)  |
| `fiscal_periods`       | Fiscal year/period management  | Strong      | id                               |
| `branches`             | Cooperative branches           | Strong      | id                               |
| `settings`             | System configuration           | Strong      | id                               |
| `activity_logs`        | Audit trail                    | Strong      | id                               |
| `notifications`        | System notifications           | Strong      | id                               |

---

## 2. Entity Details

### 2.1 User Management

#### `users`

**Description:** System users who can log in and perform actions
**Type:** Strong Entity

| Attribute         | Data Type       | Constraints            | Description                  |
| ----------------- | --------------- | ---------------------- | ---------------------------- |
| id                | BIGINT UNSIGNED | PK, AUTO_INCREMENT     | Unique identifier            |
| name              | VARCHAR(255)    | NOT NULL               | Full name                    |
| email             | VARCHAR(255)    | NOT NULL, UNIQUE       | Email address (login)        |
| email_verified_at | TIMESTAMP       | NULLABLE               | Email verification timestamp |
| password          | VARCHAR(255)    | NOT NULL               | Hashed password              |
| branch_id         | BIGINT UNSIGNED | FK, NULLABLE           | Associated branch            |
| is_active         | BOOLEAN         | NOT NULL, DEFAULT TRUE | Account status               |
| last_login_at     | TIMESTAMP       | NULLABLE               | Last login timestamp         |
| remember_token    | VARCHAR(100)    | NULLABLE               | Remember me token            |
| created_at        | TIMESTAMP       | NOT NULL               | Record creation              |
| updated_at        | TIMESTAMP       | NOT NULL               | Last update                  |
| deleted_at        | TIMESTAMP       | NULLABLE               | Soft delete                  |

**Business Rules:**

- Email must be unique across all users
- Password must be hashed using bcrypt
- Soft delete preserves audit trail

---

#### `roles`

**Description:** Roles for role-based access control (using Spatie)
**Type:** Strong Entity

| Attribute  | Data Type       | Constraints        | Description          |
| ---------- | --------------- | ------------------ | -------------------- |
| id         | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier    |
| name       | VARCHAR(255)    | NOT NULL, UNIQUE   | Role name            |
| guard_name | VARCHAR(255)    | NOT NULL           | Guard name (web/api) |
| created_at | TIMESTAMP       | NOT NULL           | Record creation      |
| updated_at | TIMESTAMP       | NOT NULL           | Last update          |

**Business Rules:**

- Standard roles: super-admin, manager, teller, loan-officer, accountant, warehouse, member-services, auditor

---

#### `permissions`

**Description:** Individual permissions assignable to roles
**Type:** Strong Entity

| Attribute  | Data Type       | Constraints        | Description       |
| ---------- | --------------- | ------------------ | ----------------- |
| id         | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| name       | VARCHAR(255)    | NOT NULL, UNIQUE   | Permission name   |
| guard_name | VARCHAR(255)    | NOT NULL           | Guard name        |
| created_at | TIMESTAMP       | NOT NULL           | Record creation   |
| updated_at | TIMESTAMP       | NOT NULL           | Last update       |

---

### 2.2 Member Management

#### `member_types`

**Description:** Classification of cooperative members
**Type:** Strong Entity

| Attribute             | Data Type       | Constraints            | Description                         |
| --------------------- | --------------- | ---------------------- | ----------------------------------- |
| id                    | BIGINT UNSIGNED | PK, AUTO_INCREMENT     | Unique identifier                   |
| name                  | VARCHAR(100)    | NOT NULL               | Type name (e.g., Regular, Honorary) |
| description           | TEXT            | NULLABLE               | Type description                    |
| simpanan_pokok_amount | DECIMAL(15,2)   | NOT NULL               | Required principal savings          |
| simpanan_wajib_amount | DECIMAL(15,2)   | NOT NULL               | Monthly mandatory amount            |
| is_active             | BOOLEAN         | NOT NULL, DEFAULT TRUE | Type status                         |
| created_at            | TIMESTAMP       | NOT NULL               | Record creation                     |
| updated_at            | TIMESTAMP       | NOT NULL               | Last update                         |

---

#### `members`

**Description:** Cooperative members
**Type:** Strong Entity

| Attribute      | Data Type                                                 | Constraints                 | Description                    |
| -------------- | --------------------------------------------------------- | --------------------------- | ------------------------------ |
| id             | BIGINT UNSIGNED                                           | PK, AUTO_INCREMENT          | Unique identifier              |
| member_number  | VARCHAR(20)                                               | NOT NULL, UNIQUE            | Member number (MBR-YYYY-NNNNN) |
| member_type_id | BIGINT UNSIGNED                                           | FK, NOT NULL                | Member type                    |
| branch_id      | BIGINT UNSIGNED                                           | FK, NULLABLE                | Home branch                    |
| nik            | VARCHAR(16)                                               | NOT NULL, UNIQUE            | National ID number             |
| name           | VARCHAR(255)                                              | NOT NULL                    | Full name                      |
| birth_place    | VARCHAR(100)                                              | NULLABLE                    | Place of birth                 |
| birth_date     | DATE                                                      | NULLABLE                    | Date of birth                  |
| gender         | ENUM('M','F')                                             | NOT NULL                    | Gender                         |
| religion       | VARCHAR(50)                                               | NULLABLE                    | Religion                       |
| marital_status | ENUM('single','married','divorced','widowed')             | NULLABLE                    | Marital status                 |
| occupation     | VARCHAR(100)                                              | NULLABLE                    | Job/occupation                 |
| monthly_income | DECIMAL(15,2)                                             | NULLABLE                    | Monthly income                 |
| address        | TEXT                                                      | NOT NULL                    | Full address                   |
| rt             | VARCHAR(5)                                                | NULLABLE                    | RT number                      |
| rw             | VARCHAR(5)                                                | NULLABLE                    | RW number                      |
| village        | VARCHAR(100)                                              | NULLABLE                    | Village/Kelurahan              |
| district       | VARCHAR(100)                                              | NULLABLE                    | District/Kecamatan             |
| city           | VARCHAR(100)                                              | NULLABLE                    | City/Kabupaten                 |
| province       | VARCHAR(100)                                              | NULLABLE                    | Province                       |
| postal_code    | VARCHAR(10)                                               | NULLABLE                    | Postal code                    |
| phone          | VARCHAR(20)                                               | NULLABLE                    | Phone number                   |
| mobile         | VARCHAR(20)                                               | NULLABLE                    | Mobile number                  |
| email          | VARCHAR(255)                                              | NULLABLE                    | Email address                  |
| photo          | VARCHAR(255)                                              | NULLABLE                    | Photo file path                |
| status         | ENUM('pending','active','inactive','resigned','deceased') | NOT NULL, DEFAULT 'pending' | Member status                  |
| join_date      | DATE                                                      | NOT NULL                    | Membership start date          |
| resign_date    | DATE                                                      | NULLABLE                    | Resignation date               |
| resign_reason  | TEXT                                                      | NULLABLE                    | Reason for resignation         |
| notes          | TEXT                                                      | NULLABLE                    | Additional notes               |
| registered_by  | BIGINT UNSIGNED                                           | FK                          | User who registered            |
| approved_by    | BIGINT UNSIGNED                                           | FK, NULLABLE                | User who approved              |
| approved_at    | TIMESTAMP                                                 | NULLABLE                    | Approval timestamp             |
| created_at     | TIMESTAMP                                                 | NOT NULL                    | Record creation                |
| updated_at     | TIMESTAMP                                                 | NOT NULL                    | Last update                    |
| deleted_at     | TIMESTAMP                                                 | NULLABLE                    | Soft delete                    |

**Business Rules:**

- NIK must be exactly 16 digits and unique
- Member number auto-generated in format MBR-YYYY-NNNNN
- Status must follow lifecycle: pending → active → inactive/resigned/deceased
- Cannot resign with outstanding loan balance

---

#### `member_documents`

**Description:** Documents uploaded for member verification
**Type:** Weak Entity (depends on members)

| Attribute     | Data Type                        | Constraints        | Description        |
| ------------- | -------------------------------- | ------------------ | ------------------ |
| id            | BIGINT UNSIGNED                  | PK, AUTO_INCREMENT | Unique identifier  |
| member_id     | BIGINT UNSIGNED                  | FK, NOT NULL       | Parent member      |
| document_type | ENUM('ktp','kk','photo','other') | NOT NULL           | Document type      |
| file_name     | VARCHAR(255)                     | NOT NULL           | Original filename  |
| file_path     | VARCHAR(255)                     | NOT NULL           | Storage path       |
| file_size     | INT                              | NOT NULL           | File size in bytes |
| mime_type     | VARCHAR(100)                     | NOT NULL           | MIME type          |
| notes         | TEXT                             | NULLABLE           | Document notes     |
| uploaded_by   | BIGINT UNSIGNED                  | FK                 | User who uploaded  |
| created_at    | TIMESTAMP                        | NOT NULL           | Record creation    |
| updated_at    | TIMESTAMP                        | NOT NULL           | Last update        |

---

#### `member_families`

**Description:** Family members / beneficiaries
**Type:** Weak Entity (depends on members)

| Attribute            | Data Type                                         | Constraints             | Description            |
| -------------------- | ------------------------------------------------- | ----------------------- | ---------------------- |
| id                   | BIGINT UNSIGNED                                   | PK, AUTO_INCREMENT      | Unique identifier      |
| member_id            | BIGINT UNSIGNED                                   | FK, NOT NULL            | Parent member          |
| name                 | VARCHAR(255)                                      | NOT NULL                | Family member name     |
| relationship         | ENUM('spouse','child','parent','sibling','other') | NOT NULL                | Relationship           |
| birth_date           | DATE                                              | NULLABLE                | Date of birth          |
| phone                | VARCHAR(20)                                       | NULLABLE                | Contact phone          |
| is_beneficiary       | BOOLEAN                                           | NOT NULL, DEFAULT FALSE | Designated beneficiary |
| is_emergency_contact | BOOLEAN                                           | NOT NULL, DEFAULT FALSE | Emergency contact      |
| created_at           | TIMESTAMP                                         | NOT NULL                | Record creation        |
| updated_at           | TIMESTAMP                                         | NOT NULL                | Last update            |

---

### 2.3 Savings Management

#### `savings_products`

**Description:** Savings product configuration
**Type:** Strong Entity

| Attribute            | Data Type                                   | Constraints             | Description            |
| -------------------- | ------------------------------------------- | ----------------------- | ---------------------- |
| id                   | BIGINT UNSIGNED                             | PK, AUTO_INCREMENT      | Unique identifier      |
| code                 | VARCHAR(20)                                 | NOT NULL, UNIQUE        | Product code           |
| name                 | VARCHAR(100)                                | NOT NULL                | Product name           |
| type                 | ENUM('pokok','wajib','sukarela','deposito') | NOT NULL                | Savings type           |
| description          | TEXT                                        | NULLABLE                | Product description    |
| interest_rate        | DECIMAL(5,2)                                | NOT NULL, DEFAULT 0     | Annual interest rate % |
| interest_calculation | ENUM('daily','monthly','annually')          | NOT NULL                | Calculation method     |
| min_balance          | DECIMAL(15,2)                               | NOT NULL, DEFAULT 0     | Minimum balance        |
| min_deposit          | DECIMAL(15,2)                               | NOT NULL, DEFAULT 0     | Minimum deposit        |
| min_withdrawal       | DECIMAL(15,2)                               | NOT NULL, DEFAULT 0     | Minimum withdrawal     |
| max_withdrawal_daily | DECIMAL(15,2)                               | NULLABLE                | Daily withdrawal limit |
| allow_interest       | BOOLEAN                                     | NOT NULL, DEFAULT TRUE  | Earns interest         |
| is_mandatory         | BOOLEAN                                     | NOT NULL, DEFAULT FALSE | Required for members   |
| is_active            | BOOLEAN                                     | NOT NULL, DEFAULT TRUE  | Product status         |
| gl_account_id        | BIGINT UNSIGNED                             | FK                      | GL account mapping     |
| created_at           | TIMESTAMP                                   | NOT NULL                | Record creation        |
| updated_at           | TIMESTAMP                                   | NOT NULL                | Last update            |

**Business Rules:**

- Simpanan Pokok: One-time, no interest, non-withdrawable until resignation
- Simpanan Wajib: Monthly mandatory, low/no interest
- Simpanan Sukarela: Flexible, earns interest
- Each type has different GL account mapping

---

#### `savings_accounts`

**Description:** Individual member savings accounts
**Type:** Strong Entity

| Attribute          | Data Type                         | Constraints                | Description               |
| ------------------ | --------------------------------- | -------------------------- | ------------------------- |
| id                 | BIGINT UNSIGNED                   | PK, AUTO_INCREMENT         | Unique identifier         |
| account_number     | VARCHAR(20)                       | NOT NULL, UNIQUE           | Account number            |
| member_id          | BIGINT UNSIGNED                   | FK, NOT NULL               | Account owner             |
| savings_product_id | BIGINT UNSIGNED                   | FK, NOT NULL               | Product type              |
| balance            | DECIMAL(15,2)                     | NOT NULL, DEFAULT 0        | Current balance           |
| last_interest_date | DATE                              | NULLABLE                   | Last interest calculation |
| status             | ENUM('active','dormant','closed') | NOT NULL, DEFAULT 'active' | Account status            |
| opened_at          | DATE                              | NOT NULL                   | Account opening date      |
| closed_at          | DATE                              | NULLABLE                   | Account closing date      |
| closed_reason      | TEXT                              | NULLABLE                   | Reason for closing        |
| created_at         | TIMESTAMP                         | NOT NULL                   | Record creation           |
| updated_at         | TIMESTAMP                         | NOT NULL                   | Last update               |

**Business Rules:**

- One account per savings product type per member
- Balance cannot be negative
- Cannot close account with non-zero balance (except settlement)

---

#### `savings_transactions`

**Description:** Deposit and withdrawal transactions
**Type:** Weak Entity (depends on savings_accounts)

| Attribute          | Data Type                                                                         | Constraints        | Description                |
| ------------------ | --------------------------------------------------------------------------------- | ------------------ | -------------------------- |
| id                 | BIGINT UNSIGNED                                                                   | PK, AUTO_INCREMENT | Unique identifier          |
| transaction_number | VARCHAR(30)                                                                       | NOT NULL, UNIQUE   | Transaction reference      |
| savings_account_id | BIGINT UNSIGNED                                                                   | FK, NOT NULL       | Account                    |
| type               | ENUM('deposit','withdrawal','interest','transfer_in','transfer_out','correction') | NOT NULL           | Transaction type           |
| amount             | DECIMAL(15,2)                                                                     | NOT NULL           | Transaction amount         |
| balance_before     | DECIMAL(15,2)                                                                     | NOT NULL           | Balance before transaction |
| balance_after      | DECIMAL(15,2)                                                                     | NOT NULL           | Balance after transaction  |
| description        | VARCHAR(255)                                                                      | NULLABLE           | Transaction description    |
| reference_type     | VARCHAR(100)                                                                      | NULLABLE           | Related entity type        |
| reference_id       | BIGINT UNSIGNED                                                                   | NULLABLE           | Related entity ID          |
| journal_entry_id   | BIGINT UNSIGNED                                                                   | FK, NULLABLE       | Posted journal entry       |
| processed_by       | BIGINT UNSIGNED                                                                   | FK, NOT NULL       | User who processed         |
| processed_at       | TIMESTAMP                                                                         | NOT NULL           | Processing timestamp       |
| created_at         | TIMESTAMP                                                                         | NOT NULL           | Record creation            |
| updated_at         | TIMESTAMP                                                                         | NOT NULL           | Last update                |

**Business Rules:**

- Withdrawal cannot exceed available balance
- All transactions must post to General Ledger
- Transaction number format: SAV-YYYYMMDD-NNNNN

---

### 2.4 Loan Management

#### `loan_products`

**Description:** Loan product configuration
**Type:** Strong Entity

| Attribute               | Data Type                                    | Constraints             | Description                 |
| ----------------------- | -------------------------------------------- | ----------------------- | --------------------------- |
| id                      | BIGINT UNSIGNED                              | PK, AUTO_INCREMENT      | Unique identifier           |
| code                    | VARCHAR(20)                                  | NOT NULL, UNIQUE        | Product code                |
| name                    | VARCHAR(100)                                 | NOT NULL                | Product name                |
| type                    | ENUM('productive','consumptive','emergency') | NOT NULL                | Loan type                   |
| description             | TEXT                                         | NULLABLE                | Product description         |
| interest_rate           | DECIMAL(5,2)                                 | NOT NULL                | Annual interest rate %      |
| interest_type           | ENUM('flat','declining','effective')         | NOT NULL                | Interest calculation method |
| min_amount              | DECIMAL(15,2)                                | NOT NULL                | Minimum loan amount         |
| max_amount              | DECIMAL(15,2)                                | NOT NULL                | Maximum loan amount         |
| min_term_months         | INT                                          | NOT NULL                | Minimum term in months      |
| max_term_months         | INT                                          | NOT NULL                | Maximum term in months      |
| admin_fee_percent       | DECIMAL(5,2)                                 | NOT NULL, DEFAULT 0     | Admin fee percentage        |
| insurance_fee_percent   | DECIMAL(5,2)                                 | NOT NULL, DEFAULT 0     | Insurance fee percentage    |
| penalty_rate            | DECIMAL(5,2)                                 | NOT NULL, DEFAULT 0     | Late penalty rate %         |
| grace_period_days       | INT                                          | NOT NULL, DEFAULT 0     | Grace period for payment    |
| requires_collateral     | BOOLEAN                                      | NOT NULL, DEFAULT FALSE | Collateral required         |
| collateral_min_percent  | DECIMAL(5,2)                                 | NULLABLE                | Minimum collateral value %  |
| is_active               | BOOLEAN                                      | NOT NULL, DEFAULT TRUE  | Product status              |
| gl_principal_account_id | BIGINT UNSIGNED                              | FK                      | GL for principal            |
| gl_interest_account_id  | BIGINT UNSIGNED                              | FK                      | GL for interest income      |
| created_at              | TIMESTAMP                                    | NOT NULL                | Record creation             |
| updated_at              | TIMESTAMP                                    | NOT NULL                | Last update                 |

---

#### `loans`

**Description:** Loan applications and active loans
**Type:** Strong Entity

| Attribute               | Data Type                                                                                                         | Constraints               | Description               |
| ----------------------- | ----------------------------------------------------------------------------------------------------------------- | ------------------------- | ------------------------- |
| id                      | BIGINT UNSIGNED                                                                                                   | PK, AUTO_INCREMENT        | Unique identifier         |
| loan_number             | VARCHAR(20)                                                                                                       | NOT NULL, UNIQUE          | Loan reference number     |
| member_id               | BIGINT UNSIGNED                                                                                                   | FK, NOT NULL              | Borrower                  |
| loan_product_id         | BIGINT UNSIGNED                                                                                                   | FK, NOT NULL              | Loan product              |
| application_date        | DATE                                                                                                              | NOT NULL                  | Application date          |
| purpose                 | TEXT                                                                                                              | NOT NULL                  | Loan purpose              |
| principal_amount        | DECIMAL(15,2)                                                                                                     | NOT NULL                  | Requested/approved amount |
| interest_rate           | DECIMAL(5,2)                                                                                                      | NOT NULL                  | Applied interest rate     |
| term_months             | INT                                                                                                               | NOT NULL                  | Loan term in months       |
| installment_amount      | DECIMAL(15,2)                                                                                                     | NOT NULL                  | Monthly installment       |
| total_interest          | DECIMAL(15,2)                                                                                                     | NOT NULL                  | Total interest            |
| total_amount            | DECIMAL(15,2)                                                                                                     | NOT NULL                  | Principal + interest      |
| admin_fee               | DECIMAL(15,2)                                                                                                     | NOT NULL, DEFAULT 0       | Admin fee charged         |
| insurance_fee           | DECIMAL(15,2)                                                                                                     | NOT NULL, DEFAULT 0       | Insurance fee             |
| disbursed_amount        | DECIMAL(15,2)                                                                                                     | NULLABLE                  | Net disbursement          |
| outstanding_principal   | DECIMAL(15,2)                                                                                                     | NOT NULL, DEFAULT 0       | Current outstanding       |
| outstanding_interest    | DECIMAL(15,2)                                                                                                     | NOT NULL, DEFAULT 0       | Unpaid interest           |
| paid_principal          | DECIMAL(15,2)                                                                                                     | NOT NULL, DEFAULT 0       | Total principal paid      |
| paid_interest           | DECIMAL(15,2)                                                                                                     | NOT NULL, DEFAULT 0       | Total interest paid       |
| penalty_amount          | DECIMAL(15,2)                                                                                                     | NOT NULL, DEFAULT 0       | Accumulated penalties     |
| status                  | ENUM('draft','pending','analyzing','committee','approved','rejected','disbursed','active','closed','written_off') | NOT NULL, DEFAULT 'draft' | Loan status               |
| collectibility          | ENUM('current','special_mention','substandard','doubtful','loss')                                                 | NULLABLE                  | Loan classification       |
| days_overdue            | INT                                                                                                               | NOT NULL, DEFAULT 0       | Days past due             |
| disbursement_method     | ENUM('savings','cash')                                                                                            | NULLABLE                  | Disbursement method       |
| disbursement_account_id | BIGINT UNSIGNED                                                                                                   | FK, NULLABLE              | Target savings account    |
| disbursed_at            | TIMESTAMP                                                                                                         | NULLABLE                  | Disbursement timestamp    |
| first_due_date          | DATE                                                                                                              | NULLABLE                  | First payment due         |
| last_payment_date       | DATE                                                                                                              | NULLABLE                  | Last payment received     |
| maturity_date           | DATE                                                                                                              | NULLABLE                  | Final due date            |
| closed_at               | TIMESTAMP                                                                                                         | NULLABLE                  | Closure timestamp         |
| applied_by              | BIGINT UNSIGNED                                                                                                   | FK                        | User who created          |
| analyzed_by             | BIGINT UNSIGNED                                                                                                   | FK, NULLABLE              | Loan officer              |
| disbursed_by            | BIGINT UNSIGNED                                                                                                   | FK, NULLABLE              | User who disbursed        |
| notes                   | TEXT                                                                                                              | NULLABLE                  | Internal notes            |
| created_at              | TIMESTAMP                                                                                                         | NOT NULL                  | Record creation           |
| updated_at              | TIMESTAMP                                                                                                         | NOT NULL                  | Last update               |

**Business Rules:**

- Member must be active to apply
- Member must have paid Simpanan Pokok
- Maximum outstanding loans based on member type and history
- Collectibility based on days overdue: current (0), special mention (1-30), substandard (31-60), doubtful (61-90), loss (90+)

---

#### `loan_schedules`

**Description:** Repayment schedule for each loan
**Type:** Weak Entity (depends on loans)

| Attribute          | Data Type                                         | Constraints                  | Description               |
| ------------------ | ------------------------------------------------- | ---------------------------- | ------------------------- |
| id                 | BIGINT UNSIGNED                                   | PK, AUTO_INCREMENT           | Unique identifier         |
| loan_id            | BIGINT UNSIGNED                                   | FK, NOT NULL                 | Parent loan               |
| installment_number | INT                                               | NOT NULL                     | Installment sequence      |
| due_date           | DATE                                              | NOT NULL                     | Payment due date          |
| principal_due      | DECIMAL(15,2)                                     | NOT NULL                     | Principal portion         |
| interest_due       | DECIMAL(15,2)                                     | NOT NULL                     | Interest portion          |
| total_due          | DECIMAL(15,2)                                     | NOT NULL                     | Total installment         |
| principal_paid     | DECIMAL(15,2)                                     | NOT NULL, DEFAULT 0          | Principal paid            |
| interest_paid      | DECIMAL(15,2)                                     | NOT NULL, DEFAULT 0          | Interest paid             |
| penalty_paid       | DECIMAL(15,2)                                     | NOT NULL, DEFAULT 0          | Penalty paid              |
| total_paid         | DECIMAL(15,2)                                     | NOT NULL, DEFAULT 0          | Total paid                |
| balance_after      | DECIMAL(15,2)                                     | NOT NULL                     | Outstanding after payment |
| status             | ENUM('upcoming','due','partial','paid','overdue') | NOT NULL, DEFAULT 'upcoming' | Schedule status           |
| paid_at            | TIMESTAMP                                         | NULLABLE                     | Payment timestamp         |
| created_at         | TIMESTAMP                                         | NOT NULL                     | Record creation           |
| updated_at         | TIMESTAMP                                         | NOT NULL                     | Last update               |

---

#### `loan_payments`

**Description:** Actual payments received for loans
**Type:** Weak Entity (depends on loans)

| Attribute          | Data Type                                | Constraints         | Description              |
| ------------------ | ---------------------------------------- | ------------------- | ------------------------ |
| id                 | BIGINT UNSIGNED                          | PK, AUTO_INCREMENT  | Unique identifier        |
| payment_number     | VARCHAR(30)                              | NOT NULL, UNIQUE    | Payment reference        |
| loan_id            | BIGINT UNSIGNED                          | FK, NOT NULL        | Parent loan              |
| loan_schedule_id   | BIGINT UNSIGNED                          | FK, NULLABLE        | Schedule applied to      |
| payment_date       | DATE                                     | NOT NULL            | Payment date             |
| amount             | DECIMAL(15,2)                            | NOT NULL            | Total payment            |
| principal_amount   | DECIMAL(15,2)                            | NOT NULL            | Allocated to principal   |
| interest_amount    | DECIMAL(15,2)                            | NOT NULL            | Allocated to interest    |
| penalty_amount     | DECIMAL(15,2)                            | NOT NULL, DEFAULT 0 | Penalty portion          |
| payment_method     | ENUM('cash','savings_deduct','transfer') | NOT NULL            | Payment method           |
| savings_account_id | BIGINT UNSIGNED                          | FK, NULLABLE        | If deducted from savings |
| journal_entry_id   | BIGINT UNSIGNED                          | FK, NULLABLE        | Posted journal           |
| notes              | TEXT                                     | NULLABLE            | Payment notes            |
| processed_by       | BIGINT UNSIGNED                          | FK, NOT NULL        | User who processed       |
| created_at         | TIMESTAMP                                | NOT NULL            | Record creation          |
| updated_at         | TIMESTAMP                                | NOT NULL            | Last update              |

---

#### `loan_collaterals`

**Description:** Collateral for secured loans
**Type:** Weak Entity (depends on loans)

| Attribute       | Data Type                                                | Constraints                 | Description            |
| --------------- | -------------------------------------------------------- | --------------------------- | ---------------------- |
| id              | BIGINT UNSIGNED                                          | PK, AUTO_INCREMENT          | Unique identifier      |
| loan_id         | BIGINT UNSIGNED                                          | FK, NOT NULL                | Parent loan            |
| type            | ENUM('property','vehicle','savings','inventory','other') | NOT NULL                    | Collateral type        |
| description     | TEXT                                                     | NOT NULL                    | Collateral description |
| estimated_value | DECIMAL(15,2)                                            | NOT NULL                    | Estimated value        |
| document_number | VARCHAR(100)                                             | NULLABLE                    | Document reference     |
| document_date   | DATE                                                     | NULLABLE                    | Document date          |
| document_path   | VARCHAR(255)                                             | NULLABLE                    | Uploaded document      |
| status          | ENUM('pledged','released','foreclosed')                  | NOT NULL, DEFAULT 'pledged' | Collateral status      |
| notes           | TEXT                                                     | NULLABLE                    | Additional notes       |
| created_at      | TIMESTAMP                                                | NOT NULL                    | Record creation        |
| updated_at      | TIMESTAMP                                                | NOT NULL                    | Last update            |

---

#### `loan_approvals`

**Description:** Approval workflow for loans
**Type:** Weak Entity (depends on loans)

| Attribute      | Data Type                             | Constraints                 | Description        |
| -------------- | ------------------------------------- | --------------------------- | ------------------ |
| id             | BIGINT UNSIGNED                       | PK, AUTO_INCREMENT          | Unique identifier  |
| loan_id        | BIGINT UNSIGNED                       | FK, NOT NULL                | Parent loan        |
| approval_level | INT                                   | NOT NULL                    | Approval sequence  |
| approver_role  | VARCHAR(50)                           | NOT NULL                    | Required role      |
| approver_id    | BIGINT UNSIGNED                       | FK, NULLABLE                | User who approved  |
| status         | ENUM('pending','approved','rejected') | NOT NULL, DEFAULT 'pending' | Approval status    |
| decision_date  | TIMESTAMP                             | NULLABLE                    | Decision timestamp |
| comments       | TEXT                                  | NULLABLE                    | Approval comments  |
| created_at     | TIMESTAMP                             | NOT NULL                    | Record creation    |
| updated_at     | TIMESTAMP                             | NOT NULL                    | Last update        |

---

### 2.5 Trading / Inventory

#### `categories`

**Description:** Product categories
**Type:** Strong Entity

| Attribute   | Data Type       | Constraints            | Description          |
| ----------- | --------------- | ---------------------- | -------------------- |
| id          | BIGINT UNSIGNED | PK, AUTO_INCREMENT     | Unique identifier    |
| parent_id   | BIGINT UNSIGNED | FK, NULLABLE           | Parent category      |
| name        | VARCHAR(100)    | NOT NULL               | Category name        |
| slug        | VARCHAR(100)    | NOT NULL, UNIQUE       | URL-friendly name    |
| description | TEXT            | NULLABLE               | Category description |
| is_active   | BOOLEAN         | NOT NULL, DEFAULT TRUE | Category status      |
| sort_order  | INT             | NOT NULL, DEFAULT 0    | Display order        |
| created_at  | TIMESTAMP       | NOT NULL               | Record creation      |
| updated_at  | TIMESTAMP       | NOT NULL               | Last update          |

---

#### `suppliers`

**Description:** Product suppliers/vendors
**Type:** Strong Entity

| Attribute      | Data Type       | Constraints            | Description          |
| -------------- | --------------- | ---------------------- | -------------------- |
| id             | BIGINT UNSIGNED | PK, AUTO_INCREMENT     | Unique identifier    |
| code           | VARCHAR(20)     | NOT NULL, UNIQUE       | Supplier code        |
| name           | VARCHAR(255)    | NOT NULL               | Company name         |
| contact_person | VARCHAR(100)    | NULLABLE               | Contact person       |
| phone          | VARCHAR(20)     | NULLABLE               | Phone number         |
| email          | VARCHAR(255)    | NULLABLE               | Email address        |
| address        | TEXT            | NULLABLE               | Full address         |
| city           | VARCHAR(100)    | NULLABLE               | City                 |
| payment_terms  | INT             | NOT NULL, DEFAULT 0    | Payment terms (days) |
| is_active      | BOOLEAN         | NOT NULL, DEFAULT TRUE | Supplier status      |
| notes          | TEXT            | NULLABLE               | Additional notes     |
| created_at     | TIMESTAMP       | NOT NULL               | Record creation      |
| updated_at     | TIMESTAMP       | NOT NULL               | Last update          |
| deleted_at     | TIMESTAMP       | NULLABLE               | Soft delete          |

---

#### `products`

**Description:** Inventory products for trading
**Type:** Strong Entity

| Attribute               | Data Type       | Constraints             | Description            |
| ----------------------- | --------------- | ----------------------- | ---------------------- |
| id                      | BIGINT UNSIGNED | PK, AUTO_INCREMENT      | Unique identifier      |
| sku                     | VARCHAR(50)     | NOT NULL, UNIQUE        | Stock Keeping Unit     |
| barcode                 | VARCHAR(50)     | NULLABLE, UNIQUE        | Barcode                |
| name                    | VARCHAR(255)    | NOT NULL                | Product name           |
| description             | TEXT            | NULLABLE                | Product description    |
| category_id             | BIGINT UNSIGNED | FK, NOT NULL            | Product category       |
| supplier_id             | BIGINT UNSIGNED | FK, NULLABLE            | Primary supplier       |
| unit                    | VARCHAR(20)     | NOT NULL                | Unit of measure        |
| cost_price              | DECIMAL(15,2)   | NOT NULL                | Purchase cost          |
| selling_price           | DECIMAL(15,2)   | NOT NULL                | Standard selling price |
| member_price            | DECIMAL(15,2)   | NULLABLE                | Member discount price  |
| stock_quantity          | DECIMAL(15,2)   | NOT NULL, DEFAULT 0     | Current stock          |
| min_stock               | DECIMAL(15,2)   | NOT NULL, DEFAULT 0     | Reorder point          |
| max_stock               | DECIMAL(15,2)   | NULLABLE                | Maximum stock level    |
| is_active               | BOOLEAN         | NOT NULL, DEFAULT TRUE  | Product status         |
| is_taxable              | BOOLEAN         | NOT NULL, DEFAULT FALSE | Subject to tax         |
| tax_rate                | DECIMAL(5,2)    | NOT NULL, DEFAULT 0     | Tax percentage         |
| gl_cogs_account_id      | BIGINT UNSIGNED | FK, NULLABLE            | COGS account           |
| gl_inventory_account_id | BIGINT UNSIGNED | FK, NULLABLE            | Inventory account      |
| gl_sales_account_id     | BIGINT UNSIGNED | FK, NULLABLE            | Sales revenue account  |
| image_path              | VARCHAR(255)    | NULLABLE                | Product image          |
| created_at              | TIMESTAMP       | NOT NULL                | Record creation        |
| updated_at              | TIMESTAMP       | NOT NULL                | Last update            |
| deleted_at              | TIMESTAMP       | NULLABLE                | Soft delete            |

**Business Rules:**

- Member price must be less than or equal to selling price
- Stock quantity updates via goods receipt and sales
- Low stock alert when stock_quantity <= min_stock

---

#### `purchase_orders`

**Description:** Purchase orders to suppliers
**Type:** Strong Entity

| Attribute       | Data Type                                                  | Constraints               | Description         |
| --------------- | ---------------------------------------------------------- | ------------------------- | ------------------- |
| id              | BIGINT UNSIGNED                                            | PK, AUTO_INCREMENT        | Unique identifier   |
| po_number       | VARCHAR(20)                                                | NOT NULL, UNIQUE          | PO reference number |
| supplier_id     | BIGINT UNSIGNED                                            | FK, NOT NULL              | Supplier            |
| order_date      | DATE                                                       | NOT NULL                  | Order date          |
| expected_date   | DATE                                                       | NULLABLE                  | Expected delivery   |
| subtotal        | DECIMAL(15,2)                                              | NOT NULL, DEFAULT 0       | Subtotal amount     |
| tax_amount      | DECIMAL(15,2)                                              | NOT NULL, DEFAULT 0       | Tax amount          |
| discount_amount | DECIMAL(15,2)                                              | NOT NULL, DEFAULT 0       | Discount            |
| total_amount    | DECIMAL(15,2)                                              | NOT NULL, DEFAULT 0       | Total amount        |
| status          | ENUM('draft','submitted','partial','received','cancelled') | NOT NULL, DEFAULT 'draft' | PO status           |
| notes           | TEXT                                                       | NULLABLE                  | Order notes         |
| created_by      | BIGINT UNSIGNED                                            | FK, NOT NULL              | User who created    |
| approved_by     | BIGINT UNSIGNED                                            | FK, NULLABLE              | User who approved   |
| created_at      | TIMESTAMP                                                  | NOT NULL                  | Record creation     |
| updated_at      | TIMESTAMP                                                  | NOT NULL                  | Last update         |

---

#### `purchase_order_items`

**Description:** Line items in purchase order
**Type:** Weak Entity (depends on purchase_orders)

| Attribute         | Data Type       | Constraints         | Description       |
| ----------------- | --------------- | ------------------- | ----------------- |
| id                | BIGINT UNSIGNED | PK, AUTO_INCREMENT  | Unique identifier |
| purchase_order_id | BIGINT UNSIGNED | FK, NOT NULL        | Parent PO         |
| product_id        | BIGINT UNSIGNED | FK, NOT NULL        | Product           |
| quantity          | DECIMAL(15,2)   | NOT NULL            | Ordered quantity  |
| received_quantity | DECIMAL(15,2)   | NOT NULL, DEFAULT 0 | Received so far   |
| unit_price        | DECIMAL(15,2)   | NOT NULL            | Unit price        |
| discount_percent  | DECIMAL(5,2)    | NOT NULL, DEFAULT 0 | Line discount %   |
| tax_percent       | DECIMAL(5,2)    | NOT NULL, DEFAULT 0 | Tax %             |
| total_price       | DECIMAL(15,2)   | NOT NULL            | Line total        |
| created_at        | TIMESTAMP       | NOT NULL            | Record creation   |
| updated_at        | TIMESTAMP       | NOT NULL            | Last update       |

---

#### `goods_receipts`

**Description:** Goods receipt against purchase orders
**Type:** Strong Entity

| Attribute         | Data Type                          | Constraints               | Description       |
| ----------------- | ---------------------------------- | ------------------------- | ----------------- |
| id                | BIGINT UNSIGNED                    | PK, AUTO_INCREMENT        | Unique identifier |
| receipt_number    | VARCHAR(20)                        | NOT NULL, UNIQUE          | Receipt reference |
| purchase_order_id | BIGINT UNSIGNED                    | FK, NULLABLE              | Related PO        |
| supplier_id       | BIGINT UNSIGNED                    | FK, NOT NULL              | Supplier          |
| receipt_date      | DATE                               | NOT NULL                  | Receipt date      |
| invoice_number    | VARCHAR(50)                        | NULLABLE                  | Supplier invoice  |
| invoice_date      | DATE                               | NULLABLE                  | Invoice date      |
| total_amount      | DECIMAL(15,2)                      | NOT NULL, DEFAULT 0       | Total value       |
| status            | ENUM('draft','posted','cancelled') | NOT NULL, DEFAULT 'draft' | Receipt status    |
| journal_entry_id  | BIGINT UNSIGNED                    | FK, NULLABLE              | Posted journal    |
| notes             | TEXT                               | NULLABLE                  | Receipt notes     |
| received_by       | BIGINT UNSIGNED                    | FK, NOT NULL              | User who received |
| created_at        | TIMESTAMP                          | NOT NULL                  | Record creation   |
| updated_at        | TIMESTAMP                          | NOT NULL                  | Last update       |

---

#### `goods_receipt_items`

**Description:** Line items in goods receipt
**Type:** Weak Entity (depends on goods_receipts)

| Attribute              | Data Type       | Constraints        | Description       |
| ---------------------- | --------------- | ------------------ | ----------------- |
| id                     | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| goods_receipt_id       | BIGINT UNSIGNED | FK, NOT NULL       | Parent receipt    |
| purchase_order_item_id | BIGINT UNSIGNED | FK, NULLABLE       | Related PO item   |
| product_id             | BIGINT UNSIGNED | FK, NOT NULL       | Product           |
| quantity               | DECIMAL(15,2)   | NOT NULL           | Received quantity |
| unit_price             | DECIMAL(15,2)   | NOT NULL           | Unit cost         |
| total_price            | DECIMAL(15,2)   | NOT NULL           | Line total        |
| created_at             | TIMESTAMP       | NOT NULL           | Record creation   |
| updated_at             | TIMESTAMP       | NOT NULL           | Last update       |

---

#### `sales`

**Description:** Sales/POS transactions
**Type:** Strong Entity

| Attribute          | Data Type                  | Constraints                   | Description                 |
| ------------------ | -------------------------- | ----------------------------- | --------------------------- |
| id                 | BIGINT UNSIGNED            | PK, AUTO_INCREMENT            | Unique identifier           |
| sale_number        | VARCHAR(20)                | NOT NULL, UNIQUE              | Sale reference              |
| member_id          | BIGINT UNSIGNED            | FK, NULLABLE                  | Member (if member purchase) |
| sale_date          | DATETIME                   | NOT NULL                      | Sale timestamp              |
| subtotal           | DECIMAL(15,2)              | NOT NULL                      | Subtotal before discount    |
| discount_amount    | DECIMAL(15,2)              | NOT NULL, DEFAULT 0           | Discount applied            |
| tax_amount         | DECIMAL(15,2)              | NOT NULL, DEFAULT 0           | Tax amount                  |
| total_amount       | DECIMAL(15,2)              | NOT NULL                      | Final total                 |
| payment_method     | ENUM('cash','credit')      | NOT NULL, DEFAULT 'cash'      | Payment method              |
| amount_paid        | DECIMAL(15,2)              | NOT NULL                      | Amount received             |
| change_amount      | DECIMAL(15,2)              | NOT NULL, DEFAULT 0           | Change given                |
| is_member_purchase | BOOLEAN                    | NOT NULL, DEFAULT FALSE       | Member transaction          |
| status             | ENUM('completed','voided') | NOT NULL, DEFAULT 'completed' | Sale status                 |
| journal_entry_id   | BIGINT UNSIGNED            | FK, NULLABLE                  | Posted journal              |
| notes              | TEXT                       | NULLABLE                      | Sale notes                  |
| cashier_id         | BIGINT UNSIGNED            | FK, NOT NULL                  | Cashier user                |
| created_at         | TIMESTAMP                  | NOT NULL                      | Record creation             |
| updated_at         | TIMESTAMP                  | NOT NULL                      | Last update                 |

---

#### `sale_items`

**Description:** Line items in sales
**Type:** Weak Entity (depends on sales)

| Attribute        | Data Type       | Constraints         | Description          |
| ---------------- | --------------- | ------------------- | -------------------- |
| id               | BIGINT UNSIGNED | PK, AUTO_INCREMENT  | Unique identifier    |
| sale_id          | BIGINT UNSIGNED | FK, NOT NULL        | Parent sale          |
| product_id       | BIGINT UNSIGNED | FK, NOT NULL        | Product sold         |
| quantity         | DECIMAL(15,2)   | NOT NULL            | Quantity sold        |
| unit_price       | DECIMAL(15,2)   | NOT NULL            | Selling price        |
| cost_price       | DECIMAL(15,2)   | NOT NULL            | Cost at time of sale |
| discount_percent | DECIMAL(5,2)    | NOT NULL, DEFAULT 0 | Line discount        |
| tax_percent      | DECIMAL(5,2)    | NOT NULL, DEFAULT 0 | Tax percentage       |
| total_price      | DECIMAL(15,2)   | NOT NULL            | Line total           |
| created_at       | TIMESTAMP       | NOT NULL            | Record creation      |
| updated_at       | TIMESTAMP       | NOT NULL            | Last update          |

---

#### `stock_movements`

**Description:** Inventory movement audit log
**Type:** Strong Entity

| Attribute       | Data Type                                | Constraints        | Description          |
| --------------- | ---------------------------------------- | ------------------ | -------------------- |
| id              | BIGINT UNSIGNED                          | PK, AUTO_INCREMENT | Unique identifier    |
| product_id      | BIGINT UNSIGNED                          | FK, NOT NULL       | Product              |
| movement_type   | ENUM('in','out','adjustment','transfer') | NOT NULL           | Movement type        |
| quantity        | DECIMAL(15,2)                            | NOT NULL           | Quantity moved       |
| quantity_before | DECIMAL(15,2)                            | NOT NULL           | Stock before         |
| quantity_after  | DECIMAL(15,2)                            | NOT NULL           | Stock after          |
| unit_cost       | DECIMAL(15,2)                            | NULLABLE           | Cost per unit        |
| reference_type  | VARCHAR(100)                             | NOT NULL           | Source document type |
| reference_id    | BIGINT UNSIGNED                          | NOT NULL           | Source document ID   |
| notes           | TEXT                                     | NULLABLE           | Movement notes       |
| created_by      | BIGINT UNSIGNED                          | FK, NOT NULL       | User who created     |
| created_at      | TIMESTAMP                                | NOT NULL           | Record creation      |

---

### 2.6 Accounting

#### `chart_of_accounts`

**Description:** Account structure for general ledger
**Type:** Strong Entity

| Attribute        | Data Type                                              | Constraints             | Description                   |
| ---------------- | ------------------------------------------------------ | ----------------------- | ----------------------------- |
| id               | BIGINT UNSIGNED                                        | PK, AUTO_INCREMENT      | Unique identifier             |
| parent_id        | BIGINT UNSIGNED                                        | FK, NULLABLE            | Parent account                |
| account_code     | VARCHAR(20)                                            | NOT NULL, UNIQUE        | Account code                  |
| account_name     | VARCHAR(255)                                           | NOT NULL                | Account name                  |
| account_type     | ENUM('asset','liability','equity','revenue','expense') | NOT NULL                | Account type                  |
| account_category | VARCHAR(100)                                           | NOT NULL                | Sub-category                  |
| normal_balance   | ENUM('debit','credit')                                 | NOT NULL                | Normal balance side           |
| is_header        | BOOLEAN                                                | NOT NULL, DEFAULT FALSE | Header account (non-postable) |
| is_cash_account  | BOOLEAN                                                | NOT NULL, DEFAULT FALSE | Cash/bank account             |
| is_active        | BOOLEAN                                                | NOT NULL, DEFAULT TRUE  | Account status                |
| balance          | DECIMAL(15,2)                                          | NOT NULL, DEFAULT 0     | Current balance               |
| description      | TEXT                                                   | NULLABLE                | Account description           |
| created_at       | TIMESTAMP                                              | NOT NULL                | Record creation               |
| updated_at       | TIMESTAMP                                              | NOT NULL                | Last update                   |

**Business Rules:**

- Cannot post to header accounts
- Account code format: X-XXXX (Type-Sequence)
- Assets/Expenses: Normal debit, Liabilities/Equity/Revenue: Normal credit

---

#### `fiscal_periods`

**Description:** Fiscal year and period management
**Type:** Strong Entity

| Attribute  | Data Type                      | Constraints              | Description                  |
| ---------- | ------------------------------ | ------------------------ | ---------------------------- |
| id         | BIGINT UNSIGNED                | PK, AUTO_INCREMENT       | Unique identifier            |
| year       | INT                            | NOT NULL                 | Fiscal year                  |
| period     | INT                            | NOT NULL                 | Period number (1-12 or 1-13) |
| name       | VARCHAR(50)                    | NOT NULL                 | Period name                  |
| start_date | DATE                           | NOT NULL                 | Period start                 |
| end_date   | DATE                           | NOT NULL                 | Period end                   |
| status     | ENUM('open','closed','locked') | NOT NULL, DEFAULT 'open' | Period status                |
| closed_at  | TIMESTAMP                      | NULLABLE                 | Closing timestamp            |
| closed_by  | BIGINT UNSIGNED                | FK, NULLABLE             | User who closed              |
| created_at | TIMESTAMP                      | NOT NULL                 | Record creation              |
| updated_at | TIMESTAMP                      | NOT NULL                 | Last update                  |

**Business Rules:**

- Cannot post to closed/locked periods
- Only one period can be "current" (for default posting)

---

#### `journal_entries`

**Description:** Journal entry headers
**Type:** Strong Entity

| Attribute         | Data Type                                                       | Constraints               | Description          |
| ----------------- | --------------------------------------------------------------- | ------------------------- | -------------------- |
| id                | BIGINT UNSIGNED                                                 | PK, AUTO_INCREMENT        | Unique identifier    |
| entry_number      | VARCHAR(30)                                                     | NOT NULL, UNIQUE          | Journal reference    |
| entry_date        | DATE                                                            | NOT NULL                  | Transaction date     |
| fiscal_period_id  | BIGINT UNSIGNED                                                 | FK, NOT NULL              | Posting period       |
| source            | ENUM('manual','savings','loan','sales','purchase','adjustment') | NOT NULL                  | Entry source         |
| description       | TEXT                                                            | NOT NULL                  | Entry description    |
| total_debit       | DECIMAL(15,2)                                                   | NOT NULL                  | Total debits         |
| total_credit      | DECIMAL(15,2)                                                   | NOT NULL                  | Total credits        |
| status            | ENUM('draft','posted','reversed')                               | NOT NULL, DEFAULT 'draft' | Entry status         |
| reference_type    | VARCHAR(100)                                                    | NULLABLE                  | Source document type |
| reference_id      | BIGINT UNSIGNED                                                 | NULLABLE                  | Source document ID   |
| posted_at         | TIMESTAMP                                                       | NULLABLE                  | Posting timestamp    |
| posted_by         | BIGINT UNSIGNED                                                 | FK, NULLABLE              | User who posted      |
| reversed_entry_id | BIGINT UNSIGNED                                                 | FK, NULLABLE              | Reversing entry      |
| created_by        | BIGINT UNSIGNED                                                 | FK, NOT NULL              | User who created     |
| created_at        | TIMESTAMP                                                       | NOT NULL                  | Record creation      |
| updated_at        | TIMESTAMP                                                       | NOT NULL                  | Last update          |

**Business Rules:**

- Total debits must equal total credits
- Cannot modify posted entries (must reverse and re-enter)
- Entry number format: JE-YYYYMM-NNNNN

---

#### `journal_details`

**Description:** Journal entry line items
**Type:** Weak Entity (depends on journal_entries)

| Attribute        | Data Type       | Constraints         | Description       |
| ---------------- | --------------- | ------------------- | ----------------- |
| id               | BIGINT UNSIGNED | PK, AUTO_INCREMENT  | Unique identifier |
| journal_entry_id | BIGINT UNSIGNED | FK, NOT NULL        | Parent journal    |
| account_id       | BIGINT UNSIGNED | FK, NOT NULL        | GL account        |
| description      | VARCHAR(255)    | NULLABLE            | Line description  |
| debit_amount     | DECIMAL(15,2)   | NOT NULL, DEFAULT 0 | Debit amount      |
| credit_amount    | DECIMAL(15,2)   | NOT NULL, DEFAULT 0 | Credit amount     |
| created_at       | TIMESTAMP       | NOT NULL            | Record creation   |
| updated_at       | TIMESTAMP       | NOT NULL            | Last update       |

**Business Rules:**

- Each line must have either debit OR credit, not both
- Minimum 2 lines per journal entry

---

### 2.7 System & Audit

#### `branches`

**Description:** Cooperative branches/units
**Type:** Strong Entity

| Attribute  | Data Type       | Constraints             | Description       |
| ---------- | --------------- | ----------------------- | ----------------- |
| id         | BIGINT UNSIGNED | PK, AUTO_INCREMENT      | Unique identifier |
| code       | VARCHAR(10)     | NOT NULL, UNIQUE        | Branch code       |
| name       | VARCHAR(100)    | NOT NULL                | Branch name       |
| address    | TEXT            | NULLABLE                | Branch address    |
| phone      | VARCHAR(20)     | NULLABLE                | Phone number      |
| email      | VARCHAR(255)    | NULLABLE                | Email address     |
| manager_id | BIGINT UNSIGNED | FK, NULLABLE            | Branch manager    |
| is_active  | BOOLEAN         | NOT NULL, DEFAULT TRUE  | Branch status     |
| is_main    | BOOLEAN         | NOT NULL, DEFAULT FALSE | Main/head office  |
| created_at | TIMESTAMP       | NOT NULL                | Record creation   |
| updated_at | TIMESTAMP       | NOT NULL                | Last update       |

---

#### `settings`

**Description:** System configuration settings
**Type:** Strong Entity

| Attribute   | Data Type                                           | Constraints             | Description          |
| ----------- | --------------------------------------------------- | ----------------------- | -------------------- |
| id          | BIGINT UNSIGNED                                     | PK, AUTO_INCREMENT      | Unique identifier    |
| group       | VARCHAR(50)                                         | NOT NULL                | Setting group        |
| key         | VARCHAR(100)                                        | NOT NULL                | Setting key          |
| value       | TEXT                                                | NULLABLE                | Setting value        |
| type        | ENUM('string','integer','decimal','boolean','json') | NOT NULL                | Value type           |
| description | TEXT                                                | NULLABLE                | Setting description  |
| is_public   | BOOLEAN                                             | NOT NULL, DEFAULT FALSE | Visible to all users |
| created_at  | TIMESTAMP                                           | NOT NULL                | Record creation      |
| updated_at  | TIMESTAMP                                           | NOT NULL                | Last update          |

---

#### `activity_logs`

**Description:** Audit trail (using Spatie Activity Log)
**Type:** Strong Entity

| Attribute    | Data Type       | Constraints        | Description        |
| ------------ | --------------- | ------------------ | ------------------ |
| id           | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier  |
| log_name     | VARCHAR(255)    | NULLABLE           | Log channel        |
| description  | TEXT            | NOT NULL           | Action description |
| subject_type | VARCHAR(255)    | NULLABLE           | Subject model type |
| subject_id   | BIGINT UNSIGNED | NULLABLE           | Subject model ID   |
| causer_type  | VARCHAR(255)    | NULLABLE           | Actor model type   |
| causer_id    | BIGINT UNSIGNED | NULLABLE           | Actor model ID     |
| properties   | JSON            | NULLABLE           | Additional data    |
| event        | VARCHAR(255)    | NULLABLE           | Event name         |
| batch_uuid   | CHAR(36)        | NULLABLE           | Batch identifier   |
| created_at   | TIMESTAMP       | NOT NULL           | Record creation    |
| updated_at   | TIMESTAMP       | NOT NULL           | Last update        |

---

#### `notifications`

**Description:** System notifications
**Type:** Strong Entity

| Attribute       | Data Type       | Constraints | Description        |
| --------------- | --------------- | ----------- | ------------------ |
| id              | CHAR(36)        | PK          | UUID               |
| type            | VARCHAR(255)    | NOT NULL    | Notification class |
| notifiable_type | VARCHAR(255)    | NOT NULL    | Target model type  |
| notifiable_id   | BIGINT UNSIGNED | NOT NULL    | Target model ID    |
| data            | JSON            | NOT NULL    | Notification data  |
| read_at         | TIMESTAMP       | NULLABLE    | Read timestamp     |
| created_at      | TIMESTAMP       | NOT NULL    | Record creation    |
| updated_at      | TIMESTAMP       | NOT NULL    | Last update        |

---

## 3. Relationship Specifications

| Relationship     | Entity A          | Entity B             | Cardinality | Participation | Description                |
| ---------------- | ----------------- | -------------------- | ----------- | ------------- | -------------------------- |
| belongs_to       | users             | branches             | N:1         | Partial       | User works at a branch     |
| has_roles        | users             | roles                | M:N         | Total         | Users have roles           |
| has_permissions  | roles             | permissions          | M:N         | Total         | Roles have permissions     |
| has_type         | members           | member_types         | N:1         | Total         | Member has a type          |
| belongs_to       | members           | branches             | N:1         | Partial       | Member home branch         |
| has_documents    | members           | member_documents     | 1:N         | Partial       | Member has documents       |
| has_family       | members           | member_families      | 1:N         | Partial       | Member has family          |
| has_accounts     | members           | savings_accounts     | 1:N         | Total         | Member has savings         |
| for_product      | savings_accounts  | savings_products     | N:1         | Total         | Account is a product       |
| has_transactions | savings_accounts  | savings_transactions | 1:N         | Partial       | Account has transactions   |
| has_loans        | members           | loans                | 1:N         | Partial       | Member has loans           |
| for_product      | loans             | loan_products        | N:1         | Total         | Loan is a product          |
| has_schedule     | loans             | loan_schedules       | 1:N         | Total         | Loan has schedule          |
| has_payments     | loans             | loan_payments        | 1:N         | Partial       | Loan receives payments     |
| has_collaterals  | loans             | loan_collaterals     | 1:N         | Partial       | Loan has collateral        |
| has_approvals    | loans             | loan_approvals       | 1:N         | Total         | Loan goes through approval |
| in_category      | products          | categories           | N:1         | Total         | Product in category        |
| supplied_by      | products          | suppliers            | N:1         | Partial       | Product has supplier       |
| ordered_from     | purchase_orders   | suppliers            | N:1         | Total         | PO from supplier           |
| has_items        | purchase_orders   | purchase_order_items | 1:N         | Total         | PO has items               |
| for_po           | goods_receipts    | purchase_orders      | N:1         | Partial       | Receipt for PO             |
| has_items        | goods_receipts    | goods_receipt_items  | 1:N         | Total         | Receipt has items          |
| by_member        | sales             | members              | N:1         | Partial       | Sale to member             |
| has_items        | sales             | sale_items           | 1:N         | Total         | Sale has items             |
| moves_stock      | stock_movements   | products             | N:1         | Total         | Movement affects product   |
| in_period        | journal_entries   | fiscal_periods       | N:1         | Total         | Entry in period            |
| has_lines        | journal_entries   | journal_details      | 1:N         | Total         | Entry has details          |
| to_account       | journal_details   | chart_of_accounts    | N:1         | Total         | Detail posts to account    |
| parent_account   | chart_of_accounts | chart_of_accounts    | N:1         | Partial       | Self-referencing           |
| parent_category  | categories        | categories           | N:1         | Partial       | Self-referencing           |

---

## 4. ERD Diagram (Mermaid)

```mermaid
erDiagram
    %% User Management
    users ||--o{ activity_logs : creates
    users }o--|| branches : works_at
    users }o--o{ roles : has
    roles }o--o{ permissions : has

    %% Member Management
    members ||--o{ member_documents : has
    members ||--o{ member_families : has
    members }o--|| member_types : is_type
    members }o--o| branches : belongs_to

    %% Savings
    members ||--o{ savings_accounts : owns
    savings_accounts }o--|| savings_products : is_type
    savings_accounts ||--o{ savings_transactions : has
    savings_transactions }o--o| journal_entries : posts_to

    %% Loans
    members ||--o{ loans : applies
    loans }o--|| loan_products : is_type
    loans ||--|{ loan_schedules : has
    loans ||--o{ loan_payments : receives
    loans ||--o{ loan_collaterals : secured_by
    loans ||--|{ loan_approvals : goes_through
    loan_payments }o--o| journal_entries : posts_to

    %% Trading
    categories ||--o{ products : contains
    categories }o--o| categories : parent
    suppliers ||--o{ products : supplies
    suppliers ||--o{ purchase_orders : receives
    purchase_orders ||--|{ purchase_order_items : has
    purchase_order_items }o--|| products : for
    goods_receipts }o--o| purchase_orders : for
    goods_receipts ||--|{ goods_receipt_items : has
    goods_receipt_items }o--|| products : for
    products ||--o{ stock_movements : tracks

    %% Sales
    sales }o--o| members : to
    sales ||--|{ sale_items : has
    sale_items }o--|| products : for
    sales }o--o| journal_entries : posts_to

    %% Accounting
    chart_of_accounts }o--o| chart_of_accounts : parent
    journal_entries }o--|| fiscal_periods : in
    journal_entries ||--|{ journal_details : has
    journal_details }o--|| chart_of_accounts : posts_to

    %% Entities
    users {
        bigint id PK
        string name
        string email UK
        string password
        bigint branch_id FK
        boolean is_active
        timestamp created_at
    }

    members {
        bigint id PK
        string member_number UK
        bigint member_type_id FK
        string nik UK
        string name
        date birth_date
        enum status
        date join_date
        timestamp created_at
    }

    savings_accounts {
        bigint id PK
        string account_number UK
        bigint member_id FK
        bigint savings_product_id FK
        decimal balance
        enum status
        timestamp created_at
    }

    savings_transactions {
        bigint id PK
        string transaction_number UK
        bigint savings_account_id FK
        enum type
        decimal amount
        decimal balance_after
        bigint journal_entry_id FK
        timestamp created_at
    }

    loans {
        bigint id PK
        string loan_number UK
        bigint member_id FK
        bigint loan_product_id FK
        decimal principal_amount
        decimal interest_rate
        int term_months
        enum status
        decimal outstanding_principal
        timestamp created_at
    }

    loan_schedules {
        bigint id PK
        bigint loan_id FK
        int installment_number
        date due_date
        decimal principal_due
        decimal interest_due
        enum status
    }

    products {
        bigint id PK
        string sku UK
        string name
        bigint category_id FK
        decimal cost_price
        decimal selling_price
        decimal stock_quantity
        boolean is_active
    }

    sales {
        bigint id PK
        string sale_number UK
        bigint member_id FK
        decimal total_amount
        enum payment_method
        bigint cashier_id FK
        timestamp created_at
    }

    chart_of_accounts {
        bigint id PK
        string account_code UK
        string account_name
        enum account_type
        enum normal_balance
        decimal balance
    }

    journal_entries {
        bigint id PK
        string entry_number UK
        date entry_date
        bigint fiscal_period_id FK
        decimal total_debit
        decimal total_credit
        enum status
    }
```

---

## 5. Design Decisions & Notes

### 5.1 Key Assumptions

1. **Single Currency**: System assumes Indonesian Rupiah (IDR) only
2. **Cash-Based MVP**: Only cash payments for POS in MVP (no e-payment integration)
3. **Single Cooperative**: Design supports single cooperative with multiple branches
4. **Perpetual Inventory**: Real-time stock updates (not periodic)
5. **Accrual Accounting**: Interest recognition follows accrual basis

### 5.2 Normalization Notes

- All tables are in 3NF (Third Normal Form)
- Intentional denormalization:
  - `balance_after` in transactions (for performance, avoids recalculation)
  - `outstanding_principal/interest` in loans (frequently queried, updated on payment)
  - `stock_quantity` in products (denormalized from movements for performance)

### 5.3 Indexing Recommendations

| Table                | Index               | Columns                            | Purpose            |
| -------------------- | ------------------- | ---------------------------------- | ------------------ |
| members              | idx_member_search   | (name, nik, member_number)         | Quick search       |
| members              | idx_member_status   | (status, branch_id)                | Filtering          |
| savings_transactions | idx_sav_txn_date    | (processed_at, savings_account_id) | Statement queries  |
| loans                | idx_loan_status     | (status, member_id)                | Portfolio queries  |
| loan_schedules       | idx_schedule_due    | (due_date, status)                 | Collection reports |
| sales                | idx_sales_date      | (sale_date, cashier_id)            | Daily reports      |
| journal_details      | idx_journal_account | (account_id, journal_entry_id)     | Ledger queries     |

### 5.4 Soft Delete Strategy

Tables with `deleted_at`:

- `users` - Preserve audit trail
- `members` - Regulatory requirement
- `suppliers` - Historical references
- `products` - Historical references

Tables with hard delete (via cascade):

- `member_documents` - When member deleted
- `member_families` - When member deleted
- Junction tables (role_has_permissions, etc.)

### 5.5 Questions Requiring Clarification

1. **Multi-branch inventory**: Should inventory be tracked per-branch or consolidated?
2. **Member credit limit**: Is there a credit limit for credit sales to members?
3. **Loan collateral ratio**: What is the minimum collateral value percentage?
4. **SHU calculation**: What is the formula for surplus distribution?
5. **Account code structure**: Confirm chart of accounts numbering scheme

---

## 6. Appendix

### 6.1 Standard Audit Fields

All transactional tables include:

- `created_at` - Record creation timestamp
- `updated_at` - Last modification timestamp
- `created_by` / `processed_by` - User who created/processed

### 6.2 Enum Values Reference

```sql
-- Member Status
ENUM('pending', 'active', 'inactive', 'resigned', 'deceased')

-- Savings Transaction Type
ENUM('deposit', 'withdrawal', 'interest', 'transfer_in', 'transfer_out', 'correction')

-- Loan Status
ENUM('draft', 'pending', 'analyzing', 'committee', 'approved', 'rejected', 'disbursed', 'active', 'closed', 'written_off')

-- Loan Collectibility
ENUM('current', 'special_mention', 'substandard', 'doubtful', 'loss')

-- Account Type
ENUM('asset', 'liability', 'equity', 'revenue', 'expense')

-- Journal Status
ENUM('draft', 'posted', 'reversed')
```

### 6.3 Revision History

| Version | Date       | Author   | Changes              |
| ------- | ---------- | -------- | -------------------- |
| 1.0     | 2026-02-03 | [Author] | Initial ERD creation |

---

_End of Entity Relationship Diagram Document_
