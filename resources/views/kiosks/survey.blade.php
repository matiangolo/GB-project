<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('includes.favicon-meta')

    <title>{{ config('app.name', 'Carrefour Market') }} | Bevraging Kiosk</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/survey-kiosk.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/survey-kiosk.js') }}" defer></script>

    <script>
        window._asset = '{{ asset('') }}';
    </script>

</head>
<body>

<main id="app">

    <div class="exit-button-wrapper" v-if="showExitButton">
        <div class="exit-button-wrapper__exit-button" @click="hideForms"></div>
    </div>


    <div class="app__left" :class="[{'hideForm': showRightForm}]">
        <div class="app__left__photo-wrapper" :class="[{'expandedLeftForm': showRightForm}]">
            <div class="app__left__logo-box">
                <img class="app__left__logo-box__logo" :src="asset('image/logo-market.png')" alt="Main logo">
            </div>
            <div class="app__left__survey">
                <photo-booth
                    @photo-booth-item-clicked="photoBoothItemClicked"
                    :show="showLeftForm"
{{--                    I would write this as a method--}}
                    v-on:error="questionError = true; showRightForm = true">
                </photo-booth>
            </div>
        </div>
        <div class="app__left__form" :class="[{'SlideUpLeftForm': showLeftForm}]">
            <reward-form
                @key-pressed="resetTimer"
                @form-submitted="formSubmitted"
                :show="showLeftForm">
            </reward-form>
        </div>
    </div>


    <div class="app__right" :class="[{'expandedForm': showRightForm}, {'expandedLeftForm': showLeftForm}]">

        <div class="app__right__top">
            <h1 class="app__right__top__title">Wij horen graag uw feedback</h1>
            <h2 class="app__right__top__subtitle">Scan de QR code:</h2>
            <div class="app__right__top__QR__container">
                <img class="app__right__top__QR__container__QR" src="{{asset('image/pngFiles/QR-benjamin.png')}}"
                     alt="Insert QR code">
            </div>
            <button class="kiosk__button" @click="qrCodeButtonClicked" v-if="!showRightForm">Of klik voor een kort
                formulier
            </button>
        </div>

        <div class="app__right__bottom" :class="[{'SlideUpRightForm': showRightForm}]">
            <feedback-form
                @key-pressed="resetTimer"
                :show="showRightForm">
            </feedback-form>
        </div>
    </div>
</main>

</body>
</html>
