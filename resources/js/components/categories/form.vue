<template>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                {{ object === null ? "Add new" : "Edit" }} category
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <input name="name"
                    v-model="name"
                    v-validate="'required|max:255'"
                    class="form-control"
                    :class="{'is-invalid': errors.has('name')}"
                    placeholder="Name" />
            </div>
            <p class="text-danger" v-if="errors.has('name')">{{ errors.first('name') }}</p>
            <div class="form-group">
                <textarea name="description"
                        rows="5"
                        v-model="description"
                        v-validate="'required|max:255'"
                        class="form-control"
                        :class="{'is-invalid': errors.has('description')}"
                        placeholder="Description"></textarea>
            </div>
            <p class="text-danger" v-if="errors.has('description')">{{ errors.first('description') }}</p>
        </div>
        <div class="card-footer">
            <a href="/" class="btn btn-secondary" role="button">
                Cancel
            </a>
            <button class="btn btn-success" @click.prevent="saveAll()">
                Save
            </button>
        </div>
    </div>
</template>
<script>
 export default {
     props: {
         object: {
             type: Object,
             default: null
         }
     },
     data() {
         return {
             name: this.loadModelData('name'),
             description: this.loadModelData('description')
         }
     },
     methods: {

         loadModelData(key) {

             if(this.object !== null) {

                 return this.object[key];

             }

             return '';

         },
         saveAll() {

             this.$validator.validateAll().then((valid) => {

                 if(valid) {

                     let url = '/categories';

                     if(this.object !== null) {

                         url += `/${this.object['id']}`;

                     }

                     axios.post(url, {
                         name: this.name,
                         description: this.description
                     }).then((response) => {

                         if(response.data.status) {

                             window.location.href = '/';

                         } else showMessage(
                             "Nothing was changed",
                             "error"
                         );

                     }).catch((error) => showValidationErrors(error));

                 }

             });

         }

     }
 }
</script>
