<template>
    <div class="single-room">
        <HeroSmall :title="roomTitle" :assetsImage="true" :image="heroImage" />
        <div class="single-room__loader">
            <div class="lds-hourglass"></div>
        </div>
        <Slider :slides="slides" :assetsImage="true" :isSingle="true" />

        <div class="container">
            <div class="single-room__wrapper" v-if="rooms">
                <div
                    v-for="(room, index) in rooms"
                    :key="index"
                    class="single-room__room"
                >
                    <div class="single-room__main-box">
                        <RouterLink
                            class="single-room__back-link"
                            to="/rezerwacja"
                        >
                            <svg
                                width="12"
                                height="8"
                                viewBox="0 0 12 8"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M4.42276 -1.32737e-06C4.54602 -1.31121e-06 4.66928 0.0410615 4.76659 0.129054C4.95472 0.299173 4.95472 0.58075 4.76659 0.750869L1.17259 4.00073L4.76659 7.2506C4.95472 7.42072 4.95472 7.70229 4.76659 7.87241C4.57846 8.04253 4.26706 8.04253 4.07893 7.87241L0.141101 4.31164C-0.0470329 4.14152 -0.0470328 3.85994 0.141101 3.68983L4.07893 0.129054C4.17624 0.0410615 4.2995 -1.34354e-06 4.42276 -1.32737e-06Z"
                                    fill="#DDC261"
                                />
                                <path
                                    d="M0.595217 3.56077L11.5134 3.56077C11.7794 3.56077 12 3.76022 12 4.00073C12 4.24125 11.7794 4.4407 11.5134 4.4407L0.595217 4.4407C0.329235 4.4407 0.108665 4.24125 0.108665 4.00073C0.108665 3.76022 0.329235 3.56077 0.595217 3.56077Z"
                                    fill="#DDC261"
                                />
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
                                <li
                                    v-for="(feature, index) in room.amenities"
                                    :key="index"
                                >
                                    <img
                                        v-if="feature.name == 'Klimatyzacja'"
                                        src="@/assets/images/klimatyzacja.svg"
                                        alt=""
                                    />
                                    <img
                                        v-if="feature.name == 'Taras'"
                                        src="@/assets/images/balkon.svg"
                                        alt=""
                                    />
                                    <img
                                        v-if="feature.name == 'Balkon'"
                                        src="@/assets/images/balkon.svg"
                                        alt=""
                                    />
                                    <img
                                        v-if="
                                            feature.name ==
                                            'Przystosowany dla niepełnosprawnych'
                                        "
                                        src="@/assets/images/inwalida.svg"
                                        alt=""
                                    />
                                    <img
                                        v-if="feature.name == 'Widok na morze'"
                                        src="@/assets/images/sea-view.svg"
                                        alt=""
                                    />
                                    <img
                                        v-if="feature.name == 'Wi-Fi'"
                                        src="@/assets/images/wifi.svg"
                                        alt=""
                                    />
                                    <span>{{ feature.name }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-room__side-box">
                        <div class="single-room__date">
                            <span>Termin</span>
                            <div class="single-room__date-inputs">
                                <input
                                    v-model="startDate"
                                    :min="todayDate"
                                    type="date"
                                    name="booking-start"
                                />
                                <input
                                    v-model="endDate"
                                    :min="startDate"
                                    type="date"
                                    name="booking-start"
                                />
                            </div>
                        </div>
                        <div class="single-room__occupancy">
                            <span>Ilość osób</span>
                            <select
                                v-model="occupancy"
                                name="occupancy"
                                id="occupancy"
                            >
                                <option selected="selected" value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="single-room__catering">
                            <h3>Wyżywienie</h3>
                            <div class="single-room__filter-features">
                                <div for="all-inclusive">
                                    <input
                                        checked="true"
                                        v-model="cateringInput"
                                        value="allInclusive"
                                        name="catering-name"
                                        type="radio"
                                    />
                                    <label>All inclusive</label>
                                </div>
                                <div for="breakfast-dinner">
                                    <input
                                        v-model="cateringInput"
                                        value="breakfastDinner"
                                        name="catering-name"
                                        type="radio"
                                    />
                                    <label>Śniadanie + Obiad</label>
                                </div>
                                <div for="dinner">
                                    <input
                                        v-model="cateringInput"
                                        name="catering-name"
                                        value="dinner"
                                        type="radio"
                                    />
                                    <label>Obiad</label>
                                </div>
                                <div for="breakfast">
                                    <input
                                        v-model="cateringInput"
                                        name="catering-name"
                                        value="breakfast"
                                        type="radio"
                                    />
                                    <label>Śniadanie</label>
                                </div>
                            </div>
                        </div>
                        <div class="single-room__price-box">
                            <button
                                v-if="price == 0"
                                class="single-room__submit"
                                @click="calcPrice"
                            >
                                Pokaż cenę
                            </button>
                            <button
                                v-if="price"
                                class="single-room__submit-clicked"
                                @click="calcPrice"
                            >
                                Aktualizuj cenę
                            </button>
                            <span v-if="price" class="single-room__price"
                                >{{ price }} zł</span
                            >
                            <span v-if="price" class="single-room__suffix"
                                >Łącznie</span
                            >
                            <button
                                v-if="price"
                                class="single-room__submit"
                                @click="submitFirstStep"
                            >
                                Dokonaj rezerwacji
                            </button>
                            <div v-if="error" class="single-room__error-box">
                                <p>{{error}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <BookingForm
            :roomId="roomId"
            :image="heroImage"
            :roomTitle="roomTitle"
            :startDate="startDate"
            :endDate="endDate"
            :occupancy="occupancy"
            :catering="cateringInput"
            :price="price"
        />
        <ContactForm />
    </div>
</template>

<script>
import ContactForm from "@/components/ContactForm.vue";
import HeroSmall from "@/components/HeroSmall.vue";
import BookingForm from "@/components/BookingForm.vue";
import Slider from "@/components/Slider.vue";
import axios from "axios";

export default {
	components:{
		ContactForm,
		HeroSmall,
		BookingForm,
		Slider
	},
    data() {
        return {
            slides: [],
            heroImage: "",
            rooms: [],
            catering: [],
            startDate: null,
            endDate: null,
            roomTitle: "",
            allInclusiveSet: true,
            price: 0,
            pricePerNight: 0,
            occupancy: null,
            todayDate: "",
            diffDays: null,
            roomId: null,
            error: null,

            //v-model
            allInclusive: null,
            breakfastDinner: null,
            dinner: null,
            breakfast: null,
            cateringInput: "allInclusive",

            //Axios price
            breakfastPrice: 0,
            allInclusivePrice: 0,
            breakfastDinnerPrice: 0,
            dinnerPrice: 0,
        };
    },
    methods: {


        submitFirstStep: function () {
            this.calcPrice();
            
            //query converions
            if (this.cateringInput == "allInclusive") {
                this.cateringInput = 'all_inclusive'
            }
            if (this.cateringInput == "breakfastDinner") {
                this.cateringInput = "breakfast_dinner"
            }
            let occupancyConverted = parseInt(this.occupancy);


            axios
            .post('https://hotel.mpastuszek.pl/api/bookings/check', {
                room_id: this.roomId,
                start_date: this.startDate,
                end_date: this.endDate,
                number_of_people: occupancyConverted,
                catering: this.cateringInput,
                amount: this.price,
            })
            .then((response) => {
                this.error = null;


                //booking form display
                const background = document.querySelector(
                    ".booking-form__background"
                );
                const form = document.querySelector(".booking-form");
                background.style.display = "block";
                form.style.display = "block";
            })
            .catch((error) => {
                this.error = null;
                if (error.response) {
                    this.error = error.response.data;
                    // console.log(error.response.status);
                    // console.log(error.response.headers);
                }

                console.log(this.roomId);
                console.log(this.startDate);
                console.log(this.endDate);
                console.log(occupancyConverted);
                console.log(this.cateringInput);
                console.log(this.price);

            });
            
            
        },

        setLocalStorage: function () {
            this.startDate = window.localStorage.getItem("start_date");
            this.endDate = window.localStorage.getItem("end_date");
            this.occupancy = window.localStorage.getItem("occupancy");
        },

        addToLocalStorage: function () {
            if (this.startDate) {
                window.localStorage.setItem("start_date", this.startDate);
            }
            if (this.endDate) {
                window.localStorage.setItem("end_date", this.endDate);
            }
            if (this.occupancy) {
                window.localStorage.setItem("occupancy", this.occupancy);
            }
        },
        getTodayDate: function () {
            let today = new Date();
            let dd = String(today.getDate() + 1).padStart(2, "0");
            let mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
            let yyyy = today.getFullYear();

            today = yyyy + "-" + mm + "-" + dd;
            this.todayDate = today;
        },
        calcPrice: function () {
            this.addToLocalStorage();
            if (this.cateringInput == "allInclusive") {
                this.price =
                    (this.pricePerNight + this.allInclusivePrice) *
                    this.occupancy *
                    this.calcDate;
            } else if (this.cateringInput == "breakfastDinner") {
                this.price =
                    (this.pricePerNight + this.breakfastDinnerPrice) *
                    this.occupancy *
                    this.calcDate;
            } else if (this.cateringInput == "dinner") {
                this.price =
                    (this.pricePerNight + this.dinnerPrice) *
                    this.occupancy *
                    this.calcDate;
            } else if (this.cateringInput == "breakfast") {
                this.price =
                    (this.pricePerNight + this.breakfastPrice) *
                    this.occupancy *
                    this.calcDate;
            } else {
                this.price = 0;
            }
        },
    },
    computed: {
        calcDate() {
            const startDate = new Date(this.startDate);
            const endDate = new Date(this.endDate);
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return (this.diffDays = diffDays);
        },
    },

    mounted() {
        this.setLocalStorage();
        axios
            .get(
                "https://hotel.mpastuszek.pl/api/rooms/" + this.$route.params.id
            )
            .then((response) => {
                this.rooms = response.data;
                this.roomTitle = this.rooms.data.room_type.name;
                this.roomId = this.rooms.data.id,
                this.heroImage = this.rooms.data.photos.hero;
                this.slides = this.rooms.data.photos.gallery;
                this.pricePerNight = this.rooms.data.price_per_night;
                document.querySelector('.lds-hourglass').style.display = 'none';
                console.log(this.roomId);
            });

        axios
            .get("https://hotel.mpastuszek.pl/api/meals")
            .then((response) => {
                this.catering = response.data;

                //catering price
                this.allInclusivePrice = this.catering.data[3].cost;
                this.breakfastDinnerPrice = this.catering.data[2].cost;
                this.dinnerPrice = this.catering.data[1].cost;
                this.breakfastPrice = this.catering.data[0].cost;
                this.calcPrice();
            })
            .catch((error) => {
                console.log(error);
            });
        this.getTodayDate();
    },
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.single-room {
    &__loader {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    &__error-box {
        margin-top: 20px;
        p {
            text-align: center;
            color: red;
        }
    }
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
    &__room {
        margin-bottom: 120px;
        display: flex;
        justify-content: space-between;
        @include breakpoint-max("s-tablet") {
            flex-direction: column-reverse;
        }
    }
    &__main-box {
        flex: 2;
        margin-right: 300px;
        @include breakpoint-max("mobile") {
            margin-right: 0;
        }
    }
    &__side-box {
        flex: 1;
        @include breakpoint-max("s-tablet") {
            margin-bottom: 40px;
        }
    }
    &__back-link {
        margin-bottom: 24px;
        display: inline-block;
        text-decoration: none;
        &:hover {
            span {
                color: $black;
            }
            svg {
                transform: translateX(-5px);
            }
        }
        svg {
            margin-right: 5px;
            transition: 0.3s ease;
        }
        span {
            transition: 0.3s ease;
            font-weight: 600;
            font-size: 1.4rem;
            color: $gold;
        }
    }
    &__title {
        font-weight: 600;
        font-size: 4rem;
        line-height: 4.8rem;
        color: $black;
        margin-bottom: 48px;
    }
    &__text {
        font-weight: 400;
        font-size: 1.4rem;
        line-height: 1.7rem;
        color: $black;
        margin-bottom: 71px;
    }
    &__room-features {
        & > span {
            font-weight: 600;
            font-size: 1.4rem;
            line-height: 1.7rem;
            display: inline-block;
            margin-bottom: 32px;
        }
        ul {
            display: flex;
            list-style: none;
            li {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-right: 33px;
                flex: 1;
                img {
                    width: 32px;
                    height: 32px;
                    margin-bottom: 16px;
                }
                span {
                    font-weight: 400;
                    font-size: 1.4rem;
                    line-height: 1.7rem;
                    color: $black;
                    text-align: center;
                }
            }
        }
    }
    &__date {
        & > span {
            font-weight: 600;
            font-size: 1.6rem;
            line-height: 1.9rem;
            display: inline-block;
            margin-bottom: 19px;
        }
    }
    &__date-inputs {
        display: flex;
        flex-direction: row;
        margin-bottom: 25px;
        @include breakpoint-max("tablet") {
            margin-bottom: 30px;
        }
        @include breakpoint-max("mobile") {
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
                @include breakpoint-max("mobile") {
                    margin-right: 0;
                    margin-bottom: 20px;
                    width: 100%;
                }
            }
        }
    }
    &__occupancy {
        display: flex;
        flex-direction: column;
        margin-bottom: 25px;
        & > span {
            font-weight: 600;
            font-size: 1.6rem;
            line-height: 1.9rem;
            display: inline-block;
            margin-bottom: 19px;
        }
        select {
            border: 1px solid $gold;
            padding: 8px 10px;
            font-family: "Montserrat", sans-serif;
            border-radius: 3px;
        }
    }
    &__catering {
        h3 {
            font-weight: 600;
            font-size: 1.6rem;
            line-height: 1.9rem;
            display: inline-block;
            margin-bottom: 19px;
        }
        label {
        }
    }
    &__filter-features {
        div {
            display: flex;
            margin-bottom: 14px;
        }
    }
    &__price-box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        span {
            text-align: center;
        }
    }
    &__price {
        color: $black;
        font-size: 3.6rem;
        line-height: 4.3rem;
        font-weight: 600;
        margin-top: 16px;
    }
    &__submit {
        margin-top: 16px;
        cursor: pointer;
        @include gold-button;
    }
    &__submit-clicked {
        @include gold-button;
        background-color: $white;
        color: $black;
        cursor: pointer;
    }
}
</style>
