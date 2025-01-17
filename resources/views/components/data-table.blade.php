<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        {{ $column }}
      </tr>
    </thead>
    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
      {{ $slot }}
    </tbody>
  </table>
</div>