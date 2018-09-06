<template>
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h4 class="text-center">{{ counter }}</h4>
    </div>
</template>
<script>
 export default {
     created() {

         axios.post("/visits").then((response) => {

             this.counter = response.data.counter;

         }).catch((error) => defaultErrorMessage());

     },
     data() {
         return {
             counter: ''
         }
     }
 }
</script>
