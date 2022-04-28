<template>
    <section class="title-and-text-black">
        
        <div class="title-and-text-black__background-columns container">
            <div class="title-and-text-black__col-1">
                <figure class="title-and-text-black__figure title-and-text-black__floating">
                    <img src="@/assets/images/restauracja-zapiekanki.png" alt="restauracja-zapiekanki">
                </figure>
                <figure class="title-and-text-black__figure title-and-text-black__floating-main">
                    <img src="@/assets/images/restauracja-ramen.png" alt="restauracja-ramen">
                </figure>
            </div>
            <div class="title-and-text-black__col-2"></div>
            <div class="title-and-text-black__col-3"></div>
        </div>
        <div class="container">
            <div class="title-and-text-black__wrapper">
                <h2 class="title-and-text-black__big-title">
                    RESTAURACJA
                </h2>
                <div class="title-and-text-black__content-box">
                    <h3 class="title-and-text-black__title">
                        Lorem ipsum dolor
                    </h3>
                    <p class="title-and-text-black__text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.
                    </p>
                    <RouterLink class="title-and-text-black__button" to="/">
                        Dokonaj rezerwacji
                    </RouterLink>
                </div>
            </div>
        </div>
    </section>
</template>


<script>
    import gsap from 'gsap';
    import { ScrollTrigger } from "gsap/ScrollTrigger";

    gsap.registerPlugin(ScrollTrigger);
    
    export default {
        methods: {
            
            scrollAnimationThird() {
                gsap.set(".title-and-text-black__floating-main", {yPercent: 0});
                gsap.to(".title-and-text-black__floating-main", {
                    yPercent: 40,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".title-and-text-black",
                        scrub: 2
                    },
                });

                gsap.set(".title-and-text-black__floating", {yPercent: 40});
                gsap.to(".title-and-text-black__floating", {
                    yPercent: 0,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".title-and-text-black",
                        scrub: 2
                    },
                });

            },
            
        },
        mounted() {
            this.scrollAnimationThird();
        },
        
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.title-and-text-black {
    margin-top: 166px;
    position: relative;
    background-color: $black;
    padding: 258px 0;
    overflow: hidden;
    @include breakpoint-max('mobile') {
        overflow: hidden;
        padding-bottom: 200px;
    }
    &__background-columns {
        display: flex;
        position: absolute;
        left: 50%;
        top:0;
        width: 100%;
        height: 100%;
        transform: translateX(-50%);
        z-index: 1;

    }
    &__col-1, &__col-2, &__col-3 {
        flex: 1;
    }
    &__col-1 {
        position: relative;

        @include breakpoint-max('s-tablet') {
            border-right: none;
        }
    }
    &__col-2 {
        @include breakpoint-max('s-tablet') {
            display: none;
        }
    }
    &__col-3 {
        display: flex;
        align-items: flex-end;
    }
    &__col-1, &__col-3 {
        border-left: 1px solid rgba(245, 245, 245, 0.1);
        border-right: 1px solid rgba(245, 245, 245, 0.1);
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
    &__floating {
        position: absolute;
        left: 40%;
        top: 423px;
        transform: scale(0.7);
        z-index: 1;
        @include breakpoint-max('mobile') {
            top: 266px;
            left: 40%;
        }
    }
    &__button {
        @include gold-button;
    }
    &__wrapper {
        position: relative;
        z-index: 2;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        @include breakpoint-max('s-tablet') {
            align-items: flex-start;
        }
    }
    &__big-title {
        font-size: 14.4rem;
        line-height: 17.7rem;
        color: $white;
        font-weight: 700;
        @include breakpoint-max('s-tablet') {
            font-size: 9rem;
            line-height: 15rem;
        }
        @include breakpoint-max('mobile') {
            font-size: 4rem;
            line-height: 15rem;
        }
    }
    &__title {
        font-weight: 600;
        font-size: 2.4rem;
        line-height: 2.9rem;
        margin-top: 49px;
        margin-bottom: 22px;
        color: $white;

        @include breakpoint-max('mobile') {
            margin-top: 20px;
        }
    }
    &__text {
        font-weight: 400;
        font-size: 1.4rem;
        line-height: 1.7rem;
        margin-bottom: 32px;
        color: $white;

    }
    &__content-box {
        max-width: 570px;
    }
}
</style>