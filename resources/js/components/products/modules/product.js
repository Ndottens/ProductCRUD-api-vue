import axios from 'axios'

export default class Product {

    static index() {
        return axios.get('http://127.0.0.1:8000/api/products')
    }

    static store(form) {
        return axios.post('http://127.0.0.1:8000/api/products', form)
    }

    static destroy(id) {
        return axios.delete(`http://127.0.0.1:8000/api/products/${id}`)
    }

    static update(id, form) {
        return axios.patch(`http://127.0.0.1:8000/api/products/${id}`, form)
    }

    static loadProduct(id) {
        return axios.get(`http://127.0.0.1:8000/api/products/${id}`)
    }

    static load() {
        return axios.get('http://127.0.0.1:8000/api/categories')
    }
}
