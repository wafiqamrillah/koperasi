<SpladeToast v-bind:auto-dismiss="@json($autoDismiss)" #default="toast">
    <x-splade-component is="transition" appear show="toast.show">
        <x-splade-component is="transition" child after-leave="toast.emitDismiss">
            <div @class([
                'tw-p-4 tw-pointer-events-auto tw-border-l-4 tw-shadow-md tw-min-w-[240px]',
                'tw-bg-green-50 tw-border-green-400' => $isSuccess,
                'tw-bg-yellow-50 tw-border-yellow-400' => $isWarning,
                'tw-bg-red-50 tw-border-red-400' => $isDanger,
                'tw-bg-blue-50 tw-border-blue-400' => $isInfo,
            ])>
                <div class="tw-flex">
                    <div class="tw-flex-shrink-0">
                        @if($isSuccess)
                            <svg class="tw-h-5 tw-w-5 tw-text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        @elseif($isWarning)
                            <svg class="tw-h-5 tw-w-5 tw-text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        @elseif($isDanger)
                            <svg class="tw-h-5 tw-w-5 tw-text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        @elseif($isInfo)
                            <svg class="tw-h-5 tw-w-5 tw-text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>
                    <div class="ml-3 break-words">
                        <h3 @class([
                            'tw-text-sm tw-font-medium',
                            'tw-text-green-800' => $isSuccess,
                            'tw-text-orange-800' => $isWarning,
                            'tw-text-red-800' => $isDanger,
                            'tw-text-blue-800' => $isInfo,
                        ])>
                           {{ $title ?: $message }}
                        </h3>

                        @if($title && $message)
                            <div @class([
                                'tw-mt-2 tw-text-sm',
                                'tw-text-green-700' => $isSuccess,
                                'tw-text-orange-700' => $isWarning,
                                'tw-text-red-700' => $isDanger,
                                'tw-text-blue-700' => $isInfo,
                            ])>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="tw-ml-auto tw-pl-3">
                        <div class="-tw-mx-1.5 -tw-my-1.5">
                            <button type="button" @click.prevent="toast.setShow(false)" @class([
                                'tw-inline-flex tw-rounded-md tw-p-1.5 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2',
                                'tw-bg-green-50 tw-text-green-500 hover:tw-bg-green-100 focus:tw-ring-offset-green-50 focus:tw-ring-green-600' => $isSuccess,
                                'tw-bg-orange-50 tw-text-orange-500 hover:tw-bg-orange-100 focus:tw-ring-offset-orange-50 focus:tw-ring-orange-600' => $isWarning,
                                'tw-bg-red-50 tw-text-red-500 hover:tw-bg-red-100 focus:tw-ring-offset-red-50 focus:tw-ring-red-600' => $isDanger,
                                'tw-bg-blue-50 tw-text-blue-500 hover:tw-bg-blue-100 focus:tw-ring-offset-blue-50 focus:tw-ring-blue-600' => $isInfo,
                            ])>
                                <span class="tw-sr-only">Dismiss Toast</span>
                                <svg class="tw-h-5 tw-w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </x-splade-component>
    </x-splade-component>
</SpladeToast>