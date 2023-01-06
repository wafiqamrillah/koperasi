<SpladeConfirm
    default-title="{{ __('Are you sure you want to continue?') }}"
    default-text=""
    default-confirm-button="{{ __('Confirm') }}"
    default-cancel-button="{{ __('Cancel') }}"
>
    <template #default="confirm">
        <x-splade-component is="transition" show="confirm.isOpen">
            <x-splade-component is="dialog" class="tw-relative tw-z-30" close="confirm.setIsOpen(false)">
                <!-- The backdrop, rendered as a fixed sibling to the panel container -->
                <x-splade-component
                    is="transition"
                    child
                    animation="opacity"
                    enter="tw-transition tw-ease-in-out tw-duration-300"
                    enterFrom="tw-opacity-0"
                    enterTo="tw-opacity-100"
                    leave="tw-transition tw-ease-in-out tw-duration-300"
                    leaveFrom="tw-opacity-100"
                    leaveTo="tw-opacity-0">
                    <div class="tw-fixed tw-z-30 tw-inset-0 tw-bg-black/75" />
                </x-splade-component>

                <!-- Full-screen scrollable container -->
                <div class="tw-fixed tw-inset-0 tw-z-40 tw-overflow-y-auto tw-p-4">
                    <!-- Container to center the panel -->
                    <div class="tw-flex tw-min-h-full tw-items-center tw-justify-center">
                        <!-- The actual dialog panel -->
                        <x-splade-component
                            is="transition"
                            child
                            animation="fade"
                            enter="tw-transition tw-transform tw-ease-in-out tw-duration-300"
                            enterFrom="tw-opacity-0 tw-translate-y-4 sm:tw-translate-y-0 sm:tw-scale-95"
                            enterTo="tw-opacity-100 tw-translate-y-0 sm:tw-scale-100"
                            leave="tw-transition tw-transform tw-ease-in-out tw-duration-300"
                            leaveFrom="tw-opacity-100 tw-translate-y-0 sm:tw-scale-100"
                            leaveTo="tw-opacity-0 tw-translate-y-4 sm:tw-translate-y-0 sm:tw-scale-95"
                            after-leave="confirm.emitClose"
                            class="sm:tw-max-w-md md:tw-max-w-xl lg:tw-max-w-3xl">
                            <x-splade-component is="dialog" panel class="modal-content">
                                <div v-if="confirm.title" class="modal-header">
                                    <h2 class="text-lg font-medium text-gray-900" v-text="confirm.title" />
                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" dusk="close-modal-button" @click="confirm.close" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button> --}}
                                </div>

                                <div v-if="confirm.text" class="modal-body">
                                    <p v-text="confirm.text" />
                                </div>

                                <div class="modal-footer">
                                    <button
                                        dusk="splade-confirm-confirm"
                                        type="button"
                                        class="btn btn-primary"
                                        @click.prevent="confirm.confirm"
                                        v-text="confirm.confirmButton"
                                    />
                                    <button
                                        dusk="splade-confirm-cancel"
                                        type="button"
                                        class="btn btn-default"
                                        @click.prevent="confirm.cancel"
                                        v-text="confirm.cancelButton"
                                    />
                                </div>
                            </x-splade-component>
                        </x-splade-component>
                    </div>
                </div>
            </x-splade-component>
        </x-splade-component>
    </template>
</SpladeConfirm>