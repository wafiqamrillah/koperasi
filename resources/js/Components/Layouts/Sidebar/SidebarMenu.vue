<script>
    export default {
        props: {
            menu: {
                type: Object,
                default : {}
            }
        },
        data() {
            return {
                activated: false,
            };
        },
        methods: {
            isActivated(currentMenu = {}) {
                const currentUrl = window.location.href;
                if (currentMenu?.link !== "#") return currentUrl === currentMenu?.link;
                
                if (!currentMenu.childs) return false;
                if (!(currentMenu.childs.length > 0)) return false;

                if (!currentMenu.childs.find((val, ind) => (val?.link === currentUrl) || this.isActivated(val))) return false;
                
                return true;
            }
        },
        created() {
            this.activated = this.isActivated(this.menu);
        },
        updated() {
            this.activated = this.isActivated(this.menu);
        }
    }
</script>

<template>
    <li class="nav-item" :class="{ 'menu-is-opening menu-open' : (menu?.childs ?? []).length > 0 && isActivated(menu) }">
        <template v-if="menu.link !== '#'">
            <Link :href="menu.link" class="nav-link" :class="{ 'active' : activated }">
                <i :class="`nav-icon ${menu?.icon_class}`"></i>
                <p>
                    {{ menu.label }}
                    <template v-if="(menu?.childs ? menu.childs : []).length > 0">
                        <i class="right fa-solid fa-angle-left"></i>
                    </template>
                </p>
            </Link>
        </template>
        <template v-else>
            <a :href="menu.link" class="nav-link" :class="{ 'active' : activated }">
                <i :class="`nav-icon ${menu?.icon_class}`"></i>
                <p>
                    {{ menu.label }}
                    <template v-if="(menu?.childs ? menu.childs : []).length > 0">
                        <i class="right fa-solid fa-angle-left"></i>
                    </template>
                </p>
            </a>
        </template>
        
        <template v-if="(menu?.childs ? menu.childs : []).length > 0">
            <ul class="nav nav-treeview" :style="{ 'display' : !activated ? 'none' : 'block' }">
                <template v-for="(child, index) in menu.childs" :key="index">
                    <SidebarMenu :menu="child" />
                </template>
            </ul>
        </template>
    </li>
</template>