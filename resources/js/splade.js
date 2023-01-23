import { createApp, defineAsyncComponent } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

// Components
import SidebarMenu from "./Components/Layouts/Sidebar/SidebarMenu.vue";

const el = document.getElementById("app");

const app = createApp({
    render: renderSpladeApp({ el })
});

// Use
app.use(SpladePlugin, {
    "max_keep_alive": 10,
    "transform_anchors": false,
    "progress_bar": true
});

// Components
app.component("SidebarMenu", SidebarMenu);

// Mounts
app.mount(el);

// Global Properties
app.config.globalProperties.$axios = window.axios;
app.config.globalProperties.$console = console;
app.config.globalProperties.$window = window;