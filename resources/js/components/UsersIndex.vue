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

                    <tr v-for="user in users.data" :key="user.id">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.last_logged_at }}</td>
                        <td>{{ user.authorized_at }}</td>
                        <td>
                            <button class="btn btn-danger btn-block" @click="newModal">
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
        <div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="updateType" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateType">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <select class="browser-default custom-select form-control" v-model="type">
                            <option v-for="type in types.data" v-bind:key="type.id" :value="type.id">{{ type.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" >Update</button>
                </div>

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
        }
    },
    watch:{
        paginate: function(value){
            this.getUsers();
        },
        search: function(value){
            this.getUsers();
        },
    },
    methods: {
        getUsers(page = 1){
            axios.get('/api/users?page='+ page + '&paginate=' + this.paginate + '&q=' + this.search)
            .then(response => {
                this.users = response.data;
            });
        }
        },
        getTypes(){
            axios.get('/api/types')
            .then(response => {
                this.types = response.data;
            });
        },
        newModal(){
            $('#typeModal').modal('show');
        },
    },
    mounted(){
        this.getUsers();
        this.getTypes();
    }
};

</script>
