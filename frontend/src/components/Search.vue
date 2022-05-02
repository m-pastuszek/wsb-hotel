<template>
    <section class="search">
        <div class="container">
            <div class="search__wrapper">
                <div v-for="(room, index) in rooms" :key="index" class="search__room">
                    <figure class="search__room-figure">
                        <img :src="'/src/assets/images/' + room.thumbNail" alt="">
                    </figure>
                    <div class="search__room-content">
                        <h3 class="search__room-title">
                            {{ room.title }}
                        </h3>
                        <p class="search__room-desc">
                            {{ room.desc }}
                        </p>
                        <div class="search__room-features">
                            <span>Udogodnienia</span>
                            <ul>
                                <li v-for="(feature, index) in room.features" :key="index">{{ feature }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="search__price-col">
                        <span class="search__price">{{ room.price }} zł/noc</span>
                        <span class="search__price-comment">Za osobę</span>
                        <RouterLink class="search__booking" to="/rezerwacja">Dokonaj rezerwacji</RouterLink>
                        <RouterLink class="search__show-more" to="/rezerwacja">Zobacz więcej</RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<script>
    export default {
        data() {
            return {
                rooms: [
                    {
                        id: '1',
                        thumbNail: 'bed.png',
                        title: 'Pokój Standard - 2+2',
                        desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.',
                        features: ['Klimatyzacja', 'Room Service', 'WI-FI'],
                        price: '250',
                    },
                    {
                        id: '2',
                        thumbNail: 'photo-umbrella.jpg',
                        title: 'Pokój Standard - 2+2',
                        desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.',
                        features: ['Klimatyzacja', 'Room Service', 'WI-FI'],
                        price: '250',
                    },
                    {
                        id: '3',
                        thumbNail: 'restauracja-ramen.png',
                        title: 'Pokój Standard - 2+2',
                        desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec nibh arcu nec donec. Egestas amet commodo, amet, eget risus purus. Sed mi nunc, quis odio id cras pellentesque. Adipiscing aenean etiam urna blandit. Non vitae interdum arcu sit nascetur turpis lorem sit.',
                        features: ['Klimatyzacja', 'Room Service', 'WI-FI'],
                        price: '250',
                    }
                ]
            }
        }
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.search {
    &__wrapper {
        
    }
    &__room {
        display: flex;
        align-items: flex-end;
        margin-bottom: 64px;
        @include breakpoint-max('s-tablet') {
            flex-direction: column;
            align-items: center;
        }
        &-figure {
            max-width: 274px;
            width: 100%;
            height: 274px;
            flex: 1;
            margin-right: 24px;
            @include breakpoint-max('s-tablet') {
                margin-bottom: 16px;
                margin-right: 0;
                width: 200px;
                height: 200px;
            }
            img {
                width: 100%;
                height: 100%;
                @include breakpoint-max('s-tablet') {
                    width: 200px;
                    height: 200px;
                }
                object-fit: cover;
            }

        }
        &-content {
            flex: 1;
            @include breakpoint-max('s-tablet') {
                text-align: center;
            }
        }
        
        &-title {
            font-weight: 600;
            color: $black;
            font-size: 2.4rem;
            line-height: 2.9rem;
            margin-bottom: 16px;
        }
        &-desc {
            max-width: 468px;
            margin-bottom: 46px;
            font-size: 1.4rem;
            line-height: 1.7rem;
            font-weight: 400;
            @include breakpoint-max('s-tablet') {
                margin-bottom: 16px;
            }
        }
        &-features {
            span {
                font-weight: 600;
                font-size: 1.4rem;
                line-height: 1.7rem;
                margin-bottom: 16px;
                display: inline-block;
            }
            ul {
                display: flex;
                list-style: none;
                @include breakpoint-max('s-tablet') {
                    justify-content: center;
                    margin-bottom: 16px;
                }
                li {
                    margin-right: 32px;
                    
                    &:last-child {
                        margin-right: 0;
                    }
                }
            }
        }
    }
    &__price-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-left: 40px;
        @include breakpoint-max('s-tablet') {
            margin-left: 0;
        }
    }
    &__price {
        color: $black;
        font-weight: 600;
        font-size: 2.4rem;
        line-height: 2.9rem;
    }
    &__price-comment {
        font-weight: 400;
        color: $gray;
        font-size: 1.4rem;
        line-height: 1.7rem;
        margin-bottom: 16px;
    }
    &__booking {
        @include gold-button;
        margin-bottom: 16px;;
    }
    &__show-more {
        color: $gold;
    }
}
</style>