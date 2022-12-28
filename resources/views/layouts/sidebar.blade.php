<aside class="fixed pt-16 min-h-screen max-h-screen left-0 w-80 z-10 bg-base-100 flex flex-col overflow-hidden shadow-lg">
  <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
    <div class="avatar">
      <div class="w-16 rounded-full">
          <img src="https://placeimg.com/80/80/people" />
      </div>
    </div>
    <div class="flex flex-col space-y-1">
      <div class="text-xs">
        Welcome
      </div>
      <div class="font-bold">
        {{ auth()->user()->name }}
      </div>
    </div>
  </div>
  <ul class="flex-1 flex flex-col text-sm divide-y divide-gray-200 overflow-y-auto">
    <!-- Sidebar content here -->
    @for ($i = 0; $i < 100; $i++)
      <li
        class="p-4 hover:bg-gray-300 hover:cursor-pointer">
        <a>Sidebar Item 1</a>
      </li>
    @endfor
  </ul>
</aside>