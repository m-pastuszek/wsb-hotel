<template>
    <section class="big-title-on-white">
        <div class="big-title-on-white__anchor-div" id="spa"></div>
        <div class="big-title-on-white__background-columns container">
            <div class="big-title-on-white__col-1"></div>
            <div class="big-title-on-white__col-2"></div>
            <div class="big-title-on-white__col-3">
                <figure class="big-title-on-white__figure floating">
                    <img src="@/assets/images/spa-man.jpg" alt="masaż mężczyzna">
                </figure>
                <figure class="big-title-on-white__figure floating-main">
                    <img src="@/assets/images/spa-massage.jpg" alt="masaż kobieta">
                </figure>
            </div>
        </div>
        <div class="container">
            <div class="big-title-on-white__wrapper">
                <h2 class="big-title-on-white__big-title">
                    SPA
                </h2>
                <h3 class="big-title-on-white__title">
                    Lorem ipsum dolor
                </h3>
                <p class="big-title-on-white__text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.
                </p>
                <RouterLink class="big-title-on-white__button" to="/rezerwacja">
                    Dokonaj rezerwacji
                </RouterLink>
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
            
            scrollAnimationSecond() {
                gsap.set(".floating-main", {yPercent: 40});
                gsap.to(".floating-main", {
                    yPercent: 0,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".big-title-on-white",
                        scrub: 2
                    },
                });

                gsap.set(".floating", {yPercent: -20});
                gsap.to(".floating", {
                    yPercent: 0,
                    ease: "power3.easeInOut",
                    scrollTrigger: {
                        trigger: ".big-title-on-white",
                        scrub: 2
                    },
                });

            },
            
        },
        mounted() {
            this.scrollAnimationSecond();
        },
        
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.big-title-on-white {
    margin-top: 166px;
    margin-bottom: 182px;
    position: relative;
    z-index: 1;
    @include breakpoint-max('mobile') {
        overflow: hidden;
        padding-bottom: 200px;
    }
    &__anchor-div {
        position: absolute;
        top: -250px;
        left: 0;
        height: 0;
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
        position: relative;
    }
    &__col-1, &__col-3 {
        border-left: 1px solid #F5F5F5;
        border-right: 1px solid #F5F5F5;
    }
    
    &__figure {
        position: relative;
        width: 100%;
        height: 0;
        padding-top: 117%;
        z-index: -1;
        img {
            position: absolute;
            left: 0;
            top: 0;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        &.floating {
            position: absolute;
            left: -40%;
            top: -123px;
            transform: scale(0.7);
            z-index: 1;
            @include breakpoint-max('mobile') {
                top: 266px;
                left: 40%;
            }
        }
    }
    &__button {
        @include gold-button;
    }
    &__wrapper {
        position: relative;
        z-index: 2;
        max-width: 650px;
    }
    &__big-title {
        font-size: 28.8rem;
        line-height: 25.1rem;
        color: $black;
        font-weight: 700;
        @include breakpoint-max('mobile') {
            font-size: 10rem;
            line-height: 15rem;
        }
    }
    &__title {
        font-weight: 600;
        font-size: 2.4rem;
        line-height: 2.9rem;
        margin-top: 72px;
        margin-bottom: 22px;
        @include breakpoint-max('mobile') {
            margin-top: 20px;
        }
    }
    &__text {
        font-weight: 400;
        font-size: 1.4rem;
        line-height: 1.7rem;
        margin-bottom: 32px;
    }
}
</style>