<?= $this->extend('layout/admin_template') ?>
<?= $this->section('users_management') ?>
<div class="p-8">
    
    <!-- Pesan Flashdata -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
        </div>
    <?php endif; ?>
    <!-- End Pesan Flashdata -->
    
    <header class="bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-primary-dark">
            <i class="fa-solid fa-users-cog mr-2"></i> Kelola Users
        </h2>
    </header>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">Daftar Users</h3>
        
        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <input type="text" id="searchUserInput" class="border rounded px-3 py-2 w-full md:w-1/3" placeholder="Cari nama, username, email..." oninput="filterUserTable()">
            <select id="filterUserRole" class="border rounded px-3 py-2 w-full md:w-1/4" onchange="filterUserTable()">
                <option value="">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        
        <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-card-info">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No. HP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($users)) : ?>
                        <tr>
                            <td colspan="10" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Belum ada data Users.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php $no=1; foreach ($users as $user) : ?>
                            <tr class="hover:bg-bg-light-yellow transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                    <?= $no++; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <img src="<?= !empty($user['gambar_user']) ? base_url('uploads/users/' . $user['gambar_user']) : base_url('assets/default_profile.png') ?>" 
                                         alt="<?= esc($user['username']) ?>" 
                                         class="w-12 h-12 rounded-full object-cover border-2 border-primary-dark">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-primary-dark">
                                    <?= esc($user['username']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= esc($user['nama_depan']) ?> <?= esc($user['nama_belakang']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= !empty($user['tanggal_lahir']) ? esc($user['tanggal_lahir']) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= !empty($user['no_telp']) ? '+62' . esc($user['no_telp']) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= !empty($user['alamat']) ? esc($user['alamat']) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($user['email']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?= (esc($user['role']) == 'admin') ? 'bg-primary-dark text-white' : 'bg-gray-200 text-gray-800' ?>">
                                        <?= ucfirst(esc($user['role'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <a href="<?= site_url('admin/user/delete/' . esc($user['id_user'])) ?>" 
                                       onclick="return confirm('Anda yakin ingin menghapus user <?= esc($user['username']) ?>?')" 
                                       class="text-red-600 hover:text-red-900 mx-1" 
                                       title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterUserTable() {
    const search = document.getElementById('searchUserInput').value.toLowerCase();
    const role = document.getElementById('filterUserRole').value.toLowerCase();
    const table = document.getElementById('usersTable');
    const rows = table.querySelectorAll('tbody tr');
    let visibleRows = 0;
    
    rows.forEach(row => {
        // Skip empty state row
        if (row.cells.length === 1 || row.querySelector('td[colspan]')) {
            return;
        }
        
        // Get all text content for searching
        const username = row.querySelector('td:nth-child(3)')?.innerText.toLowerCase() || '';
        const nama = row.querySelector('td:nth-child(4)')?.innerText.toLowerCase() || '';
        const email = row.querySelector('td:nth-child(8)')?.innerText.toLowerCase() || '';
        const searchText = username + ' ' + nama + ' ' + email;
        
        // Get role from the role badge
        const roleSpan = row.querySelector('td:nth-child(9) span');
        const roleText = roleSpan ? roleSpan.innerText.toLowerCase().trim() : '';
        
        let show = true;
        
        // Search filter
        if (search && !searchText.includes(search)) {
            show = false;
        }
        
        // Role filter
        if (role && roleText !== role) {
            show = false;
        }
        
        row.style.display = show ? '' : 'none';
        if (show) visibleRows++;
    });
    
    // Show or hide empty state
    const emptyState = table.querySelector('tbody tr td[colspan]');
    if (emptyState && visibleRows === 0) {
        emptyState.parentElement.style.display = '';
    } else if (emptyState) {
        emptyState.parentElement.style.display = 'none';
    }
}
</script>

<?= $this->endSection() ?>
