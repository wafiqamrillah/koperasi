<SpladeToasts>
    <template #default="toasts">
        <x-splade-component
            is="transition"
            animation="opacity"
            appear
            show="toasts.hasBackdrop"
            class="fixed z-30 inset-0 bg-black/75"
            style="position: fixed; z-index: 30; top: 0px; right: 0px; bottom: 0px; left: 0px; background-color: rgb(0, 0, 0, .75);"
        />

        <div
            style="
                position: fixed;
                z-index: 40;
                top: 0px;
                right: 0px;
                bottom: 0px;
                left: 0px;
                display: grid;
                grid-template-columns: repeat(1, minmax(0, 1fr));
                grid-auto-flow: row;
                pointer-events: none;
            ">
            <div v-for="position in toasts.positions" style="position: relative">
                <div :style="{
                        'position: absolute; width: 100%; height: 100%; display: flex; flex-direction: column; padding: 1rem; margin-top: 1rem;' : true,
                        'align-items: flex-start; justify-content: flex-start;': position == 'left-top',
                        'align-items: center; justify-content: flex-start;': position == 'center-top',
                        'align-items: flex-end; justify-content: flex-start;': position == 'right-top',
                        'align-items: flex-start; justify-content: center;': position == 'left-center',
                        'align-items: center; justify-content: center;': position == 'center-center',
                        'align-items: flex-end; justify-content: center;': position == 'right-center',
                        'align-items: flex-start; justify-content: flex-end;': position == 'left-bottom',
                        'align-items: center; justify-content: flex-end;': position == 'center-bottom',
                        'align-items: flex-end; justify-content: flex-end;': position == 'right-bottom'
                    }"
                >
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
