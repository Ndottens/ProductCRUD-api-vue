<template>
    <div class="row">
        <div class="col-md-12">
            <p>
                <u class="btn" @click="navigateToDashboard">Dashboard</u>
            </p>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Form</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" v-model="form.category_id">
                            <option value="null">Choose Product</option>
                            <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                        </select>
                        <small class="text-danger">{{
                                errors ? errors.category_id ? errors.category_id[0] + '*' : '' : '' }}</small>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title" v-model="form.title">
                        <small class="text-danger">{{ errors ? errors.title ? errors.title[0] + '*' : '' : '' }}</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" v-model="form.description"
                                  placeholder="Enter description"></textarea>
                        <small class="text-danger">{{
                                errors ? errors.description ? errors.description[0] + '*' : '' : '' }}</small>
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" @change="uploadFile">
                            <label class="custom-file-label" for="customFile">{{ fileName ? fileName : 'Choose File' }}</label>
                         </div>
                          <small class="text-danger">{{
                                errors ? errors.photo ? errors.photo[0] + '*' : '' : '' }}</small>
                    </div>

                    <button class="btn btn-sm btn-outline-success float-right" @click="save">Submit</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from './modules/product'

export default {
    name: 'ProductCreate',
    data() {
        return {
            categories: null,
            form: {
                title: null,
                description: null,
                category_id: null,
            },
            photo: null,
            fileName: null,
            errors: null
        }
    },
    methods: {
        uploadFile(event) {
            this.photo = event.target.files[0]
            this.fileName = event.target.files[0].name
        },

        save() {
            const data = new FormData();         
            data.append('photo', this.photo);
            
            for (const key in this.form) {
                data.append(`${key}`, this.form[key])
            }

            Product.store(data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(({data}) => {
                this.$root.$emit('success', data.message)
                this.$router.push({name: 'products.show', params: { id: data.product.id }})
            }).catch((error) => {
                this.errors = error.response.data.errors
                this.$root.$emit('error', error.response.data.message)
            })
        },

        loadCategories() {
            Product.load().then(({data}) => {
                this.categories = data
            }).catch((error) => {
                this.$root.$emit('error', error)
            })
        },

        navigateToDashboard() {
            this.$router.push({name: 'products.index'})
        }
    },
    mounted() {
        this.loadCategories()
    }
}
</script>
