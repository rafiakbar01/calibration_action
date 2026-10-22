<div x-data="{ openReg: false }">
  <!-- Trigger example: <button @click="openReg = true" class="btn">Open Registrasi</button> -->

  <div x-show="openReg" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 w-full max-w-lg border border-gray-200 dark:border-gray-700">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Registrasi User</h3>
        <button @click="openReg = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">&times;</button>
      </div>

      <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Username</label>
            <input type="text" name="username" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
            <input type="text" name="nama" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIK</label>
            <input type="text" name="nik" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
            <select name="role" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
              <option value="">-- Pilih Role --</option>
              <option value="super admin">Super Admin</option>
              <option value="teknisi">Teknisi</option>
              <option value="checker">Checker</option>
              <option value="approver">Approver</option>
              <option value="ppic">PPIC</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
            <input type="password" name="password" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
          </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
          <button type="button" @click="openReg = false" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200">Batal</button>
          <button type="submit" class="px-4 py-2 rounded-lg bg-brand-600 text-white hover:bg-brand-700">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>