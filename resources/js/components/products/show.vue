<template>
    <div class="row">
        <div class="col-md-12">
            <u class="btn" @click="navigateToDashboard">Dashboard</u>
            <div class="btn btn-sm btn-outline-primary float-right mt-1" @click="navigateToEdit">Edit Product</div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>
                <div class="card-body" v-if="product">
                    <p class="font-weight-bolder">Title:
                        <span class="font-weight-normal">{{ product.title }}</span>
                    </p>
                    <p class="font-weight-bolder">Description:
                        <span class="font-weight-normal">{{ product.description }}</span>
                    </p>
                    <p class="font-weight-bolder">Category:
                        <span class="font-weight-normal">{{ product.category ? product.category.title : '' }}</span>
                    </p>
                    <p class="font-weight-bolder">Created At:
                        <span class="font-weight-normal">{{ formatDate(product.created_at) }}</span>
                    </p>

                    <img :src="'http://127.0.0.1:8000/storage/' + product.image" v-if="product.image" style="width: 300px; height: 300px;" alt="image">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from './modules/product'
import moment from 'moment'

export default {
    name: 'ProductShow',
    data() {
        return {
            product: null
        }
    },
    methods: {
        formatDate(date) {
            return moment(date).format('DD-MM-YYYY hh:mm:ss');
        },

        navigateToDashboard() {
            this.$router.push({name: 'products.index'})
        },

        navigateToEdit() {
            this.$router.push({name: 'products.edit', params: {id: this.$route.params.id}})
        },

        loadProduct() {
            Product.loadProduct(this.$route.params.id).then(({data}) => {
                this.product = data
            }).catch((error) => {
                this.$root.$emit('error', error)
            })
        }
    },
    mounted() {
        this.loadProduct()
    }
}
</script>
