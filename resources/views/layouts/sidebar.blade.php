<aside class="fixed pt-16 min-h-screen max-h-screen left-0 w-80 z-10 bg-base-100 flex overflow-hidden shadow-lg">
  <ul class="flex-auto flex flex-col text-sm divide-y divide-gray-200 overflow-y-auto">
    <!-- Sidebar content here -->
    @for ($i = 0; $i < 100; $i++)
      <li
        class="p-4 hover:bg-gray-300 hover:cursor-pointer">
        <a>Sidebar Item 1</a>
      </li>
    @endfor
  </ul>
</aside>