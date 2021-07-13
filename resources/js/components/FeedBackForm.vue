<template>
    <form class="feedback__form">

        <div class="feedback__form__input-container">
            <input @keydown="keyPressed" v-model="email" type="email" class="feedback__form__input" placeholder="Email"
                   id="email" required>
            <label for="email" class="feedback__form__label">Email</label>
        </div>

        <textarea @keydown="keyPressed" v-model="message" rows="10" cols="60" class="feedback__form__input__textArea"
                  placeholder="Vul dit veld in."></textarea>

        <div @click="formSubmitted" class="kiosk__button">Verzenden</div>
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
            message: '',
        }
    },
    methods: {
        keyPressed() {
            this.$emit('key-pressed');
        },
        formSubmitted() {

            let formData = {
                "email": this.email,
                "message": this.message
            };

            //--||Returns/register the answer to the database
            axios.post('/api/survey-questions/question-of-the-day/1', {answer: formData})
                .then(response => {
                    console.log(response)
                })
                .catch(err => console.error(err));
        }
    },
    watch: {
        show(newValue) {
            if (!newValue) {
                this.email = '';
                this.message = '';
            }
        }
    }
}
</script>


<style lang="scss">
@import "resources/sass/variables";
.feedback__form {
    display: flex;
    flex-direction: column;
    //justify-content: space-between;

    max-width: 500rem;
    height: 100%;
    width: 80%;
    padding: 2rem;

    background-color: transparent;


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
            border-bottom: 3px solid rgba(236,155,0);
        }

        &::-webkit-input-placeholder {
            color: gray;
        }

        &__textArea {
            font-size: 1.5rem;
            font-weight: 600;

            &:focus {
                outline: none;
            }
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
