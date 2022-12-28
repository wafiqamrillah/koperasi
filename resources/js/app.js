import "./bootstrap";
import "../css/app.css";
import "../css/laravel-splade.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");

createApp({
    render: renderSpladeApp({ el })
})
    .directive('click-outside', {
        bind: function (el, binding, vnode) {
            el.clickOutsideEvent = function (event) {
                if (!(el == event.target || el.contains(event.target))) {
                    vnode.context[binding.expression](event);
                }
            };
            
            document.body.addEventListener('click', el.clickOutsideEvent);
        },
        unbind: function (el) {
            document.body.removeEventListener('click', el.clickOutsideEvent)
        },
    })
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true
    })
    .mount(el);
