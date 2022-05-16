<template>
    <section class="booking-form">
        <div class="booking-form__wrapper">
            <button @click="closeForm" class="booking-form__back-link">
                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.42276 -1.32737e-06C4.54602 -1.31121e-06 4.66928 0.0410615 4.76659 0.129054C4.95472 0.299173 4.95472 0.58075 4.76659 0.750869L1.17259 4.00073L4.76659 7.2506C4.95472 7.42072 4.95472 7.70229 4.76659 7.87241C4.57846 8.04253 4.26706 8.04253 4.07893 7.87241L0.141101 4.31164C-0.0470329 4.14152 -0.0470328 3.85994 0.141101 3.68983L4.07893 0.129054C4.17624 0.0410615 4.2995 -1.34354e-06 4.42276 -1.32737e-06Z" fill="#DDC261"/>
                    <path d="M0.595217 3.56077L11.5134 3.56077C11.7794 3.56077 12 3.76022 12 4.00073C12 4.24125 11.7794 4.4407 11.5134 4.4407L0.595217 4.4407C0.329235 4.4407 0.108665 4.24125 0.108665 4.00073C0.108665 3.76022 0.329235 3.56077 0.595217 3.56077Z" fill="#DDC261"/>
                </svg>
                <span>Powrót</span>
            </button>
            <div class="booking-form__title-row">
                <img class="booking-form__image" :src="image" alt="">
                <div class="booking-form__main-info-box">
                    <h2 class="booking-form__room-title">
                        {{roomTitle}}
                    </h2>
                    <div class="booking-form__date">
                        {{ startDate }} - {{ endDate }}
                    </div>
                    <div class="booking-form__occupancy">
                        Liczba osób: {{ occupancy }}
                    </div>
                    <div class="booking-form__catering">
                        <span v-if="catering == 'allInclusive'">All inclusive</span>
                        <span v-if="catering == 'dinner'">Obiady</span>
                        <span v-if="catering == 'breakfast'">Śniadania</span>
                        <span v-if="catering == 'breakfastDinner'">Śniadania + obiady</span>
                    </div>
                    <div class="booking-form__price-box">
                        <span class="booking-form__prefix">Do zapłaty:</span><span class="booking-form__price">{{price}} zł</span>
                    </div>
                </div>
            </div>
            <div class="booking-form__form-row">
                <div class="booking-form__form-title-box">
                    <h2>Wpisz swoje dane</h2>
                    <svg width="168" height="40" viewBox="0 0 168 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M151.959 20.5C151.333 20.5 150.721 20.4113 150.121 20.2338C149.529 20.0479 149.031 19.7944 148.625 19.4732L149.335 18.193C149.656 18.4549 150.045 18.6662 150.501 18.8268C150.957 18.9873 151.435 19.0676 151.933 19.0676C152.525 19.0676 152.986 18.9493 153.315 18.7127C153.645 18.4676 153.81 18.138 153.81 17.7239C153.81 17.3183 153.657 16.9972 153.353 16.7606C153.049 16.5239 152.559 16.4056 151.883 16.4056H151.071V15.2775L153.607 12.2606L153.822 12.8817H149.056V11.5H155.102V12.6028L152.567 15.6197L151.705 15.1127H152.2C153.29 15.1127 154.105 15.3577 154.646 15.8479C155.195 16.3296 155.47 16.9507 155.47 17.7113C155.47 18.2099 155.343 18.6704 155.09 19.093C154.836 19.5155 154.448 19.8577 153.924 20.1197C153.408 20.3732 152.753 20.5 151.959 20.5Z"
                            fill="#C4C4C4" />
                        <g filter="url(#filter0_d_377_540)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M163.25 16C163.25 9.7868 158.213 4.75 152 4.75C145.787 4.75 140.75 9.7868 140.75 16C140.75 22.2132 145.787 27.25 152 27.25C158.213 27.25 163.25 22.2132 163.25 16ZM164 16C164 9.37258 158.627 4 152 4C145.373 4 140 9.37258 140 16C140 22.6274 145.373 28 152 28C158.627 28 164 22.6274 164 16Z"
                                fill="#C4C4C4" />
                        </g>
                        <circle cx="110" cy="16" r="2" fill="#C4C4C4" />
                        <circle cx="120" cy="16" r="2" fill="#C4C4C4" />
                        <circle cx="130" cy="16" r="2" fill="#C4C4C4" />
                        <path
                            d="M84.9673 20.5V19.3972L88.4912 16.0507C88.787 15.7718 89.0067 15.5268 89.1504 15.3155C89.294 15.1042 89.387 14.9099 89.4292 14.7324C89.4799 14.5465 89.5053 14.3732 89.5053 14.2127C89.5053 13.807 89.3658 13.4944 89.087 13.2746C88.8081 13.0465 88.3982 12.9324 87.8574 12.9324C87.4264 12.9324 87.0335 13.0085 86.6785 13.1606C86.332 13.3127 86.032 13.5451 85.7785 13.8577L84.625 12.9704C84.9715 12.5056 85.4363 12.1465 86.0194 11.893C86.6109 11.631 87.2701 11.5 87.9968 11.5C88.6391 11.5 89.1968 11.6056 89.6701 11.8169C90.1518 12.0197 90.5194 12.3113 90.7729 12.6915C91.0349 13.0718 91.1658 13.5239 91.1658 14.0479C91.1658 14.3352 91.1278 14.6225 91.0518 14.9099C90.9757 15.1887 90.832 15.4845 90.6208 15.7972C90.4095 16.1099 90.1011 16.4606 89.6954 16.8493L86.6658 19.7268L86.3236 19.1056H91.5081V20.5H84.9673Z"
                            fill="#C4C4C4" />
                        <g filter="url(#filter1_d_377_540)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M99.25 16C99.25 9.7868 94.2132 4.75 88 4.75C81.7868 4.75 76.75 9.7868 76.75 16C76.75 22.2132 81.7868 27.25 88 27.25C94.2132 27.25 99.25 22.2132 99.25 16ZM100 16C100 9.37258 94.6274 4 88 4C81.3726 4 76 9.37258 76 16C76 22.6274 81.3726 28 88 28C94.6274 28 100 22.6274 100 16Z"
                                fill="#C4C4C4" />
                        </g>
                        <circle cx="46" cy="16" r="2" fill="#C4C4C4" />
                        <circle cx="56" cy="16" r="2" fill="#C4C4C4" />
                        <circle cx="66" cy="16" r="2" fill="#C4C4C4" />
                        <g filter="url(#filter2_d_377_540)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M35 16C35 7.71573 28.2843 0.999999 20 0.999999C11.7157 1 5 7.71573 5 16C5 24.2843 11.7157 31 20 31C28.2843 31 35 24.2843 35 16ZM36 16C36 7.16344 28.8366 -1.08564e-06 20 -6.99382e-07C11.1634 -3.13124e-07 4 7.16344 4 16C4 24.8366 11.1634 32 20 32C28.8366 32 36 24.8366 36 16Z"
                                fill="#DDC261" />
                        </g>
                        <path d="M19.5371 22V10.8571L20.5143 11.8686H17V10H21.7657V22H19.5371Z" fill="#DDC261" />
                        <defs>
                            <filter id="filter0_d_377_540" x="136" y="4" width="32" height="32" filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                    result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="2" />
                                <feComposite in2="hardAlpha" operator="out" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_377_540" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_377_540" result="shape" />
                            </filter>
                            <filter id="filter1_d_377_540" x="72" y="4" width="32" height="32" filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                    result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="2" />
                                <feComposite in2="hardAlpha" operator="out" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_377_540" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_377_540" result="shape" />
                            </filter>
                            <filter id="filter2_d_377_540" x="0" y="0" width="40" height="40" filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                    result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="2" />
                                <feComposite in2="hardAlpha" operator="out" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_377_540" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_377_540" result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </div>
                <form 
                    @submit.prevent="checkForm"
                    class="booking-form__form"
                    method="post"
                    >
                    <div class="booking-form__full-name">
                        <label for="name">
                            <p>Imię:</p>
                            <input v-model="name" name="name" autocomplete="off" type="text" placeholder="Podaj swoje imię">
                        </label>
                        <label for="name">
                            <p>Nazwisko:</p>
                            <input v-model="surname" name="surname" type="text" placeholder="Podaj swoje nazwisko">
                        </label>
                    </div>
                    <label for="name">
                        <p>Adres email:</p>
                        <input v-model="email" name="email" type="text" placeholder="Podaj swój email">
                    </label>
                    <label for="name">
                        <p>Numer telefonu:</p>
                        <input v-model="phone" name="phone" type="text" placeholder="Podaj swój numer telefonu">
                    </label>
                    <label for="message">
                        <div class="booking-form__message-texts"><p>Życzenia specjalne:</p><p class="optional">opcionalne</p></div>
                        <p class="booking-form__message-info">
                            Realizacja życzeń specjalnych nie jest gwarantowana, ale obiekt postara się spełnić Twoją prośbę. Zawsze możesz dodać życzenie specjalne po sfinalizowaniu rezerwacji!
                        </p>
                        <textarea v-model="message" placeholder="Wpisz swoją wiadomość..." name="" id="" cols="30" rows="3"></textarea>
                    </label>
                    
                    <div class="booking-form__send-button">
                        <button>Następny krok: Przekierowanie do płatności</button>
                    </div>
                    <!-- <div class="booking-form__error-box">
                        <p v-if="errors.length">
                            <b>Proszę poprawić następujące błędy:</b>
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </p>
                    </div> -->
                    <!-- <div v-if="status" class="booking-form__status-box">
                        <span>{{ status }}</span>
                    </div> -->
                </form>
            </div>
        </div>
    </section>
</template>


<script>
    export default {
        data() {
            return {
                
            }
        },
        props: {
            image: String,
            roomTitle: String,
            startDate: String,
            endDate: String,
            occupancy: Number,
            catering: String,
            price: Number,
        },
        methods: {
            closeForm: function () {
                const background = document.querySelector('.booking-form__background');
                const form = document.querySelector('.booking-form');
                background.style.display = "none";
                form.style.display = "none";
            },
            backgroundClose: function () {
                
                const background = document.querySelector('.booking-form__background');
                const form = document.querySelector('.booking-form');
                if (background) {
                    background.addEventListener('click', function () {
                        background.style.display = "none";
                        form.style.display = "none";
                    })
                    
                }
            },
        },
        mounted() {
            this.backgroundClose();
        }
    }
</script>
<style lang="scss" scoped>
@import "@/assets/scss/variables.scss";
@import "@/assets/scss/breakpoints.scss";
@import "@/assets/scss/global.scss";
@import "@/assets/scss/mixins.scss";

.booking-form {
    display: none;
    position: fixed;
    top: 2%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 50;
    background-color: $white;
    padding: 24px 48px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
    overflow-y: scroll;
    max-height: 95vh;
    @include breakpoint-max('mobile') {
            width: 100vw;
    }
    &__title-row {
        display: flex;
        padding-bottom: 24px;
        border-bottom: 1px solid $gold;
        @include breakpoint-max('mobile') {
            flex-direction: column;
            align-items: center;
        }
    }
    &__wrapper {
        min-width: 474px;
        @include breakpoint-max('mobile') {
            min-width: initial;
        }
    }
    &__main-info-box {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;
    }
    &__image {
        max-width: 227px;
        object-fit: cover;
        margin-right: 19px;
        @include breakpoint-max('mobile') {
            max-width: 150px;
            margin-bottom: 30px;
        }
    }
    &__back-link {
        margin-bottom: 24px;
        display: inline-block;
        text-decoration: none;
        background-color: transparent;
        border: none;
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
            transition: .3s ease;

        }
        span {
            transition: .3s ease;
            font-weight: 600;
            font-size: 1.4rem;
            color: $gold;
        }
    }
    &__price-box {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
    }
    &__form-title-box {
        margin-top: 24px;
        margin-bottom: 32px;
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        h2 {
            font-size: 2.4rem;
            
        }
    }




    &__form {
        background-color: $white;
        width: 100%;
        height: 100%;
        
        label {
            width: 100%;
            margin-bottom: 30px;
            display: inline-block;
            p {
                color: $gold;
                font-weight: 600;
                font-style: 1.6rem;
                line-height: 1.9rem;
                margin-bottom: 10px;
            }
            textarea {
                width: 100%;
                border: 1px solid $gold;
                resize: none;
                padding: 8px;
                font-family: 'Montserrat', sans-serif;
                &::placeholder {
                    font-size: 1.4rem;
                    color: $lightGray;
                    line-height: 1.7rem;
                    font-weight: 400;
                    font-family: 'Montserrat', sans-serif;

                }
                &:focus {
                    outline: none;
                }
            }
        }
        input {
            width: 100%;
            border: none;
            border-bottom: 1px solid $gold;
            padding: 10px 0;
            font-family: 'Montserrat', sans-serif;
            &::placeholder {
                font-size: 1.4rem;
                color: $lightGray;
                line-height: 1.7rem;
                font-weight: 400;
                font-family: 'Montserrat', sans-serif;

            }
            &:focus {
                outline: none;
            }
        }
    }
    &__full-name {
        display: flex;
        label {
            &:first-child {
                margin-right: 82px;
            }
        }
    }
    &__message-texts {
        display: flex;
        justify-content: space-between;
        .optional {
            font-size: 10px;
            font-weight: 400;
            color: $gray;
        } 
    }
    &__message-info {
        font-weight: 400;
        font-size: 10px;
        line-height: 1.2rem;
        color: $black !important;
    }
    &__send-button {
        display: flex;
        justify-content: flex-end;
        width: 100%;
    }
    &__send-button {
        button {
            @include gold-button;
        }
    }
}
</style>