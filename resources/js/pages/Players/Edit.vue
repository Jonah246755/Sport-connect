<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineOptions({ layout: AppLayout })

type Team = { id: number; name: string }
type Player = { id: number; team_id: number; name: string; jersey_number: number | null; injured: boolean; notes: string | null }

const props = defineProps<{ player: Player; teams: Team[] }>()

const form = useForm({
  team_id: props.player.team_id,
  name: props.player.name,
  jersey_number: props.player.jersey_number,
  injured: props.player.injured,
  notes: props.player.notes ?? '',
})

const submit = () => {
  form.put(route('players.update', props.player.id))
}
</script>

<template>
  <Head title="Edit player" />

  <div class="p-6 space-y-6 max-w-xl">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Edit player</h1>
      <Link :href="route('players.index')" class="underline">Back</Link>
    </div>

    <form class="space-y-4" @submit.prevent="submit">
      <div class="space-y-1">
        <label class="text-sm">Team</label>
        <select v-model="form.team_id" class="w-full border rounded px-3 py-2">
          <option v-for="t in teams" :key="t.id" :value="t.id">{{ t.name }}</option>
        </select>
        <div v-if="form.errors.team_id" class="text-sm text-red-600">{{ form.errors.team_id }}</div>
      </div>

      <div class="space-y-1">
        <label class="text-sm">Name</label>
        <input v-model="form.name" class="w-full border rounded px-3 py-2" />
        <div v-if="form.errors.name" class="text-sm text-red-600">{{ form.errors.name }}</div>
      </div>

      <div class="space-y-1">
        <label class="text-sm">Jersey number (optional)</label>
        <input v-model.number="form.jersey_number" type="number" class="w-full border rounded px-3 py-2" />
        <div v-if="form.errors.jersey_number" class="text-sm text-red-600">{{ form.errors.jersey_number }}</div>
      </div>

      <label class="flex items-center gap-2">
        <input v-model="form.injured" type="checkbox" />
        <span class="text-sm">Injured</span>
      </label>

      <div class="space-y-1">
        <label class="text-sm">Notes (optional)</label>
        <textarea v-model="form.notes" class="w-full border rounded px-3 py-2" rows="4" />
      </div>

      <div class="flex gap-3">
        <button type="submit" class="border rounded px-4 py-2" :disabled="form.processing">
          Save changes
        </button>
      </div>
    </form>
  </div>
</template>
w