<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineOptions({ layout: AppLayout })

type Player = {
  id: number
  name: string
  jersey_number: number | null
  injured: boolean
  team: { id: number; name: string } | null
}

defineProps<{ players: Player[] }>()

const destroyPlayer = (id: number) => {
  if (!confirm('Player verwijderen?')) return
  router.delete(route('players.destroy', id))
}
</script>

<template>
  <Head title="Players" />

  <div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Players</h1>
      <Link :href="route('players.create')" class="underline">+ New player</Link>
    </div>

    <div class="border rounded-md divide-y">
      <div v-for="p in players" :key="p.id" class="flex items-center justify-between p-4">
        <div>
          <div class="font-medium">
            {{ p.name }}
            <span v-if="p.jersey_number !== null" class="opacity-70">#{{ p.jersey_number }}</span>
            <span v-if="p.injured" class="ml-2 text-sm opacity-70">(injured)</span>
          </div>
          <div class="text-sm opacity-70">{{ p.team?.name ?? '-' }}</div>
        </div>

        <div class="flex gap-4">
          <Link :href="route('players.edit', p.id)" class="underline">Edit</Link>
          <button type="button" class="underline" @click="destroyPlayer(p.id)">Delete</button>
        </div>
      </div>

      <div v-if="players.length === 0" class="p-4 text-sm opacity-70">
        No players yet.
      </div>
    </div>
  </div>
</template>
