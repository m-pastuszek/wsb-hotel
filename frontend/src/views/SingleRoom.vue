<template>
    <div class="single-room">
        <HeroSmall :title="roomTitle" :assetsImage="true" :image="heroImage"/>
        <Slider :slides="slides" :assetsImage="true" isSingle="true"/>
        <div class="container">
            <div class="single-room__wrapper" v-if="rooms">
                <div v-for="(room, index) in rooms" :key="index" class="single-room__room">
                    <div class="single-room__main-box">
                        <RouterLink to="/rezerwacja">
                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.42276 -1.32737e-06C4.54602 -1.31121e-06 4.66928 0.0410615 4.76659 0.129054C4.95472 0.299173 4.95472 0.58075 4.76659 0.750869L1.17259 4.00073L4.76659 7.2506C4.95472 7.42072 4.95472 7.70229 4.76659 7.87241C4.57846 8.04253 4.26706 8.04253 4.07893 7.87241L0.141101 4.31164C-0.0470329 4.14152 -0.0470328 3.85994 0.141101 3.68983L4.07893 0.129054C4.17624 0.0410615 4.2995 -1.34354e-06 4.42276 -1.32737e-06Z" fill="#DDC261"/>
                                <path d="M0.595217 3.56077L11.5134 3.56077C11.7794 3.56077 12 3.76022 12 4.00073C12 4.24125 11.7794 4.4407 11.5134 4.4407L0.595217 4.4407C0.329235 4.4407 0.108665 4.24125 0.108665 4.00073C0.108665 3.76022 0.329235 3.56077 0.595217 3.56077Z" fill="#DDC261"/>
                            </svg>
                            <span>Powrót</span>
                        </RouterLink>
                        <h1 class="single-room__title">
                            {{ room.room_type.description }}
                        </h1>
                        <p class="single-room__text">
                            {{ room.description }}
                        </p>
                        <div class="single-room__room-features">
                            <span>Udogodnienia</span>
                            <ul>
                                <li v-for="(feature, index) in room.amenities" :key="index">{{ feature.name }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-room__side-box">

                    </div>
                </div>
            </div>
        </div>
        <ContactForm/>
    </div>
</template>

<script setup>
    import ContactForm from '@/components/ContactForm.vue';
    import HeroSmall from '@/components/HeroSmall.vue';
    import Slider from '@/components/Slider.vue';

</script>
<script>
    import axios from 'axios';


    export default {
        data() {
            return {
                slides: [],
                heroImage: '',

                searchStatus: false,
                rooms: [],
                seaView: false,
                startDate: null,
                endDate: null,
                roomTitle: '',
                filters: [
                    { id: 1 },
                ],
                
            }
        },
        methods: {

        },
        computed: {

        },
        mounted() {
             axios.get('https://hotel.mpastuszek.pl/api/rooms/'+this.$route.params.id)
                .then(response => {
                    this.rooms = response.data;
                    this.roomTitle = this.rooms.data.room_type.name;
                    this.heroImage = this.rooms.data.photos[0].url;

                    this.slides = this.rooms.data.photos;

                    if (this.rooms.data.length == 0) {
                        this.searchStatus = true;
                    } else {
                        this.searchStatus = false;
                    }
                })
        }
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.single-room {


}
</style>