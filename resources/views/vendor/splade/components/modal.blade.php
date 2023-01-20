@props([
    'title',
    'close' => 'modal.setIsOpen'
])

<x-splade-component is="modal-wrapper" :base-attributes="$attributes->except('class')" :key="$modalKey" :close-button="$closeButton" :name="$name" :close="$close">
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
                after-leave="modal.emitClose"
                v-bind:class="{
                    'tw-transition tw-w-full': true,
                    'tw-blur-sm': !modal.onTopOfStack,
                    'sm:tw-max-w-sm': modal.maxWidth == 'sm',
                    'sm:tw-max-w-md': modal.maxWidth == 'md',
                    'sm:tw-max-w-md md:tw-max-w-lg': modal.maxWidth == 'lg',
                    'sm:tw-max-w-md md:tw-max-w-xl': modal.maxWidth == 'xl',
                    'sm:tw-max-w-md md:tw-max-w-xl lg:tw-max-w-2xl': modal.maxWidth == '2xl',
                    'sm:tw-max-w-md md:tw-max-w-xl lg:tw-max-w-3xl': modal.maxWidth == '3xl',
                    'sm:tw-max-w-md md:tw-max-w-xl lg:tw-max-w-3xl xl:tw-max-w-4xl': modal.maxWidth == '4xl',
                    'sm:tw-max-w-md md:tw-max-w-xl lg:tw-max-w-3xl xl:tw-max-w-5xl': modal.maxWidth == '5xl',
                    'sm:tw-max-w-md md:tw-max-w-xl lg:tw-max-w-3xl xl:tw-max-w-5xl 2xl:tw-max-w-6xl': modal.maxWidth == '6xl',
                    'sm:tw-max-w-md md:tw-max-w-xl lg:tw-max-w-3xl xl:tw-max-w-5xl 2xl:tw-max-w-7xl': modal.maxWidth == '7xl'
                }">
                <x-splade-component is="dialog" panel dusk="modal-dialog">
                    <div {{ $attributes->class('text-sm modal-content') }}>
                        <x-splade-data :default="['title' => isset($title) ? $title : null]">
                            <div v-if="data.title || modal.closeButton" class="modal-header">
                                <template v-if="data.title">
                                    <h2 class="text-lg font-medium text-gray-900" v-html="data.title" />
                                </template>
                                <template v-if="modal.closeButton">
                                    <button type="button" class="close" @click="modal.close" data-dismiss="modal" aria-label="Close" dusk="close-modal-button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </template>
                            </div>
                        </x-splade-data>

                        {{ $slot }}
                    </div>
                </x-splade-component>
            </x-splade-component>
        </div>
    </div>
</x-splade-component>