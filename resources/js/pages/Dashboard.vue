<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

type Stats = {
    sports: number;
    teams: number;
    players: number;
    trainings: number;
    injured_players: number;
};

const props = defineProps<{
    stats: Stats;
}>();

const hasAnyData =
    props.stats.sports > 0 ||
    props.stats.teams > 0 ||
    props.stats.players > 0 ||
    props.stats.trainings > 0;
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">Dashboard</h1>
                    <p class="text-sm opacity-70">
                        Overzicht van je Sportteam Management Tool.
                    </p>
                </div>

                <div class="flex gap-3">
                    <Link
                        :href="route('sports.create')"
                        class="rounded-md border border-sidebar-border/70 px-3 py-2 text-sm hover:bg-white/5"
                    >
                        + Sport
                    </Link>
                    <Link
                        :href="route('teams.create')"
                        class="rounded-md border border-sidebar-border/70 px-3 py-2 text-sm hover:bg-white/5"
                    >
                        + Team
                    </Link>
                    <Link
                        :href="route('players.create')"
                        class="rounded-md border border-sidebar-border/70 px-3 py-2 text-sm hover:bg-white/5"
                    >
                        + Player
                    </Link>
                    <Link
                        :href="route('trainings.create')"
                        class="rounded-md border border-sidebar-border/70 px-3 py-2 text-sm hover:bg-white/5"
                    >
                        + Training
                    </Link>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-5">
                <Link
                    :href="route('sports.index')"
                    class="rounded-xl border border-sidebar-border/70 p-4 hover:bg-white/5"
                >
                    <div class="text-sm opacity-70">Sports</div>
                    <div class="mt-2 text-3xl font-semibold">
                        {{ stats.sports }}
                    </div>
                </Link>

                <Link
                    :href="route('teams.index')"
                    class="rounded-xl border border-sidebar-border/70 p-4 hover:bg-white/5"
                >
                    <div class="text-sm opacity-70">Teams</div>
                    <div class="mt-2 text-3xl font-semibold">
                        {{ stats.teams }}
                    </div>
                </Link>

                <Link
                    :href="route('players.index')"
                    class="rounded-xl border border-sidebar-border/70 p-4 hover:bg-white/5"
                >
                    <div class="text-sm opacity-70">Players</div>
                    <div class="mt-2 text-3xl font-semibold">
                        {{ stats.players }}
                    </div>
                </Link>

                <Link
                    :href="route('trainings.index')"
                    class="rounded-xl border border-sidebar-border/70 p-4 hover:bg-white/5"
                >
                    <div class="text-sm opacity-70">Trainings</div>
                    <div class="mt-2 text-3xl font-semibold">
                        {{ stats.trainings }}
                    </div>
                </Link>

                <div
                    class="rounded-xl border border-sidebar-border/70 p-4"
                >
                    <div class="text-sm opacity-70">Injured players</div>
                    <div class="mt-2 text-3xl font-semibold">
                        {{ stats.injured_players }}
                    </div>
                </div>
            </div>

            <div
                v-if="!hasAnyData"
                class="rounded-xl border border-sidebar-border/70 p-6"
            >
                <div class="text-lg font-semibold">Nog geen data</div>
                <p class="mt-2 text-sm opacity-70">
                    Begin met het aanmaken van een sport, daarna teams, daarna spelers. Trainings koppel je aan een team.
                </p>

                <div class="mt-4 flex flex-wrap gap-3">
                    <Link
                        :href="route('sports.create')"
                        class="rounded-md border border-sidebar-border/70 px-3 py-2 text-sm hover:bg-white/5"
                    >
                        Maak je eerste sport
                    </Link>
                    <Link
                        :href="route('teams.create')"
                        class="rounded-md border border-sidebar-border/70 px-3 py-2 text-sm hover:bg-white/5"
                    >
                        Maak je eerste team
                    </Link>
                    <Link
                        :href="route('players.create')"
                        class="rounded-md border border-sidebar-border/70 px-3 py-2 text-sm hover:bg-white/5"
                    >
                        Maak je eerste player
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
