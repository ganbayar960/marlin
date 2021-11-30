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
                            <button class="btn btn-danger btn-block">
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
    </div>
</template>

<script>
export default {
    data(){
        return {
            users: {},
            paginate : 10,
            search : "",
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
    mounted(){
        this.getUsers();
    }
};

</script>
