<template>
    <section class="gold-bar">
        <div class="gold-bar__wrapper">
            <div class="gold-bar__box">
                <p class="gold-bar__line-first">
                    <span> HOTEL PRINCE RESORT BALI </span>
                    <svg width="71" height="68" viewBox="0 0 71 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M42.5451 26.5236L42.8819 27.5599H43.9716H66.396L48.3323 40.728L47.4659 41.3596L47.783 42.3837L54.5139 64.1243L36.3836 50.9076L35.5 50.2635L34.6164 50.9076L16.4861 64.1243L23.217 42.3837L23.5341 41.3596L22.6677 40.728L4.60402 27.5599H27.0284H28.1181L28.4549 26.5236L35.5 4.85191L42.5451 26.5236Z" stroke="white" stroke-width="3"/>
                    </svg>
                    <span> HOTEL PRINCE RESORT BALI </span>
                </p>
                <p class="gold-bar__line-first gold-bar__line-second">
                    <span> HOTEL PRINCE RESORT BALI </span>
                    <svg width="71" height="68" viewBox="0 0 71 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M42.5451 26.5236L42.8819 27.5599H43.9716H66.396L48.3323 40.728L47.4659 41.3596L47.783 42.3837L54.5139 64.1243L36.3836 50.9076L35.5 50.2635L34.6164 50.9076L16.4861 64.1243L23.217 42.3837L23.5341 41.3596L22.6677 40.728L4.60402 27.5599H27.0284H28.1181L28.4549 26.5236L35.5 4.85191L42.5451 26.5236Z" stroke="white" stroke-width="3"/>
                    </svg>
                    <span> HOTEL PRINCE RESORT BALI </span>
                </p>
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

.gold-bar {
    background-color: $gold;
    overflow: hidden;
    padding: 10px 0;
    position: relative;
    z-index: 3;
    p {
        color: $white;
        font-family: 'Raleway', sans-serif;
        font-size: 9.6rem;
        font-weight: 200;
        white-space: nowrap;
        line-height: 96px;
    }
    &__box {
        display: flex;
        align-items: center;
    }
    &__line-first {
        display: inline-block;
        padding-left: 100%;
        animation: gold-bar 14s linear infinite;
    }
    &__line-second {
        animation-delay: 7s;
    }
    @keyframes gold-bar {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(-100%, 0);
        }
    }
}
</style>