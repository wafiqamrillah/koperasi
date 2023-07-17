import Alpine from 'alpinejs'
import jQuery from 'jquery';

// Preparting Alpine
window.Alpine = Alpine;

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.nav = {
    width: 990,
    make() {
        return {
            collapsed: function () {
                if (window.innerWidth < this.width) {
                    return true;
                }

                return false;
            },
            resize() {
                if (window.innerWidth < this.width) {
                    this.collapsed = true;
                }
            },
            click() {
                this.collapsed = !this.collapsed;
                if (!this.collapsed) {
                    this.$refs.body.classList.add("sidebar-open");
                } else {
                    this.$refs.body.classList.remove("sidebar-open");
                }
            },
            clickAway() {
                if (window.innerWidth < this.width) {
                    this.$refs.body.classList.remove("sidebar-open");
                    this.collapsed = true;
                }
            }
        };
    },
};

window.permissions = () => {
    return {
        checkAll(id, css) {
            document.getElementById(id).checked = Array.from(document.querySelectorAll('.' + css)).every((element) => {
                return element.checked === true
            });
        },
        reCheckedSelectAll(el, css) {
            let event = new Event('change');
            Array.from(document.querySelectorAll('.' + css)).forEach((element) => {
                element.checked = el.checked
                element.dispatchEvent(event);
            });
        }
    }
};

Alpine.start();

// Preparing jQuery
window.jQuery = jQuery;
// See https://github.com/alpinejs/alpine/pull/2063
// This change would allow to enable compability with jQuery event system
document.addEventListener('alpine:init', () => {
    Alpine.setListenerManipulators(
        (target, eventName, handler, options, modifiers) => { jQuery(target).on(eventName, handler); },
        (target, eventName, handler, options) => { jQuery(target).off(eventName, handler); }
    );
});