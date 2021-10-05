<template>
    <div class="card bg-dark text-white">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <ul v-for="category in categories" class="list-unstyled custom-hover py-2" style="cursor: default">
                <li class="ml-2" @click="filter(category)">{{ category.title }} <span class="float-right badge-dark mr-2">{{ category.products_count }}</span></li>
            </ul>
        </div>
    </div>
</template>

<style>
.badge-dark {
    border-radius: 2px;
    color: #6ef575;
    background-color: #232323;
}
.custom-hover:hover {
    background-color: #0d1117;
    opacity: 90%;
    border-radius: 2px;
}
</style>

<script>
    import Product from '../module/product'

    export default {
        name: 'CategoryInformation',
        data() {
            return {
                categories: null
            }
        },
        methods: {
            loadCategories() {
                Product.loadCategories().then(({data}) => {
                    this.categories = data
                }).catch((error) => {
                    this.$root.$emit('error', error)
                })
            },
            filter(category) {
                this.$emit('filterCategory', category)
            }
        },
        mounted() {
            this.loadCategories()
        },
    }
</script>
