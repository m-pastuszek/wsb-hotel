<template>
    <section class="slider" :class="{ 'slider--single': isSingle}" id="slider">
            <h2 class="slider__title">
                Hotel
            </h2>
            <div class="slider__wrapper">
                <swiper
                :modules="autoplay"
                :slidesPerView="3"
                :spaceBetween="118"
                :slidesPerGroup="1"
                :loop="true"
                :loopFillGroupWithBlank="true"
                :speed="800"
                :autoplay='{
                    "delay": 4500,
                    "disableOnInteraction": false,
                }'
                :navigation='{
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev",
                }'
                >
                    <swiper-slide v-for=" (slide, index) in slides " :key="index">
                        <div class="slider__slide-box">
                            <figure class="slider__picture">
                                <img v-if="assetsImage == false" :src="getImageUrl(slide.imageUrl)" :alt="slide.alt">
                                <img v-if="assetsImage" :src="slide.url" :alt="slide.alt">
                            </figure>
                            <h3 v-if="!isSingle" class="slider__slide-title">
                                {{ slide.title }}
                            </h3>
                            <p v-if="!isSingle" class="slider__slide-text">
                                {{ slide.text }}
                            </p>
                            <RouterLink v-if="!isSingle" class="slider__slide-button" to="/">
                                Dokonaj rezerwacji
                            </RouterLink>
                        </div>
                    </swiper-slide>
                </swiper>
                <div class="swiper-button-prev">
                    <svg width="20" height="20" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.57 0.180128C7.76 0.180128 7.95 0.250128 8.10001 0.400127C8.39 0.690127 8.39 1.17013 8.1 1.46013L2.56 7.00013L8.1 12.5401C8.39 12.8301 8.39 13.3101 8.1 13.6001C7.81 13.8901 7.33 13.8901 7.04 13.6001L0.970003 7.53013C0.680003 7.24013 0.680003 6.76013 0.970003 6.47013L7.04 0.400127C7.19 0.250128 7.38 0.180128 7.57 0.180128Z" fill="white"/>
                        <path d="M1.67 6.25013L18.5 6.25013C18.91 6.25013 19.25 6.59013 19.25 7.00013C19.25 7.41013 18.91 7.75013 18.5 7.75013L1.67 7.75013C1.26 7.75013 0.920005 7.41013 0.920005 7.00013C0.920005 6.59013 1.26 6.25013 1.67 6.25013Z" fill="white"/>
                    </svg>
                </div>
                <div class="swiper-button-next">
                    <svg width="20" height="20" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.43 13.8199C12.24 13.8199 12.05 13.7499 11.9 13.5999C11.61 13.3099 11.61 12.8299 11.9 12.5399L17.44 6.99987L11.9 1.45987C11.61 1.16987 11.61 0.689873 11.9 0.399873C12.19 0.109873 12.67 0.109873 12.96 0.399873L19.03 6.46987C19.32 6.75987 19.32 7.23987 19.03 7.52987L12.96 13.5999C12.81 13.7499 12.62 13.8199 12.43 13.8199Z" fill="white"/>
                        <path d="M18.33 7.74987L1.5 7.74987C1.09 7.74987 0.749996 7.40987 0.749996 6.99987C0.749996 6.58987 1.09 6.24987 1.5 6.24987L18.33 6.24987C18.74 6.24987 19.08 6.58987 19.08 6.99987C19.08 7.40987 18.74 7.74987 18.33 7.74987Z" fill="white"/>
                    </svg>
                </div>
            </div>
    </section>
</template>


<script>
    // Import Swiper Vue.js components
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import SwiperCore, { Autoplay,Navigation} from 'swiper/core';
    SwiperCore.use([Autoplay, Navigation]);
    // Import Swiper styles
    import 'swiper/css/bundle';

    export default {
        props: {
            slides: Array,
            isSingle: Boolean,
            assetsImage: Boolean,
        },
        data() {
            return {
            }
        },
        methods: {
            getImageUrl(name) {
                if (this.assetsImage === true) {
                    return image;
                } else {
                    return new URL(`../assets/images/${name}.png`, import.meta.url).href
                }
			}
        },
        components: {
            Swiper,
            SwiperSlide,
        },
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.slider {
    background-color: $gold;
    padding-bottom: 66px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow-x: hidden;
    position: relative;
    z-index: 2;
    &--single {
        background-color: $white;
        .slider__title, .slider__slide-title, .slider__slide-text, .slider__slide-button {
            display: none;
        }
        .slider__picture {
            margin-bottom: 0;
        }
        .swiper-button-prev, .swiper-button-next {
            top: 50% !important;
            transform: translateY(-50%);
        }
    }
    &__wrapper {
        width: 128%;
        position: relative;
        @include breakpoint-max('s-tablet') {
            width: 300%;
        }
        .swiper-button-prev, .swiper-button-next {
            z-index: 2;
            top: 30%;
            &:hover {
                &::after {
                    background-color: $gold;
                }
            }
            &::after {
                content: "";
                width: 64px;
                height: 64px;
                border: 1px solid $white;
                border-radius: 50%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                transition: .3s ease;
                z-index: 1;
            }
            svg {
                z-index: 2;
            }
        }
        .swiper-button-next {
            right: 20%;
        }
        .swiper-button-prev {
            left: 20%;
        }
    }

    &__title {
        font-size: 28.8rem;
        line-height: 35.1rem;
        text-align: center;
        font-weight: 700;
        color: $white;
        font-family: "Montserrat", sans-serif;
        transform: translateY(120px);
        @include breakpoint-max('s-tablet') {
            font-size: 18rem;
            transform: translateY(100px);
        }
    }
    &__slide-box {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    &__picture {
        padding-top: 56%;
        position: relative;
        height: 0;
        width: 100%;
        margin-bottom: 48px;
        img {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }
    &__slide-title {
        font-size: 2.4rem;
        line-height: 2.9rem;
        font-weight: 600;
        text-align: center;
        color: $white;
        margin-bottom: 16px;
    }
    &__slide-text {
        font-size: 1.4rem;
        line-height: 1.7rem;
        font-weight: 400;
        text-align: center;
        color: $white;
        margin-bottom: 24px;
    }
    &__slide-button {
        @include gold-button;
        background-color: $white;
        color: $gold;
        border-color: $white;
        &:hover {
            background-color: $gold;
            color: $white !important;
        }
    }
}
</style>