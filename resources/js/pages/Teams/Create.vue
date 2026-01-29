<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })

type Sport = { id: number; name: string }

const props = defineProps<{ sports: Sport[] }>()

const form = useForm({
  sport_id: props.sports[0]?.id ?? null,
  name: '',
})

const submit = () => form.post('/teams')
</script>

<template>
  <Head title="Create team" />

  <div class="p-6 space-y-6 max-w-xl">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Create team</h1>
      <Link href="/teams" class="underline">Back</Link>
    </div>

    <form class="space-y-4" @submit.prevent="submit">
      <div class="space-y-1">
        <label class="text-sm">Sport</label>
        <select v-model="form.sport_id" class="w-full border rounded px-3 py-2">
          <option v-for="s in sports" :key="s.id" :value="s.id">{{ s.name }}</option>
        </select>
        <div v-if="form.errors.sport_id" class="text-sm text-red-600">{{ form.errors.sport_id }}</div>
      </div>

      <div class="space-y-1">
        <label class="text-sm">Team name</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" />
        <div v-if="form.errors.name" class="text-sm text-red-600">{{ form.errors.name }}</div>
      </div>

      <button type="submit" class="border rounded px-4 py-2" :disabled="form.processing">
        Save
      </button>
    </form>
  </div>
</template>
