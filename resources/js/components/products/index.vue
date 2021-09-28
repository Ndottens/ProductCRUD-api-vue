<template>
    <div class="row">
        <div class="col-md-12">
            <p class="btn text-white font-weight-normal">Dashboard | Dark themed</p>
            <div class="btn btn-sm btn-outline-success text-success float-right mt-1" @click="navigateToCreate">Create Product</div>
        </div>
        <div class="col-md-12">
            <div class="card text-white bg-dark">
                <div class="card-header">Products</div>
                <div class="card-body">
                    <table class="table table-striped table-dark" v-if="products">
                        <thead>
                        <tr>
                            <th scope="col" class="text-white font-weight-normal">Title</th>
                            <th scope="col" class="text-white font-weight-normal">Description</th>
                            <th scope="col" class="text-white font-weight-normal">Category</th>
                            <th scope="col" class="text-white font-weight-normal">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in products">
                            <td>{{ product.title }}</td>
                            <td>{{ product.description }}</td>
                            <td>{{ product.category ? product.category.title : '' }}</td>
                            <td>
                                <i class="fas fa-eye text-success" @click="show(product.id)"></i>
                                <i class="fas fa-edit text-info" @click="edit(product.id)"></i>
                                <i class="fas fa-trash-alt text-danger" @click="destroy(product.id)"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from './module/product'

export default {
    name: 'ProductIndex',
    data() {
        return {
            products: null
        }
    },
    methods: {
        loadTable() {
            Product.index().then(({data}) => {
                this.products = data
            }).catch((error) => {
                this.$root.$emit('error', error)
            })
        },

        destroy(id) {
            Product.destroy(id).then(({data}) => {
                this.$root.$emit('success', data.message)
                this.loadTable()
            }).catch((error) => {
                this.$root.$emit('error', error)
            })
        },

        show(id) {
            this.$router.push({name: 'products.show', params: {id: id}})
        },

        edit(id) {
            this.$router.push({name: 'products.edit', params: {id: id}})
        },

        navigateToCreate() {
            this.$router.push({name: 'products.create'})
        },
    },
    mounted() {
        this.loadTable()
    }
}
</script>
