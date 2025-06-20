<script setup>
import { sidebarState } from "@/Composables";
import PerfectScrollbar from "@/Components/PerfectScrollbar.vue";
import ProfileCard from "@/Components/ProfileCard.vue";
import SidebarLink from "@/Components/Sidebar/SidebarLink.vue";
import SidebarCollapsible from "@/Components/Sidebar/SidebarCollapsible.vue";
import SidebarCollapsibleItem from "@/Components/Sidebar/SidebarCollapsibleItem.vue";
import { DashboardIcon, CircleStackIcon } from "@/Components/Icons/solid";
import { BriefcaseIcon, AcademicCapIcon } from "@heroicons/vue/solid";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const path = ref(null);
router.on("navigate", () => {
    path.value = route().current();
});
</script>

<template>
    <!-- profile card -->
    <ProfileCard />

    <PerfectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <!-- dashboard -->
        <SidebarLink
            title="Dashboard"
            :href="route('dashboard')"
            :active="$page.url.startsWith('/dashboard')"
        >
            <template #icon>
                <DashboardIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <!-- ADMIN MENU -->
        <section
            v-if="$page.props.auth.user.role == 'admin'"
            class="flex flex-col flex-1 gap-4"
        >
            <!-- divider -->
            <div
                v-show="sidebarState.isOpen || sidebarState.isHovered"
                class="relative flex items-center"
            >
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="px-2 text-gray-400 text-sm">Administrator</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- identitas -->
            <SidebarLink
                title="Identitas"
                :href="route('admin.identitas.index')"
                :active="$page.url.startsWith('/admin/identitas')"
            >
                <template #icon>
                    <BriefcaseIcon
                        class="flex-shrink-0 w-6 h-6"
                        aria-hidden="true"
                    />
                </template>
            </SidebarLink>

            <!-- master data -->
            <SidebarCollapsible
                title="Master Data"
                :active="$page.url.startsWith('/admin/master-data/')"
            >
                <template #icon>
                    <CircleStackIcon
                        class="flex-shrink-0 w-6 h-6"
                        aria-hidden="true"
                    />
                </template>

                <SidebarCollapsibleItem
                    :href="route('admin.master-data.data-asatidz.index')"
                    title="Data Asatidz"
                    :active="
                        $page.url.startsWith('/admin/master-data/data-asatidz')
                    "
                />
                <SidebarCollapsibleItem
                    :href="route('admin.master-data.data-santri.index')"
                    title="Data Santri"
                    :active="
                        $page.url.startsWith('/admin/master-data/data-santri')
                    "
                />
                <SidebarCollapsibleItem
                    :href="route('components.buttons')"
                    title="Data Kitab"
                    :active="route().current('components.buttons')"
                />
                <SidebarCollapsibleItem
                    :href="route('components.buttons')"
                    title="Data Kelas"
                    :active="route().current('components.buttons')"
                />
                <SidebarCollapsibleItem
                    :href="route('components.buttons')"
                    title="Data Periode"
                    :active="route().current('components.buttons')"
                />
            </SidebarCollapsible>

            <!-- taqrir -->
            <SidebarLink
                title="Taqrir"
                :href="route('welcome')"
                :active="route().current('welcome')"
            >
                <template #icon>
                    <AcademicCapIcon
                        class="flex-shrink-0 w-6 h-6"
                        aria-hidden="true"
                    />
                </template>
            </SidebarLink>
        </section>
        <!-- END ADMIN MENU -->

        <!-- Examples -->
        <!--
        => External link example
        <SidebarLink
            title="Github"
            href="https://github.com/kamona-wd/kui-laravel-breeze"
            external
            target="_blank"
        >
        </SidebarLink>

        => Collapsible examples
        <SidebarCollapsible title="Users" :active="$page.url.startsWith('/users')">
            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="$page.url === '/users/index'" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="$page.url === '/users/create'" />
        </SidebarCollapsible>

        <SidebarCollapsible title="Users" :active="usePage().url.value.startsWith('/users')">
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="route().current('users.index')" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="route().current('users.create')" />
        </SidebarCollapsible>-->
    </PerfectScrollbar>
</template>
