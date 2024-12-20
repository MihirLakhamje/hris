<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        {{ $column }}
        
      </tr>
    </thead>
    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
      <!-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td class="px-6 py-4">
          Apple MacBook Pro 17"
        </td>
        <td class="px-6 py-4">
          <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
        </td>
      </tr> -->

      {{ $slot }}
    </tbody>
  </table>
</div>