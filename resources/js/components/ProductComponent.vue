<template>
  <div class="container my-5">
    <div class="row">
      <div class="col-md-4 offset-4">
        <button @click="create" class="btn btn-info d-inline">
          Create<i class="fas fa-plus-circle ml-2"></i>
        </button>
      </div>
      <div class="col">
        <form action="" @submit.prevent="view">
          <div class="input-group mb-3">
            <input
              type="text"
              v-model="search"
              class="form-control"
              placeholder="Search"
            />
            <div class="input-group-append" id="button-addon4">
              <button class="btn btn-info" type="submit">
                <span class="fas fa-search"></span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h4>{{ isEdit ? "Edit" : "Create" }}</h4>
          </div>
          <div class="card-body">
            <alert-error :form="products" :message="error"></alert-error>
            <form @submit.prevent="isEdit ? update() : store()">
              <div class="form-group">
                <label for="">Name</label>
                <input
                  type="text"
                  v-model="products.name"
                  class="form-control"
                  :class="{ 'is-invalid': products.errors.has('name') }"
                />
                <has-error :form="products" field="name"></has-error>
              </div>
              <div class="form-group">
                <label for="">Price</label>
                <input
                  type="text"
                  v-model="products.price"
                  class="form-control"
                  :class="{ 'is-invalid': products.errors.has('price') }"
                />
                <has-error :form="products" field="name"></has-error>
              </div>
              <button class="btn btn-info" type="submit">
                <span class="fas fa-save mr-2"></span>Save
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in product.data" :key="product.id">
              <th scope="row">{{ product.id }}</th>
              <td>{{ product.name }}</td>
              <td>{{ product.price }}</td>
              <td>
                <button class="btn btn-warning" @click="edit(product)">
                  <span class="fas fa-edit mr-2"></span> Edit
                </button>
                <button class="btn btn-danger" @click="deletes(product.id)">
                  <span class="fas fa-trash-alt mr-2"></span>Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <loading :active.sync="isLoading" 
       
        :is-full-page="fullPage"></loading>
        <pagination :data="product" @pagination-change-page="view"></pagination>
      </div>
    </div>
  </div>
</template>

<script>
 import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
  components: {
Loading
  },
  data() {
    return {
      isLoading: false,
      search: "",
      isEdit: false,
      product: {},
      products: new Form({
        name: "",
        price: "",
        id: "",
      }),
      error: "",
    };
  },

  methods: {
    view(page = 1) {
    
      this.$Progress.start();
      this.isLoading=true;
      axios
        .get(
          `http://127.0.0.1:8000/api/product?page=${page}&search=${this.search}`
        )
        .then((response) => {
          
          this.product = response.data;
          this.$Progress.finish();
          this.isLoading=false;
        }).catch(
          response => {
             this.$Progress.fail();
            this.isLoading=false;
          }
        );
    },
    create() {

      this.products.clear();
      this.products.name = "";
      this.products.price = "";
      this.products.reset();
     
    },
    store() {
      this.products
        .post("http://127.0.0.1:8000/api/product", this.products)
        .then((response) => {
          this.view();
          this.products.name = "";
          this.products.price = "";
         
           Toast.fire({
            icon: "success",
            title: "Signed in successfully",
          });
        })
        .catch((response) => {
          this.error = response.response.data.message;
        });
    },
    edit(edit) {
      this.products.clear();
      this.isEdit = true;
      this.products.fill(edit);
    },
    update() {
      this.products
        .put(`http://127.0.0.1:8000/api/product/${this.products.id}`)
        .then((respone) => {
          this.view();
          this.products.reset();
          Toast.fire({
            icon: "success",
            title: "Signed in successfully",
          });
        })
        .catch((response) => {
          this.error = response.response.data.message;
        });
    },
    deletes(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`http://127.0.0.1:8000/api/product/${id}`)
            .then((respone) => {
              this.view();
              Swal.fire({
                title: "Delete",
                icon: "success",
              });
              Toast.fire({
                icon: "success",
                title: "Signed in successfully",
              });
            });
        }
      });
    },
  },
  created() {
    this.view();
  },
};
</script>

