<template>
    <div class="row">
        <div class="col-md-12">
            <u class="btn font-weight-normal text-white" @click="navigateToDashboard">Dashboard</u>
            <div class="btn btn-sm btn-outline-primary text-white float-right mt-1" @click="navigateToEdit">Edit Product</div>
        </div>
        <div class="col-md-12">

            <div class="card bg-dark text-white">
                <div class="row no-gutters">
                    <div class="col-auto">
                        <img class="img-fluid" :src="'http://127.0.0.1:8000/storage/' + product.image" v-if="product ? product.image: false" style="width: 300px; height: 300px;" alt="image">
                    </div>
                    <div class="col">
                        <div class="card-body px-5 mt-5" v-if="product">
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
                                <span class="font-weight-normal">{{ product.created_at }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from './module/product'

export default {
    name: 'ProductShow',
    data() {
        return {
            product: null
        }
    },
    methods: {
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
