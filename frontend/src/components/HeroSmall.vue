<template>
    <section class="hero-small">
        <img class="hero-small__background" src="@/assets/images/rezerwacja-hero.png" alt="">
        <div class="container">
            <div class="hero-small__wrapper">
                <h1>REZERWACJA</h1>
            </div>
        </div>
    </section>
</template>


<script>

</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.hero-small {
    position: relative;
    min-height: 450px;
    margin-bottom: 32px;
    &__background {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        left: 0;
        top: 0;
        z-index: 1;
    }
    &__wrapper {
        position: relative;
        z-index: 2;
        min-height: 450px;
        display: flex;
        justify-content: center;
        align-items: center;
        h1 {
            font-size: 14.4rem;
            line-height: 17.4rem;
            font-weight: 700;
            text-align: center;
            color: $white;
            @include breakpoint-max('tablet') {
                font-size: 10rem;
            }
            @include breakpoint-max('s-tablet') {
                font-size: 8rem;
            }
            @include breakpoint-max('mobile') {
                font-size: 6rem;
            }
        }
    }
}
</style>