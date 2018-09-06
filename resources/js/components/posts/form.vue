<template>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                {{ object === null ? "Add new" : "Edit" }} post
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
                <textarea name="content"
                        rows="5"
                        v-model="content"
                        v-validate="'required|max:20000'"
                        class="form-control"
                        :class="{'is-invalid': errors.has('content')}"
                        placeholder="Content"></textarea>
            </div>
            <p class="text-danger" v-if="errors.has('content')">{{ errors.first('content') }}</p>
            <div class="form-group">
                <button class="btn btn-danger float-right"
                        v-if="typeof old_file === 'string' && old_file.length"
                        @click.prevent="deleteFile()">
                    Delete existing file
                </button>
                <input name="file"
                       type="file"
                       @change="fileUploaded"
                       v-validate="'size:2048'"
                       :class="{'is-invalid': errors.has('file')}" />
            </div>
            <p class="text-danger" v-if="errors.has('file')">{{ errors.first('file') }}</p>
        </div>
        <div class="card-footer">
            <a :href="`/categories/${category_id}`" class="btn btn-secondary" role="button">
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
         category_id: {
             type: Number,
             required: true
         },
         object: {
             type: Object,
             default: null
         }
     },
     data() {
         return {
             file: '',
             old_file: this.loadModelData('file'),
             name: this.loadModelData('name'),
             content: this.loadModelData('content')
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

                     let url = `/posts/${this.category_id}`;

                     if(this.object !== null) {

                         url += `/${this.object['id']}`;

                     }

                     let formData = new FormData();

                     formData.append('name', this.name);

                     formData.append('file', this.file);

                     formData.append('old_file', this.old_file);

                     formData.append('content', this.content);

                     axios.post(url, formData, {
                         headers: {
                             'Content-Type': 'multipart/form-data'
                         }
                     }).then((response) => {

                         if(response.data.status) {

                             window.location.href = `/categories/${this.category_id}`;

                         } else showMessage(
                             "Nothing was changed",
                             "error"
                         );

                     }).catch((error) => showValidationErrors(error));

                 }

             });

         },
         fileUploaded(event) {

             this.file = event.target.files[0];

             this.old_file = '';

         },
         deleteFile() {

             this.old_file = '';

         }

     }
 }
</script>
