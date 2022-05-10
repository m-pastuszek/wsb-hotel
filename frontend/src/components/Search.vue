<template>
    <section class="search">
        <div class="container">
            <div class="search__filter-wrapper">
                <div class="search__filter-first-row">
                    <input v-model="startDate" type="date" name="booking-start">
                    <input v-model="endDate" type="date" name="booking-start">
                </div>
                <div class="search__filter-second-row">
                    <h3>Dodatkowe opcje</h3>
                    <label for="sea_view">
                        <input v-model="seaView" @click="this.filters[0].sea_view = !this.filters[0].sea_view"  name="sea_view" type="checkbox">
                        <p>Widok na morze</p>
                    </label>
                    <label for="terrace">
                        <input v-model="terrace" @click="this.filters[0].terrace = !this.filters[0].terrace"  name="terrace" type="checkbox">
                        <p>Taras</p>
                    </label>
                    <label for="balcony">
                        <input v-model="balcony" @click="this.filters[0].balcony = !this.filters[0].balcony"  name="balcony" type="checkbox">
                        <p>Balkon</p>
                    </label>
                    <label for="air_conditioning">
                        <input v-model="air_conditioning" @click="this.filters[0].air_conditioning = !this.filters[0].air_conditioning"  name="air_conditioning" type="checkbox">
                        <p>Klimatyzacja</p>
                    </label>
                    <label for="adapted_for_disabled">
                        <input v-model="adapted_for_disabled" @click="this.filters[0].adapted_for_disabled = !this.filters[0].adapted_for_disabled"  name="adapted_for_disabled" type="checkbox">
                        <p>Przystosowanie dla niepełnosprawnych</p>
                    </label>
                    <div class="search__filter-send-button">
                        <button @click="filterResults">Wyślij wiadomość</button>
                    </div>
                </div>
            </div>
            <div class="search__wrapper" v-if="rooms">
                <div v-for="(room, index) in rooms.data" :key="index" class="search__room">
                    <figure class="search__room-figure">
                        <!-- <img :src="'bed.png' + room.thumbNail" alt=""> -->
                        <img src="@/assets/images/bed.png">
                    </figure>
                    <div class="search__room-content">
                        <h3 class="search__room-title">
                            {{ room.room_type.description }}
                        </h3>
                        <p class="search__room-desc">
                            {{ room.description }}
                        </p>
                        <div class="search__room-features">
                            <span>Udogodnienia</span>
                            <ul>
                                <li v-for="(feature, index) in room.amenities" :key="index">{{ feature.name }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="search__price-col">
                        <span class="search__price">{{ room.price_per_night }} zł/noc</span>
                        <span class="search__price-comment">Za osobę</span>
                        <RouterLink class="search__booking" to="/rezerwacja">Dokonaj rezerwacji</RouterLink>
                        <RouterLink class="search__show-more" :to="`/room/${room.id}`">Zobacz więcej</RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                rooms: [],
                seaView: false,
                startDate: null,
                endDate: null,
                filters: [
                    { sea_view: false },
                    { terrace: false },
                    { balcony: false },
                    { air_conditioning: false },
                    { aadapted_for_disabled: false },
                    { occupancy: null },
                    { start_date: null },
                    { end_date: null },
                ],
                
            }
        },
        methods: {
            filterResults: function () {
                this.filters[6].start_date = this.startDate;
                this.filters[7].end_date = this.endDate;

                console.log(this.filters);
                // this.filters.forEach((element) => {
                //     for (const [key, value] of Object.entries(element)) {
                //         params.append(`${key}`, `${value}`);
                //     }
                // });

                axios.get('https://hotel.mpastuszek.pl/api/bookings/available-rooms', {
                    // params: this.axiosParams
                    params:
                        // sea_view: 'true',
                        this.axiosParams
                    
                })
                .then(response => {
                    this.rooms = response.data
                    // console.log(axiosParams);
                })
                console.log(this.startDate);
                console.log(this.endDate);
            }
        },
        computed: {
            axiosParams() {

                const params = new URLSearchParams();
                this.filters.forEach((element) => {
                    for (const [key, value] of Object.entries(element)) {
                        if (value) {
                            params.append(`${key}`, `${value}`);
                        }
                    }
                });

                

                return params;
                console.log();
                // params.append('sea_view', 'true');

            }
        },
        mounted() {
            axios
                .get('https://hotel.mpastuszek.pl/api/bookings/available-rooms')
                .then(response => {
                    this.rooms = response.data
                    // console.log(this.rooms);
                })
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