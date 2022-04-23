

<template>
  <div class="home">
    <Hero/>
    <GoldBar/>
    <TitleAndImages/>
    <Slider/>
    <BigTitleOnWhite/>
    <TitleAndTextOnBlack/>
    <ContactForm/>
  </div>
</template>

<script setup>
import Hero from '@/components/Hero.vue'
import GoldBar from '@/components/GoldBar.vue'
import TitleAndImages from '@/components/TitleAndImages.vue'
import BigTitleOnWhite from '@/components/BigTitleOnWhite.vue'
import TitleAndTextOnBlack from '@/components/TitleAndTextOnBlack.vue'
import Slider from '@/components/Slider.vue'
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
