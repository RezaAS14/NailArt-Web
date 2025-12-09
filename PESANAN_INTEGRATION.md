# Pesanan (Order) Management System - Integration Guide

## Overview

The **Pesanan** (Order) management system is a complete tracking solution integrated with the checkout workflow. This system allows administrators to monitor and manage customer orders with payment status and order processing status.

## Database Structure

### Pesanan Table
```sql
CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL AUTO_INCREMENT,
  `id_checkout` int NOT NULL,
  `keterangan_pembayaran` enum('Belum Bayar','Menunggu Verifikasi','Lunas','Gagal'),
  `status_pesanan` enum('Menunggu Pembayaran','Diproses','Dikemas','Dikirim','Selesai','Dibatalkan'),
  PRIMARY KEY (`id_pesanan`),
  FOREIGN KEY (`id_checkout`) REFERENCES `checkout` (`id_checkout`)
);
```

**Fields:**
- `id_pesanan`: Unique order identifier (Auto-increment)
- `id_checkout`: Reference to checkout transaction (Foreign key)
- `keterangan_pembayaran`: Payment status (enum)
  - `Belum Bayar` (Not Paid) - Default value
  - `Menunggu Verifikasi` (Awaiting Verification)
  - `Lunas` (Paid in Full)
  - `Gagal` (Failed)
- `status_pesanan`: Order processing status (enum)
  - `Menunggu Pembayaran` (Awaiting Payment) - Default value
  - `Diproses` (Processing)
  - `Dikemas` (Packing)
  - `Dikirim` (Shipped)
  - `Selesai` (Completed)
  - `Dibatalkan` (Cancelled)

## Workflow

### 1. Order Creation (Automatic)
When a customer completes a checkout:
- A checkout record is created in the `checkout` table
- A corresponding pesanan record is **automatically created** in the `pesanan` table
- Default values: `keterangan_pembayaran='Belum Bayar'`, `status_pesanan='Menunggu Pembayaran'`

**File:** `app/Controllers/Home.php::processCheckout()`
```php
$pesananData = [
    'id_checkout' => $checkoutId,
    'keterangan_pembayaran' => 'Belum Bayar',
    'status_pesanan' => 'Menunggu Pembayaran'
];
$pesananModel->insert($pesananData);
```

### 2. Order Management (Admin Panel)
Administrators can:
- View all orders with customer and checkout information
- Search orders by customer name, email, or address
- Filter orders by payment status and order status
- Update payment status and order status in real-time via dropdown

**Endpoint:** `/admin/pesanan`

## Admin Panel Features

### Kelola Pesanan Page

**Location:** `app/Views/admin/pesanan_management.php`

**Display Columns:**
1. No. (Nomor)
2. Tanggal (Order Date)
3. Nama Pembeli (Customer Name)
4. Email (Customer Email)
5. Alamat (Delivery Address)
6. Total (Total Amount)
7. Keterangan Pembayaran (Payment Status) - Editable dropdown
8. Status Pesanan (Order Status) - Editable dropdown

### Search & Filter Features

**Search Bar:**
- Searches across: Customer name, email, and address
- Real-time filtering
- Placeholder: "Cari nama pembeli, email, atau alamat..."

**Status Filters:**
1. **Status Pesanan Filter** (Order Status)
   - Semua Status (All Statuses)
   - Menunggu Pembayaran (Awaiting Payment)
   - Diproses (Processing)
   - Dikemas (Packing)
   - Dikirim (Shipped)
   - Selesai (Completed)
   - Dibatalkan (Cancelled)

2. **Keterangan Filter** (Payment Status)
   - Semua Keterangan (All)
   - Sudah Bayar (Paid)
   - Belum Bayar (Not Paid)
   - Menunggu Verifikasi (Awaiting Verification)

### Status Update via Dropdown

**Payment Status Dropdown:**
- Options: Belum Bayar, Sudah Bayar, Menunggu Verifikasi
- Updates via AJAX to database
- Success notification: SweetAlert2

**Order Status Dropdown:**
- Options: Menunggu Pembayaran, Diproses, Dikemas, Dikirim, Selesai, Dibatalkan
- Updates via AJAX to database
- Success notification: SweetAlert2

## API Endpoints

### GET /admin/pesanan
**Description:** Retrieve and display all pesanan records with join data
**Response:** pesanan_management.php view with pesanan_data array

**Data Joined:**
- `pesanan.*` - All pesanan fields
- `checkout.tanggal_checkout` - Order date
- `checkout.total_harga` - Total amount
- `user.nama_depan, user.nama_belakang` - Customer name
- `user.alamat` - Delivery address
- `user.email` - Customer email

### POST /admin/updatePesananStatus
**Description:** Update pesanan payment and order status
**Parameters:**
```json
{
  "id_pesanan": 1,
  "status": "Diproses",
  "keterangan": "Sudah Bayar"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Pesanan berhasil diupdate"
}
```

## Models & Controllers

### PesananModel
**File:** `app/Models/PesananModel.php`
- Table: `pesanan`
- Primary Key: `id_pesanan`
- Allowed Fields: `id_checkout`, `keterangan_pembayaran`, `status_pesanan`
- Default Values:
  - `keterangan_pembayaran` → 'Belum Bayar'
  - `status_pesanan` → 'Menunggu Pembayaran'

### Admin Controller Methods

#### pesanan()
- **Purpose:** Fetch and display all pesanan with related data
- **Line:** ~476 in Admin.php
- **Returns:** View with pesanan_data array (ordered by DESC id_pesanan)

#### updatePesananStatus()
- **Purpose:** Update pesanan status via AJAX
- **Line:** ~492 in Admin.php
- **Parameters:** POST id_pesanan, status, keterangan
- **Returns:** JSON response

## Navigation Integration

**Location:** `app/Views/layout/admin_template.php`

Pesanan menu item added to admin sidebar:
```php
<a href="<?= site_url('admin/pesanan') ?>" 
    class="admin-link flex items-center p-3 rounded-lg transition duration-200 hover:bg-sidebar-hover <?= (isset($currentPage) && $currentPage == 'pesanan') ? 'active' : '' ?>">
    <i class="fa-solid fa-box-open mr-3"></i> Kelola Pesanan
</a>
```

**Icon:** fa-box-open (package icon)

## Routes Configuration

**File:** `app/Config/Routes.php`

```php
$routes->group('admin', function($routes) {
    // ... other routes
    
    // Pesanan Routes
    $routes->get('pesanan', 'Admin::pesanan');
    $routes->post('updatePesananStatus', 'Admin::updatePesananStatus');
});
```

## Client-Side Functionality

### JavaScript Features

**Filter Function:**
- Combines text search with status filters
- Real-time table row visibility toggle
- Supports multiple filter combinations

**Status Update Handler:**
- AJAX POST to updatePesananStatus endpoint
- Automatic row data attribute updates
- SweetAlert2 success/error notifications
- Automatic filter reapplication after update

**DOMContentLoaded Listeners:**
- Attaches change event listeners to all dropdowns
- Enables real-time updates without page refresh

## Security

### Authorization
- All pesanan endpoints require admin authentication
- Implement role-based access control in filters

### Validation
- AJAX requests should validate POST data
- SQL injection prevention via CodeIgniter query builder
- XSS prevention via esc() function on output

### Data Protection
- Pesanan records linked to authenticated user sessions
- Foreign key constraints prevent orphaned records

## Testing Checklist

- [ ] Create new checkout → Pesanan record auto-created
- [ ] Navigate to /admin/pesanan → Display all orders
- [ ] Search by customer name → Filter works
- [ ] Filter by order status → Display correct records
- [ ] Filter by payment status → Display correct records
- [ ] Update payment status dropdown → AJAX updates DB
- [ ] Update order status dropdown → AJAX updates DB
- [ ] Update while filtered → Rows update and filters maintained
- [ ] Refresh page → Changes persisted in database
- [ ] No notification on page refresh → Uses database, not session

## Performance Considerations

1. **Database Join:** Pesanan page joins 3 tables (pesanan, checkout, user)
   - Consider indexing id_checkout foreign key
   - Consider indexing user.id_user for faster joins

2. **AJAX Updates:** Single dropdown change triggers database write
   - Minimal performance impact for typical order volume
   - Consider debouncing if high-frequency updates occur

3. **Search & Filter:** JavaScript-based filtering on client
   - Scales well for typical order counts
   - Consider server-side pagination if > 1000 orders

## Future Enhancements

1. **Customer Portal:**
   - Allow customers to view their own order status
   - Real-time notifications on status changes

2. **Bulk Actions:**
   - Update multiple orders at once
   - Batch status transitions

3. **Order History:**
   - Timeline view of status changes
   - User who made each update

4. **Notifications:**
   - Email notifications on status changes
   - SMS alerts for payment reminders

5. **Reporting:**
   - Order statistics dashboard
   - Payment success rates
   - Status distribution reports

## Related Documentation

- Database Structure: See `/DATABASE_VERSIONS.md`
- Checkout System: See `/CRUD_DOCUMENTATION.md`
- Admin Dashboard: See Admin.php documentation
- Error Handling: See `/REGISTER_ERROR_GUIDE.md`
