<!--START-SPLADE-MODAL-{{ $key }}-->
<SpladeModal {{ $baseAttributes->mergeVueBinding(':close-button', $closeButton) }} :name="@js($name)">
    <template #default="modal">
        <x-splade-component is="transition" show="modal.isOpen">
            <x-splade-component is="dialog" v-bind:dusk="`modal.${modal.stack}`" close="modal.setIsOpen" class="tw-relative tw-z-20">
                <!-- The backdrop, rendered as a fixed sibling to the panel container -->
                <x-splade-component
                    is="transition" child
                    v-if="modal.stack === 1"
                    animation="opacity">
                    <div v-show="modal.onTopOfStack" class="tw-fixed tw-z-30 tw-inset-0 tw-bg-black/75" />
                </x-splade-component>

                <div v-if="modal.stack > 1 && modal.onTopOfStack" class="tw-fixed tw-z-30 tw-inset-0 tw-bg-black/75" />

                {{ $slot }}
            </x-splade-component>
        </x-splade-component>
    </template>
</SpladeModal>
<!--END-SPLADE-MODAL-{{ $key }}-->