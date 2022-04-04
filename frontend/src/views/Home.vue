

<template>
  <div class="home">
    <Hero/>
    <GoldBar/>
    <TitleAndImages/>
    <BigTitleOnWhite/>
  </div>
</template>

<script setup>
import Hero from '@/components/Hero.vue'
import GoldBar from '@/components/GoldBar.vue'
import TitleAndImages from '@/components/TitleAndImages.vue'
import BigTitleOnWhite from '@/components/BigTitleOnWhite.vue'




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
