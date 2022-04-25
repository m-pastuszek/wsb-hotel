<template>
    <section class="contact-form">
        <div class="container">
            <div class="contact-form__wrapper">
                <div class="contact-form__left">
                    <div class="contact-form__content">
                        <h2 class="contact-form__title">
                            KON-<br>TAKT
                        </h2>
                        <h3 class="contact-form__el-title">
                            Adres
                        </h3>
                        <div class="contact-form__info-box">
                            <p>ul. Poznanska 12,  60-324 Poznan, Polska</p>
                        </div>
                        <h3 class="contact-form__el-title">
                            Recepcja
                        </h3>
                        <div class="contact-form__info-box">
                            <a href="mailto:kontakt@prince-resort.com">kontakt@prince-resort.com</a>
                            <a href="tel:+48 233 233 234">+48 233 233 234</a>
                        </div>
                        <h3 class="contact-form__el-title">
                            Dyrekcja hotelu
                        </h3>
                        <div class="contact-form__info-box">
                            <a href="mailto:kontakt@prince-resort.com">kontakt@prince-resort.com</a>
                            <a href="tel:+48 233 233 234">+48 233 233 234</a>
                        </div>
                    </div>
                </div>
                <div class="contact-form__right">
                    <form action="" class="contact-form__form">
                        <label for="name">
                            <p>Imię:</p>
                            <input name="name" type="text" placeholder="Podaj swoje imię">
                        </label>
                        <label for="name">
                            <p>Nazwisko:</p>
                            <input name="surname" type="text" placeholder="Podaj swoje nazwisko">
                        </label>
                        <label for="name">
                            <p>Adres email:</p>
                            <input name="email" type="text" placeholder="Podaj swój email">
                        </label>
                        <label for="message">
                            <p>Twoja wiadomość:</p>
                            <input name="message" type="text" placeholder="Wpisz swoją wiadomość...">
                        </label>
                        <label class="contact-form__checkbox-label" for="rodo">
                            <input name="rodo" type="checkbox">
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut facilisis tristique urna et proin. Bibendum vitae tristique interdum dignissim at ut amet vitae. Sem elit risus, eget feugiat odio vitae duis enim id. Viverra posuere pretium luctus molestie gravida. Eget cras nulla eu semper sit sem pellentesque justo.</span>
                        </label>
                        <label class="contact-form__checkbox-label" for="marketing">
                            <input name="marketing" type="checkbox">
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut facilisis tristique urna et proin. Bibendum vitae tristique interdum dignissim at ut amet vitae. </span>
                        </label>
                        <label for="" class="contact-form__submit-label">
                            <input type="submit" value="Wyślij wiadomość">
                        </label>
                    </form>
                </div>
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

.contact-form {
    background-color: $gold;
    padding: 121px 0;
    &__wrapper {
        display: flex;
        justify-content: space-between;
    }
    &__left, &__right {
        flex: 1;
    }
    &__title {
        font-size: 14.4rem;
        line-height: 12.9rem;
        color: $black;
        letter-spacing: 0.01em;
        margin-bottom: 67px;
    }
    &__el-title {
        font-size: 2.4rem;
        line-height: 2.9rem;
        color: $black;
        font-weight: 600;
        margin-bottom: 16px;
    }
    &__info-box {
        margin-bottom: 32px;
        color: $white;
        &:last-child {
            margin-bottom: 0;
        }
        a {
            color: $white;
            text-decoration: none;
            transition: .3s ease;
            &:first-child {
                margin-right: 32px;
            }
            &:hover {
                color: $black;
            }
        }
    }
    &__form {
        background-color: $white;
        width: 100%;
        height: 100%;
        padding: 48px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
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
    &__checkbox-label {
        display: flex !important;
        align-items: flex-start;
        input {
            width: initial;
            &:hover {
                cursor: pointer;
            }
        }
        span {
            margin-left: 16px;
            font-weight: 400;
            color: $black;
            font-size: 1rem;
            line-height: 1.2rem;
        }
    }
    &__submit-label {
        display: flex !important;
        justify-content: flex-end;
        width: 100%;
        margin-top: 32px;
        input {
            @include gold-button;
            width: initial;
        }
    }
}
</style>