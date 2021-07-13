<template>
    <!--    TODO: create fallback template when no question is available (fallback = expanded leftSide)-->

    <div class="photo-booth" v-if="question"><!--    Show elements only when loaded Using v-if-->
        <h1 class="photo-booth__question" v-if="!showFeedback">{{ question.question }}</h1>
        <h1 class="photo-booth__question" v-if="showFeedback">Bedankt voor uw Feedback!</h1>

        <button @click="photoBoothItemClicked('buttonBad')"
                class="photo-booth__button"
                v-if="badEmojiButton"
                :class="[{'hideIcon': !heartEmojiButton}]">
            <!-- bad Emoji-->
            <div class="emoji emoji--bad">
                <div class="emoji__hand">
                    <div class="emoji__thumb">
                    </div>
                </div>
            </div>
        </button>


        <button @click="photoBoothItemClicked('buttonHeart')"
                class="photo-booth__button"
                v-if="heartEmojiButton"
                :class="[{'hideIcon': !badEmojiButton}]">
            <!-- Love  Emoji-->
            <div class="emoji emoji--love">
                <div class="emoji__heart">
                </div>
            </div>
        </button>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component-Survey mounted.');
        this.getQuestionVar();
    },
    props: [
        'show',
    ],
    data() {
        return {
            question: null,
            badEmojiButton: true,
            heartEmojiButton: true,
            showFeedback: false,
        }
    },
    methods: {
        getQuestionVar() {
            // This will get the question that needs to be shown on the page
            // type: 1 means that the question is a yes/no question
            axios.get('/api/survey-questions/question-of-the-day')
                .then(response => {
                    console.log(response);
                    this.question = response.data;
                })
                .catch(err => {
                        console.log(err);
                        this.$emit('error');
                    }
                )
        },
        photoBoothItemClicked(button) {
            let answer;

            if (button === "buttonHeart") {
                answer = true;
                this.badEmojiButton = false;
            }
            if (button === "buttonBad") {
                answer = false;
                this.heartEmojiButton = false;
            }
            //--||Returns an event to the global Instance
            this.$emit('photo-booth-item-clicked', answer);
        }
    },
    watch: {
        show: function (newValue) {
            // if (newValue) this.showFeedback = true;
            // if (!newValue) this.showFeedback = false;
            //Shorthand
            this.showFeedback = newValue;

            if (!newValue) {
                this.badEmojiButton = true;
                this.heartEmojiButton = true;
            }
        }
    }
}
</script>


<style lang="scss">
@import "../../sass/variables";

.photo-booth {
    display: flex;
    align-content: center;
    align-items: center;
    justify-content: space-around;
    flex-wrap: wrap;

    position: relative;

    width: 100%;
    height: 100%;

    &:after {
        content: "";
        position: absolute;

        height: 90%;
        width: 90%;
        background-color: transparent;
        border: 2px solid $color-primary-kiosk;
        border-radius: 20px;
        box-shadow: 0 0 8px $color-secondary-kiosk;
        z-index: -10;
    }

    &__question {
        display: flex;
        justify-content: center;

        width: 100%;
        height: 10%;
        margin-bottom: 3.5rem;
    }

    &__button {
        display: flex;
        flex-basis: 50%;
        justify-content: space-around;

        position: relative;

        background-color: transparent;

        transition: all .75s;

        &:focus {
            outline: none;
        }
    }
}


///--||Toggle classes
.photo-booth {
    &__button {

        &.hideIcon {
            transform: scale(1.3);
        }
    }
}


.emoji {
    width: 120px;
    height: 120px;
    margin: 15px 15px 40px;
    background: #FFDA6A;
    display: inline-block;
    border-radius: 50%;
    position: relative;
}

.emoji:after {
    position: absolute;
    bottom: -40px;
    font-size: 18px;
    width: 60px;
    left: calc(50% - 30px);
    color: #8A8A8A;
}

.emoji__heart,
.emoji__hand,
.emoji__thumb {
    position: absolute;
}


.emoji__heart:before,
.emoji__heart:after,
.emoji__hand:before,
.emoji__hand:after,
.emoji__thumb:before,
.emoji__thumb:after {
    position: absolute;
    content: '';
}

.emoji--bad {
    background: red;
    transform: rotate(180deg);
}

.emoji--bad:after {
    //content: 'bad';
}

.emoji--bad .emoji__hand {
    left: 25px;
    bottom: 30px;
    width: 20px;
    height: 40px;
    background: #FFFFFF;
    border-radius: 5px;
    z-index: 0;
    animation: hands-up 2s linear infinite;
}

.emoji--bad .emoji__hand:before {
    left: 25px;
    bottom: 5px;
    width: 40px;
    background: inherit;
    height: 10px;
    border-radius: 2px 10px 10px 2px;
    box-shadow: 1px -9px 0 1px #FFFFFF, 2px -19px 0 2px #FFFFFF, 3px -29px 0 3px #FFFFFF;
}

.emoji--bad .emoji__thumb {
    border-bottom: 20px solid #FFFFFF;
    border-left: 20px solid transparent;
    top: -25px;
    right: -25px;
    z-index: 2;
    transform: rotate(5deg);
    transform-origin: 0% 100%;
    animation: thumbs-up 2s linear infinite;
}

.emoji--bad .emoji__thumb:before {
    border-radius: 50% 50% 0 0;
    background: #FFFFFF;
    width: 10px;
    height: 12px;
    left: -10px;
    top: -8px;
    transform: rotate(-15deg);
    transform-origin: 100% 100%;
    box-shadow: -1px 4px 0 -1px #FFFFFF;
}

.emoji--love {
    background: green;
}

.emoji--love:after {
    //content: 'Love';
}

.emoji--love .emoji__heart {
    left: calc(50% - 40px);
    top: calc(50% - 40px);
    width: 80px;
    height: 80px;
    animation: heart-beat 1s linear infinite alternate;
}

.emoji--love .emoji__heart:before,
.emoji--love .emoji__heart:after {
    left: calc(50% - 20px);
    top: calc(50% - 32px);
    width: 40px;
    height: 64px;
    background: #FFFFFF;
    border-radius: 20px 20px 0 0;
}

.emoji--love .emoji__heart:before {
    transform: translate(20px) rotate(-45deg);
    transform-origin: 0 100%;
}

.emoji--love .emoji__heart:after {
    transform: translate(-20px) rotate(45deg);
    transform-origin: 100% 100%;
}


@keyframes heart-beat {
    25% {
        transform: scale(1.1);
    }

    75% {
        transform: scale(0.6);
    }
}

@keyframes hands-up {
    25% {
        transform: rotate(15deg);
    }

    50% {
        transform: rotate(-15deg) translateY(-10px);
    }

    75%,
    100% {

        transform: rotate(0deg);
    }
}

@keyframes thumbs-up {
    25% {
        transform: rotate(20deg);
    }

    50%,
    100% {
        transform: rotate(5deg);
    }
}


</style>
