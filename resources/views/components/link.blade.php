@props([
  'active' => false,
  'typeoflink' => 'nav-link'
])

@if($typeoflink == 'nav-link')
  <a class="{{ $active ? 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group bg-gray-100 dark:bg-gray-700 group' : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group' }}"
    {{ $attributes }}>
    {{ $icon }}
    <span class="ms-3">{{ $slot }}</span>
  </a>

@elseif($typeoflink == 'link')
  <a {{ $attributes->merge(['class' => 'flex items-center font-medium text-black-600 dark:text-black-500 hover:underline']) }}>
    {{ $icon ?? '' }}
    <span class="ms-1">{{ $slot }}</span>
  </a>

@elseif($typeoflink == 'button')
  <button {{ $attributes->merge(['class' => 'flex items-center font-medium text-black-600 dark:text-black-500 hover:underline']) }}>
    {{ $icon ?? '' }}
    <span class="ms-1">{{ $slot }}</span>
  </button>
@endif