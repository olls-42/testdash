<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import {
    NavigationMenu,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    navigationMenuTriggerStyle,
} from '@/components/ui/navigation-menu';
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import type { BreadcrumbItem, NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Menu, Search, BadgeDollarSign, User } from 'lucide-vue-next';
import { computed } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
console.log(page.props)
const auth = computed(() => page.props.auth);

const isCurrentRoute = computed(() => (url: string) => page.url === url);

const activeItemStyles = computed(
    () => (url: string) => (isCurrentRoute.value(url) ? 'active' : ''),
);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
        adminOnly: false
    },
    {
        title: 'Plans',
        href: '/plans',
        icon: BadgeDollarSign,
        adminOnly: false
    },
    {
        title: 'Users',
        href: '/users',
        icon: User,
        adminOnly: true
    }
];

const logoutItems: NavItem[] = [
    {
        title: 'Sign Out',
        href: 'logout',
        icon: User,
    },
];

const loginItems: NavItem[] = [
    {
        title: 'Login',
        href: 'login',
        icon: User,
    },
    {
        title: 'Registration',
        href: 'register',
        icon: User
    }
];

let visibleMenuItem = (item: NavItem) => {
    if (item.adminOnly) {
        if (page.props.auth?.user?.is_admin) {
            return true
        }

        return false
    }

    return true
};

</script>

<template>

    <div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <Link :href="route('dashboard')" class="d-flex align-items-center  text-decoration-none px-5">
                <AppLogo />
            </Link>
            <NavigationMenu class="">
                <NavigationMenuList class="nav nav-pills">
                    <NavigationMenuItem v-for="(item, index) in mainNavItems" :key="index" class="nav-item">
                        <Link :href="item.href" :class="[navigationMenuTriggerStyle(), activeItemStyles(item.href), 'nav-link']" v-if="visibleMenuItem(item)">
                            <component v-if="item.icon" :is="item.icon" class="" />
                            {{ item.title }}
                        </Link>
                        <!-- todo:remove me?div v-if="isCurrentRoute(item.href)" class="" ></div-->
                    </NavigationMenuItem>
                </NavigationMenuList>
            </NavigationMenu>
            <NavigationMenu class="" v-if="!auth.user">
                <NavigationMenuList class="nav nav-pills">
                    <NavigationMenuItem v-for="(item, index) in loginItems" :key="index" class="nav-item" >
                        <Link :href="item.href" :class="[navigationMenuTriggerStyle(), activeItemStyles(item.href), 'nav-link']" method="get"  >
                            <component v-if="item.icon" :is="item.icon" class="" />
                            {{ item.title }}
                        </Link>
                        <!-- todo:remove me?div v-if="isCurrentRoute(item.href)" class="" ></div-->
                    </NavigationMenuItem>
                </NavigationMenuList>
            </NavigationMenu>
            <NavigationMenu class="" v-if="auth.user">
                <NavigationMenuList class="nav nav-pills">
                    <NavigationMenuItem v-for="(item, index) in logoutItems" :key="index" class="nav-item" >
                        <Link :href="item.href" :class="[navigationMenuTriggerStyle(), activeItemStyles(item.href), 'nav-link']" method="post"  >
                            <component v-if="item.icon" :is="item.icon" class="" />
                            {{ item.title }}
                        </Link>
                        <!-- todo:remove me?div v-if="isCurrentRoute(item.href)" class="" ></div-->
                    </NavigationMenuItem>
                </NavigationMenuList>
            </NavigationMenu>
        </header>
    </div>

    <div v-if="props.breadcrumbs.length > 1" class="">
        <div class="">
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </div>
    </div>

</template>
