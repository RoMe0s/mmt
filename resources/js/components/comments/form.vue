<template>
    <div>
        <h3>Comments</h3>
        <ul class="list-group" v-if="elements.length">
            <li class="list-group-item" v-for="element in elements">
                <div class="xs-12">
                    <strong>
                        {{ element.author }}
                    </strong>
                    <small class="float-right">
                        {{ element.created_at }}
                    </small>
                </div>
                <hr />
                <div class="xs-12">
                    {{ element.content }}
                </div>
            </li>
        </ul>
        <hr v-if="elements.length" />
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <input name="author"
                           v-model="author"
                           v-validate="{ required: true, max: 255, regex: /^\s*[a-za-я]+\s+[a-zа-я]+\s*$/ui}"
                           :class="{'is-invalid': errors.has('author')}"
                           class="form-control"
                           placeholder="Author" />
                </div>
                <p class="text-danger" v-if="errors.has('author')">{{ errors.first('author') }}</p>
                <div class="form-group">
                    <textarea name="content"
                              v-model="content"
                              v-validate="'required|max:20000'"
                              :class="{'is-invalid': errors.has('content')}"
                              rows="5"
                              class="form-control"
                              placeholder="Content"></textarea>
                </div>
                <p class="text-danger" v-if="errors.has('content')">{{ errors.first('content') }}</p>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" @click.prevent="saveAll()">
                    Add comment
                </button>
            </div>
        </div>
    </div>
</template>
<script>
 export default {
     props: {
         type: {
             type: String,
             required: true
         },
         id: {
             type: Number,
             required: true
         }
     },
     created() {

         axios.post('/comments/list', {
             type: this.type,
             id: this.id
         }).then((response) => {

             this.elements = response.data.elements;

         }).catch((error) => defaultErrorMessage());

     },
     data() {
         return {
             elements: [],
             author: '',
             content: ''
         }
     },
     methods: {

         saveAll() {

             this.$validator.validateAll().then((valid) => {

                 if(valid) {

                     axios.post('/comments', {
                         type: this.type,
                         id: this.id,
                         author: this.author,
                         content: this.content
                     }).then((response) => {

                         if(response.data.object) {

                             this.elements.push(
                                 response.data.object
                             );

                             this.author = '';

                             this.content = '';

                             this.$validator.reset();

                         } else defaultErrorMessage();

                     }).catch((error) => showValidationErrors(error));

                 }

             });

         }

     }
 }
</script>
