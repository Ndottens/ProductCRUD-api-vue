<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <u class="btn" @click="navigateToDashboard">Dashboard</u>
                <div class="btn btn-sm btn-outline-primary float-right mt-1" @click="navigateToEdit">Edit Product</div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Products</div>
                    <div class="card-body" v-if="product">
                        <p>{{ product.title }}</p>
                        <p>{{ product.description }}</p>
                        <p>{{ product.category ? product.category.title : ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from './modules/product'
export default {
    name: 'ProductShow',
    data() {
        return {
            product: null
        }
    },
    methods: {
        navigateToDashboard () {
            this.$router.push({ name: 'products.index'})
        },

        navigateToEdit() {
            this.$router.push({ name: 'products.edit', params: { id:this.$route.params.id } })
        },

        loadProduct() {
            Product.loadProduct(this.$route.params.id).then(({ data }) => {
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
