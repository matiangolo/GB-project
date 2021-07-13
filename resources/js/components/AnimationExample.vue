<template>
    <div>
        <p v-if="showHoi">Hoi</p>
        <button @click="toggleHoi">iets van tekst</button>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return{
            showHoi: false
        }
    },
    methods:{
        toggleHoi(){
            this.showHoi? this.showHoi = false : this.showHoi = true;
        }
    }
}
</script>

