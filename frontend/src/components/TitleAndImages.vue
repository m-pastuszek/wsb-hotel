<template>
    <section class="title-and-image">
        <div class="container">
            <div class="title-and-image__wrapper">
                <div class="title-and-image__col-1 col">
                    <figure class="title-and-image__figure first-photo">
                        <img src="@/assets/images/photo-umbrella.jpg" alt="plażowicze pod parasolem">
                    </figure>
                </div>
                <div class="title-and-image__col-2 col">
                    
                </div>
                <div class="title-and-image__col-3 col">
                    <figure class="title-and-image__figure second-photo">
                        <img src="@/assets/images/snorkling.jpg" alt="plażowicze pod parasolem">
                    </figure>
                    <figure class="title-and-image__figure third-photo">
                        <img src="@/assets/images/coast.jpg" alt="plażowicze pod parasolem">
                    </figure>
                </div>
            </div>
        </div>
        <h3 class="title-and-image__title">
            Witaj w raju
        </h3>
    </section>
</template>


<script>
    import gsap from 'gsap';
    import { ScrollTrigger } from "gsap/ScrollTrigger";

    gsap.registerPlugin(ScrollTrigger);
    
    export default {
        methods: {
            
            scrollAnimation() {
                gsap.set(".first-photo", {yPercent: -20});
                gsap.to(".first-photo", {
                    yPercent: 10,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".title-and-image",
                        scrub: 2
                    },
                });

                gsap.set(".second-photo", {yPercent: -20});
                gsap.to(".second-photo", {
                    yPercent: 50,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".title-and-image",
                        scrub: 2
                    },
                });

                gsap.set(".third-photo", {yPercent: 40});
                gsap.to(".third-photo", {
                    yPercent: -30,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".title-and-image",
                        scrub: 2
                    },
                });

                gsap.set(".title-and-image__title", {opacity: 0});
                gsap.to(".title-and-image__title", {
                    opacity: 1,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".title-and-image",
                        scrub: 1
                    },
                });
            },
            
        },
        mounted() {
            this.scrollAnimation();
        },
        
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.title-and-image {
    position: relative;
    padding-bottom: 152px;
    &__wrapper {
        display: flex;
        .col {
            flex: 1;
        }
        .third-photo {
            position: relative;
            z-index: 3;
        }
    }
    &__figure {
        position: relative;
        width: 100%;
        height: 0;
        padding-top: 117%;
        img {
            position: absolute;
            left: 0;
            top: 0;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    }
    &__col-1 {
        padding-top: 290px;
        border-left: 1px solid #F5F5F5;
        border-right: 1px solid #F5F5F5;
    }
    &__col-2 {
        @include breakpoint-max('s-tablet') {
            display: none;
        }
    }
    &__col-3 {
        border-left: 1px solid #F5F5F5;
        border-right: 1px solid #F5F5F5;
        figure:last-child {
            margin-top: 450px;
        }
    }
    &__title {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        color: $gold;
        font-weight: 700;
        font-size: 14.4rem;
        line-height: 17.5rem;
        white-space: nowrap;
        @include breakpoint-max('s-tablet') {
            font-size: 5rem;
        }
    }
}
</style>