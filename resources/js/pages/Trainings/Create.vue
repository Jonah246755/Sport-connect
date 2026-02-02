<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineOptions({ layout: AppLayout })

type Team = { id: number; name: string }

const props = defineProps<{ teams: Team[] }>()

const form = useForm({
  team_id: props.teams[0]?.id ?? null,
  starts_at: '',
  location: '',
  notes: '',
})

const submit = () => {
  form.post(route('trainings.store'))
}
</script>

<template>
  <Head title="Create training" />

  <div class="p-6 space-y-6 max-w-xl">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Create training</h1>
      <Link :href="route('trainings.index')" class="underline">Back</Link>
    </div>

    <form class="space-y-4" @submit.prevent="submit">
      <div>
        <label class="block text-sm mb-1">Team</label>
        <select v-model="form.team_id" class="w-full border rounded px-3 py-2 bg-transparent">
          <option v-for="t in teams" :key="t.id" :value="t.id">{{ t.name }}</option>
        </select>
        <div v-if="form.errors.team_id" class="text-sm text-red-500 mt-1">{{ form.errors.team_id }}</div>
      </div>

      <div>
        <label class="block text-sm mb-1">Starts at</label>
        <input v-model="form.starts_at" type="datetime-local" class="w-full border rounded px-3 py-2 bg-transparent" />
        <div v-if="form.errors.starts_at" class="text-sm text-red-500 mt-1">{{ form.errors.starts_at }}</div>
      </div>

      <div>
        <label class="block text-sm mb-1">Location</label>
        <input v-model="form.location" type="text" class="w-full border rounded px-3 py-2 bg-transparent" />
        <div v-if="form.errors.location" class="text-sm text-red-500 mt-1">{{ form.errors.location }}</div>
      </div>

      <div>
        <label class="block text-sm mb-1">Notes</label>
        <textarea v-model="form.notes" rows="4" class="w-full border rounded px-3 py-2 bg-transparent" />
        <div v-if="form.errors.notes" class="text-sm text-red-500 mt-1">{{ form.errors.notes }}</div>
      </div>

      <button type="submit" class="underline" :disabled="form.processing">
        Save
      </button>
    </form>
  </div>
</template>
