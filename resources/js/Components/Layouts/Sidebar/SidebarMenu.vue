<script setup>
    import { watch } from 'vue';

    const props = defineProps({
        menu: {
            type: Object,
            default : {}
        }
    });
</script>

<template>
    <li class="nav-item">
        <template v-if="menu.link !== '#'">
            <Link :href="menu.link" class="nav-link" :class="{ 'active' : false  }">
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
            <a :href="menu.link" class="nav-link">
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
            <ul class="nav nav-treeview">
                <template v-for="(child, index) in menu.childs" :key="index">
                    <SidebarMenu :menu="child" />
                </template>
            </ul>
        </template>
    </li>
</template>