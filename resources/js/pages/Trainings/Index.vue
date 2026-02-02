<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineOptions({ layout: AppLayout })

type Training = {
  id: number
  starts_at: string
  location: string | null
  team: { id: number; name: string }
}

defineProps<{ trainings: Training[] }>()

const destroyTraining = (id: number) => {
  if (!confirm('Training verwijderen?')) return
  router.delete(route('trainings.destroy', id))
}
</script>

<template>
  <Head title="Trainings" />

  <div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Trainings</h1>
      <Link :href="route('trainings.create')" class="underline">+ New training</Link>
    </div>

    <div class="border rounded-md divide-y">
      <div v-for="t in trainings" :key="t.id" class="flex items-center justify-between p-4">
        <div>
          <div class="font-medium">{{ t.team.name }}</div>
          <div class="text-sm opacity-70">
            {{ new Date(t.starts_at).toLocaleString() }}
            <span v-if="t.location">• {{ t.location }}</span>
          </div>
        </div>

        <div class="flex gap-4">
          <Link :href="route('trainings.edit', t.id)" class="underline">Edit</Link>
          <button type="button" class="underline" @click="destroyTraining(t.id)">Delete</button>
        </div>
      </div>

      <div v-if="trainings.length === 0" class="p-4 text-sm opacity-70">
        No trainings yet.
      </div>
    </div>
  </div>
</template>
