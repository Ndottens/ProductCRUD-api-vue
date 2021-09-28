<template>
    <div class="container my-4">
        <router-view> </router-view>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$root.$on('error', function (error) {
            Vue.$toast.open({
                message: error,
                type: 'error',
            });
        }).$nextTick()

        this.$root.$on('success', function (message) {
            Vue.$toast.open({
                message: message,
                type: 'success',
            });
        }).$nextTick()
    }
}
</script>

<style>
.bg-dark {
    background-color: #161B22 !important;
}
.table-dark {
    background-color: #0D1117 !important;
}

.table-dark th, .table-dark td, .table-dark thead th {
    border-color: #161B22;
}

.text-white {
    color: #f3f0f0 !important;
}

.btn-outline-success:hover {
    color: white !important;
}

.form-control, .form-control:focus {
    color: #a9a9a9 !important;
    background-color: #232931 !important;
    border: 1px solid #161B22 !important;
}

.custom-file-label {
    color: #a9a9a9 !important;
    background-color: #232931 !important;
    border: 1px solid #161B22 !important;
}

.text-danger {
    color: #f75651 !important;
}

.custom-file-label::after {
    color: #a9a9a9 !important;
    background-color: #232931 !important;
}
</style>
