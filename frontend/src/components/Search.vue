<template>
    <section class="search">
        <div class="container">
            <div class="search__filter-wrapper">
                <div class="search__filter-first-row">
                    <div class="search__date">
                        <span>Termin</span>
                        <div class="search__date-inputs">
                            <input v-model="startDate" :min="todayDate" type="date" name="booking-start">
                            <input v-model="endDate" :min="startDate" type="date" name="booking-start">
                        </div>
                    </div>
                    <div class="search__occupancy">
                        <span>Ilość osób</span>
                        <select v-model="occupancy" name="occupancy" id="occupancy">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                </div>
                <div class="search__filter-second-row">
                    <h3>Dodatkowe opcje</h3>
                    <div class="search__filter-features">
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
                            <button @click="filterResults">Szukaj</button>
                        </div>
                    </div>
                </div>
            </div>
            <p v-if="this.searchStatus" class="search__no-results">Brak wyników wyszukiwania. Spróbuj wybrać inne kryteria.</p>
            
            <div class="search__loader-box">
                <div class="lds-hourglass"></div>
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
                        <RouterLink class="search__booking" :to="`/room/${room.id}`">Dokonaj rezerwacji</RouterLink>
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
                searchStatus: false,
                rooms: [
                    {data: []}
                ],
                seaView: false,
                startDate: null,
                endDate: null,
                todayDate: '',
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
            addToLocalStorage: function () {
                window.localStorage.setItem('start_date', this.startDate);
                window.localStorage.setItem('end_date', this.endDate);
                window.localStorage.setItem('occupancy', this.occupancy);
            },
            getTodayDate: function () {
                let today = new Date();
                let dd = String(today.getDate() + 1).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                let yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                this.todayDate = today;
            },
            filterResults: function () {
                this.filters[6].start_date = this.startDate;
                this.filters[7].end_date = this.endDate;
                
                document.querySelector('.lds-hourglass').style.display = 'inline-block';

                

                axios.get('https://hotel.mpastuszek.pl/api/bookings/available-rooms', {
                    
                    params:
                        this.axiosParams
                        
                    
                })
                .then(response => {
                    this.rooms = response.data;
                    document.querySelector('.lds-hourglass').style.display = 'none';

                    if (this.rooms.data.length == 0) {
                        this.searchStatus = true;
                    } else {
                        this.searchStatus = false;
                    }
                })
                this.addToLocalStorage();
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
            }
        },
        mounted() {
            axios
                .get('https://hotel.mpastuszek.pl/api/bookings/available-rooms')
                .then(response => {
                    this.rooms = response.data;
                    document.querySelector('.lds-hourglass').style.display = 'none';
                })
            this.getTodayDate();
        }
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.search {

    .lds-hourglass {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;

    }
    .lds-hourglass:after {
        content: " ";
        display: block;
        border-radius: 50%;
        width: 0;
        height: 0;
        margin: 8px;
        box-sizing: border-box;
        border: 32px solid $gold;
        border-color: $gold transparent $gold transparent;
        animation: lds-hourglass 1.2s infinite;
    }
    @keyframes lds-hourglass {
        0% {
            transform: rotate(0);
            animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }
        50% {
            transform: rotate(900deg);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        100% {
            transform: rotate(1800deg);
        }
    }

    &__loader-box {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    &__wrapper {
        margin-bottom: 108px;
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
    &__filter-wrapper {
        margin-bottom: 108px;
    }
    &__filter-first-row {
        display: flex;
        margin-bottom: 25px;
        @include breakpoint-max('tablet') {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        & > div {
            display: flex;
            flex-direction: column;
            margin-right: 82px;
            & > span {
                font-weight: 600;
                font-size: 1.6rem;
                line-height: 2rem;
                color: $black;
                margin-bottom: 20px;
            }
        }
    }
    &__date-inputs {
        display: flex;
        flex-direction: row;
        @include breakpoint-max('tablet') {
            margin-bottom: 30px;
        }
        @include breakpoint-max('mobile') {
            flex-direction: column;
            width: 100%;
        }
        input {
            border: 1px solid $gold;
            padding: 8px 10px;
            font-family: "Montserrat", sans-serif;
            border-radius: 3px;
            &:first-child {
                margin-right: 20px;
                @include breakpoint-max('mobile') {
                    margin-right: 0;
                    margin-bottom: 20px;
                    width: 100%;
                }
            }
        }
    }

    &__occupancy {
        select {
            border: 1px solid $gold;
            padding: 8px 10px;
            font-family: "Montserrat", sans-serif;
            border-radius: 3px;
        }
    }
    &__filter-second-row {
        & > h3 {
            font-weight: 600;
            font-size: 1.6rem;
            line-height: 2rem;
            color: $black;
            margin-bottom: 20px;
        } 
    }
    &__filter-features {
        display: flex;
        align-items: center;
        @include breakpoint-max('tablet') {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        label {
            display: flex;
            align-items: center;
            margin-right: 32px;
            @include breakpoint-max('tablet') {
                margin-right: 0;
                margin-bottom: 10px;
            }
            p {
                display: block;
                margin-bottom: 4px;
            }
        }
    }
    &__filter-send-button {
        @include breakpoint-max('tablet') {
            margin-top: 20px;
        }
        @include breakpoint-max('mobile') {
            width: 100%;
        }
        button {
            min-width: 275px;
            padding: 12px 20px;
            background-color: $gold;
            border: 1px solid $gold;
            border-radius: 33px;
            font-weight: 600;
            font-size: 1.4rem;
            line-height: 1.7rem;
            color: $white;
            font-family: "Montserrat", sans-serif;
            filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.1));
            cursor: pointer;
            transition: .3s ease;
            @include breakpoint-max('mobile') {
                width: 100%;
            }
            &:focus {
                outline: none;
            }
            &:hover {
                background-color: #FFFFFF;
                color: #252525 !important;
            }
        }
    }
    &__no-results {
        margin-bottom: 108px;
    }
}
</style>