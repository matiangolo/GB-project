<template>
    <form class="reward__form">
        <h1 class="reward__form__title">Vul onderstaand formulier in en maak kans op bijzondere prijzen</h1>

        <div class="reward__form__input-container">
            <input @keydown="keyPressed" v-model="email" type="email" class="reward__form__input" placeholder="Email"
                   id="email" required>
            <label for="email" class="reward__form__label">Email</label>
        </div>

        <div class="reward__form__input-container">
            <input @keydown="keyPressed" v-model="address" type="text" class="reward__form__input" placeholder="Adress"
                   id="adress" required>
            <label for="adress" class="reward__form__label">Adress</label>
        </div>

        <div class="reward__form__input-container reward__form__input-container--split">
            <div class="reward__form__input-container--split__wrapper reward__form__input-container--split__wrapper--1">
                <input @keydown="keyPressed" v-model="street" type="text"
                       class="reward__form__input" placeholder="Straat"
                       id="straat" required>
                <label for="straat" class="reward__form__label">Straat</label>
            </div>

            <div class="reward__form__input-container--split__wrapper reward__form__input-container--split__wrapper--2">
                <input @keydown="keyPressed" v-model="houseNr" type="text"
                       class="reward__form__input" placeholder="Nr."
                       id="huisnummer" required>
                <label for="huisnummer" class="reward__form__label">Nr.</label>
            </div>

            <div class="reward__form__input-container--split__wrapper reward__form__input-container--split__wrapper--3">
                <input @keydown="keyPressed" v-model="postCode" type="text"
                       class="reward__form__input" placeholder="Postcode"
                       id="postcode" required>
                <label for="postcode" class="reward__form__label">Postcode</label>
            </div>
        </div>


        <button @click="formSubmitted" class="kiosk__button">Verzenden</button>
    </form>
</template>

<script>
export default {
    mounted() {
        console.log('Component-reward-form mounted.')
    },
    props: [
        'show',
    ],
    data() {
        return {
            email: '',
            address: '',
            street: '',
            houseNr: '',
            postCode: '',
        }
    },
    methods: {
        keyPressed() {
            this.$emit('key-pressed');
        },
        formSubmitted() {
            let formData = {
                    "email": this.email,
                    "address": this.address,
                    "street": this.street,
                    "houseNr": this.houseNr,
                    "postCode": this.postCode
            };

            this.$emit('form-submitted', formData);
        }
    },

    watch: {
        show(newValue) {
            if (!newValue) {
                this.email = '';
                this.address = '';
                this.street = '';
                this.houseNr = '';
                this.postCode = '';
            }
        }
    },
}
</script>


<style lang="scss">
@import "resources/sass/variables";

.reward__form {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    height: 100%;
    width: 80%;
    padding: 2rem;

    background-color: transparent;

    &__title {
        text-align: center;
        color: black;
    }

    &__input-container--split {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;

        &__wrapper {
            &--1 {
                width: 50%;
            }

            &--2 {
                width: 10%;
            }

            &--3 {
                width: 20%;
            }
        }
    }

    &__input {
        font-size: 1.5rem;
        font-family: inherit;
        color: inherit;
        padding: 1rem 2rem;
        border-radius: 2px;
        background-color: transparent;
        border: none;
        border-bottom: 3px solid rgba($color-primary-kiosk, .6);

        width: 100%;
        display: block;
        transition: all 0.3s;

        &:focus {
            outline: none;
            box-shadow: 0 1rem 2rem rgba($color-primary-kiosk, .15);
            border-bottom: 3px solid $color-secondary-kiosk;
        }

        &:focus:invalid {
            border-bottom: 3px solid rgba(236, 155, 0);
        }

        &::-webkit-input-placeholder {
            color: gray;
        }
    }

    &__label {
        font-size: 1.2rem;
        font-weight: 700;
        margin-left: 2rem;
        margin-top: 0.7rem;
        display: block;
        transition: all 0.3s;

    }

    &__input:placeholder-shown + &__label {
        //select sibling use the same order as used in html//use ~ if the sibling is not directly after the other
        //when placeholder is shown then do 'this' on the label
        opacity: 0;
        visibility: hidden;
        transform: translateY(4rem);
        color: white;
    }
}
</style>
