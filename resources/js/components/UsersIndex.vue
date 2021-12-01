<template>
    <div>
        <div class="row mt-4">
            <div class="col-sm-6">
                <div class="input-group">
                    <input
                        v-model="search"
                        type="search"
                        class="form-control border-end-0 border"
                        placeholder="Search"
                    />
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12">
                <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>
                            Full Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Last Logged In
                        </th>
                        <th>
                            Authorized
                        </th>
                        <th>
                            User Type
                        </th>
                    </tr>

                    <tr v-for="user in usersData" :key="user.id">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.last_logged_at }}</td>
                        <td>{{ user.authorized_at }}</td>
                        <td>
                            <button class="btn btn-danger btn-block" @click="newModal(user)">
                                {{ user.type }}
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 offset-6">
                <pagination :data="users" @pagination-change-page="getUsers"></pagination>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog" aria-labelledby="updateType" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateType">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="updateType()">
                    <div class="modal-body">
                        {{selectedID}}
                        <div class="form-group">
                            <select class="browser-default custom-select form-control" name="type_id" id="type_id" v-model="form.type_id">
                                <option v-for="type in types.data" v-bind:key="type.id" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="submit" >Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return {
            users: {},
            paginate : 10,
            search : "",
            types : {},
            selectedID : "",
            currentUser : null,
            form: new Form({
                    id:'',
                    type_id: '',
                })
        }
    },
    watch:{
        paginate: function(value){
            this.getUsers();
        },
        search: function(value){
            this.getUsers();
        }
    },
    computed: {
        usersData (){
            return this.users.data;
        }
    },
    methods: {
        getUsers(page = 1){
            axios.get('/api/users?page='+ page + '&paginate=' + this.paginate + '&q=' + this.search)
            .then(response => {
                this.users = response.data;
            });
        },
        getTypes(){
            axios.get('/api/types')
            .then(response => {
                this.types = response.data;
            });
        },
        newModal(user){
            this.currentUser = user;
            this.form.reset();
            $('#editTypeModal').modal('show');
            this.form.fill(user);
            this.form.type_id = this.types.data.filter(a => {
                if(a.name === user.type){
                    return true;
                }
                return false;
            })[0].id;
        },
        updateType(){
                const _this = this;
                this.form.put('api/user')
                .then(response => {
                    _this.users.data = _this.users.data.map(a => {
                        if(_this.currentUser.id === a.id){
                            a.type_id = _this.form.type_id;
                            a.type = _this.types.data.filter(a => {
                                if(a.id === _this.form.type_id){
                                    return true;
                                }
                                return false;
                            })[0].name;
                        }
                        return a;
                    });
                    console.log(response);
                    // success
                    $('#editTypeModal').modal('hide'); 
                })
            },
    },
    mounted(){
        this.getUsers();
        this.getTypes();
    }
};

</script>
