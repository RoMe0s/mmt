<template>
    <div>
        <ul class="list-group categories-list">
            <li class="list-group-item" v-for="(element, index) in elements">
                <span class="element-title">{{ element['name'] }}</span>
                <div class="btn-group btn-group-sm float-right">
                    <a :href="`/categories/${element['id']}`" class="btn btn-info" role="button">
                        Show
                    </a>
                    <a :href="`/categories/${element['id']}/edit`" class="btn btn-primary">
                        Edit
                    </a>
                    <button class="btn btn-danger" @click.prevent="deleteOne(index)">
                        Destroy
                    </button>
                </div>
            </li>
        </ul>
        <div class="alert alert-info" v-if="!elements.length && loaded">
            Empty
        </div>
    </div>
</template>
<script>
 export default {
     created() {

         axios.post('/categories/list').then((response) => {

             this.elements = response.data.elements;

             this.loaded = true;

         }).catch((error) => {

             this.loaded = true;

             defaultErrorMessage();

         });

     },
     data() {
         return {
             loaded: false,
             elements: []
         }
     },
     methods: {

         deleteOne(index) {

             closureQuestion(() => {

                 axios.delete(`/categories/${this.elements[index]['id']}`).then((response) => {

                     if(response.data.status) {

                         showMessage(
                             "Deleted"
                         );

                         this.$delete(
                             this.elements,
                             index
                         );

                     }

                 }).catch(() => defaultErrorMessage());

             }, 'warning', 'Record will be deleted');

         }

     }
 }
</script>
