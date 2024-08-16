<script setup lang="ts">
import { ChevronDown, LogOut, CircleUser, Menu, CarFront, Layers3, Building2, UsersRound, Cog, PanelLeftClose, PanelLeftOpen } from 'lucide-vue-next'
import { Button } from '@/shadcn/Components/ui/button'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/shadcn/Components/ui/dropdown-menu'
import { Sheet, SheetContent, SheetTrigger } from '@/shadcn/Components/ui/sheet'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link, usePage } from '@inertiajs/vue3'
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/shadcn/Components/ui/collapsible'
import { ref, onMounted } from 'vue'
import Card from '@/shadcn/Components/ui/card/Card.vue'
import CardHeader from '@/shadcn/Components/ui/card/CardHeader.vue'
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from '@/shadcn/Components/ui/tooltip'
import { useToast } from 'vue-toast-notification';

const appurl = ref((usePage().props.url as { appurl: string }).appurl).value;

const isLinkActive = (href: string) => {
    return window.location.pathname === new URL(appurl + href).pathname;
};

const menuList = ref([
    {
        groupLabel: "Gestion",
        menus: [
            {
                href: appurl + "/vehicles-list",
                label: "Véhicules",
                active: isLinkActive("/vehicles-list"),
                icon: CarFront,
                submenus: [],
            },
            {
                href: "/categories",
                label: "Categories",
                active: isLinkActive("/categories"),
                icon: Layers3,
                submenus: [],
            },
            {
                href: "/agencies",
                label: "Agences",
                active: isLinkActive("/agencies"),
                icon: Building2,
                submenus: [],
            },
        ],
    },
    {
        groupLabel: "Administration",
        menus: [

            {
                href: "/people",
                label: "Persons",
                active: isLinkActive("/people"),
                icon: UsersRound,
                submenus: [
                    {
                        href: appurl + "/people/overview",
                        label: "Vue d\'ensemble",
                        active: isLinkActive("/people"),
                    },
                    {
                        href: appurl + "/people/agents",
                        label: "Agents",
                        active: isLinkActive("/people"),
                    },
                    {
                        href: appurl + "/people/clients",
                        label: "Clients",
                        active: isLinkActive("/people"),
                    },
                ],
            },
            {
                href: appurl + "/settings/account",
                label: "Paramétres",
                active: isLinkActive("/settings"),
                icon: Cog,
                submenus: [
                    {
                        href: appurl + "/settings/account",
                        label: "Compte",
                        active: isLinkActive("/settings/account"),
                    },
                    {
                        href: appurl + "/settings/email-templates",
                        label: "Modéles des émails",
                        active: isLinkActive("/settings/email-templates"),
                    },
                    {
                        href: appurl + "/settings/activity-logs",
                        label: "Journal d\'activités",
                        active: isLinkActive("/settings/activity-logs"),
                    },
                    {
                        href: appurl + "/settings/roles-permissions",
                        label: "Rôles & Permissions",
                        active: isLinkActive("/settings/roles-permissions"),
                    },
                ],
            },
        ],
    },
]);
const submenusOpen = ref(menuList.value.map(() => false));
const isSidebarOpen = ref(true);


</script>

<template>
    <div :class="[
        'grid min-h-screen w-full transition-all',
        isSidebarOpen ? 'md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]' : 'grid-cols-[64px_1fr]'
    ]">
        <div class="hidden bg-muted/30 md:block ">
            <Card class="flex h-full max-h-screen flex-col gap-2 fixed rounded-none"
                :class="isSidebarOpen ? 'w-[280px]' : 'w-16'">

                <CardHeader>
                    <div class="relative flex items-center justify-center">
                        <Link :href="appurl + '/dashboard'" class="flex items-center gap-2 font-semibold">
                        <ApplicationLogo class="h-6 w-6 object-contain" />
                        <span class="" v-if="isSidebarOpen">Auto jahiz</span>
                        </Link>

                    </div>
                    <Button variant="default" size="icon" class="rounded border absolute -right-8 top-2 "
                        @click="[isSidebarOpen = !isSidebarOpen, submenusOpen = submenusOpen.map(() => false)]">
                        <PanelLeftClose class="h-4 w-4" v-if="isSidebarOpen" />
                        <PanelLeftOpen class="h-4 w-4" v-else />
                    </Button>

                </CardHeader>
                <div class="flex-1 ">
                    <nav class="grid items-start  text-sm font-medium ">
                        <div v-for="({ groupLabel, menus }, index) in menuList" :key="index">
                            <h4
                                class="flex items-center gap-2 px-4 py-2 transition-all text-base font-semibold tracking-wide border-b ml-1">
                                <span class="" v-if="isSidebarOpen"> {{ groupLabel }} </span>
                            </h4>
                            <div v-for="({ href, label, icon, submenus, active }, index) in menus" :key="index"
                                class="w-full">
                                <div v-if="submenus.length === 0">
                                    <Link :href="href"
                                        class="flex items-center  py-2 mt-2 text-foreground transition-all w-full"
                                        :class="active && isSidebarOpen ? 'bg-muted-foreground/20 text-gray-600' : ''">

                                    <TooltipProvider>
                                        <Tooltip>
                                            <span
                                                :class="active && !isSidebarOpen ? 'bg-muted-foreground/20 w-full py-2' : ''">
                                                <TooltipTrigger as-child>
                                                    <component :is="icon" class="transition-all h-4 w-4 ml-5 mr-3" />
                                                </TooltipTrigger>
                                            </span>

                                            <span>
                                                <span v-if="isSidebarOpen">{{ label }}</span>
                                            </span>

                                            <TooltipContent side="right" class="ml-4">
                                                <p>{{ label }}</p>
                                            </TooltipContent>
                                        </Tooltip>
                                    </TooltipProvider>
                                    </Link>
                                </div>



                                <Collapsible v-else v-model:open="submenusOpen[index]">
                                    <CollapsibleTrigger @click="isSidebarOpen = true"
                                        class="flex items-center justify-between gap-3 px-4 py-2 text-foreground transition-all w-full mt-2"
                                        :class="active && isSidebarOpen ? 'bg-muted-foreground/20 text-gray-600 rounded' : ''">
                                        <div class="flex items-center gap-3">
                                            <TooltipProvider>
                                                <Tooltip>
                                                    <TooltipTrigger>
                                                        <component :is="icon" class="h-4 w-4 transition-all ml-1"
                                                            :class="active && !isSidebarOpen ? 'bg-muted-foreground/20 text-gray-600 rounded' : ''" />
                                                    </TooltipTrigger>
                                                    <TooltipContent side="right" class="ml-4">
                                                        <p>{{ label }}</p>
                                                    </TooltipContent>
                                                </Tooltip>
                                            </TooltipProvider>
                                            <span v-if="isSidebarOpen">{{ label }}</span>
                                        </div>

                                        <!-- Hide Chevron when sidebar is closed -->
                                        <ChevronDown v-if="isSidebarOpen"
                                            class="h-4 w-4 transition-transform duration-300"
                                            :class="submenusOpen[index] ? 'rotate-180' : 'rotate-0'" />
                                    </CollapsibleTrigger>

                                    <CollapsibleContent class="pl-3">
                                        <ul class="flex flex-col space-y-2">
                                            <li v-for="(submenu, subIndex) in submenus" :key="subIndex"
                                                class="border-gray-600">
                                                <Link :href="submenu.href"
                                                    class="block text-muted-foreground mt-0.5 ml-9">
                                                {{ submenu.label }}
                                                </Link>
                                            </li>
                                        </ul>
                                    </CollapsibleContent>
                                </Collapsible>

                            </div>
                        </div>
                    </nav>

                </div>
                <div class="mt-auto p-4">
                    <Link :href="route('logout')" method="post">
                    <Button variant="default" size="icon"
                        class="w-full flex items-center gap-2 hover:bg-muted-foreground/50 ">
                        <TooltipProvider>
                            <Tooltip>
                                <TooltipTrigger>
                                    <LogOut class="h-5 w-5" />
                                </TooltipTrigger>
                                <TooltipContent side="right" class="ml-3">
                                    Déconnexion
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>
                        <span class="" v-if="isSidebarOpen"> Déconnexion </span>
                    </Button>
                    </Link>
                </div>
            </Card>
        </div>
        <div class="flex flex-col">
            <header class="flex h-14 items-center gap-4 border-b bg-muted/30 px-4 lg:h-[60px] lg:px-6">
                <Sheet>
                    <SheetTrigger as-child>
                        <Button variant="outline" size="icon" class="shrink-0 md:hidden">
                            <Menu class="h-5 w-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="flex flex-col">
                        <nav class="grid gap-2 text-lg font-medium">
                            <a href="#" class="flex items-center gap-2 text-lg font-semibold">
                                <ApplicationLogo class="h-6 w-6" />
                                <span class="">Auto jahiz</span>
                            </a>
                        </nav>
                        <div v-for="({ groupLabel, menus }, index) in menuList" :key="index">
                            <h4
                                class="flex items-center gap-2 px-3 py-2 transition-all text-base font-semibold tracking-wide border-b">
                                {{ groupLabel }}
                            </h4>
                            <div v-for="({ href, label, icon: Icon, submenus, active }, index) in menus" :key="index"
                                class="w-full">
                                <div v-if="submenus.length === 0">
                                    <a :href="href"
                                        class="flex items-center gap-3 px-3 py-2 mt-2 text-foreground transition-all"
                                        :class="active ? 'bg-muted-foreground/20  text-gray-600' : ''">
                                        <component :is="Icon" class="h-5 w-5" />
                                        {{ label }}
                                    </a>
                                </div>
                                <Collapsible v-else v-model:open="submenusOpen[index]">
                                    <CollapsibleTrigger
                                        class="flex items-center justify-between gap-3 px-3 py-2 text-foreground transition-all w-full mt-2"
                                        :class="active ? 'bg-muted-foreground/20  text-gray-600' : ''">
                                        <div class="flex items-center gap-3">
                                            <component :is="Icon" class="h-5 w-5" />
                                            {{ label }}
                                        </div>
                                        <ChevronDown class="h-4 w-4 transition-transform duration-300"
                                            :class="submenusOpen[index] ? 'rotate-180' : 'rotate-0'" />

                                    </CollapsibleTrigger>
                                    <CollapsibleContent class="pl-3">
                                        <ul>
                                            <li v-for="(submenu, subIndex) in submenus" :key="subIndex" class="py-1">
                                                <a :href="submenu.href"
                                                    class="block transition-all text-muted-foreground mt-0.5  ">
                                                    {{ submenu.label }}
                                                </a>
                                            </li>
                                        </ul>
                                    </CollapsibleContent>
                                </Collapsible>
                            </div>
                        </div>
                        <div class="mt-auto p-4">
                            <Link :href="route('logout')" method="post">
                            <Button variant="default" size="sm"
                                class="w-full flex items-center gap-2 hover:bg-muted-foreground/50 ">
                                <LogOut class="h-5 w-5" />
                                Déconnexion
                            </Button>
                            </LInk>
                        </div>
                    </SheetContent>
                </Sheet>
                <div class="w-full flex-1">

                </div>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="secondary" size="icon" class="rounded-full">
                            <CircleUser class="h-5 w-5" />
                            <span class="sr-only">Toggle user menu</span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>
                            {{ $page.props.auth.user.name }}
                        </DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem class="cursor-pointer">
                            <Link :href="appurl + '/settings/account'"> Profil </Link>
                        </DropdownMenuItem>
                        <DropdownMenuItem class="cursor-pointer">
                            <Link :href="route('logout')" method="post" as="button">
                            Déconnexion
                            </Link>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6 h-screen">
                <slot />
            </main>
        </div>
    </div>
</template>