

<template>
  <div class="booking">
    <HeroSmall title="REZERWACJA" image="rezerwacja-hero"/>
    <Search/>
    <ContactForm/>
  </div>
</template>

<script setup>
import HeroSmall from '@/components/HeroSmall.vue'
import Search from '@/components/Search.vue'
import ContactForm from '@/components/ContactForm.vue'




</script>


<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
