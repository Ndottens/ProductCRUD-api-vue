<template>
    <div class="row">
        <div class="col-md-12">
            <p>
                <u class="btn" @click="navigateToDashboard">Dashboard</u>
            </p>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Form</div>
                <div class="card-body" v-if="form">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" v-model="form.category_id">
                            <option value="null">Choose Product</option>
                            <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                        </select>
                        <small class="text-danger">{{
                                errors ? errors.category_id ? errors.category_id[0] + '*' : '' : ''
                            }}</small>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title"
                               v-model="form.title">
                        <small class="text-danger">{{ errors ? errors.title ? errors.title[0] + '*' : '' : '' }}</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" v-model="form.description"
                                  placeholder="Enter description"></textarea>
                        <small class="text-danger">{{
                                errors ? errors.description ? errors.description[0] + '*' : '' : ''
                            }}</small>
                    </div>

                    <button class="btn btn-sm btn-outline-success float-right" @click="edit">Submit</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from './modules/product'

export default {
    name: 'ProductEdit',
    data() {
        return {
            categories: null,
            form: {
                title: null,
                description: null,
                category_id: null
            },
            errors: null
        }
    },
    methods: {
        loadCategories() {
            Product.load().then(({data}) => {
                this.categories = data
            }).catch((error) => {
                this.$root.$emit('error', error)
            })
        },

        loadProduct() {
            Product.loadProduct(this.$route.params.id).then(({data}) => {
                this.form = {
                    title: data.title,
                    description: data.description,
                    category_id: data.category_id
                }
            }).catch((error) => {
                this.$root.$emit('error', error)
            })
        },

        edit() {
            Product.update(this.$route.params.id, this.form).then(({data}) => {
                this.$root.$emit('success', data.message)
                this.$router.push({name: 'products.show', params: {id: data.product.id}})
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
        this.loadProduct()
    }
}
</script>
