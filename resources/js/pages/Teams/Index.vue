<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })

type Team = { id: number; name: string; sport: { id: number; name: string } }

defineProps<{ teams: Team[] }>()

const destroyTeam = (id: number) => {
  if (!confirm('Team verwijderen?')) return
  router.delete(`/teams/${id}`)
}
</script>

<template>
  <Head title="Teams" />

  <div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Teams</h1>
      <Link href="/teams/create" class="underline">+ New team</Link>
    </div>

    <div class="border rounded-md divide-y">
      <div v-for="team in teams" :key="team.id" class="flex items-center justify-between p-4">
        <div>
          <div class="font-medium">{{ team.name }}</div>
          <div class="text-sm opacity-70">{{ team.sport.name }}</div>
        </div>

        <div class="flex gap-4">
          <Link :href="`/teams/${team.id}/edit`" class="underline">Edit</Link>
          <button type="button" class="underline" @click="destroyTeam(team.id)">Delete</button>
        </div>
      </div>

      <div v-if="teams.length === 0" class="p-4 text-sm opacity-70">
        No teams yet.
      </div>
    </div>
  </div>
</template>
