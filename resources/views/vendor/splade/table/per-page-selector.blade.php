<select
    name="per_page"
    class="tw-block focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-min-w-max tw-shadow-sm tw-text-sm tw-border-gray-300 tw-rounded-md"
    @change="table.updateQuery('perPage', $event.target.value)"
  >
    @foreach($table->allPerPageOptions() as $perPage)
        <option value="{{ $perPage }}" @selected($perPage === $table->perPage())>
            {{ $perPage }} {{ __('per page') }}
        </option>
    @endforeach
</select>