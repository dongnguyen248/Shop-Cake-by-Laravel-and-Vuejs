<template>
  <div class="container">
    <div class="row pt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Users Table</h3>

            <div style="width:200px; display:inline; margin-left:650px">
              <select
                v-model="filterUser"
                name="filterUser"
                class="form-control"
                style="width:200px; display:inline"
              >
                <option value="all">All type</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal()">
                Add new
                <i class="fa fa-user-plus fa-fw"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>Creaed at</th>
                  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name | upFirst }}</td>
                  <td>{{ user.email }}</td>
                  <td v-if="user.isAdmin == 1">Admin</td>

                  <td v-else>User</td>

                  <td>{{ user.created_at | myDate }}</td>
                  <td>
                    <a href="#">
                      <i class="fa fa-edit text-blue" @click="editModal(user)"></i>
                    </a>
                    /
                    <a href="#">
                      <i class="fa fa-trash text-red" @click="deleteUser(user.id)"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <div>
          <paginate
            :page-count="totalPage"
            :click-handler="getUserPage"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination'"
            :page-class="'page-item'"
            :page-link-class="'page-link'"
            :prev-link-class="'page-link'"
            :next-link-class="'page-link'"
          ></paginate>
        </div>
        <!-- /.card -->
      </div>
    </div>

    <div
      class="modal fade"
      id="userModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="userModal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEdit ? "Edit user" : "Add new" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="isEdit ? updateUser() : createUser()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                  placeholder="Name"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                  placeholder="Password"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                  placeholder="Email address"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <select
                  v-model="form.type"
                  name="type"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has('type')
                                    }"
                >
                  <option value>Select User Role</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">{{ isEdit ? "Update" : "Create" }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  watch: {
    filterUser() {
      console.log(this.filterUser);
      this.getUserFilter();
    }
  },
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        password: "",
        email: "",
        type: ""
      }),
      users: [],
      totalPage: 1,
      isEdit: false,
      filterUser: "all"
    };
  },
  methods: {
    newModal() {
      this.isEdit = false;
      this.form.reset();
      this.form.clear();
      $("#userModal").modal("show");
    },
    editModal(user) {
      this.isEdit = true;
      this.form.clear();
      this.form.reset();
      $("#userModal").modal("show");
      this.form.fill(user);
    },
    createUser() {
      this.form.post("api/user").then(({ data }) => {
        $("#userModal").modal("hide");
        this.getUser();
        Toast.fire({
          icon: "success",
          title: "Creaed user in successfully"
        });
      });
    },
    getUser() {
      this.$Progress.start();
      axios.get("api/user").then(({ data }) => {
        this.users = data.data;
        console.log(this.users[0].isAdmin);

        this.totalPage = data.last_page;
      });
      this.$Progress.finish();
    },
    getUserPage(page) {
      axios.get("api/user?page=" + page).then(({ data }) => {
        this.users = data.data;
        this.totalPage = data.last_page;
      });
    },
    getUserFilter() {
      axios.get("api/user/filter/" + this.filterUser).then(({ data }) => {
        this.users = data.data;
        this.totalPage = data.last_page;
      });
    },
    updateUser() {
      this.form.put("api/user/" + this.form.id).then(() => {
        $("#userModal").modal("hide");
        this.getUser();
        Toast.fire({
          icon: "success",
          title: "Updated user in successfully"
        });
      });
    },
    deleteUser(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("api/user/" + id)
            .then(response => {
              Swal.fire("Deleted!", "User has been deleted.", "success");
              this.getUser();
            })
            .catch(() => {
              Swal.fire("Failed!", "There was something wronge.", "warning");
            });
        }
      });
    }
  },
  mounted() {
    this.getUser();
  }
};
</script>
