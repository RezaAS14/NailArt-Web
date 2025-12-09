# Pesanan (Order) System - Quick Start Guide

## 🚀 Getting Started

### What is Pesanan?
**Pesanan** (Indonesian for "Order") is an order tracking and management system that automatically creates records for every customer checkout and allows admins to track payment status and order processing.

---

## ⚡ Quick Access

### For Customers
✅ **Automatic** - No action needed!
- Complete checkout → Pesanan auto-created
- Payment status: Default "Belum Bayar"
- Order status: Default "Menunggu Pembayaran"

### For Admins
1. **Login** to admin panel
2. **Click** "Kelola Pesanan" in sidebar
3. **View** all orders
4. **Search** by customer name/email/address
5. **Filter** by payment or order status
6. **Update** status via dropdowns
7. **Save** happens automatically

---

## 📊 Status Reference

### Payment Status (Keterangan Pembayaran)
| Status | Meaning | Action |
|--------|---------|--------|
| **Belum Bayar** 🟡 | Not paid yet | Wait for payment |
| **Menunggu Verifikasi** 🔵 | Awaiting verification | Verify payment proof |
| **Sudah Bayar** ✅ | Paid | Process order |
| **Lunas** 💚 | Paid in full | Can ship |
| **Gagal** ❌ | Payment failed | Refund/retry |

### Order Status (Status Pesanan)
| Status | Meaning | What's Happening |
|--------|---------|------------------|
| **Menunggu Pembayaran** 🟡 | Awaiting payment | Customer hasn't paid |
| **Diproses** 🔵 | Processing | Picking items |
| **Dikemas** 📦 | Packing | Wrapping order |
| **Dikirim** 🚚 | Shipped | In transit |
| **Selesai** ✅ | Completed | Delivered |
| **Dibatalkan** ❌ | Cancelled | Order stopped |

---

## 🎯 Common Tasks

### Task 1: Check All Orders
1. Go to `/admin/pesanan`
2. See all customer orders in table
3. Sorted by newest first

### Task 2: Find Specific Order
1. Use search box: "Cari nama pembeli, email, atau alamat..."
2. Type customer name (e.g., "Ahmad")
3. Table filters automatically
4. Press Enter or watch in real-time

### Task 3: Show Only Unpaid Orders
1. Click "Keterangan Filter" dropdown
2. Select "Belum Bayar"
3. See only unpaid orders
4. Can also add status filter

### Task 4: Show Orders Being Packed
1. Click "Status Pesanan Filter" dropdown
2. Select "Dikemas"
3. See only orders in packing stage
4. Combine with Keterangan filter

### Task 5: Update Payment Status
1. Find order in table
2. Click dropdown under "Keterangan Pembayaran"
3. Select new status (e.g., "Sudah Bayar")
4. Automatic save (see green checkmark)
5. Row updates immediately

### Task 6: Update Order Status
1. Find order in table
2. Click dropdown under "Status Pesanan"
3. Select new status (e.g., "Dikemas")
4. Automatic save
5. Customers can see this status

---

## 🔄 Typical Workflow

```
ORDER ARRIVES
    ↓
1. Verify Payment (Update Keterangan → Sudah Bayar)
    ↓
2. Start Processing (Update Status → Diproses)
    ↓
3. Pack Order (Update Status → Dikemas)
    ↓
4. Ship to Customer (Update Status → Dikirim)
    ↓
5. Delivery Confirmed (Update Status → Selesai)
    ✅ ORDER COMPLETE
```

---

## 📋 Order Information Displayed

For each order, you can see:
- **No.** - Order number (for reference)
- **Tanggal** - When customer placed order
- **Nama Pembeli** - Customer full name
- **Email** - Customer email for contact
- **Alamat** - Delivery address
- **Total** - Total amount paid (Rp format)
- **Keterangan Pembayaran** - Payment status (editable)
- **Status Pesanan** - Order status (editable)

---

## 💡 Pro Tips

### Tip 1: Combine Filters
Use both filters together:
1. Filter by "Belum Bayar" (payment)
2. AND filter by "Dikemas" (status)
3. Shows orders paid but not yet shipped

### Tip 2: Quick Search
Just type first name:
- "Ahmad" finds all Ahmad's orders
- "reza@email.com" finds by email
- "Jl. Merdeka" finds by address

### Tip 3: Batch Review
1. Filter by "Menunggu Pembayaran"
2. See all awaiting payment
3. Contact customers to pay
4. Update when payment received

### Tip 4: Prepare Shipments
1. Filter by "Dikemas"
2. See all orders ready to ship
3. Print labels
4. Update to "Dikirim" when posted

### Tip 5: Resolve Issues
1. Filter by "Gagal"
2. Contact customers
3. Issue refund or retry payment
4. Update status accordingly

---

## ✅ Verification Checklist

- [ ] Can access `/admin/pesanan`
- [ ] See all orders in table
- [ ] Search box works
- [ ] Status filters work
- [ ] Keterangan filters work
- [ ] Can change payment status
- [ ] Can change order status
- [ ] Changes saved to database
- [ ] Dropdown updates visible
- [ ] Green checkmark confirms save

---

## 🆘 Troubleshooting

| Problem | Solution |
|---------|----------|
| Page not found | Ensure logged in as admin |
| No orders showing | Create order first in checkout |
| Search not working | Type customer name/email/address |
| Status won't update | Check database connection |
| Change disappeared on refresh | Was it auto-saved? Check for green tick |

---

## 🔐 Security

- ✅ Admin-only access (requires login)
- ✅ Role-based (only admin role)
- ✅ SQL injection prevented
- ✅ Data validation enforced
- ✅ Foreign key constraints checked

---

## 📱 Browser Support

- ✅ Chrome/Edge (Recommended)
- ✅ Firefox
- ✅ Safari
- ✅ Mobile browsers (responsive)

---

## 📞 Need Help?

Check documentation files:
- **PESANAN_INTEGRATION.md** - Technical details
- **PESANAN_SYSTEM_SUMMARY.md** - System overview
- **README.md** - Project documentation
- **CRUD_DOCUMENTATION.md** - Database operations
- **IMPLEMENTATION_SUMMARY.md** - What was added

---

## 🎓 Learning Path

1. **Beginner**: Just update status dropdowns ← You are here
2. **Intermediate**: Combine filters effectively
3. **Advanced**: Monitor trends and patterns
4. **Expert**: Custom reporting (future feature)

---

**Status: Ready to Use ✅**

Start managing orders now! Head to `/admin/pesanan`

---

*Last Updated: December 2025*
*Version: 1.0*
*Status: Production Ready*
