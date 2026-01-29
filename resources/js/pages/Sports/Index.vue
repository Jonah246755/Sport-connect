<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })

type Sport = { id: number; name: string }

defineProps<{ sports: Sport[] }>()

const destroySport = (id: number) => {
  if (!confirm('Sport verwijderen?')) return
  router.delete(`/sports/${id}`)
}
</script>

<template>
  <Head title="Sports" />

  <div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Sports</h1>
      <Link href="/sports/create" class="underline">+ New sport</Link>
    </div>

    <div class="border rounded-md divide-y">
      <div v-for="sport in sports" :key="sport.id" class="flex items-center justify-between p-4">
        <div>{{ sport.name }}</div>

        <div class="flex gap-4">
          <Link :href="`/sports/${sport.id}/edit`" class="underline">Edit</Link>
          <button type="button" class="underline" @click="destroySport(sport.id)">Delete</button>
        </div>
      </div>

      <div v-if="sports.length === 0" class="p-4 text-sm opacity-70">
        No sports yet.
      </div>
    </div>
  </div>
</template>
