<SpladeToasts>
    <template #default="toasts">
        <x-splade-component
            is="transition"
            animation="opacity"
            appear
            show="toasts.hasBackdrop"
            class="tw-fixed tw-z-[1200] tw-inset-0 tw-bg-black/75"
        />

        <div class="tw-fixed tw-z-[1201] tw-inset-0 tw-grid tw-grid-cols-3 tw-grid-flow-row-3 tw-pointer-events-none">
            <div v-for="position in toasts.positions" class="tw-relative">
                <div :class="{
                    'tw-absolute tw-w-full tw-h-full tw-flex tw-flex-col tw-p-4 tw-space-y-4': true,
                    'tw-items-start tw-justify-start': position == 'left-top',
                    'tw-items-center tw-justify-start': position == 'center-top',
                    'tw-items-end tw-justify-start': position == 'right-top',
                    'tw-items-start tw-justify-center': position == 'left-center',
                    'tw-items-center tw-justify-center': position == 'center-center',
                    'tw-items-end tw-justify-center': position == 'right-center',
                    'tw-items-start tw-justify-end': position == 'left-bottom',
                    'tw-items-center tw-justify-end': position == 'center-bottom',
                    'tw-items-end tw-justify-end': position == 'right-bottom'
                }">
                    <template v-for="(toast, toastKey) in toasts.toasts">
                        <template v-if="toast.position == position && !toast.dismissed && toast.html">
                            <SpladeRender
                                @dismiss="toasts.dismissToast(toastKey)"
                                :toast-key="toastKey"
                                :key="toastKey"
                                :html="toast.html"
                            />
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </template>
</SpladeToasts>
