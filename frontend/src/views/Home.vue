

<template>
  <div class="home">
    <Hero/>
    <GoldBar/>
    <TitleAndImages/>
    <Slider :slides="slides"/>
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
<script>

export default {
    data() {
      return {
        slides: [
          {
              imageUrl: 'bed',
              alt: 'łóżko w pokoju hotelowym',
              title: 'Lorem ipsum dolor 1',
              text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.',
              buttonText: 'Dokonaj rezerwacji',
              buttonLink: '#',
          },
          {
              imageUrl: 'elegant-woman',

              title: 'Lorem ipsum dolor 2',
              text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.',
              buttonText: 'Dokonaj rezerwacji',
              buttonLink: '#',
          },
          {
              imageUrl: 'assian-buisness',

              title: 'Lorem ipsum dolor 3',
              text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.',
              buttonText: 'Dokonaj rezerwacji',
              buttonLink: '#',
          }
      ]
      }
    }
}
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
