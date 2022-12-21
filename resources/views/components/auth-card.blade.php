<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div {{ $attributes->only(['class'])->class("w-full sm:max-w-xl bg-white overflow-hidden shadow-md rounded-lg") }}>
        <div class="card-body">
            @isset($logo)
                {{ $logo }}
            @else
                <div class="flex items-center justify-center">
                    <Link href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </Link>
                </div>
            @endisset

            {{ $slot }}
        </div>
    </div>
</div>
