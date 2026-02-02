<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
</script>

<template>
  <Head title="Home" />

  <div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md space-y-6 rounded-xl border border-sidebar-border/70 p-6">
      <h1 class="text-2xl font-semibold">SportConnect</h1>
      <p class="opacity-70">Log in om verder te gaan.</p>

      <div class="flex gap-3">
        <Link :href="route('login')" class="underline">Log in</Link>
        <Link :href="route('register')" class="underline">Register</Link>
      </div>
    </div>
  </div>
</template>
