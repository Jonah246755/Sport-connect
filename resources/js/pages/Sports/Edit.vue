<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })

const props = defineProps<{ sport: { id: number; name: string } }>()

const form = useForm({
  name: props.sport.name,
})

const submit = () => form.put(`/sports/${props.sport.id}`)
</script>

<template>
  <Head title="Edit sport" />

  <div class="p-6 space-y-6 max-w-xl">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Edit sport</h1>
      <Link href="/sports" class="underline">Back</Link>
    </div>

    <form class="space-y-4" @submit.prevent="submit">
      <div class="space-y-1">
        <label class="text-sm">Name</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" />
        <div v-if="form.errors.name" class="text-sm text-red-600">{{ form.errors.name }}</div>
      </div>

      <button type="submit" class="border rounded px-4 py-2" :disabled="form.processing">
        Update
      </button>
    </form>
  </div>
</template>
